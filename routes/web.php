<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| DEFAULT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect('/dashboard');

});

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login',
    [AuthController::class, 'showLogin']
)->name('login');

Route::post('/login',
    [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/register',
    [AuthController::class, 'showRegister']);

Route::post('/register',
    [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::get('/logout',
    [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard',
    [AuthController::class, 'dashboard'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| GAME
|--------------------------------------------------------------------------
*/

// REDIRECT /game
Route::get('/game', function () {

    return redirect('/game/level');

})->middleware('auth');

// PILIH LEVEL
Route::get('/game/level',
    [GameController::class, 'level'])
    ->middleware('auth');

// START GAME
Route::get('/game/start/{level}',
    [GameController::class, 'start'])
    ->middleware('auth');

// JAWAB SOAL
Route::post('/game/jawab',
    [GameController::class, 'jawab'])
    ->middleware('auth');

// NEXT SOAL
Route::get('/game/next',
    [GameController::class, 'next'])
    ->middleware('auth');

// HASIL GAME
Route::get('/game/hasil',
    [GameController::class, 'hasil'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| LEADERBOARD
|--------------------------------------------------------------------------
*/

Route::get('/leaderboard',
    [GameController::class, 'leaderboard'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| RIWAYAT PERMAINAN
|--------------------------------------------------------------------------
*/

Route::get('/riwayat',
    [GameController::class, 'riwayat'])
    ->middleware('auth')
    ->name('riwayat');

/*
|--------------------------------------------------------------------------
| CRUD SOAL
|--------------------------------------------------------------------------
*/

// LIST SOAL
Route::get('/soal',
    [GameController::class, 'soal'])
    ->middleware('auth');

// FORM TAMBAH SOAL
Route::get('/soal/create',
    [GameController::class, 'createSoal'])
    ->middleware('auth');

// SIMPAN SOAL
Route::post('/soal/store',
    [GameController::class, 'storeSoal'])
    ->middleware('auth');

// FORM EDIT SOAL
Route::get('/soal/edit/{id}',
    [GameController::class, 'editSoal'])
    ->middleware('auth');

// UPDATE SOAL
Route::post('/soal/update/{id}',
    [GameController::class, 'updateSoal'])
    ->middleware('auth');

// HAPUS SOAL
Route::get('/soal/delete/{id}',
    [GameController::class, 'deleteSoal'])
    ->middleware('auth');
