<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Soal;
use App\Models\Progress;
use App\Models\GameHistory;
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
        return auth()->check() && auth()->user()->isAdminOrGuru();
    }


    /**
     * ============================================================
     * LEADERBOARD
     * ============================================================
     */
    public function leaderboard()
    {
        $leaderboard = $this->leaderboardRows();

        return view('leaderboard', [
            'leaderboard' => $leaderboard,
            'leaderboardUpdatedAt' => now()->format('H:i:s'),
        ]);
    }

    public function leaderboardData()
    {
        return response()->json([
            'leaderboard' => $this->leaderboardRows(),
            'updated_at' => now()->format('H:i:s'),
        ]);
    }

    public function leaderboardStream()
    {
        return response()->stream(function () {
            ignore_user_abort(true);
            set_time_limit(0);

            $lastHash = null;
            $startedAt = time();
            $maxRuntime = 120;

            while (!connection_aborted() && (time() - $startedAt) < $maxRuntime) {
                $rows = $this->leaderboardRows()->values();
                $payload = [
                    'leaderboard' => $rows,
                    'updated_at' => now()->format('H:i:s'),
                ];
                $hash = md5(json_encode($payload['leaderboard']));

                if ($hash !== $lastHash) {
                    echo "event: leaderboard\n";
                    echo 'data: ' . json_encode($payload) . "\n\n";

                    $lastHash = $hash;
                } else {
                    echo "event: heartbeat\n";
                    echo 'data: ' . json_encode([
                        'updated_at' => now()->format('H:i:s'),
                    ]) . "\n\n";
                }

                if (ob_get_level() > 0) {
                    ob_flush();
                }

                flush();
                sleep(1);
            }

            echo "event: reconnect\n";
            echo 'data: ' . json_encode(['message' => 'reconnect']) . "\n\n";

            if (ob_get_level() > 0) {
                ob_flush();
            }

            flush();
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache, no-transform',
            'Connection' => 'keep-alive',
            'X-Accel-Buffering' => 'no',
        ]);
    }

    private function leaderboardRows()
    {
        return Progress::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'siswa');
            })
            ->orderByDesc('total_xp')
            ->orderByDesc('high_score')
            ->orderByDesc('correct_answer')
            ->get()
            ->values()
            ->map(function ($progress, $index) {
                $totalAnswered =
                    ($progress->correct_answer ?? 0) +
                    ($progress->wrong_answer ?? 0);

                $accuracy = $totalAnswered > 0
                    ? round((($progress->correct_answer ?? 0) / $totalAnswered) * 100)
                    : 0;

                $user = $progress->user;
                $name = $user->name ?? 'Peserta';

                return [
                    'rank' => $index + 1,
                    'user_id' => $user->id ?? null,
                    'name' => $name,
                    'initial' => strtoupper(substr($name, 0, 1)),
                    'total_xp' => (int) ($progress->total_xp ?? 0),
                    'high_score' => (int) ($progress->high_score ?? 0),
                    'total_play' => (int) ($progress->total_play ?? 0),
                    'correct_answer' => (int) ($progress->correct_answer ?? 0),
                    'wrong_answer' => (int) ($progress->wrong_answer ?? 0),
                    'accuracy' => (int) $accuracy,
                    'level' => (int) ($progress->level ?? 1),
                    'is_current_user' => auth()->id() === ($user->id ?? null),
                ];
            });
    }

    private function progressDefaults(): array
    {
        return [
            'score' => 0,
            'high_score' => 0,
            'total_xp' => 0,
            'last_soal_id' => 0,
            'level' => 1,
            'combo' => 0,
            'last_index' => 0,
            'health' => 3,
            'login_streak' => 0,
            'total_play' => 0,
            'correct_answer' => 0,
            'wrong_answer' => 0,
        ];
    }

    private function updateProgressPerAnswer($user, Soal $soal, bool $isCorrect): void
    {
        $progress = Progress::firstOrCreate(
            ['user_id' => $user->id],
            $this->progressDefaults()
        );

        $answeredInGame =
            session('game_benar', 0) +
            session('game_salah', 0);

        $currentScore = $answeredInGame > 0
            ? round((session('game_benar', 0) / $answeredInGame) * 100)
            : 0;

        $newTotalXp =
            ($progress->total_xp ?? 0) +
            ($isCorrect ? 10 : 0);

        $progress->update([
            'score' => $currentScore,
            'total_xp' => $newTotalXp,
            'level' => (int) floor($newTotalXp / 100) + 1,
            'last_soal_id' => $soal->id,
            'last_index' => session('game_index', 0),
            'correct_answer' => ($progress->correct_answer ?? 0) + ($isCorrect ? 1 : 0),
            'wrong_answer' => ($progress->wrong_answer ?? 0) + ($isCorrect ? 0 : 1),
        ]);
    }


    /**
     * ============================================================
     * HALAMAN PILIH LEVEL
     * ============================================================
     */
    public function level()
    {
        $user = auth()->user();

        $progress = Progress::firstOrCreate(
            ['user_id' => $user->id],
            [
                'score' => 0,
                'high_score' => 0,
                'total_xp' => 0,
                'last_soal_id' => 0,
                'level' => 1,
                'combo' => 0,
                'last_index' => 0,
                'health' => 3,
                'login_streak' => 0,
                'total_play' => 0,
                'correct_answer' => 0,
                'wrong_answer' => 0,
            ]
        );

        $hasLevel1 = Soal::where('level', 1)->exists();
        $hasLevel2 = Soal::where('level', 2)->exists();
        $hasLevel3 = Soal::where('level', 3)->exists();

        $playerLevel = $progress->level ?? 1;

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
                'jumlahLevelTerbuka',
                'progress'
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
            'game_last_soal_id',
            'game_result_saved',
            'game_answered_soals',
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
            'game_answered_soals' => [],
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


        $answeredSoals = array_map(
            'intval',
            session('game_answered_soals', [])
        );

        $alreadyAnswered = in_array(
            (int) $soal->id,
            $answeredSoals,
            true
        );

        if (!$alreadyAnswered) {

            /*
            |--------------------------------------------------------------------------
            | Simpan statistik sesi
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
            $answeredSoals[] = (int) $soal->id;

            session([
                'game_index' =>
                    session('game_index', 0) + 1,
                'game_last_soal_id' => $soal->id,
                'game_answered_soals' => $answeredSoals,
            ]);

            if (auth()->check()) {

                try {
                    $this->updateProgressPerAnswer(
                        auth()->user(),
                        $soal,
                        $isCorrect
                    );
                } catch (\Exception $e) {

                    /*
                    | Jangan hentikan proses menjawab soal.
                    */
                }
            }
        }


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


        if (auth()->check() && !session('game_result_saved')) {

            try {

                $user = auth()->user();

                $progress = Progress::firstOrCreate(
                    ['user_id' => $user->id],
                    $this->progressDefaults()
                );

                $progress->update([
                    'score' => $skor,
                    'high_score' => max($skor, $progress->high_score ?? 0),
                    'last_soal_id' => session('game_last_soal_id', 0),
                    'last_index' => session('game_index', 0),
                    'total_play' => ($progress->total_play ?? 0) + 1,
                ]);

                if ($skor > ($user->score ?? 0)) {
                    $user->score = $skor;
                    $user->save();
                }

                GameHistory::create([
                    'user_id' => $user->id,
                    'level' => session('game_level', 1),
                    'score' => $skor,
                    'grade' => $grade,
                    'correct_answer' => $benar,
                    'wrong_answer' => $salah,
                    'total_question' => $totalSoal,
                    'accuracy' => $akurasi,
                    'xp_earned' => $tambahanXp,
                    'played_at' => now(),
                ]);

                session(['game_result_saved' => true]);

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
        $user = auth()->user();

        $histories = GameHistory::with('user')
            ->when(!$user->isAdminOrGuru(), function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest('played_at')
            ->paginate(10);

        return view(
            'game.riwayat',
            compact('histories')
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
