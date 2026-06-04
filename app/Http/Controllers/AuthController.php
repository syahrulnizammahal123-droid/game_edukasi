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

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/dashboard')
                ->with('success', 'Login berhasil');

        }

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

        if (!Auth::check()) {

            return redirect('/login');

        }

        $user = Auth::user();

        $progress = Progress::firstOrCreate(

            ['user_id' => $user->id],

            [

                'score' => 0,

                'high_score' => 0,

                'last_soal_id' => 0

            ]

        );

       /*
|--------------------------------------------------------------------------
| XP SYSTEM
|--------------------------------------------------------------------------
*/

$xp = $progress->high_score;

// BENARKAN KESALAHAN 1: Rumus level otomatis disamakan dengan rumus kelipatan 10 XP yang ada di Blade leaderboard Anda
$level = floor(($xp * 10) / 100) + 1;

$currentXp = ($xp % 10) * 10;

$progressPercent = $currentXp;

/*
|--------------------------------------------------------------------------
| SAVE LEVEL TO DATABASE
|--------------------------------------------------------------------------
*/

if ($progress->level != $level) {

    $progress->update([
        'level' => $level
    ]);

}
        $allPlayers = Progress::orderByDesc(
            'high_score'
        )->get();

        $topPlayers = Progress::with('user')
            ->orderByDesc('high_score')
            ->take(5)
            ->get();

        $rank = 1;

        foreach ($allPlayers as $index => $item) {

            if ($item->user_id == $user->id) {

                $rank = $index + 1;

                break;

            }

        }

        /*
        |--------------------------------------------------------------------------
        | TITLE SYSTEM
        |--------------------------------------------------------------------------
        */

        // BENARKAN KESALAHAN 2: Penamaan Title diubah agar lebih formal dan akademis (cocok untuk skripsi)
        $title = 'Novice Learner';

        if ($level >= 10) {

            $title = 'Grandmaster Scholar';

        } elseif ($level >= 5) {

            $title = 'Advanced Thinker';

        } elseif ($level >= 3) {

            $title = 'Active Explorer';

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

        return view('dashboard', compact(

            'progress',
            'xp',
            'currentXp', // Ditambahkan ke compact agar bisa dibaca di dashboard tanpa error
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