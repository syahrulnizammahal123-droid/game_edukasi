<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Guiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(34, 211, 238, 0.15);
            border-color: rgba(34, 211, 238, 0.4);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden text-white" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#07111f]/80 -z-10"></div>

    <div class="absolute top-20 left-10 w-32 h-32 rounded-full bg-cyan-400/10 blur-3xl animate-pulse pointer-events-none"></div>
    <div class="absolute top-1/3 right-10 w-40 h-40 rounded-full bg-purple-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 left-1/3 w-52 h-52 rounded-full bg-pink-500/10 blur-3xl animate-pulse pointer-events-none"></div>
    <div class="absolute bottom-10 right-1/4 w-36 h-36 rounded-full bg-yellow-400/10 blur-3xl pointer-events-none"></div>
    <div class="absolute top-0 left-0 w-72 h-72 bg-cyan-400/20 blur-3xl rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-purple-500/20 blur-3xl rounded-full pointer-events-none"></div>

    <div class="relative z-10 flex min-h-screen">

        <aside class="hidden lg:flex flex-col w-72 p-6 glass border-r border-white/10 shrink-0">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-[0_0_25px_rgba(59,130,246,0.5)]">
                    <i class="fa-solid fa-gamepad text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-white">Guiz</h1>
                    <p class="text-cyan-300 text-sm">Adventure</p>
                </div>
            </div>

            <div class="space-y-4 flex-1">
                <a href="/dashboard" class="flex items-center gap-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white p-4 rounded-3xl shadow-[0_0_20px_rgba(59,130,246,0.4)]">
                    <div class="w-6 h-6 shrink-0">
                        <img src="https://api.dicebear.com/7.x/adventurer/svg?seed={{ Auth::user()->name }}" alt="Avatar" class="w-full h-full object-cover rounded-full">
                    </div>
                    <span class="font-semibold">Dashboard</span>
                </a>

                <a href="/game/level" class="flex items-center gap-4 glass text-white p-4 rounded-3xl hover:bg-white/10 transition">
                    <i class="fa-solid fa-play text-lg text-cyan-400"></i>
                    <span class="font-semibold">Mulai Game</span>
                </a>

                <a href="/leaderboard" class="flex items-center gap-4 glass text-white p-4 rounded-3xl hover:bg-white/10 transition">
                    <i class="fa-solid fa-ranking-star text-lg text-yellow-400"></i>
                    <span class="font-semibold">Peringkat</span>
                </a>

                <a href="/riwayat" class="flex items-center gap-4 glass text-white p-4 rounded-3xl hover:bg-white/10 transition">
                    <i class="fa-solid fa-clock-rotate-left text-lg text-purple-400"></i>
                    <span class="font-semibold">Riwayat Permainan</span>
                </a>

                <a href="/soal" class="flex items-center gap-4 glass text-white p-4 rounded-3xl hover:bg-white/10 transition">
                    <i class="fa-solid fa-book-open text-lg text-emerald-400"></i>
                    <span class="font-semibold">Kelola Soal</span>
                </a>
            </div>

            <div class="mt-auto">
                <a href="/logout" class="flex items-center justify-center gap-3 bg-gradient-to-r from-red-500 to-red-700 text-white p-4 rounded-3xl shadow-xl">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="font-semibold">Keluar</span>
                </a>
            </div>
        </aside>

        <main class="flex-1 p-5 lg:p-8 overflow-y-auto pb-24">

            <div class="lg:hidden flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-extrabold text-white">Guiz Adventure</h1>
                    <p class="text-cyan-300 text-sm">Game Quiz Petualangan</p>
                </div>
                <a href="/logout" class="w-12 h-12 rounded-2xl bg-red-500/20 border border-red-400/20 flex items-center justify-center text-red-300">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>

            <div class="glass card-hover rounded-[35px] p-6 lg:p-8 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex-1">
                        <p class="text-cyan-300 font-semibold mb-3">
                            <i class="fa-solid fa-wand-magic-sparkles mr-2"></i>{{ $greeting }}
                        </p>
                        <h1 class="text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                            {{ Auth::user()->name }},<br>Siap Memulai Petualangan?
                        </h1>
                        <p class="text-white/60 mt-4 max-w-xl text-sm">
                            Jelajahi dunia pengetahuan super interaktif dan tingkatkan skor terbaikmu melalui tantangan quiz yang seru dan menantang.
                        </p>
                        <div class="flex flex-wrap gap-4 mt-6">
                            <a href="/game/level" class="inline-flex items-center gap-3 bg-gradient-to-r from-cyan-400 to-blue-600 text-white px-6 py-4 rounded-3xl font-semibold shadow-xl">
                                <i class="fa-solid fa-play"></i>
                                <span>Mulai Petualangan</span>
                            </a>
                        </div>
                    </div>

                    <div class="glass rounded-[30px] p-5 min-w-[280px] w-full lg:w-auto">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shrink-0 p-0.5">
                                <img src="https://api.dicebear.com/7.x/adventurer/svg?seed={{ Auth::user()->name }}" alt="Avatar" class="w-full h-full object-cover rounded-[22px] bg-slate-900">
                            </div>
                            <div>
                                <h2 class="text-white text-xl font-bold truncate max-w-[160px]">{{ Auth::user()->name }}</h2>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-cyan-500/20 text-cyan-300 text-xs font-semibold mt-1 border border-cyan-400/20">
                                    <i class="fa-solid fa-shield-halved text-[10px]"></i> {{ $title ?? 'Pemain Kuis' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <div class="glass card-hover rounded-[30px] p-5 flex flex-col justify-between">
                    <span class="text-white/60 text-xs font-medium uppercase tracking-wider">Level Player</span>
                    <h2 class="text-white text-4xl font-extrabold mt-4">{{ $level }}</h2>
                </div>
                <div class="glass card-hover rounded-[30px] p-5 flex flex-col justify-between">
                    <span class="text-white/60 text-xs font-medium uppercase tracking-wider">Total Exp Poin</span>
                    <h2 class="text-cyan-400 text-4xl font-extrabold mt-4">{{ $xp }}</h2>
                </div>
                <div class="glass card-hover rounded-[30px] p-5 flex flex-col justify-between">
                    <span class="text-white/60 text-xs font-medium uppercase tracking-wider">High Score Global</span>
                    <h2 class="text-yellow-400 text-4xl font-extrabold mt-4">{{ $progress->high_score }}</h2>
                </div>
                <div class="glass card-hover rounded-[30px] p-5 flex flex-col justify-between">
                    <span class="text-white/60 text-xs font-medium uppercase tracking-wider">Login Streak</span>
                    <h2 class="text-orange-400 text-4xl font-extrabold mt-4">🔥 {{ $progress->login_streak }} Hari</h2>
                </div>
            </div>

            <div class="glass card-hover rounded-[35px] p-6 lg:p-8 mb-8">
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-white/60 font-medium">Progres Akumulasi Naik Level berikutnya</span>
                        <span class="text-cyan-300 font-bold tracking-wide">{{ $progressPercent }}%</span>
                    </div>
                    <div class="w-full h-3.5 rounded-full bg-white/10 overflow-hidden p-0.5 border border-white/5">
                        <div class="h-full rounded-full bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 transition-all duration-500" style="width: {{ $progressPercent }}%"></div>
                    </div>
                </div>
            </div>

            <div class="glass card-hover rounded-[35px] p-6 lg:p-8 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div>
                        <p class="text-cyan-300 font-semibold text-xs uppercase tracking-wider mb-2">Sesi Waktu Arena</p>
                        <h2 id="live-clock" class="text-5xl font-mono font-bold tracking-widest text-white">00:00:00</h2>
                        <p class="text-white/60 text-xs mt-2">Waktu aktifitas petualangan kuis realtime server.</p>
                    </div>
                    <div class="flex items-center gap-4 px-6 py-4 rounded-2xl bg-emerald-500/10 border border-emerald-400/20 self-start lg:self-auto">
                        <div class="w-4 h-4 rounded-full bg-emerald-400 animate-pulse shadow-[0_0_15px_rgba(52,211,153,0.8)]"></div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Server Online</h3>
                            <p class="text-emerald-300 text-xs font-medium">Sesi akun terhubung aman</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass card-hover rounded-[35px] p-6 lg:p-8 mb-8">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center shadow-[0_0_30px_rgba(251,191,36,0.35)]">
                            <i class="fa-solid fa-ticket text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-cyan-300 text-xs font-semibold uppercase tracking-wide">Musim Progresif</p>
                            <h2 class="text-white text-2xl font-bold">Adventure Pass</h2>
                        </div>
                    </div>
                    <div class="px-5 py-2 rounded-2xl bg-gradient-to-r from-cyan-500/20 to-blue-600/20 border border-cyan-400/20 text-white font-extrabold text-sm">
                        Tier Reward {{ $level }}
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    <div class="rounded-2xl p-4 text-center {{ $level >= 1 ? 'bg-gradient-to-br from-cyan-500/20 to-blue-600/20 border border-cyan-400/20' : 'bg-white/5 border border-white/10 opacity-40' }}">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center mx-auto mb-3">
                            <i class="fa-solid fa-star text-white text-lg"></i>
                        </div>
                        <h3 class="text-white font-bold text-sm">Tier 1</h3>
                        <p class="text-white/50 text-xs mt-1">+50 XP Booster</p>
                    </div>

                    <div class="rounded-2xl p-4 text-center {{ $level >= 2 ? 'bg-gradient-to-br from-purple-500/20 to-pink-600/20 border border-purple-400/20' : 'bg-white/5 border border-white/10 opacity-40' }}">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center mx-auto mb-3">
                            <i class="fa-solid fa-medal text-white text-lg"></i>
                        </div>
                        <h3 class="text-white font-bold text-sm">Tier 2</h3>
                        <p class="text-white/50 text-xs mt-1">Rare Badge</p>
                    </div>

                    <div class="rounded-2xl p-4 text-center {{ $level >= 3 ? 'bg-gradient-to-br from-emerald-500/20 to-cyan-600/20 border border-emerald-400/20' : 'bg-white/5 border border-white/10 opacity-40' }}">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400 to-cyan-500 flex items-center justify-center mx-auto mb-3">
                            <i class="fa-solid fa-gem text-white text-lg"></i>
                        </div>
                        <h3 class="text-white font-bold text-sm">Tier 3</h3>
                        <p class="text-white/50 text-xs mt-1">Crystal Gems</p>
                    </div>

                    <div class="rounded-2xl p-4 text-center {{ $level >= 5 ? 'bg-gradient-to-br from-yellow-400/20 to-orange-500/20 border border-yellow-400/20' : 'bg-white/5 border border-white/10 opacity-40' }}">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center mx-auto mb-3">
                            <i class="fa-solid fa-crown text-white text-lg"></i>
                        </div>
                        <h3 class="text-white font-bold text-sm">Tier 5</h3>
                        <p class="text-white/50 text-xs mt-1">Gold Crown</p>
                    </div>

                    <div class="rounded-2xl p-4 text-center {{ $level >= 10 ? 'bg-gradient-to-br from-pink-500/20 to-purple-700/20 border border-pink-400/20' : 'bg-white/5 border border-white/10 opacity-40' }}">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-pink-500 to-purple-700 flex items-center justify-center mx-auto mb-3">
                            <i class="fa-solid fa-dragon text-white text-lg"></i>
                        </div>
                        <h3 class="text-white font-bold text-sm">Tier 10</h3>
                        <p class="text-white/50 text-xs mt-1">Mythic Dragon</p>
                    </div>
                </div>
            </div>

            <div class="glass card-hover rounded-[35px] p-6 lg:p-8 mb-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                        <i class="fa-solid fa-chart-pie text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">Battle Record Analitika</h3>
                        <p class="text-xs text-white/50">Rasio data komparasi ketepatan jawaban</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                        <span class="text-xs text-white/50 block">Jawaban Tepat</span>
                        <h4 class="text-2xl font-black text-emerald-400 mt-2">{{ $progress->high_score }}</h4>
                    </div>
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                        <span class="text-xs text-white/50 block">Estimasi Meleset</span>
                        <h4 class="text-2xl font-black text-red-400 mt-2">{{ floor($progress->high_score / 3) }}</h4>
                    </div>
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5 col-span-2 sm:col-span-1">
                        <span class="text-xs text-white/50 block">Rasio Win Rate</span>
                        <h4 class="text-2xl font-black text-purple-400 mt-2">{{ min(100, 70 + $level) }}%</h4>
                    </div>
                </div>
            </div>

            <div class="glass card-hover rounded-[35px] p-6 lg:p-8 mb-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/20">
                        <i class="fa-solid fa-chart-line text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">XP Analytics</h3>
                        <p class="text-xs text-white/50">Grafik historis penambahan poin level kuis</p>
                    </div>
                </div>
                <div class="bg-slate-950/40 border border-white/5 rounded-2xl p-4">
                    <canvas id="progressChart" class="max-h-60 w-full"></canvas>
                </div>
            </div>

            <div class="glass card-hover rounded-[35px] p-6 lg:p-8 mb-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center shadow-lg shadow-pink-500/20">
                        <i class="fa-solid fa-bullseye text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">Misi Quest Harian</h3>
                        <p class="text-xs text-white/50">Target aktif harian pencari bonus multiplier</p>
                    </div>
                </div>
                <div class="p-4 bg-white/5 border border-white/5 rounded-2xl space-y-3">
                    <div class="flex justify-between items-center">
                        <h4 class="text-sm font-bold text-white/90">Quiz Explorer Master</h4>
                        <span class="text-xs text-cyan-300 font-bold">+25 XP Poin</span>
                    </div>
                    <p class="text-xs text-white/60">Selesaikan minimal batas aman 5 tantangan soal hari ini.</p>
                    <div class="space-y-1 pt-2">
                        <div class="w-full h-2 rounded-full bg-white/10 overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-cyan-400 to-blue-500 transition-all duration-300" style="width: {{ min(($progress->high_score / 5) * 100, 100) }}%"></div>
                        </div>
                        <div class="text-right text-[10px] text-white/40 font-semibold">{{ min($progress->high_score, 5) }}/5 Selesai</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                
                <div class="glass card-hover rounded-[35px] p-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center shadow-[0_0_20px_rgba(251,191,36,0.3)]">
                            <i class="fa-solid fa-crown text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-cyan-300 text-xs font-semibold">Ranking Global</p>
                            <h2 class="text-white text-xl font-bold">Top Player</h2>
                        </div>
                    </div>

                    <div class="space-y-3 max-h-[350px] overflow-y-auto pr-2">
                        @if(isset($topPlayers) && count($topPlayers) > 0)
                            @foreach($topPlayers as $index => $player)
                                <div class="flex items-center justify-between p-4 rounded-2xl bg-white/5 border border-white/10 gap-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 
                                            {{ $index == 0 ? 'bg-gradient-to-br from-yellow-400 to-orange-500' : '' }}
                                            {{ $index == 1 ? 'bg-gradient-to-br from-slate-300 to-slate-500' : '' }}
                                            {{ $index == 2 ? 'bg-gradient-to-br from-amber-700 to-orange-800' : '' }}
                                            {{ $index > 2 ? 'bg-gradient-to-br from-cyan-400 to-blue-600' : '' }}
                                        ">
                                            <span class="text-white font-bold text-sm">#{{ $index + 1 }}</span>
                                        </div>
                                        <div>
                                            <h3 class="text-white font-bold text-sm truncate max-w-[140px]">{{ $player->user->name ?? 'User' }}</h3>
                                            <p class="text-white/50 text-[10px]">Level {{ floor(($player->high_score * 10) / 100) + 1 }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-cyan-300 text-lg font-extrabold tracking-wide">{{ $player->high_score }}</h3>
                                        <p class="text-white/40 text-[9px] uppercase">Score</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-12 text-white/40 text-xs">Papan peringkat kosong.</div>
                        @endif
                    </div>
                </div>

                <div class="glass card-hover rounded-[35px] p-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-[0_0_20px_rgba(34,211,238,0.3)]">
                            <i class="fa-solid fa-clock-rotate-left text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-cyan-300 text-xs font-semibold">Aktivitas Player</p>
                            <h2 class="text-white text-xl font-bold">Recent Activity</h2>
                        </div>
                    </div>

                    <div class="space-y-4 max-h-[350px] overflow-y-auto pr-2">
                        @if($xp > 0)
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-white/5 border border-white/10">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-check text-white text-base"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h2 class="text-white font-bold text-sm">Quiz Selesai</h2>
                                    <p class="text-white/60 text-xs mt-1 truncate">Sesi pencatatan riwayat kuis terbaru berhasil disimpan.</p>
                                </div>
                                <span class="text-emerald-400 font-bold text-xs whitespace-nowrap">+{{ $xp }} EXP</span>
                            </div>
                        @else
                            <div class="text-center py-12 text-white/40">
                                <i class="fa-solid fa-folder-open text-2xl mb-2 block"></i>
                                Belum ada riwayat aktivitas kuis terdeteksi.
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </main>
    </div>

    @include('components.loading')
    @include('components.sound')
    @include('components.level-up')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('progressChart');
        if(ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5', 'Terbaru'],
                    datasets: [{
                        label: 'Progress Distribusi XP',
                        data: [10, 35, 50, 70, 90, {{ $xp ?? 100 }}],
                        borderWidth: 3,
                        borderColor: '#22d3ee',
                        backgroundColor: 'rgba(34, 211, 238, 0.03)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { labels: { color: '#ffffff', font: { family: 'Poppins', size: 11 } } } },
                    scales: {
                        x: { ticks: { color: 'rgba(255,255,255,0.6)', font: { size: 10 } }, grid: { color: 'rgba(255,255,255,0.03)' } },
                        y: { ticks: { color: 'rgba(255,255,255,0.6)', font: { size: 10 } }, grid: { color: 'rgba(255,255,255,0.03)' } }
                    }
                }
            });
        }

        // Live Realtime Server Digital Clock System
        function updateClock(){
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID');
            const clockNode = document.getElementById('live-clock');
            if(clockNode) clockNode.innerHTML = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>