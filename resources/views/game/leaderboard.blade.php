<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - Guiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .glass {
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .podium-glow-1 {
            box-shadow: 0 0 40px rgba(234, 179, 8, 0.25);
            border-color: rgba(234, 179, 8, 0.4);
        }
        .podium-glow-2 {
            box-shadow: 0 0 30px rgba(148, 163, 184, 0.15);
            border-color: rgba(148, 163, 184, 0.3);
        }
        .podium-glow-3 {
            box-shadow: 0 0 30px rgba(180, 83, 9, 0.15);
            border-color: rgba(180, 83, 9, 0.3);
        }
        .row-hover:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(34, 211, 238, 0.3);
            transform: scale(1.01);
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden text-white" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#030712]/90 -z-20"></div>
    <div class="fixed inset-0 bg-gradient-to-tr from-purple-950/20 via-transparent to-cyan-950/20 -z-10"></div>

    <div class="absolute top-20 left-10 w-48 h-48 rounded-full bg-cyan-500/10 blur-3xl animate-pulse pointer-events-none"></div>
    <div class="absolute top-1/3 right-10 w-64 h-64 rounded-full bg-purple-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 left-1/3 w-72 h-72 rounded-full bg-pink-500/10 blur-3xl animate-pulse pointer-events-none"></div>

    <div class="relative z-10 flex min-h-screen">

        <aside class="hidden lg:flex flex-col w-80 p-6 glass border-r border-white/10 shrink-0">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,0.5)]">
                    <i class="fa-solid fa-gamepad text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-extrabold tracking-wide text-white">Guiz Adventure</h1>
                    <p class="text-cyan-400 text-xs font-medium">Game Quiz Petualangan</p>
                </div>
            </div>

            <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/5 mb-8">
                <div class="w-10 h-10 rounded-xl overflow-hidden bg-slate-950/60 p-1 border border-white/10 shadow-inner">
                    <!-- Menggunakan avatar maskot hewan/makhluk fantasi (Acme/Bottts) yang serasi dengan tema game -->
                    <img src="https://api.dicebear.com/7.x/bottts/svg?seed={{ Auth::user()->name }}&colors=cyan,blue,purple" alt="Avatar" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-white/50 truncate">{{ $title ?? 'Novice Explorer' }}</p>
                </div>
            </div>

            <nav class="space-y-2 flex-1">
                <a href="/dashboard" class="flex items-center gap-4 text-white/70 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition font-medium">
                    <i class="fa-solid fa-columns text-lg text-cyan-400"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/game/level" class="flex items-center gap-4 text-white/70 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition font-medium">
                    <i class="fa-solid fa-play text-lg text-cyan-400"></i>
                    <span>Mulai Game</span>
                </a>
                <a href="/riwayat" class="flex items-center gap-4 text-white/70 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition font-medium">
                    <i class="fa-solid fa-clock-rotate-left text-lg text-purple-400"></i>
                    <span>Riwayat Kuis</span>
                </a>
                <a href="/leaderboard" class="flex items-center gap-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white p-4 rounded-2xl font-semibold shadow-[0_0_20px_rgba(59,130,246,0.3)] transition">
                    <i class="fa-solid fa-ranking-star text-lg"></i>
                    <span>Peringkat Global</span>
                </a>
                <a href="/soal" class="flex items-center gap-4 text-white/70 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition font-medium">
                    <i class="fa-solid fa-book-open text-lg text-emerald-400"></i>
                    <span>Kelola Soal</span>
                </a>
            </nav>

            <div class="pt-4 border-t border-white/5">
                <a href="/logout" class="flex items-center justify-center gap-3 bg-red-500/10 hover:bg-red-500/20 text-red-400 p-4 rounded-2xl font-semibold transition border border-red-500/20">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar Sistem</span>
                </a>
            </div>
        </aside>

        <main class="flex-1 p-4 lg:p-8 max-w-7xl mx-auto w-full overflow-y-auto pb-24">
            
            <div class="lg:hidden flex items-center justify-between mb-6 p-4 glass rounded-2xl border border-white/5">
                <div>
                    <h1 class="text-xl font-extrabold">Guiz Adventure</h1>
                    <p class="text-cyan-400 text-xs">Peringkat Global</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl overflow-hidden bg-slate-950/60 p-1 border border-white/10 shadow-inner">
                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed={{ Auth::user()->name }}&colors=cyan,blue,purple" alt="Avatar">
                    </div>
                    <a href="/logout" class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center text-red-400 border border-red-500/20">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white shadow-[0_0_25px_rgba(234,179,8,0.3)]">
                        <i class="fa-solid fa-crown text-2xl animate-pulse"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-wide">Global Leaderboard</h1>
                        <p class="text-sm text-cyan-400/80 font-medium">Panggung kehormatan siswa dengan kompetensi penalaran terbaik</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 bg-white/5 p-1.5 rounded-2xl border border-white/5 self-start md:self-auto">
                    <button class="px-4 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-md">All-Time</button>
                    <button class="px-4 py-2 rounded-xl text-xs font-semibold text-white/60 hover:text-white hover:bg-white/5 transition">Bulanan</button>
                    <button class="px-4 py-2 rounded-xl text-xs font-semibold text-white/60 hover:text-white hover:bg-white/5 transition">Mingguan</button>
                </div>
            </div>

            <div class="glass rounded-3xl p-6 mb-8 border border-white/5 bg-slate-900/30">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-cyan-400/10 flex items-center justify-center text-cyan-400">
                        <i class="fa-solid fa-chart-bar text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-black uppercase tracking-wider text-cyan-300">Rasio Ketepatan Jawaban Kelas</h3>
                        <p class="text-[11px] text-white/40">Mengukur tingkat pemahaman kognitif siswa secara klasikal</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs"><span class="text-white/60">Akurasi Soal Mudah</span><span class="text-green-400 font-bold">82%</span></div>
                        <div class="w-full h-2 bg-white/10 rounded-full overflow-hidden"><div class="h-full bg-green-400 rounded-full" style="width: 82%"></div></div>
                    </div>
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs"><span class="text-white/60">Akurasi Soal Menengah</span><span class="text-purple-400 font-bold">68%</span></div>
                        <div class="w-full h-2 bg-white/10 rounded-full overflow-hidden"><div class="h-full bg-purple-400 rounded-full" style="width: 68%"></div></div>
                    </div>
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs"><span class="text-white/60">Akurasi Soal Sulit</span><span class="text-yellow-400 font-bold">54%</span></div>
                        <div class="w-full h-2 bg-white/10 rounded-full overflow-hidden"><div class="h-full bg-yellow-400 rounded-full" style="width: 54%"></div></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end mb-12 max-w-4xl mx-auto">
                @if(isset($topPlayers[1]))
                <div class="glass rounded-[30px] p-6 text-center border relative overflow-hidden order-2 md:order-1 podium-glow-2 min-h-[250px] flex flex-col justify-center">
                    <div class="absolute top-4 left-4 w-8 h-8 bg-slate-400 text-slate-950 font-black rounded-full flex items-center justify-center text-sm shadow">2</div>
                    <div class="w-20 h-20 rounded-2xl border-2 border-slate-400/50 p-1 mx-auto mb-4 bg-slate-950/60 shadow-inner">
                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed={{ $topPlayers[1]->user->name ?? 'User2' }}&colors=cyan" alt="Avatar" class="w-full h-full object-cover rounded-xl">
                    </div>
                    <h3 class="font-extrabold text-lg tracking-wide truncate">{{ $topPlayers[1]->user->name ?? 'Explorer' }}</h3>
                    <p class="text-xs text-white/50 mb-3">Level {{ floor(($topPlayers[1]->high_score * 10) / 100) + 1 }}</p>
                    <div class="inline-block bg-slate-400/10 text-slate-300 font-black px-4 py-2 rounded-xl border border-slate-400/20 text-md mx-auto">
                        {{ $topPlayers[1]->high_score }} <span class="text-xs font-normal text-white/40">Pts</span>
                    </div>
                </div>
                @endif

                @if(isset($topPlayers[0]))
                <div class="glass rounded-[32px] p-8 text-center border-2 relative overflow-hidden order-1 md:order-2 podium-glow-1 min-h-[290px] flex flex-col justify-center bg-gradient-to-b from-amber-500/10 to-transparent transform md:-translate-y-4">
                    <div class="absolute top-0 inset-x-0 flex justify-center"><div class="w-24 h-1 bg-gradient-to-r from-transparent via-yellow-400 to-transparent"></div></div>
                    <div class="absolute top-4 left-4 w-9 h-9 bg-gradient-to-br from-yellow-400 to-orange-500 text-slate-950 font-black rounded-full flex items-center justify-center text-base shadow-lg shadow-yellow-500/20"><i class="fa-solid fa-crown text-xs"></i></div>
                    <div class="w-24 h-24 rounded-2xl border-2 border-yellow-400 p-1 mx-auto mb-4 bg-slate-950/70 shadow-2xl shadow-yellow-500/20">
                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed={{ $topPlayers[0]->user->name ?? 'User1' }}&colors=amber,yellow" alt="Avatar" class="w-full h-full object-cover rounded-xl">
                    </div>
                    <h3 class="font-black text-xl tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-amber-400 truncate">{{ $topPlayers[0]->user->name ?? 'Supreme King' }}</h3>
                    <p class="text-xs text-yellow-400/70 font-semibold mb-4">Level {{ floor(($topPlayers[0]->high_score * 10) / 100) + 1 }} • Master</p>
                    <div class="inline-block bg-yellow-400 text-slate-950 font-black px-5 py-2 rounded-xl text-lg mx-auto shadow-xl shadow-yellow-500/20">
                        {{ $topPlayers[0]->high_score }} <span class="text-xs font-bold opacity-60">Pts</span>
                    </div>
                </div>
                @endif

                @if(isset($topPlayers[2]))
                <div class="glass rounded-[30px] p-6 text-center border relative overflow-hidden order-3 podium-glow-3 min-h-[230px] flex flex-col justify-center">
                    <div class="absolute top-4 left-4 w-8 h-8 bg-amber-700 text-white font-black rounded-full flex items-center justify-center text-sm shadow">3</div>
                    <div class="w-20 h-20 rounded-2xl border-2 border-amber-700/50 p-1 mx-auto mb-4 bg-slate-950/60 shadow-inner">
                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed={{ $topPlayers[2]->user->name ?? 'User3' }}&colors=purple" alt="Avatar" class="w-full h-full object-cover rounded-xl">
                    </div>
                    <h3 class="font-extrabold text-lg tracking-wide truncate">{{ $topPlayers[2]->user->name ?? 'Explorer' }}</h3>
                    <p class="text-xs text-white/50 mb-3">Level {{ floor(($topPlayers[2]->high_score * 10) / 100) + 1 }}</p>
                    <div class="inline-block bg-amber-700/10 text-amber-400 font-black px-4 py-2 rounded-xl border border-amber-700/20 text-md mx-auto">
                        {{ $topPlayers[2]->high_score }} <span class="text-xs font-normal text-white/40">Pts</span>
                    </div>
                </div>
                @endif
            </div>

            <div class="glass rounded-2xl p-4 mb-6 flex flex-col sm:flex-row items-center justify-between gap-4 border border-white/5 bg-slate-900/20">
                <div class="relative w-full sm:max-w-xs">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-white/40 text-xs"></i>
                    <input type="text" placeholder="Cari nama petualang..." class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-xs text-white placeholder-white/30 focus:outline-none focus:border-cyan-400/50 transition">
                </div>
                <div class="text-xs text-white/50 flex items-center gap-2 self-end sm:self-auto">
                    <i class="fa-solid fa-circle-info text-cyan-400"></i> Peringkat diperbarui secara otomatis setiap kuis selesai.
                </div>
            </div>

            <div class="space-y-3">
                <div class="hidden md:grid grid-cols-12 px-6 text-xs text-white/40 font-bold uppercase tracking-wider">
                    <div class="col-span-2">Posisi Peringkat</div>
                    <div class="col-span-5">Siswa</div>
                    <div class="col-span-3 text-center">Tingkat Level</div>
                    <div class="col-span-2 text-right">Skor Akumulasi</div>
                </div>

                @if(isset($topPlayers) && count($topPlayers) > 0)
                    @foreach($topPlayers as $index => $player)
                        <div class="glass rounded-2xl p-4 md:p-5 grid grid-cols-3 md:grid-cols-12 items-center border border-white/5 row-hover">
                            <div class="col-span-1 md:col-span-2 flex items-center gap-3">
                                <span class="text-sm font-black text-white/80 w-8">#{{ $index + 1 }}</span>
                                <span class="text-[10px] text-emerald-400 flex items-center gap-1 bg-emerald-400/10 px-1.5 py-0.5 rounded-md font-bold hidden md:inline-flex">
                                    <i class="fa-solid fa-caret-up"></i> Aktif
                                </span>
                            </div>

                            <div class="col-span-1 md:col-span-5 flex items-center gap-4 justify-center md:justify-start">
                                <div class="w-10 h-10 rounded-xl bg-slate-950/60 border border-white/10 p-1 shrink-0 shadow-inner">
                                    <img src="https://api.dicebear.com/7.x/bottts/svg?seed={{ $player->user->name ?? 'User' }}&colors=blue,cyan" alt="Avatar" class="w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="min-w-0 text-center md:text-left">
                                    <h4 class="font-bold text-sm tracking-wide text-white truncate">{{ $player->user->name ?? 'User Anonymous' }}</h4>
                                    <p class="text-[10px] text-cyan-400/70 font-medium md:hidden">Level {{ floor(($player->high_score * 10) / 100) + 1 }}</p>
                                </div>
                            </div>

                            <div class="hidden md:block col-span-3 text-center">
                                <span class="px-3 py-1 rounded-full bg-cyan-500/10 text-cyan-300 text-xs font-bold border border-cyan-500/20">
                                    Lv {{ floor(($player->high_score * 10) / 100) + 1 }}
                                </span>
                            </div>

                            <div class="col-span-1 md:col-span-2 text-right">
                                <span class="text-base font-black text-cyan-400 tracking-wide">{{ $player->high_score }}</span>
                                <span class="text-[10px] text-white/40 block md:inline font-medium"> Pts</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="glass rounded-3xl p-12 text-center border border-white/5">
                        <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center text-white/30 mx-auto mb-4">
                            <i class="fa-solid fa-users-slash text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-lg">Leaderboard Kosong</h4>
                        <p class="text-xs text-white/40 max-w-xs mx-auto mt-1">Belum ada siswa yang mendaftar skor terbaik musim ini.</p>
                    </div>
                @endif
            </div>

        </main>
    </div>

    @include('components.loading')
    @include('components.sound')
</body>
</html>