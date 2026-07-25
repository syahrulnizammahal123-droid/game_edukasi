<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data pengguna dari database (diurutkan berdasarkan skor tertinggi)
        try {
            $users = User::orderBy('score', 'desc')->get();
        } catch (\Exception $e) {
            $users = collect([]);
        }

        // 2. Jika database kosong/belum siap, gunakan data sampel berstruktur objek agar tidak error
        if ($users->isEmpty()) {
            $users = collect([
                (object) ['name' => 'Siswa A', 'total_xp' => 1250, 'score' => 1250],
                (object) ['name' => 'Siswa B', 'total_xp' => 980,  'score' => 980],
                (object) ['name' => 'Siswa C', 'total_xp' => 850,  'score' => 850],
                (object) ['name' => 'Siswa D', 'total_xp' => 720,  'score' => 720],
                (object) ['name' => 'Siswa E', 'total_xp' => 600,  'score' => 600],
            ]);
        }

        // 3. Render ke view leaderboard HANYA SATU KALI
        return view('leaderboard', compact('users'));
    }
}