<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameKilatController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES & REDIRECTS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

/*
|--------------------------------------------------------------------------
| 2. SESSIONS & AUTHENTICATION (GUEST ONLY)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::get('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| 3. ADVENTURE HUB FRAMEWORK (PROTECTED BY AUTH MIDDLEWARE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // --- DASHBOARD BERANDA ---
    Route::get('/dashboard', [AuthController::class, 'dashboard']);

    // --- GAMEPLAY SYSTEM (ARENA PERMAINAN UTAMA - PILIHAN GANDA) ---
    Route::get('/game', function () {
        return redirect('/game/level');
    });
    
    Route::prefix('game')->name('game.')->group(function () {
        Route::get('/level', [GameController::class, 'level'])->name('level');
        Route::get('/start/{level}', [GameController::class, 'start'])->name('start');
        Route::post('/jawab', [GameController::class, 'jawab'])->name('jawab');
        Route::get('/next', [GameController::class, 'next'])->name('next');
        Route::get('/hasil', [GameController::class, 'hasil'])->name('hasil');
    });

    // --- GAME KILAT SYSTEM (MODE BARU: BENAR / SALAH TIME ATTACK) ---
    Route::prefix('game-kilat')->name('game-kilat.')->group(function () {
        Route::get('/level', [GameKilatController::class, 'level'])->name('level');
        Route::get('/start/{level}', [GameKilatController::class, 'start'])->name('start');
        Route::get('/next', [GameKilatController::class, 'next'])->name('next');
        Route::post('/jawab', [GameKilatController::class, 'jawab'])->name('jawab');
        Route::get('/hasil', [GameKilatController::class, 'hasil'])->name('hasil');
    });

    // --- HISTORY & RANKINGS ---
    Route::get('/leaderboard', [GameController::class, 'leaderboard']);
    Route::get('/riwayat', [GameController::class, 'riwayat'])->name('riwayat');

    // --- CRUD BANK SOAL MANAGEMENT (ADVENTURE QUIZ - PILIHAN GANDA) ---
    Route::prefix('soal')->name('soal.')->group(function () {
        Route::get('/', [GameController::class, 'soal'])->name('index');             
        Route::get('/create', [GameController::class, 'createSoal'])->name('create'); 
        Route::post('/', [GameController::class, 'storeSoal'])->name('store');         
        Route::get('/{id}/edit', [GameController::class, 'editSoal'])->name('edit');   
        Route::put('/{id}', [GameController::class, 'updateSoal'])->name('update');    
        Route::delete('/{id}', [GameController::class, 'deleteSoal'])->name('destroy');
    });

    // --- CRUD BANK SOAL MANAGEMENT (GAME KILAT BENAR / SALAH) ---
    Route::prefix('soal-kilat')->name('soal-kilat.')->group(function () {
        Route::get('/{id}/edit', [GameKilatController::class, 'editSoal'])->name('edit');   
        Route::put('/{id}', [GameKilatController::class, 'updateSoal'])->name('update');    
        Route::delete('/{id}', [GameKilatController::class, 'destroySoal'])->name('destroy');
    });

});