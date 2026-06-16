<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Progress;
use App\Models\Soal;
use App\Models\Achievement;
use App\Models\GameHistory;
use App\Models\User;

class GameController extends Controller
{
    public function level()
    {
        $progress = Progress::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'score' => 0,
                'high_score' => 0,
                'last_soal_id' => 0,
                'level' => 1,
                'combo' => 0,
                'last_index' => 0
            ]
        );

        $calculatedLevel = max(1, floor($progress->high_score / 100) + 1);
        
        if ($progress->level != $calculatedLevel && $progress->level < $calculatedLevel) {
            $progress->level = $calculatedLevel;
            $progress->save();
        }

        return view('game.level', [
            'playerLevel' => $progress->level,
            'xp'          => $progress->high_score,
            'progress'    => $progress
        ]);
    }

    public function start($level)
    {
        $progress = Progress::firstWhere('user_id', Auth::id());
        if (!$progress) {
            $progress = Progress::create([
                'user_id' => Auth::id(),
                'score' => 0,
                'high_score' => 0,
                'last_soal_id' => 0,
                'level' => 1,
                'combo' => 0,
                'last_index' => 0
            ]);
        }

        $soalIds = Soal::where('level', $level)->pluck('id')->toArray();

        // OTOMATISASI GENERATE SOAL JIKA DATABASE KOSONG
        if (empty($soalIds)) {
            $textPertanyaan = "Manakah yang merupakan fungsi utama dari Router dalam arsitektur jaringan komputer?";
            $pilihanA = "Menyimpan data permanen pengguna di dalam harddisk lokal";
            $pilihanB = "Menghubungkan dua atau lebih jaringan yang berbeda untuk mendistribusikan paket data";
            $pilihanC = "Menampilkan output visual grafis permainan ke layar monitor";
            $pilihanD = "Melakukan kompilasi kode program PHP menjadi file biner";
            $kunciJawaban = "B";
            $pembahasan = "Router bertugas sebagai perangkat taktis penunjuk jalan yang meredistribusikan paket data antar segmen jaringan lokal maupun eksternal (Internet).";

            if ($level == 2) {
                $textPertanyaan = "Dalam siklus pengembangan perangkat lunak (SDLC), apa tujuan utama dari tahap 'Testing'?";
                $pilihanA = "Menulis ulang seluruh arsitektur database dari awal";
                $pilihanB = "Menjual lisensi aplikasi kuis ke pengguna umum";
                $pilihanC = "Memastikan sistem bebas dari bug/cacat logika sebelum dideploy ke server";
                $pilihanD = "Membuat desain antarmuka grafis menggunakan aplikasi Figma";
                $kunciJawaban = "C";
                $pembahasan = "Tahap pengujian (Testing) dilakukan secara komparatif untuk menjamin reliabilitas fungsional kode program agar sesuai dengan kebutuhan fungsional pengguna.";
            } elseif ($level == 3) {
                $textPertanyaan = "Apa yang dimaksud dengan konsep berpikir kritis 'Analisis Komparatif' dalam pemecahan masalah?";
                $pilihanA = "Menerima informasi mentah secara langsung tanpa melakukan verifikasi data";
                $pilihanB = "Membandingkan dua atau lebih opsi solusi secara sistematis untuk mencari keputusan terbaik";
                $pilihanC = "Menghapus data riwayat permainan dari database server local";
                $pilihanD = "Mengabaikan argumen ilmiah yang dikirimkan oleh sistem komputer";
                $kunciJawaban = "B";
                $pembahasan = "Analisis komparatif mengasah pemikiran kritis untuk menimbang kekuatan dan kelemahan antar variabel solusi demi menghasilkan kesimpulan objektif.";
            }

            $soalAuto = Soal::create([
                'level' => (int)$level,
                'pertanyaan' => $textPertanyaan,
                'A' => $pilihanA,
                'B' => $pilihanB,
                'C' => $pilihanC,
                'D' => $pilihanD,
                'jawaban' => $kunciJawaban,
                'penjelasan' => $pembahasan
            ]);
            $soalIds = [$soalAuto->id];
        }

        session([
            'game_level' => $level,
            'game_soal_ids' => $soalIds,
            'index' => 0,
            'combo' => 0,
            'hearts' => 3,
            'correct_count' => 0,
            'wrong_count' => 0,
        ]);

        $progress->score = 0;
        $progress->combo = 0;
        $progress->last_index = 0;
        $progress->save();

        return view('game.main', [
            'soal'     => Soal::find($soalIds[0]),
            'progress' => $progress,
            'total'    => count($soalIds),
            'hearts'   => 3
        ]);
    }

    public function jawab(Request $request)
    {
        $request->validate(['jawaban' => 'required|string']);
        $progress = Progress::firstWhere('user_id', Auth::id());
        $index    = session('index', 0);
        $soalIds  = session('game_soal_ids');
        
        if (!$soalIds || !isset($soalIds[$index])) {
            return redirect('/game/level')->with('error', 'Sesi arena permainan telah berakhir.');
        }

        $soal = Soal::find($soalIds[$index]);
        $gameOver = false;

        if (strtoupper($request->jawaban) == strtoupper($soal->jawaban)) {
            $combo = session('combo', 0) + 1;
            session(['combo' => $combo, 'correct_count' => session('correct_count', 0) + 1]);

            $scoreTambah = 10;
            if ($combo >= 10) $scoreTambah += 20;
            elseif ($combo >= 5) $scoreTambah += 10;
            elseif ($combo >= 3) $scoreTambah += 5;

            if (session('game_level') >= 2) { $scoreTambah += 5; }
            $progress->score += $scoreTambah;

            if ($progress->score > $progress->high_score) {
                $progress->high_score = $progress->score;
            }

            session(['message' => '🎉 Jawaban Benar +' . $scoreTambah . ' XP', 'status' => 'benar']);
        } else {
            $hearts = session('hearts', 3) - 1;
            session(['combo' => 0, 'wrong_count' => session('wrong_count', 0) + 1, 'hearts' => $hearts]);

            if ($hearts <= 0) {
                $gameOver = true;
                session(['message' => '💀 Game Over! HP/Nyawa pertualangan kamu telah habis.', 'status' => 'salah']);
            } else {
                session(['message' => '❌ Jawaban Salah! Sisa Nyawa Kamu: ' . $hearts, 'status' => 'salah']);
            }
        }

        $progress->last_soal_id = $soal->id;
        $progress->combo        = session('combo', 0);
        $progress->last_index   = $index;
        $progress->save();
        
        $this->checkAchievements($progress);

        return view('game.penjelasan', [
            'benar'       => $soal->jawaban,
            'jawabanUser' => $request->jawaban,
            'penjelasan'  => $soal->penjelasan,
            'progress'    => $progress,
            'soal'        => $soal,
            'combo'       => session('combo', 0),
            'message'     => session('message'),
            'status'      => session('status'),
            'gameOver'    => $gameOver
        ]);
    }

    public function next()
    {
        if (session('hearts', 3) <= 0) {
            return redirect('/game/hasil');
        }

        $index   = session('index', 0) + 1;
        $soalIds = session('game_soal_ids');

        if (!$soalIds || $index >= count($soalIds)) {
            return redirect('/game/hasil');
        }

        session(['index' => $index]);
        $progress = Progress::firstWhere('user_id', Auth::id());
        $progress->last_index = $index;
        $progress->save();

        return view('game.main', [
            'soal'     => Soal::find($soalIds[$index]),
            'progress' => $progress,
            'total'    => count($soalIds),
            'hearts'   => session('hearts')
        ]);
    }

    public function hasil()
    {
        $progress = Progress::firstWhere('user_id', Auth::id());
        $score    = $progress->score;

        $correctAnswers = session('correct_count', 0);
        $wrongAnswers   = session('wrong_count', 0);
        $totalSesiSoal  = $correctAnswers + $wrongAnswers;
        $akurasi = $totalSesiSoal > 0 ? round(($correctAnswers / $totalSesiSoal) * 100) : 0;
          
        $grade = $score >= 90 ? 'S' : ($score >= 80 ? 'A' : ($score >= 70 ? 'B' : ($score >= 60 ? 'C' : 'D')));
        $stars = $score >= 90 ? 5 : ($score >= 80 ? 4 : ($score >= 70 ? 3 : ($score >= 60 ? 2 : 1)));

        GameHistory::create([
            'user_id'    => Auth::id(),
            'level'      => (int)session('game_level', 1),
            'score'      => $score,
            'grade'      => $grade,
            'stars'      => $stars,
            'created_at' => now()
        ]);

        $calculatedLevel = max(1, floor($progress->high_score / 100) + 1);
        $progress->level = $calculatedLevel;
        $progress->last_index = 0;
        $progress->combo = 0;
        $progress->score = 0; 
        $progress->save();

        $isKalah = session('hearts', 3) <= 0;
        session()->forget(['game_soal_ids', 'index', 'combo', 'correct_count', 'wrong_count', 'hearts']);

        return view('game.hasil', [
            'score'      => $score,
            'high_score' => $progress->high_score,
            'grade'      => $grade,
            'stars'      => $stars,
            'akurasi'    => $akurasi,
            'isKalah'    => $isKalah
        ]);
    }

    public function leaderboard()
    {
        $progress = Progress::firstOrCreate(
            ['user_id' => Auth::id()], 
            ['score' => 0, 'high_score' => 0, 'level' => 1]
        );

        $xp = $progress->high_score;
        $level = max(1, floor($xp / 100) + 1);
        $rank = Progress::where('high_score', '>', $progress->high_score)->count() + 1;

        $topPlayers = Progress::with('user')->orderByDesc('high_score')->take(10)->get();
        $progressPercent = min(100, ($xp % 100));
        $hour = now()->format('H');

        if ($hour < 12) { $greeting = '🌅 Selamat Pagi'; }
        elseif ($hour < 15) { $greeting = '☀️ Selamat Siang'; }
        elseif ($hour < 18) { $greeting = '🌇 Selamat Sore'; }
        else { $greeting = '🌙 Selamat Malam'; }

        $title = match (true) {
            $level >= 10 => 'Mythic Master',
            $level >= 7  => 'Grand Master',
            $level >= 5  => 'Elite Warrior',
            $level >= 3  => 'Adventure Knight',
            default      => 'Beginner'
        };

        return view('game.leaderboard', compact('progress', 'xp', 'level', 'rank', 'topPlayers', 'progressPercent', 'greeting', 'title'));
    }

    public function riwayat()
    {
        $data = GameHistory::where('user_id', Auth::id())->latest()->get();
        return view('game.riwayat', compact('data'));
    }

    /**
     * KUNCI INTEGRASI: Mengirim data Pilihan Ganda & Benar-Salah ke halaman Bank Soal
     */
    public function soal()
    {
        $data = Soal::latest()->get(); 
        $soalKilats = \App\Models\SoalKilat::latest()->get(); // <-- Mengambil data game kilat

        return view('soal', [
            'soals'      => $data,
            'soalKilats' => $soalKilats
        ]);
    }

    public function createSoal()
    {
        return view('soal.create');
    }

    public function storeSoal(Request $request)
    {
        $validatedData = $request->validate([
            'level'      => 'required|integer', 
            'pertanyaan' => 'required|string', 
            'A'          => 'required|string', 
            'B'          => 'required|string', 
            'C'          => 'required|string', 
            'D'          => 'required|string', 
            'jawaban'    => 'required|string|max:2', 
            'penjelasan' => 'nullable|string',
        ]);

        Soal::create($validatedData);
        return redirect('/soal')->with('success', 'Soal petualangan baru berhasil ditambahkan!');
    }

    public function editSoal($id)
    {
        $soal = Soal::findOrFail($id);
        return view('soal.edit', compact('soal'));
    }

    public function updateSoal(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);
        $validatedData = $request->validate([
            'level'      => 'required|integer', 
            'pertanyaan' => 'required|string', 
            'A'          => 'required|string', 
            'B'          => 'required|string', 
            'C'          => 'required|string', 
            'D'          => 'required|string', 
            'jawaban'    => 'required|string|max:2', 
            'penjelasan' => 'nullable|string',
        ]);

        $soal->update($validatedData);
        return redirect('/soal')->with('success', 'Data soal kuis berhasil diperbarui!');
    }

    public function deleteSoal($id)
    {
        Soal::findOrFail($id)->delete();
        return redirect('/soal')->with('success', 'Soal kuis berhasil dihapus!');
    }

    private function checkAchievements($progress) 
    {
        if ($progress->score >= 10) {
            Achievement::firstOrCreate(
                ['user_id' => Auth::id(), 'title' => 'Pemula'],
                ['icon' => '🌱', 'description' => 'Menyelesaikan kuis pertama']
            );
        }
        if ($progress->score >= 100) {
            Achievement::firstOrCreate(
                ['user_id' => Auth::id(), 'title' => 'Cerdas'],
                ['icon' => '🧠', 'description' => 'Mencapai skor 100']
            );
        }
        if (session('combo', 0) >= 10) {
            Achievement::firstOrCreate(
                ['user_id' => Auth::id(), 'title' => 'Combo Master'],
                ['icon' => '🔥', 'description' => 'Mencapai rekor kombo x10']
            );
        }
    }
}