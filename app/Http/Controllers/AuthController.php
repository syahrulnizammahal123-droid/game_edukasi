<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Progress;
use App\Models\GameHistory;
use App\Models\Soal;

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

            'password' => bcrypt($request->password),

            'role' => 'siswa'

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

        if ($user->isAdminOrGuru()) {

            return $this->adminDashboard();

        }

        $progress = $this->getOrCreateProgress($user);

        $xp = $progress->total_xp ?? 0;

        $level = $this->calculateLevel($xp);

        $currentXp = $xp % 100;

        $progressPercent = $currentXp;

        if ($progress->level != $level) {

            $progress->update([
                'level' => $level
            ]);

        }

        $allPlayers = Progress::whereHas('user', function ($query) {
                $query->where('role', 'siswa');
            })
            ->orderByDesc('total_xp')
            ->orderByDesc('high_score')
            ->orderByDesc('correct_answer')
            ->get();

        $topPlayers = Progress::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'siswa');
            })
            ->orderByDesc('total_xp')
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

        $totalAnswered =
            ($progress->correct_answer ?? 0) +
            ($progress->wrong_answer ?? 0);

        $averageAccuracy = $totalAnswered > 0
            ? round((($progress->correct_answer ?? 0) / $totalAnswered) * 100)
            : 0;

        $latestHistories = GameHistory::where('user_id', $user->id)
            ->latest('played_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(

            'progress',
            'xp',
            'currentXp', // Ditambahkan ke compact agar bisa dibaca di dashboard tanpa error
            'level',
            'progressPercent',
            'rank',
            'title',
            'topPlayers',
            'greeting',
            'averageAccuracy',
            'latestHistories'

        ));

    }

    private function adminDashboard()
    {
        $totalSiswa = User::where('role', 'siswa')->count();

        $totalGuru = User::whereIn('role', ['admin', 'guru'])->count();

        $totalSoal = Soal::count();

        $totalMain = GameHistory::count();

        $averageScore = (int) round(GameHistory::avg('score') ?? 0);

        $levelStats = Soal::selectRaw('level, COUNT(*) as total')
            ->groupBy('level')
            ->orderBy('level')
            ->pluck('total', 'level');

        $topStudents = Progress::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'siswa');
            })
            ->orderByDesc('total_xp')
            ->orderByDesc('high_score')
            ->take(5)
            ->get();

        $latestHistories = GameHistory::with('user')
            ->latest('played_at')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalSoal',
            'totalMain',
            'averageScore',
            'levelStats',
            'topStudents',
            'latestHistories'
        ));
    }

    private function getOrCreateProgress(User $user): Progress
    {
        return Progress::firstOrCreate(
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
    }

    private function calculateLevel(int $xp): int
    {
        return (int) floor($xp / 100) + 1;
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
