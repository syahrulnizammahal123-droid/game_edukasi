<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;


/*
|--------------------------------------------------------------------------
| 1. ROUTE UMUM
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return redirect()->route('dashboard');
});


/*
|--------------------------------------------------------------------------
| CLEAR CACHE
|--------------------------------------------------------------------------
|
| Untuk membersihkan cache Laravel.
| Setelah deployment/perubahan route, bisa buka:
|
| /clear-all
|
*/

Route::middleware(['auth', 'role:admin,guru'])->get('/clear-all', function () {

    Artisan::call('optimize:clear');

    return '
        <div style="
            font-family:Arial;
            padding:40px;
            text-align:center;
        ">

            <h1 style="color:green;">
                ✓ Cache Berhasil Dibersihkan
            </h1>

            <p>
                Laravel sudah membersihkan cache aplikasi.
            </p>

            <a href="/dashboard">
                Kembali ke Dashboard
            </a>

        </div>
    ';

})->name('clear.all');


/*
|--------------------------------------------------------------------------
| 2. GUEST
|--------------------------------------------------------------------------
|
| Hanya bisa diakses user yang belum login.
|
*/

Route::middleware('guest')->group(function () {

    // LOGIN
    Route::get(
        '/login',
        [AuthController::class, 'showLogin']
    )->name('login');

    Route::post(
        '/login',
        [AuthController::class, 'login']
    );


    // REGISTER
    Route::get(
        '/register',
        [AuthController::class, 'showRegister']
    )->name('register');

    Route::post(
        '/register',
        [AuthController::class, 'register']
    );

});


/*
|--------------------------------------------------------------------------
| 3. USER LOGIN
|--------------------------------------------------------------------------
|
| Semua route di bawah wajib login.
|
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::match(
        ['get', 'post'],
        '/logout',
        [AuthController::class, 'logout']
    )->name('logout');


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [AuthController::class, 'dashboard']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | GAME
    |--------------------------------------------------------------------------
    */

    // Jika membuka /game
    // otomatis diarahkan ke halaman pilih level
    Route::get(
        '/game',
        function () {
            return redirect()->route('game.level');
        }
    )->name('game');


    Route::prefix('game')
        ->name('game.')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | PILIH LEVEL
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/level',
                [GameController::class, 'level']
            )->name('level');


            /*
            |--------------------------------------------------------------------------
            | MULAI GAME
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/start/{level}',
                [GameController::class, 'start']
            )->name('start');


            /*
            |--------------------------------------------------------------------------
            | JAWAB SOAL
            |--------------------------------------------------------------------------
            */

            Route::post(
                '/jawab',
                [GameController::class, 'jawab']
            )->name('jawab');


            /*
            |--------------------------------------------------------------------------
            | SOAL BERIKUTNYA
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/next',
                [GameController::class, 'next']
            )->name('next');


            /*
            |--------------------------------------------------------------------------
            | HASIL GAME
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/hasil',
                [GameController::class, 'hasil']
            )->name('hasil');

        });


    /*
    |--------------------------------------------------------------------------
    | LEADERBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/leaderboard',
        [GameController::class, 'leaderboard']
    )->name('leaderboard');

    Route::get(
        '/leaderboard/data',
        [GameController::class, 'leaderboardData']
    )->name('leaderboard.data');

    Route::get(
        '/leaderboard/stream',
        [GameController::class, 'leaderboardStream']
    )->name('leaderboard.stream');


    /*
    |--------------------------------------------------------------------------
    | RIWAYAT
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/riwayat',
        [GameController::class, 'riwayat']
    )->name('riwayat');


    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN BANK SOAL
    |--------------------------------------------------------------------------
    |
    | Tambah, lihat, edit, update, dan hapus soal.
    |
    */

    Route::prefix('soal')
        ->name('soal.')
        ->middleware('role:admin,guru')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | DAFTAR SOAL
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/',
                [GameController::class, 'soal']
            )->name('index');


            /*
            |--------------------------------------------------------------------------
            | FORM TAMBAH SOAL
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/create',
                [GameController::class, 'createSoal']
            )->name('create');


            /*
            |--------------------------------------------------------------------------
            | SIMPAN SOAL
            |--------------------------------------------------------------------------
            */

            Route::post(
                '/',
                [GameController::class, 'storeSoal']
            )->name('store');


            /*
            |--------------------------------------------------------------------------
            | FORM EDIT SOAL
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/{id}/edit',
                [GameController::class, 'editSoal']
            )->name('edit');


            /*
            |--------------------------------------------------------------------------
            | UPDATE SOAL
            |--------------------------------------------------------------------------
            */

            Route::put(
                '/{id}',
                [GameController::class, 'updateSoal']
            )->name('update');


            /*
            |--------------------------------------------------------------------------
            | HAPUS SOAL
            |--------------------------------------------------------------------------
            */

            Route::delete(
                '/{id}',
                [GameController::class, 'deleteSoal']
            )->name('destroy');

        });

});
