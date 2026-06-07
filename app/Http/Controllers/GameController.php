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
    */

    public function level()
    {
        $progress = Progress::firstOrCreate(
            ['user_id' => Auth::id()],
            ['score' => 0, 'high_score' => 0, 'last_soal_id' => 0, 'level' => 1, 'combo' => 0, 'last_index' => 0]
        );

        return view('game.level', [
            'playerLevel' => $progress->level,
            'xp'          => $progress->score,
            'progress'    => $progress
        ]);
    }

    public function start($level)
    {
        $progress = Progress::firstOrCreate(
            ['user_id' => Auth::id()],
            ['score' => 0, 'high_score' => 0, 'last_soal_id' => 0, 'level' => $level, 'combo' => 0, 'last_index' => 0]
        );

        $soalIds = Soal::where('level', $level)->inRandomOrder()->pluck('id')->toArray();

        if (empty($soalIds)) {
            return redirect()->route('game.level')->with('error', 'Soal untuk Level ' . $level . ' belum diisi di database.');
        }

        $lastIndex = $progress->last_index ?? 0;
        if ($lastIndex >= count($soalIds)) {
            $lastIndex = 0;
        }

        session([
            'game_level'    => $level,
            'game_soal_ids' => $soalIds,
            'index'         => $lastIndex,
            'combo'         => $progress->combo ?? 0,
            'hearts'        => 3, 
            'correct_count' => $lastIndex == 0 ? 0 : session('correct_count', 0),
            'wrong_count'   => $lastIndex == 0 ? 0 : session('wrong_count', 0),
        ]);

        return view('game.main', [
            'soal'     => Soal::find($soalIds[$lastIndex]),
            'progress' => $progress,
            'total'    => count($soalIds),
            'hearts'   => session('hearts')
        ]);
    }

    public function jawab(Request $request)
    {
        $request->validate(['jawaban' => 'required|string']);

        $progress = Progress::firstWhere('user_id', Auth::id());
        $index    = session('index');
        $soalIds  = session('game_soal_ids');
        
        if (!$soalIds || !isset($soalIds[$index])) {
            return redirect()->route('game.level')->with('error', 'Sesi permainan telah berakhir.');
        }

        $soal = Soal::find($soalIds[$index]);
        $gameOver = false;

        if ($request->jawaban == $soal->jawaban) {
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

            session(['message' => '🎉 Jawaban Benar +' . $scoreTambah, 'status' => 'benar']);
        } else {
            $hearts = session('hearts', 3) - 1;
            session(['combo' => 0, 'wrong_count' => session('wrong_count', 0) + 1, 'hearts' => $hearts]);

            if ($hearts <= 0) {
                $gameOver = true;
                session(['message' => '💀 Game Over! Nyawa kamu habis.', 'status' => 'salah']);
            } else {
                session(['message' => '❌ Jawaban Salah! Sisa Nyawa: ' . $hearts, 'status' => 'salah']);
            }
        }

        $progress->last_soal_id = $soal->id;
        $progress->level        = session('game_level');
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
            return redirect()->route('game.hasil');
        }

        $index   = session('index') + 1;
        $soalIds = session('game_soal_ids');

        if (!$soalIds || $index >= count($soalIds)) {
            return redirect()->route('game.hasil');
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

        $progress->update([
            'total_play'     => $progress->total_play + 1,
            'correct_answer' => $progress->correct_answer + $correctAnswers,
            'wrong_answer'   => $progress->wrong_answer + $wrongAnswers,
        ]);
          
        $grade = $score >= 90 ? 'S' : ($score >= 80 ? 'A' : ($score >= 70 ? 'B' : ($score >= 60 ? 'C' : 'D')));
        $stars = $score >= 90 ? 5 : ($score >= 80 ? 4 : ($score >= 70 ? 3 : ($score >= 60 ? 2 : 1)));

        GameHistory::create([
            'user_id'    => Auth::id(),
            'level'      => session('game_level', 1),
            'score'      => $score,
            'grade'      => $grade,
            'stars'      => $stars,
            'created_at' => now()
        ]);

        $progress->update(['last_index' => 0, 'combo' => 0, 'score' => 0]);
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
        [
            'score' => 0,
            'high_score' => 0,
            'level' => 1
        ]
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

    if ($hour < 12) {
        $greeting = '🌅 Selamat Pagi';
    } elseif ($hour < 15) {
        $greeting = '☀️ Selamat Siang';
    } elseif ($hour < 18) {
        $greeting = '🌇 Selamat Sore';
    } else {
        $greeting = '🌙 Selamat Malam';
    }

    $title = match (true) {
        $level >= 10 => 'Mythic Master',
        $level >= 7  => 'Grand Master',
        $level >= 5  => 'Elite Warrior',
        $level >= 3  => 'Adventure Knight',
        default      => 'Beginner'
    };

    return view('game.leaderboard', compact(
        'progress',
        'xp',
        'level',
        'rank',
        'topPlayers',
        'progressPercent',
        'greeting',
        'title'
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
    | BACKOFFICE / CRUD SOAL FEATURES
    |--------------------------------------------------------------------------
    */
    public function soal()
    {
        $soals = Soal::orderBy('level')->orderBy('id')->get();
        return view('soal.index', compact('soals'));
    }

    public function createSoal()
    {
        return view('soal.create');
    }

    public function storeSoal(Request $request)
    {
        $data = $request->validate([
            'level' => 'required|integer',
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban' => 'required|string',
            'penjelasan' => 'nullable|string',
        ]);

        Soal::create($data);
        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan!');
    }

    public function editSoal($id)
    {
        $soal = Soal::findOrFail($id);
        return view('soal.edit', compact('soal'));
    }

    public function updateSoal(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);
        $data = $request->validate([
            'level' => 'required|integer',
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban' => 'required|string',
            'penjelasan' => 'nullable|string',
        ]);

        $soal->update($data);
        return redirect()->route('soal.index')->with('success', 'Soal berhasil diperbarui!');
    }

    public function deleteSoal($id)
    {
        Soal::findOrFail($id)->delete();
        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus!');
    }

    private function checkAchievements($progress) 
    {
        if ($progress->score >= 10) {
            Achievement::firstOrCreate(['user_id' => Auth::id(), 'title' => 'Pemula'], ['icon' => '🌱', 'description' => 'Menyelesaikan quiz pertama']);
        }
        if ($progress->score >= 100) {
            Achievement::firstOrCreate(['user_id' => Auth::id(), 'title' => 'Cerdas'], ['icon' => '🧠', 'description' => 'Mencapai score 100']);
        }
        if (session('combo', 0) >= 10) {
            Achievement::firstOrCreate(['user_id' => Auth::id(), 'title' => 'Combo Master'], ['icon' => '🔥', 'description' => 'Mencapai combo x10']);
        }
    }
}