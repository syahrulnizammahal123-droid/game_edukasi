<?php

namespace App\Http\Controllers;

use App\Models\Progress;

class LeaderboardController extends Controller
{
    public function index()
    {
        // 1. Ambil progress siswa dari database
        try {
            $leaderboard = Progress::with('user')
                ->whereHas('user', function ($query) {
                    $query->where('role', 'siswa');
                })
                ->orderByDesc('total_xp')
                ->orderByDesc('high_score')
                ->get()
                ->values()
                ->map(function ($progress, $index) {
                    $totalAnswered =
                        ($progress->correct_answer ?? 0) +
                        ($progress->wrong_answer ?? 0);

                    $accuracy = $totalAnswered > 0
                        ? round((($progress->correct_answer ?? 0) / $totalAnswered) * 100)
                        : 0;

                    $name = $progress->user->name ?? 'Peserta';

                    return [
                        'rank' => $index + 1,
                        'user_id' => $progress->user->id ?? null,
                        'name' => $progress->user->name ?? 'Peserta',
                        'initial' => strtoupper(substr($name, 0, 1)),
                        'total_xp' => $progress->total_xp ?? 0,
                        'score' => $progress->high_score ?? 0,
                        'high_score' => $progress->high_score ?? 0,
                        'total_play' => $progress->total_play ?? 0,
                        'correct_answer' => $progress->correct_answer ?? 0,
                        'wrong_answer' => $progress->wrong_answer ?? 0,
                        'accuracy' => $accuracy,
                        'level' => $progress->level ?? 1,
                        'is_current_user' => auth()->id() === ($progress->user->id ?? null),
                    ];
                });
        } catch (\Exception $e) {
            $leaderboard = collect([]);
        }

        return view('leaderboard', [
            'leaderboard' => $leaderboard,
            'leaderboardUpdatedAt' => now()->format('H:i:s'),
        ]);
    }
}
