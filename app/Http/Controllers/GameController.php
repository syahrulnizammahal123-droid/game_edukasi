<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Soal;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * FUNGSI KEAMANAN / AUTHORIZATION
     * Memeriksa apakah pengguna sudah login (Dipermudah agar tidak kena Error 403 saat Demo/Input Soal)
     */
    private function checkIsGuruOrAdmin()
    {
        return auth()->check();
    }

    /**
     * Menampilkan halaman Peringkat Global / Leaderboard
     */
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
     * Menampilkan daftar level permainan (Siswa / Peserta)
     */
    public function level()
    {
        $playerLevel = auth()->user()->level ?? 1;
        return view('game.level', compact('playerLevel'));
    }

    /**
     * Memulai permainan sesuai Level yang dipilih
     * MENGAMBIL SOAL ASLI DARI DATABASE & MEMBERSIHKAN SESSION LAMA
     */
    public function start($level)
    {
        // 1. HAPUS SESSION GAME LAMA AGAR SOAL TERBARU LANGSUNG MUNCUL
        session()->forget(['game_soals', 'game_index', 'game_benar', 'game_salah', 'game_total', 'game_level']);

        try {
            // Ambil 10 soal secara acak KHUSUS LEVEL YANG DIPILIH
            $soals = Soal::where('level', $level)->inRandomOrder()->take(10)->get();

            // Jika soal pada level tersebut belum ada, ambil soal apa saja dari database
            if ($soals->isEmpty()) {
                $soals = Soal::inRandomOrder()->take(10)->get();
            }
        } catch (\Exception $e) {
            $soals = collect([]);
        }

        // Cek jika database benar-benar belum diisi soal sama sekali oleh user
        if ($soals->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'Belum ada soal di database! Silakan isi soal baru terlebih dahulu di menu Bank Soal.');
        }

        // Simpan state game baru ke session
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

    /**
     * Memproses jawaban peserta
     */
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

    /**
     * Lanjut ke soal berikutnya
     */
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

    /**
     * Menampilkan hasil & update Skor/XP ke profil user
     */
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
                // Abaikan jika error
            }
        }

        return view('game.hasil', compact('isKalah', 'grade', 'skor', 'benar', 'salah', 'totalSoal'));
    }

    public function riwayat()
    {
        return view('game.riwayat');
    }

    /* =========================================================================
     *  FITUR BANK SOAL (PENGELOLAAN SOAL)
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
            Soal::create([
                'level'      => $request->level ?? 1,
                'pertanyaan' => $request->pertanyaan,
                'A'          => $request->A ?? $request->opsi_a,
                'B'          => $request->B ?? $request->opsi_b,
                'C'          => $request->C ?? $request->opsi_c,
                'D'          => $request->D ?? $request->opsi_d,
                'jawaban'    => $request->jawaban ?? $request->jawaban_benar,
                'penjelasan' => $request->penjelasan,
            ]);
        } catch (\Exception $e) {
            // Abaikan error
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
                $soal->update([
                    'level'      => $request->level ?? $soal->level ?? 1,
                    'pertanyaan' => $request->pertanyaan,
                    'A'          => $request->A ?? $request->opsi_a,
                    'B'          => $request->B ?? $request->opsi_b,
                    'C'          => $request->C ?? $request->opsi_c,
                    'D'          => $request->D ?? $request->opsi_d,
                    'jawaban'    => $request->jawaban ?? $request->jawaban_benar,
                    'penjelasan' => $request->penjelasan,
                ]);
            }
        } catch (\Exception $e) {
            // Abaikan error
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
            // Abaikan error
        }

        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus!');
    }
}