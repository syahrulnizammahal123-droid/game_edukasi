<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES & REDIRECTS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

// RUTE PEMBERSIH CACHE (Ditaruh di luar middleware auth agar bebas diakses)
Route::get('/clear-all', function() {
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return '<h1>Success! Cache Berhasil Dibersihkan.</h1><a href="/dashboard">Kembali ke Dashboard</a>';
});

/*
|--------------------------------------------------------------------------
| 2. SESSIONS & AUTHENTICATION (GUEST ONLY)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 3. ADVENTURE HUB FRAMEWORK (PROTECTED BY AUTH MIDDLEWARE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

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

    Route::get('/leaderboard', [GameController::class, 'leaderboard'])->name('leaderboard');
    Route::get('/riwayat', [GameController::class, 'riwayat'])->name('riwayat');

    Route::prefix('soal')->name('soal.')->group(function () {
        Route::get('/', [GameController::class, 'soal'])->name('index');             
        Route::get('/create', [GameController::class, 'createSoal'])->name('create'); 
        Route::post('/', [GameController::class, 'storeSoal'])->name('store');         
        Route::get('/{id}/edit', [GameController::class, 'editSoal'])->name('edit');   
        Route::put('/{id}', [GameController::class, 'updateSoal'])->name('update');    
        Route::delete('/{id}', [GameController::class, 'deleteSoal'])->name('destroy');
    });

});