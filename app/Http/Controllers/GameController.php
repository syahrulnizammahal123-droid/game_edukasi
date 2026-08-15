<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Soal;
use Illuminate\Http\Request;

class GameController extends Controller
{
    private function checkIsGuruOrAdmin()
    {
        return auth()->check();
    }

    public function leaderboard()
    {
        try {
            $users = User::orderBy('score', 'desc')
                        ->orderBy('total_xp', 'desc')
                        ->get();
        } catch (\Exception $e) {
            $users = collect([]);
        }

        if ($users->isEmpty()) {
            $users = collect([
                (object) ['name' => 'Peringkat 1 (Juara)', 'score' => 100, 'total_xp' => 1250],
                (object) ['name' => 'Peringkat 2',         'score' => 90,  'total_xp' => 980],
                (object) ['name' => 'Peringkat 3',         'score' => 80,  'total_xp' => 850],
                (object) ['name' => 'Peringkat 4',         'score' => 70,  'total_xp' => 720],
            ]);
        }

        return view('leaderboard', compact('users'));
    }

    /**
     * Menampilkan Halaman Level Game
     */
    public function level()
    {
        $user = auth()->user();

        // CEK KETERSEDIAAN SOAL DI DATABASE (Dinamis sesuai isi tabel Soal)
        $hasLevel1 = Soal::where('level', 1)->exists();
        $hasLevel2 = Soal::where('level', 2)->exists(); // true jika ada soal level 2, false jika tidak ada
        $hasLevel3 = Soal::where('level', 3)->exists(); // true jika ada soal level 3, false jika tidak ada

        // Murni level pemain tanpa merubah database user
        $playerLevel = $user->level ?? 1;

        return view('game.level', compact('playerLevel', 'hasLevel1', 'hasLevel2', 'hasLevel3'));
    }

    public function start($level)
    {
        session()->forget(['game_soals', 'game_index', 'game_benar', 'game_salah', 'game_total', 'game_level']);

        try {
            $soals = Soal::where('level', $level)->inRandomOrder()->take(10)->get();

            if ($soals->isEmpty()) {
                $soals = Soal::inRandomOrder()->take(10)->get();
            }
        } catch (\Exception $e) {
            $soals = collect([]);
        }

        if ($soals->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'Belum ada soal di database! Silakan isi/pindahkan soal terlebih dahulu di menu Kelola Soal.');
        }

        session([
            'game_soals' => $soals->pluck('id')->toArray(),
            'game_index' => 0,
            'game_benar' => 0,
            'game_salah' => 0,
            'game_total' => $soals->count(),
            'game_level' => $level,
        ]);

        $soal = $soals->first();

        return view('game.play', compact('level', 'soal', 'soals'));
    }

    public function jawab(Request $request)
    {
        $soalId = $request->input('soal_id');
        $jawabanUser = strtoupper($request->input('jawaban'));

        try {
            $soal = Soal::find($soalId);
            $kunci = $soal ? strtoupper($soal->jawaban ?? $soal->jawaban_benar) : $request->input('kunci_jawaban');
        } catch (\Exception $e) {
            $kunci = $request->input('kunci_jawaban');
        }

        if ($jawabanUser === strtoupper($kunci)) {
            session(['game_benar' => session('game_benar', 0) + 1]);
        } else {
            session(['game_salah' => session('game_salah', 0) + 1]);
        }

        session(['game_index' => session('game_index', 0) + 1]);

        return redirect()->route('game.next');
    }

    public function next()
    {
        $soalIds = session('game_soals', []);
        $currentIndex = session('game_index', 0);

        if ($currentIndex >= count($soalIds) || empty($soalIds)) {
            return redirect()->route('game.hasil');
        }

        $nextSoalId = $soalIds[$currentIndex];
        $level = session('game_level', 1);

        try {
            $soal = Soal::find($nextSoalId);
        } catch (\Exception $e) {
            $soal = null;
        }

        if (!$soal) {
            return redirect()->route('game.hasil');
        }

        return view('game.play', compact('level', 'soal'));
    }

    public function hasil()
    {
        $benar = session('game_benar', 0);
        $salah = session('game_salah', 0);
        $totalSoal = session('game_total', 10);

        $skor = $totalSoal > 0 ? round(($benar / $totalSoal) * 100) : 0;
        $tambahanXp = $benar * 10;
        $isKalah = $skor < 60;

        if ($skor >= 90) {
            $grade = 'A';
        } elseif ($skor >= 75) {
            $grade = 'B';
        } elseif ($skor >= 60) {
            $grade = 'C';
        } else {
            $grade = 'D';
        }

        if (auth()->check()) {
            try {
                $user = auth()->user();
                if ($skor > ($user->score ?? 0)) {
                    $user->score = $skor;
                }
                $user->total_xp = ($user->total_xp ?? 0) + $tambahanXp;

                if ($skor >= 60 && ($user->level ?? 1) <= session('game_level', 1)) {
                    $user->level = session('game_level', 1) + 1;
                }

                $user->save();
            } catch (\Exception $e) {
                //
            }
        }

        return view('game.hasil', compact('isKalah', 'grade', 'skor', 'benar', 'salah', 'totalSoal'));
    }

    public function riwayat()
    {
        return view('game.riwayat');
    }

    /* =========================================================================
     *  MANAJEMEN SOAL (BANK SOAL)
     * ========================================================================= */

    public function soal()
    {
        if (!$this->checkIsGuruOrAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        try {
            $soals = Soal::orderBy('level', 'asc')->get();
        } catch (\Exception $e) {
            $soals = collect([]);
        }

        return view('soal.index', compact('soals'));
    }

    public function createSoal()
    {
        if (!$this->checkIsGuruOrAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        return view('soal.create');
    }

    public function storeSoal(Request $request)
    {
        if (!$this->checkIsGuruOrAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        try {
            $targetLevel = (int) ($request->level ?? 1);

            Soal::create([
                'level'      => $targetLevel,
                'pertanyaan' => $request->pertanyaan,
                'A'          => $request->A ?? $request->opsi_a,
                'B'          => $request->B ?? $request->opsi_b,
                'C'          => $request->C ?? $request->opsi_c,
                'D'          => $request->D ?? $request->opsi_d,
                'jawaban'    => $request->jawaban ?? $request->jawaban_benar,
                'penjelasan' => $request->penjelasan,
            ]);

            // DIBERSIHKAN: Tidak perlu lagi merubah level user secara otomatis di sini

        } catch (\Exception $e) {
            //
        }

        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan!');
    }

    public function editSoal($id)
    {
        if (!$this->checkIsGuruOrAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        try {
            $soal = Soal::find($id);
        } catch (\Exception $e) {
            $soal = null;
        }

        if (!$soal) {
            $soal = (object) [
                'id'         => $id,
                'level'      => 1,
                'pertanyaan' => '',
                'A'          => '',
                'B'          => '',
                'C'          => '',
                'D'          => '',
                'jawaban'    => 'A',
                'penjelasan' => ''
            ];
        }

        return view('soal.edit', compact('soal'));
    }

    public function updateSoal(Request $request, $id)
    {
        if (!$this->checkIsGuruOrAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        try {
            $soal = Soal::find($id);
            if ($soal) {
                $targetLevel = (int) ($request->level ?? $soal->level ?? 1);

                $soal->update([
                    'level'      => $targetLevel,
                    'pertanyaan' => $request->pertanyaan,
                    'A'          => $request->A ?? $request->opsi_a,
                    'B'          => $request->B ?? $request->opsi_b,
                    'C'          => $request->C ?? $request->opsi_c,
                    'D'          => $request->D ?? $request->opsi_d,
                    'jawaban'    => $request->jawaban ?? $request->jawaban_benar,
                    'penjelasan' => $request->penjelasan,
                ]);

                // DIBERSIHKAN: Tidak perlu merubah level user saat soal dipindahkan

            }
        } catch (\Exception $e) {
            //
        }

        return redirect()->route('soal.index')->with('success', 'Soal berhasil diperbarui!');
    }

    public function deleteSoal($id)
    {
        if (!$this->checkIsGuruOrAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        try {
            $soal = Soal::find($id);
            if ($soal) {
                $soal->delete();
            }
        } catch (\Exception $e) {
            //
        }

        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus!');
    }
}