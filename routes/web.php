<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| DEFAULT & HOME REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION (LOGIN, REGISTER, LOGOUT)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| DASHBOARD HUB
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| GAME CORE PLATFORM
|--------------------------------------------------------------------------
*/

// REDIRECT /game
Route::get('/game', function () {
    return redirect('/game/level');
})->middleware('auth');

// PILIH LEVEL INTERFACE
Route::get('/game/level', [GameController::class, 'level'])->name('game.level')->middleware('auth');

// START SYSTEM GAME
Route::get('/game/start/{level}', [GameController::class, 'start'])->middleware('auth');

// JAWAB TANTANGAN SOAL
Route::post('/game/jawab', [GameController::class, 'jawab'])->middleware('auth');

// NEXT QUEST SOAL
Route::get('/game/next', [GameController::class, 'next'])->middleware('auth');

// HASIL SKOR GAME
Route::get('/game/hasil', [GameController::class, 'hasil'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| LEADERBOARD SYSTEM
|--------------------------------------------------------------------------
*/

Route::get('/leaderboard', [GameController::class, 'leaderboard'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| BATTLE RECORD (RIWAYAT PERMAINAN)
|--------------------------------------------------------------------------
*/

Route::get('/riwayat', [GameController::class, 'riwayat'])->middleware('auth')->name('riwayat');

/*
|--------------------------------------------------------------------------
| MANAGEMENT BANK SOAL CRUD (SINKRONISASI GAME CONTROLLER)
|--------------------------------------------------------------------------
*/

// 1. LIST SEMUA SOAL (Menampilkan Tabel Bank Soal)
Route::get('/soal', [GameController::class, 'soal'])->middleware('auth');

// 2. FORM TAMBAH SOAL
Route::get('/soal/create', [GameController::class, 'createSoal'])->middleware('auth');

// 3. SIMPAN SOAL BARU (Menggunakan standard POST)
Route::post('/soal', [GameController::class, 'storeSoal'])->middleware('auth');

// 4. FORM EDIT SOAL (Menggunakan parameter standar {id})
Route::get('/soal/{id}/edit', [GameController::class, 'editSoal'])->middleware('auth');

// 5. UPDATE DATA SOAL (Disinkronkan menggunakan PUT/PATCH sesuai standar HTML modern)
Route::put('/soal/{id}', [GameController::class, 'updateSoal'])->middleware('auth');

// 6. HAPUS SOAL DARI DATABASE (Disinkronkan menggunakan DELETE demi keamanan data kuis)
Route::delete('/soal/{id}', [GameController::class, 'deleteSoal'])->middleware('auth');