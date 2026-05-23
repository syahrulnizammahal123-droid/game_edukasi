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
    [AuthController::class, 'dashboard']);

/*
|--------------------------------------------------------------------------
| GAME
|--------------------------------------------------------------------------
*/

// REDIRECT /game
Route::get('/game', function () {

    return redirect('/game/level');

});

// PILIH LEVEL
Route::get('/game/level',
    [GameController::class, 'level']);

// START GAME
Route::get('/game/start/{level}',
    [GameController::class, 'start']);

// JAWAB SOAL
Route::post('/game/jawab',
    [GameController::class, 'jawab']);

// NEXT SOAL
Route::get('/game/next',
    [GameController::class, 'next']);

// HASIL GAME
Route::get('/game/hasil',
    [GameController::class, 'hasil']);

/*
|--------------------------------------------------------------------------
| LEADERBOARD
|--------------------------------------------------------------------------
*/

Route::get('/leaderboard',
    [GameController::class, 'leaderboard']);

/*
|--------------------------------------------------------------------------
| CRUD SOAL
|--------------------------------------------------------------------------
*/

// LIST SOAL
Route::get('/soal',
    [GameController::class, 'soal']);

// FORM TAMBAH SOAL
Route::get('/soal/create',
    [GameController::class, 'createSoal']);

// SIMPAN SOAL
Route::post('/soal/store',
    [GameController::class, 'storeSoal']);

// FORM EDIT SOAL
Route::get('/soal/edit/{id}',
    [GameController::class, 'editSoal']);

// UPDATE SOAL
Route::post('/soal/update/{id}',
    [GameController::class, 'updateSoal']);

// HAPUS SOAL
Route::get('/soal/delete/{id}',
    [GameController::class, 'deleteSoal']);