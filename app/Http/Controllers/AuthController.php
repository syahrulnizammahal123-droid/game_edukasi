<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Progress;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {

        return view('login');

    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER PAGE
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {

        return view('register');

    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER PROCESS
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {

        $request->validate([

            'name' => 'required',

            'email' => 'required|email|unique:users',

            'password' => 'required|min:6'

        ]);

        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => bcrypt($request->password)

        ]);

        return redirect('/login')
            ->with('success', 'Register berhasil');

    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN PROCESS
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {

        $credentials = $request->validate([

            'email' => ['required', 'email'],

            'password' => ['required']

        ]);

        // LOGIN
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/dashboard')
                ->with('success', 'Login berhasil');

        }

        // GAGAL LOGIN
        return back()->withErrors([

            'email' => 'Email atau password salah'

        ]);

    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {

        // CEK LOGIN
        if (!Auth::check()) {

            return redirect('/login');

        }

        // USER LOGIN
        $user = Auth::user();

        // PROGRESS
        $progress = Progress::firstOrCreate(

            ['user_id' => $user->id],

            [
                'score' => 0,
                'last_soal_id' => 0,
                'high_score' => 0,
                'level' => 1,
                'combo' => 0,
                'last_index' => 0
            ]

        );

        /*
|--------------------------------------------------------------------------
| DAILY REWARD + LOGIN STREAK
|--------------------------------------------------------------------------
*/

$today = now()->toDateString();

if ($progress->last_claim != $today) {

    // TAMBAH STREAK
    $progress->login_streak += 1;

    // BONUS BERDASARKAN STREAK
    $bonus = 5;

    if ($progress->login_streak >= 7) {

        $bonus = 20;

    } elseif ($progress->login_streak >= 3) {

        $bonus = 10;

    }

    // TAMBAH SCORE
    $progress->high_score += $bonus;

    // UPDATE TANGGAL
    $progress->last_claim = $today;

    $progress->save();

    // TOAST
    session()->flash(
        'success',
        '🔥 Login Streak '.$progress->login_streak.' Hari +'.$bonus.' Score'
    );

}

        $today = now()->toDateString();

        if ($progress->last_claim != $today) {

            // BONUS SCORE
            $progress->high_score += 5;

            // SAVE DATE
            $progress->last_claim = $today;

            $progress->save();

            // TOAST
            session()->flash(
                'success',
                'Daily Reward +5 Score berhasil diklaim'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | XP SYSTEM
        |--------------------------------------------------------------------------
        */

        // XP PLAYER
        $xp = $progress->high_score * 10;

        // LEVEL PLAYER
        $level = floor($xp / 100) + 1;

        // LEVEL LAMA
        $oldLevel = session('player_level', 1);

        // SIMPAN LEVEL BARU
        session([

            'player_level' => $level

        ]);

        // CEK LEVEL UP
        if ($level > $oldLevel) {

            session()->flash(

                'level_up',

                'Level Up!'

            );

        }

        // XP SAAT INI
        $currentXp = $xp % 100;

        // PERSEN PROGRESS
        $progressPercent = $currentXp;

        /*
        |--------------------------------------------------------------------------
        | RANK SYSTEM
        |--------------------------------------------------------------------------
        */

        // SEMUA PLAYER
        $allPlayers = Progress::orderByDesc('high_score')->get();

        // TOP PLAYER
        $topPlayers = Progress::with('user')
            ->orderByDesc('high_score')
            ->take(5)
            ->get();

        // DEFAULT RANK
        $rank = 1;

        // LOOP RANK
        foreach ($allPlayers as $index => $item) {

            if ($item->user_id == $user->id) {

                $rank = $index + 1;

                break;

            }

        }

        /*
        |--------------------------------------------------------------------------
        | PLAYER TITLE
        |--------------------------------------------------------------------------
        */

        $title = 'New Adventurer';

        if ($level >= 10) {

            $title = 'Quiz Legend';

        } elseif ($level >= 5) {

            $title = 'Quiz Warrior';

        } elseif ($level >= 3) {

            $title = 'Rising Hero';

        }
/*
|--------------------------------------------------------------------------
| GREETING SYSTEM
|--------------------------------------------------------------------------
*/

$hour = now()->format('H');

$greeting = 'Selamat Malam';

if ($hour >= 5 && $hour < 12) {

    $greeting = 'Selamat Pagi';

} elseif ($hour >= 12 && $hour < 15) {

    $greeting = 'Selamat Siang';

} elseif ($hour >= 15 && $hour < 18) {

    $greeting = 'Selamat Sore';

} 
        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(

            'progress',
            'xp',
            'level',
            'progressPercent',
            'rank',
            'title',
            'topPlayers',
            'greeting'


        ));

    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Logout berhasil');

    }

}