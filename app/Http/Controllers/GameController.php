<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Progress;
use App\Models\Soal;
use App\Models\Achievement;
use App\Models\GameHistory;

class GameController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN LEVEL
    |--------------------------------------------------------------------------
    */
    public function level()
    {
        // CEK LOGIN
        if (!Auth::check()) {
            return redirect('/login');
        }

        // USER LOGIN
        $user = Auth::user();

        // PROGRESS PLAYER
        $progress = Progress::firstOrCreate(
            ['user_id' => $user->id],
            [
                'score' => 0,
                'last_soal_id' => 0,
                'high_score' => 0,
                'level' => 1,
                'combo' => 0,
                'last_index' => 0
            ]
        );

        // XP PLAYER
        $xp = $progress->high_score * 10;

        // LEVEL PLAYER
        $playerLevel = floor($xp / 100) + 1;

        // RETURN VIEW
        return view('game.level', compact('progress', 'xp', 'playerLevel'));
    }

    /*
    |--------------------------------------------------------------------------
    | START GAME
    |--------------------------------------------------------------------------
    */
    public function start($level)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

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

        // AMBIL SOAL
        $soals = Soal::query()
            ->where('level', '=', $level)
            ->inRandomOrder()
            ->get()
            ->toArray();

        // JIKA SOAL KOSONG
        if (count($soals) == 0) {
            return redirect('/soal')->with('error', 'Soal level ini belum tersedia');
        }

        // CEK LAST INDEX
        $lastIndex = $progress->last_index ?? 0;

        // JIKA INDEX MELEBIHI TOTAL SOAL
        if ($lastIndex >= count($soals)) {
            $lastIndex = 0;
        }

        // SESSION GAME
        session([
            'index' => $lastIndex,
            'level' => $level,
            'combo' => $progress->combo ?? 0,
            'filtered_soal' => $soals
        ]);

        // MESSAGE RESUME
        if ($lastIndex > 0) {
            session()->flash('success', '💾 Progress game berhasil dipulihkan');
        }

        // RETURN VIEW
        return view('game.main', [
            'soal' => $soals[$lastIndex],
            'progress' => $progress,
            'total' => count($soals)
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | JAWAB SOAL
    |--------------------------------------------------------------------------
    */
    public function jawab(Request $request)
    {
        $progress = Progress::firstWhere('user_id', Auth::id());
        $index = session('index');
        $soals = session('filtered_soal');
        $soal = $soals[$index];

        // CEK JAWABAN
        if ($request->jawaban == $soal['jawaban']) {
            // COMBO SYSTEM
            $combo = session('combo', 0);
            $combo++;
            session(['combo' => $combo]);

            // SCORE DASAR
            $scoreTambah = 10;
            $bonusText = '';

            // BONUS COMBO
            if ($combo >= 10) {
                $scoreTambah += 20;
                $bonusText = ' 👑 ULTRA COMBO x10';
            } elseif ($combo >= 5) {
                $scoreTambah += 10;
                $bonusText = ' ⚡ Super Combo x5';
            } elseif ($combo >= 3) {
                $scoreTambah += 5;
                $bonusText = ' 🔥 Combo x3';
            }

            // BONUS LEVEL
            if (session('level') >= 2) {
                $scoreTambah += 5;
            }

            // TAMBAH SCORE
            $progress->score += $scoreTambah;

            // HIGH SCORE
            if ($progress->score > $progress->high_score) {
                $progress->high_score = $progress->score;
            }

            // MESSAGE
            session([
                'message' => '🎉 Jawaban Benar +' . $scoreTambah . $bonusText,
                'status' => 'benar'
            ]);
        } else {
            // RESET COMBO
            session(['combo' => 0]);

            // MESSAGE
            session([
                'message' => '❌ Jawaban Salah, Combo Reset',
                'status' => 'salah'
            ]);
        }

        // UPDATE PROGRESS
        $progress->last_soal_id = $index + 1;
        $progress->level = session('level');
        $progress->combo = session('combo', 0);
        $progress->last_index = session('index');

        // SAVE
        $progress->save();
        
        // ACHIEVEMENT SYSTEM
        // Pemula
        if ($progress->score >= 10) {
            Achievement::firstOrCreate([
                'user_id' => Auth::id(),
                'title' => 'Pemula'
            ], [
                'icon' => '🌱',
                'description' => 'Menyelesaikan quiz pertama'
            ]);
        }

        // Cerdas
        if ($progress->score >= 100) {
            Achievement::firstOrCreate([
                'user_id' => Auth::id(),
                'title' => 'Cerdas'
            ], [
                'icon' => '🧠',
                'description' => 'Mencapai score 100'
            ]);
        }

        // Combo Master
        if (session('combo', 0) >= 10) {
            Achievement::firstOrCreate([
                'user_id' => Auth::id(),
                'title' => 'Combo Master'
            ], [
                'icon' => '🔥',
                'description' => 'Mencapai combo x10'
            ]);
        }

        // RETURN VIEW
        return view('game.penjelasan', [
            'benar' => $soal['jawaban'],
            'jawabanUser' => $request->jawaban,
            'penjelasan' => $soal['penjelasan'],
            'progress' => $progress,
            'soal' => $soal,
            'combo' => session('combo', 0),
            'message' => session('message'),
            'status' => session('status')
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | NEXT SOAL
    |--------------------------------------------------------------------------
    */
    public function next()
    {
        $index = session('index') + 1;
        $soals = session('filtered_soal');

        // JIKA SOAL HABIS
        if ($index >= count($soals)) {
            return redirect('/game/hasil');
        }

        // UPDATE SESSION
        session(['index' => $index]);

        // UPDATE PROGRESS
        $progress = Progress::firstWhere('user_id', Auth::id());
        $progress->last_index = $index;
        $progress->save();

        // RETURN VIEW
        return view('game.main', [
            'soal' => $soals[$index],
            'progress' => $progress,
            'total' => count($soals)
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | HASIL QUIZ
    |--------------------------------------------------------------------------
    */
    public function hasil()
    {
        $progress = Progress::firstWhere('user_id', Auth::id());
        $score = $progress->score;

        // GRADE SYSTEM
        $grade = 'D';
        if ($score >= 90) {
            $grade = 'S';
        } elseif ($score >= 80) {
            $grade = 'A';
        } elseif ($score >= 70) {
            $grade = 'B';
        } elseif ($score >= 60) {
            $grade = 'C';
        }

        // STAR SYSTEM
        $stars = 1;
        if ($score >= 90) {
            $stars = 5;
        } elseif ($score >= 80) {
            $stars = 4;
        } elseif ($score >= 70) {
            $stars = 3;
        } elseif ($score >= 60) {
            $stars = 2;
        }

        // RESET PROGRESS SETELAH QUIZ SELESAI
        $progress->last_index = 0;
        $progress->combo = 0;
        $progress->score = 0; // Mengosongkan score sesi sekarang agar tidak terakumulasi berkelanjutan
        $progress->save();

        // RETURN VIEW
        return view('game.hasil', [
            'score' => $score,
            'high_score' => $progress->high_score,
            'grade' => $grade,
            'stars' => $stars
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LEADERBOARD
    |--------------------------------------------------------------------------
    */
    public function leaderboard()
    {
        $data = Progress::with('user')
            ->orderBy('high_score', 'desc')
            ->get();

        $myId = Auth::id();

        return view('game.leaderboard', compact('data', 'myId'));
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD SOAL
    |--------------------------------------------------------------------------
    */

    // LIST SOAL
    public function soal()
    {
        $data = Soal::orderBy('id', 'desc')->get();
        return view('soal.index', compact('data'));
    }

    // FORM TAMBAH
    public function createSoal()
    {
        return view('soal.create');
    }

    // SIMPAN SOAL
    public function storeSoal(Request $request)
    {
        Soal::create([
            'pertanyaan' => $request->pertanyaan,
            'A' => $request->A,
            'B' => $request->B,
            'C' => $request->C,
            'D' => $request->D,
            'jawaban' => $request->jawaban,
            'penjelasan' => $request->penjelasan,
            'level' => $request->level
        ]);

        return redirect('/soal')->with('success', 'Soal berhasil ditambahkan');
    }

    // FORM EDIT
    public function editSoal($id)
    {
        $soal = Soal::findOrFail($id);
        return view('soal.edit', compact('soal'));
    }

    // UPDATE SOAL
    public function updateSoal(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);
        $soal->update([
            'pertanyaan' => $request->pertanyaan,
            'A' => $request->A,
            'B' => $request->B,
            'C' => $request->C,
            'D' => $request->D,
            'jawaban' => $request->jawaban,
            'penjelasan' => $request->penjelasan,
            'level' => $request->level
        ]);

        return redirect('/soal')->with('success', 'Soal berhasil diupdate');
    }

    // HAPUS SOAL
    public function deleteSoal($id)
    {
        Soal::findOrFail($id)->delete();
        return redirect('/soal')->with('success', 'Soal berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT PERMAINAN
    |--------------------------------------------------------------------------
    */
    public function riwayat()
    {
        $data = GameHistory::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('game.riwayat', compact('data'));
    }
}