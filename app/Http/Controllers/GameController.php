<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Soal;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * ============================================================
     * CEK AKSES LOGIN
     * ============================================================
     */
    private function checkIsGuruOrAdmin()
    {
        return auth()->check();
    }


    /**
     * ============================================================
     * LEADERBOARD
     * ============================================================
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
                (object) [
                    'name' => 'Peringkat 1 (Juara)',
                    'score' => 100,
                    'total_xp' => 1250,
                ],
                (object) [
                    'name' => 'Peringkat 2',
                    'score' => 90,
                    'total_xp' => 980,
                ],
                (object) [
                    'name' => 'Peringkat 3',
                    'score' => 80,
                    'total_xp' => 850,
                ],
                (object) [
                    'name' => 'Peringkat 4',
                    'score' => 70,
                    'total_xp' => 720,
                ],
            ]);
        }

        return view('leaderboard', compact('users'));
    }


    /**
     * ============================================================
     * HALAMAN PILIH LEVEL
     * ============================================================
     */
    public function level()
    {
        $user = auth()->user();

        $hasLevel1 = Soal::where('level', 1)->exists();
        $hasLevel2 = Soal::where('level', 2)->exists();
        $hasLevel3 = Soal::where('level', 3)->exists();

        $playerLevel = $user->level ?? 1;

        $jumlahLevelTerbuka =
            ($hasLevel1 ? 1 : 0) +
            ($hasLevel2 ? 1 : 0) +
            ($hasLevel3 ? 1 : 0);

        return view(
            'game.level',
            compact(
                'playerLevel',
                'hasLevel1',
                'hasLevel2',
                'hasLevel3',
                'jumlahLevelTerbuka'
            )
        );
    }


    /**
     * ============================================================
     * MEMULAI GAME
     * ============================================================
     *
     * Jumlah soal mengikuti jumlah soal yang tersedia
     * pada database.
     */
    public function start($level)
    {
        $level = (int) $level;

        /*
        |--------------------------------------------------------------------------
        | Hanya Level 1, 2, dan 3
        |--------------------------------------------------------------------------
        */
        if (!in_array($level, [1, 2, 3], true)) {
            return redirect()
                ->route('game.level')
                ->with('error', 'Level tidak valid.');
        }


        /*
        |--------------------------------------------------------------------------
        | Bersihkan session game sebelumnya
        |--------------------------------------------------------------------------
        */
        session()->forget([
            'game_soals',
            'game_index',
            'game_benar',
            'game_salah',
            'game_total',
            'game_level',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Cek soal
        |--------------------------------------------------------------------------
        */
        $hasSoal = Soal::where('level', $level)->exists();

        if (!$hasSoal) {
            return redirect()
                ->route('game.level')
                ->with(
                    'error',
                    'Level ' . $level . ' sedang terkunci karena belum memiliki soal.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil semua soal pada level
        |--------------------------------------------------------------------------
        */
        try {
            $soals = Soal::where('level', $level)
                ->inRandomOrder()
                ->get();
        } catch (\Exception $e) {
            $soals = collect([]);
        }


        if ($soals->isEmpty()) {
            return redirect()
                ->route('game.level')
                ->with(
                    'error',
                    'Belum ada soal di database untuk Level ' . $level . '.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan data game ke session
        |--------------------------------------------------------------------------
        */
        session([
            'game_soals' => $soals->pluck('id')->toArray(),
            'game_index' => 0,
            'game_benar' => 0,
            'game_salah' => 0,
            'game_total' => $soals->count(),
            'game_level' => $level,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Soal pertama
        |--------------------------------------------------------------------------
        */
        $soal = $soals->first();


        return view(
            'game.play',
            compact(
                'level',
                'soal',
                'soals'
            )
        );
    }


    /**
     * ============================================================
     * JAWAB SOAL
     * ============================================================
     *
     * Diproses menggunakan AJAX supaya:
     *
     * - warna jawaban langsung berubah
     * - suara benar/salah bisa dimainkan
     * - halaman tidak langsung reload
     * - setelah beberapa detik otomatis ke soal berikutnya
     */
    public function jawab(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi input
        |--------------------------------------------------------------------------
        */
        $request->validate([
            'soal_id' => 'required|integer',
            'jawaban' => 'nullable|string|in:A,B,C,D',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ambil ID soal
        |--------------------------------------------------------------------------
        */
        $soalId = $request->input('soal_id');


        /*
        |--------------------------------------------------------------------------
        | Ambil jawaban user
        |--------------------------------------------------------------------------
        */
        $jawabanUser = strtoupper(
            trim(
                $request->input('jawaban', '')
            )
        );


        /*
        |--------------------------------------------------------------------------
        | Ambil soal
        |--------------------------------------------------------------------------
        */
        try {
            $soal = Soal::find($soalId);
        } catch (\Exception $e) {
            $soal = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Soal tidak ditemukan
        |--------------------------------------------------------------------------
        */
        if (!$soal) {

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Soal tidak ditemukan.',
                ], 404);
            }

            return redirect()
                ->route('game.level')
                ->with(
                    'error',
                    'Soal tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil kunci jawaban
        |--------------------------------------------------------------------------
        */
        $kunci = strtoupper(
            trim(
                $soal->jawaban ??
                $soal->jawaban_benar ??
                ''
            )
        );


        /*
        |--------------------------------------------------------------------------
        | Cek benar / salah
        |--------------------------------------------------------------------------
        */
        $isCorrect =
            $jawabanUser !== '' &&
            $jawabanUser === $kunci;


        /*
        |--------------------------------------------------------------------------
        | Simpan statistik
        |--------------------------------------------------------------------------
        */
        if ($isCorrect) {

            session([
                'game_benar' =>
                    session('game_benar', 0) + 1,
            ]);

        } else {

            session([
                'game_salah' =>
                    session('game_salah', 0) + 1,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Naik ke index berikutnya
        |--------------------------------------------------------------------------
        */
        session([
            'game_index' =>
                session('game_index', 0) + 1,
        ]);


        /*
        |--------------------------------------------------------------------------
        | RESPONSE AJAX
        |--------------------------------------------------------------------------
        */
        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,
                'isCorrect' => $isCorrect,
                'jawabanUser' => $jawabanUser,
                'kunci' => $kunci,
                'message' => $isCorrect
                    ? 'Jawaban benar!'
                    : 'Jawaban salah!',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Fallback jika bukan AJAX
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('game.next');
    }


    /**
     * ============================================================
     * SOAL BERIKUTNYA
     * ============================================================
     */
    public function next()
    {
        $soalIds = session(
            'game_soals',
            []
        );

        $currentIndex = session(
            'game_index',
            0
        );


        /*
        |--------------------------------------------------------------------------
        | Semua soal selesai
        |--------------------------------------------------------------------------
        */
        if (
            empty($soalIds) ||
            $currentIndex >= count($soalIds)
        ) {
            return redirect()
                ->route('game.hasil');
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil ID soal berikutnya
        |--------------------------------------------------------------------------
        */
        $nextSoalId = $soalIds[$currentIndex];


        /*
        |--------------------------------------------------------------------------
        | Level
        |--------------------------------------------------------------------------
        */
        $level = session(
            'game_level',
            1
        );


        /*
        |--------------------------------------------------------------------------
        | Ambil soal
        |--------------------------------------------------------------------------
        */
        try {
            $soal = Soal::find($nextSoalId);
        } catch (\Exception $e) {
            $soal = null;
        }


        if (!$soal) {
            return redirect()
                ->route('game.hasil');
        }


        /*
        |--------------------------------------------------------------------------
        | Tampilkan soal berikutnya
        |--------------------------------------------------------------------------
        */
        return view(
            'game.play',
            compact(
                'level',
                'soal'
            )
        );
    }


    /**
     * ============================================================
     * HASIL GAME
     * ============================================================
     */
    public function hasil()
    {
        /*
        |--------------------------------------------------------------------------
        | Benar
        |--------------------------------------------------------------------------
        */
        $benar = session(
            'game_benar',
            0
        );


        /*
        |--------------------------------------------------------------------------
        | Salah
        |--------------------------------------------------------------------------
        */
        $salah = session(
            'game_salah',
            0
        );


        /*
        |--------------------------------------------------------------------------
        | Total soal
        |--------------------------------------------------------------------------
        */
        $totalSoal = session(
            'game_total',
            0
        );


        /*
        |--------------------------------------------------------------------------
        | Akurasi
        |--------------------------------------------------------------------------
        */
        if ($totalSoal > 0) {

            $akurasi = round(
                ($benar / $totalSoal) * 100
            );

        } else {

            $akurasi = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | Skor
        |--------------------------------------------------------------------------
        */
        $skor = $akurasi;


        /*
        |--------------------------------------------------------------------------
        | XP
        |--------------------------------------------------------------------------
        */
        $tambahanXp = $benar * 10;


        /*
        |--------------------------------------------------------------------------
        | Status kalah
        |--------------------------------------------------------------------------
        */
        $isKalah = $akurasi < 60;


        /*
        |--------------------------------------------------------------------------
        | Grade
        |--------------------------------------------------------------------------
        */
        if ($akurasi >= 90) {

            $grade = 'A';

        } elseif ($akurasi >= 75) {

            $grade = 'B';

        } elseif ($akurasi >= 60) {

            $grade = 'C';

        } else {

            $grade = 'D';
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan hasil user
        |--------------------------------------------------------------------------
        */
        if (auth()->check()) {

            try {

                $user = auth()->user();


                /*
                | Simpan skor tertinggi
                */
                if (
                    $skor >
                    ($user->score ?? 0)
                ) {
                    $user->score = $skor;
                }


                /*
                | Tambahkan XP
                */
                $user->total_xp =
                    ($user->total_xp ?? 0) +
                    $tambahanXp;


                $user->save();

            } catch (\Exception $e) {

                /*
                | Jangan hentikan halaman hasil
                */
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Hasil
        |--------------------------------------------------------------------------
        */
        return view(
            'game.hasil',
            compact(
                'akurasi',
                'skor',
                'grade',
                'benar',
                'salah',
                'totalSoal',
                'isKalah'
            )
        );
    }


    /**
     * ============================================================
     * RIWAYAT
     * ============================================================
     */
    public function riwayat()
    {
        return view(
            'game.riwayat'
        );
    }


    /**
     * ============================================================
     * DAFTAR BANK SOAL
     * ============================================================
     */
    public function soal()
    {
        if (!$this->checkIsGuruOrAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        try {

            $soals = Soal::orderBy(
                    'level',
                    'asc'
                )
                ->orderBy(
                    'id',
                    'asc'
                )
                ->get();

        } catch (\Exception $e) {

            $soals = collect([]);
        }


        return view(
            'soal.index',
            compact('soals')
        );
    }


    /**
     * ============================================================
     * FORM TAMBAH SOAL
     * ============================================================
     */
    public function createSoal()
    {
        if (!$this->checkIsGuruOrAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        return view(
            'soal.create'
        );
    }


    /**
     * ============================================================
     * SIMPAN SOAL
     * ============================================================
     */
    public function storeSoal(Request $request)
    {
        if (!$this->checkIsGuruOrAdmin()) {
            abort(403, 'Akses Ditolak!');
        }


        $request->validate([
            'level' => 'required|integer|in:1,2,3',
            'pertanyaan' => 'required|string',
            'A' => 'required|string',
            'B' => 'required|string',
            'C' => 'required|string',
            'D' => 'required|string',
            'jawaban' => 'required|in:A,B,C,D',
            'penjelasan' => 'nullable|string',
        ]);


        try {

            $targetLevel =
                (int) $request->level;


            Soal::create([
                'level' => $targetLevel,
                'pertanyaan' => $request->pertanyaan,
                'A' => $request->A,
                'B' => $request->B,
                'C' => $request->C,
                'D' => $request->D,
                'jawaban' => $request->jawaban,
                'penjelasan' => $request->penjelasan,
            ]);


            return redirect()
                ->route('soal.index')
                ->with(
                    'success',
                    'Soal Level ' .
                    $targetLevel .
                    ' berhasil ditambahkan!'
                );

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal menambahkan soal: ' .
                    $e->getMessage()
                );
        }
    }


    /**
     * ============================================================
     * FORM EDIT SOAL
     * ============================================================
     */
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

            return redirect()
                ->route('soal.index')
                ->with(
                    'error',
                    'Soal tidak ditemukan.'
                );
        }


        return view(
            'soal.edit',
            compact('soal')
        );
    }


    /**
     * ============================================================
     * UPDATE SOAL
     * ============================================================
     */
    public function updateSoal(
        Request $request,
        $id
    ) {
        if (!$this->checkIsGuruOrAdmin()) {
            abort(403, 'Akses Ditolak!');
        }


        $request->validate([
            'level' => 'required|integer|in:1,2,3',
            'pertanyaan' => 'required|string',
            'A' => 'required|string',
            'B' => 'required|string',
            'C' => 'required|string',
            'D' => 'required|string',
            'jawaban' => 'required|in:A,B,C,D',
            'penjelasan' => 'nullable|string',
        ]);


        try {

            $soal = Soal::find($id);


            if (!$soal) {

                return redirect()
                    ->route('soal.index')
                    ->with(
                        'error',
                        'Soal tidak ditemukan.'
                    );
            }


            $targetLevel =
                (int) $request->level;


            $soal->update([
                'level' => $targetLevel,
                'pertanyaan' => $request->pertanyaan,
                'A' => $request->A,
                'B' => $request->B,
                'C' => $request->C,
                'D' => $request->D,
                'jawaban' => $request->jawaban,
                'penjelasan' => $request->penjelasan,
            ]);


            return redirect()
                ->route('soal.index')
                ->with(
                    'success',
                    'Soal berhasil diperbarui ke Level ' .
                    $targetLevel .
                    '!'
                );

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal memperbarui soal: ' .
                    $e->getMessage()
                );
        }
    }


    /**
     * ============================================================
     * HAPUS SOAL
     * ============================================================
     */
    public function deleteSoal($id)
    {
        if (!$this->checkIsGuruOrAdmin()) {
            abort(403, 'Akses Ditolak!');
        }


        try {

            $soal = Soal::find($id);


            if (!$soal) {

                return redirect()
                    ->route('soal.index')
                    ->with(
                        'error',
                        'Soal tidak ditemukan.'
                    );
            }


            $levelSoal =
                $soal->level;


            $soal->delete();


            return redirect()
                ->route('soal.index')
                ->with(
                    'success',
                    'Soal Level ' .
                    $levelSoal .
                    ' berhasil dihapus!'
                );

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Gagal menghapus soal: ' .
                    $e->getMessage()
                );
        }
    }
}