<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameKilatController;

/*
|--------------------------------------------------------------------------
| 1. ROUTE UMUM & MAINTENANCE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Pembersih Cache (Dapat diakses di Server Demo untuk memperbarui route/view)
Route::get('/clear-all', function() {
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return '<h1>Success! Cache Berhasil Dibersihkan.</h1><a href="/dashboard">Kembali ke Dashboard</a>';
});

/*
|--------------------------------------------------------------------------
| 2. GUEST ONLY (HANYA UNTUK YANG BELUM LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| 3. AUTHENTICATED ONLY (WAJIB LOGIN DULU)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Mendukung GET & POST untuk Logout agar mencegah error MethodNotAllowed
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Route Game Biasa
    Route::get('/game', fn() => redirect()->route('game.level'));
    
    Route::prefix('game')->name('game.')->group(function () {
        Route::get('/level', [GameController::class, 'level'])->name('level');
        Route::get('/start/{level}', [GameController::class, 'start'])->name('start');
        Route::post('/jawab', [GameController::class, 'jawab'])->name('jawab');
        Route::get('/next', [GameController::class, 'next'])->name('next');
        Route::get('/hasil', [GameController::class, 'hasil'])->name('hasil');
    });

    // Route Game Kilat
    Route::get('/game-kilat', fn() => redirect()->route('game-kilat.level'));

    Route::prefix('game-kilat')->name('game-kilat.')->group(function () {
        Route::get('/level', [GameKilatController::class, 'level'])->name('level');
        Route::get('/start/{level}', [GameKilatController::class, 'start'])->name('start');
        Route::post('/jawab', [GameKilatController::class, 'jawab'])->name('jawab');
        Route::get('/next', [GameKilatController::class, 'next'])->name('next');
        Route::get('/hasil', [GameKilatController::class, 'hasil'])->name('hasil');
    });

    Route::get('/leaderboard', [GameController::class, 'leaderboard'])->name('leaderboard');
    Route::get('/riwayat', [GameController::class, 'riwayat'])->name('riwayat');

    // Manajemen Soal
    Route::prefix('soal')->name('soal.')->group(function () {
        Route::get('/', [GameController::class, 'soal'])->name('index');             
        Route::get('/create', [GameController::class, 'createSoal'])->name('create'); 
        Route::post('/', [GameController::class, 'storeSoal'])->name('store');         
        Route::get('/{id}/edit', [GameController::class, 'editSoal'])->name('edit');   
        Route::put('/{id}', [GameController::class, 'updateSoal'])->name('update');    
        Route::delete('/{id}', [GameController::class, 'deleteSoal'])->name('destroy');
    });

});