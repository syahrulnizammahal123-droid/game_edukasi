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
    /*
    |--------------------------------------------------------------------------
    | CORE GAMEPLAY FEATURES
    |--------------------------------------------------------------------------
    | Fitur Inti Mekanisme Permainan Kuis Petualangan
    */

    public function level()
    {
        // Mengambil atau membuat progres player jika baru pertama kali masuk
        $progress = Progress::firstOrCreate(
            ['user_id' => Auth::id()],
            ['score' => 0, 'high_score' => 0, 'last_soal_id' => 0, 'level' => 1, 'combo' => 0, 'last_index' => 0]
        );

        // Menghitung level secara dinamis berdasarkan akumulasi High Score (Tiap 100 Pts naik 1 level)
        $calculatedLevel = max(1, floor($progress->high_score / 100) + 1);
        
        // Sinkronisasi otomatis level asli player jika terdeteksi ada perubahan kenaikan level
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
                'score' => 0, 'high_score' => 0, 'last_soal_id' => 0, 'level' => 1, 'combo' => 0, 'last_index' => 0
            ]);
        }

        // AMBIL DATA SOAL: Mengambil semua ID Soal yang cocok dengan tingkatan level yang dipilih
        $soalIds = Soal::where('level', $level)->pluck('id')->toArray();

        // VALIDASI DATABASE: Jika bank soal kosong di database, kembali ke menu level agar sistem tidak crash
        if (empty($soalIds)) {
            return redirect('/game/level')->with('error', 'Belum ada soal tersedia di database untuk Level ' . $level);
        }

        // RESET GAME SESSION: Setiap klik tombol mainkan dari luar, sesi pengerjaan wajib diulang dari soal pertama (Index 0)
        session([
            'game_level'    => $level,
            'game_soal_ids' => $soalIds,
            'index'         => 0, 
            'combo'         => 0,
            'hearts'        => 3, 
            'correct_count' => 0,
            'wrong_count'   => 0,
        ]);

        $progress->score = 0; // Reset score sesi aktif berjalan
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
            return redirect('/game/level')->with('error', 'Sesi arena permainan telah berakhir atau kedaluwarsa.');
        }

        $soal = Soal::find($soalIds[$index]);
        $gameOver = false;

        // Validasi kecocokan jawaban user dengan kolom jawaban di database
        if (strtoupper($request->jawaban) == strtoupper($soal->jawaban)) {
            $combo = session('combo', 0) + 1;
            session(['combo' => $combo, 'correct_count' => session('correct_count', 0) + 1]);

            // Kalkulasi bonus pengali skor kuis
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

        // Perhitungan akurasi data taktis player
        $correctAnswers = session('correct_count', 0);
        $wrongAnswers   = session('wrong_count', 0);
        $totalSesiSoal  = $correctAnswers + $wrongAnswers;
        $akurasi = $totalSesiSoal > 0 ? round(($correctAnswers / $totalSesiSoal) * 100) : 0;
          
        $grade = $score >= 90 ? 'S' : ($score >= 80 ? 'A' : ($score >= 70 ? 'B' : ($score >= 60 ? 'C' : 'D')));
        $stars = $score >= 90 ? 5 : ($score >= 80 ? 4 : ($score >= 70 ? 3 : ($score >= 60 ? 2 : 1)));

        // Rekam data riwayat game history ke database
        GameHistory::create([
            'user_id'    => Auth::id(),
            'level'      => session('game_level', 1),
            'score'      => $score,
            'grade'      => $grade,
            'stars'      => $stars,
            'created_at' => now()
        ]);

        // Hitung ulang tingkatan level global akurasi akun pasca game selesai
        $calculatedLevel = max(1, floor($progress->high_score / 100) + 1);
        $progress->level = $calculatedLevel;
        $progress->last_index = 0;
        $progress->combo = 0;
        $progress->score = 0; // Kosongkan score penampung sesi aktif
        $progress->save();

        session()->forget(['game_soal_ids', 'index', 'combo', 'correct_count', 'wrong_count', 'hearts']);

        return view('game.hasil', [
            'score'      => $score,
            'high_score' => $progress->high_score,
            'grade'      => $grade,
            'stars'      => $stars,
            'akurasi'    => $akurasi,
            'isKalah'    => session('hearts', 3) <= 0
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LEADERBOARD & HISTORY FEATURES
    |--------------------------------------------------------------------------
    */
    public function leaderboard()
    {
        $progress = Progress::firstOrCreate(
            ['user_id' => Auth::id()],
            ['score' => 0, 'high_score' => 0, 'level' => 1]
        );

        $xp = $progress->high_score;
        $level = max(1, floor($xp / 100) + 1);
        $rank = Progress::where('high_score', '>', $progress->high_score)->count() + 1;

        $topPlayers = Progress::with('user')
            ->orderByDesc('high_score')
            ->take(10)
            ->get();

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

        return view('game.leaderboard', compact(
            'progress', 'xp', 'level', 'rank', 'topPlayers', 'progressPercent', 'greeting', 'title'
        ));
    }

    public function riwayat()
    {
        $data = GameHistory::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('game.riwayat', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | BACKOFFICE / CRUD BANK SOAL SINKRONISASI DATABASE
    |--------------------------------------------------------------------------
    */
    public function soal()
    {
        $data = Soal::latest()->get(); 
        return view('soal.index', compact('data'));
    }

    public function createSoal()
    {
        return view('soal.create');
    }

    public function storeSoal(Request $request)
    {
        // Penyelarasan kolom validasi mengikuti data Model $fillable asli milikmu (A,B,C,D)
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
        return redirect('/soal')->with('success', 'Soal kuis berhasil dihapus dari sistem!');
    }

    private function checkAchievements($progress) 
    {
        if ($progress->score >= 10) {
            Achievement::firstOrCreate(['user_id' => Auth::id(), 'title' => 'Pemula'], ['icon' => '🌱', 'description' => 'Menyelesaikan kuis pertama']);
        }
        if ($progress->score >= 100) {
            Achievement::firstOrCreate(['user_id' => Auth::id(), 'title' => 'Cerdas'], ['icon' => '🧠', 'description' => 'Mencapai skor akumulasi 100']);
        }
        if (session('combo', 0) >= 10) {
            Achievement::firstOrCreate(['user_id' => Auth::id(), 'title' => 'Combo Master'], ['icon' => '🔥', 'description' => 'Mencapai rekor kombo kuis x10']);
        }
    }
}