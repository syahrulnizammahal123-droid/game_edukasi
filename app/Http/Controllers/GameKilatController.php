<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Progress;
use App\Models\SoalKilat;
use App\Models\GameHistory;

class GameKilatController extends Controller
{
    public function level()
    {
        $progress = Progress::firstOrCreate(
            ['user_id' => Auth::id()],
            ['score' => 0, 'high_score' => 0, 'level' => 1, 'combo' => 0, 'last_index' => 0]
        );

        return view('game_kilat.level', compact('progress'));
    }

    public function start($level)
    {
        $soalIds = SoalKilat::where('level', $level)->pluck('id')->toArray();

        // Jika soal untuk level tersebut masih kosong, buat dummy questions otomatis
        if (empty($soalIds)) {
            $dummyQuestions = [
                [
                    'level' => 1,
                    'pernyataan' => 'IP Address 192.168.1.1 termasuk dalam kategori IP Address Kelas C.',
                    'jawaban_benar' => true,
                    'penjelasan' => 'Benar. Rentang IP kelas C dimulai dari 192.0.0.0 hingga 223.255.255.255.'
                ],
                [
                    'level' => 1,
                    'pernyataan' => 'Berpikir kritis berarti kita harus langsung memercayai semua berita yang memiliki judul bombastis.',
                    'jawaban_benar' => false,
                    'penjelasan' => 'Salah. Fondasi utama berpikir kritis adalah melakukan analisis dan verifikasi data terlebih dahulu.'
                ],
                [
                    'level' => 1,
                    'pernyataan' => 'Kabel UTP Kategori 5e (Cat5e) secara teoritis mampu mentransmisikan data hingga kecepatan 1 Gbps.',
                    'jawaban_benar' => true,
                    'penjelasan' => 'Benar. Kabel Cat5e dirancang untuk mendukung teknologi Gigabit Ethernet.'
                ]
            ];

            foreach ($dummyQuestions as $dummy) {
                SoalKilat::create($dummy);
            }
            
            $soalIds = SoalKilat::where('level', $level)->pluck('id')->toArray();
        }

        // Set Sesi Kuis Kilat
        session([
            'kilat_level' => $level,
            'kilat_soal_ids' => $soalIds,
            'kilat_index' => 0,
            'kilat_score' => 0,
            'kilat_correct' => 0,
            'kilat_wrong' => 0
        ]);

        return redirect()->route('game-kilat.next');
    }

    public function next()
    {
        $soalIds = session('kilat_soal_ids');
        $index = session('kilat_index', 0);

        if (!$soalIds || $index >= count($soalIds)) {
            return redirect()->route('game-kilat.hasil');
        }

        $soal = SoalKilat::find($soalIds[$index]);
        return view('game_kilat.main', compact('soal', 'index', 'soalIds'));
    }

    public function jawab(Request $request)
    {
        $request->validate(['jawaban' => 'required|integer']);
        
        $soalIds = session('kilat_soal_ids');
        $index = session('kilat_index', 0);

        if (!$soalIds || !isset($soalIds[$index])) {
            return redirect()->route('game-kilat.level');
        }

        $soal = SoalKilat::find($soalIds[$index]);
        
        // Logika jika Waktu Habis (Input Value = 9 dari Timer JS)
        if ($request->jawaban == 9) {
            session(['kilat_wrong' => session('kilat_wrong', 0) + 1]);
            $isCorrect = false;
            $status = '❌ WAKTU HABIS! Analisis Masalah Terlalu Lama.';
        } else {
            // Validasi Jawaban User (1 untuk Benar/True, 0 untuk Salah/False)
            $userAns = ($request->jawaban == 1);
            $isCorrect = ($userAns === (bool)$soal->jawaban_benar);

            if ($isCorrect) {
                session(['kilat_score' => session('kilat_score', 0) + 50]);
                session(['kilat_correct' => session('kilat_correct', 0) + 1]);
                $status = '🎉 JAWABAN BENAR! +50 XP';
            } else {
                session(['kilat_wrong' => session('kilat_wrong', 0) + 1]);
                $status = '❌ JAWABAN SALAH! Kurang Teliti.';
            }
        }

        // Pindah ke indeks soal berikutnya
        session(['kilat_index' => $index + 1]);

        return view('game_kilat.penjelasan', compact('soal', 'isCorrect', 'status'));
    }

    public function hasil()
    {
        $progress = Progress::where('user_id', Auth::id())->first();
        $score = session('kilat_score', 0);
        $correct = session('kilat_correct', 0);
        $wrong = session('kilat_wrong', 0);
        
        $total = $correct + $wrong;
        $akurasi = $total > 0 ? round(($correct / $total) * 100) : 0;

        if ($progress && $score > $progress->high_score) {
            $progress->high_score = $score;
            $progress->save();
        }

        // Simpan riwayat permainan ke tabel game_histories
        GameHistory::create([
            'user_id' => Auth::id(),
            'score' => $score,
            'correct_answers' => $correct,
            'wrong_answers' => $wrong,
        ]);

        return view('game_kilat.hasil', compact('score', 'correct', 'wrong', 'akurasi'));
    }

    public function destroySoal($id)
    {
        $soal = SoalKilat::findOrFail($id);
        $soal->delete();
        return redirect()->route('soal.index')->with('success', 'Soal kilat berhasil dihapus!');
    }

    public function editSoal($id)
    {
        $soal = SoalKilat::findOrFail($id);
        return view('game_kilat.edit_soal', compact('soal'));
    }

    public function updateSoal(Request $request, $id)
    {
        $request->validate([
            'level' => 'required|integer',
            'pernyataan' => 'required|string',
            'jawaban_benar' => 'required|boolean',
            'penjelasan' => 'nullable|string'
        ]);

        $soal = SoalKilat::findOrFail($id);
        $soal->update($request->all());

        return redirect()->route('soal.index')->with('success', 'Soal kilat berhasil diperbarui!');
    }
}