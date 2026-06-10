<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Hub - Guiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .glass {
            background: rgba(11, 19, 35, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .card-cyber {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-cyber:hover {
            transform: translateY(-5px) scale(1.005);
            box-shadow: 0 15px 35px rgba(34, 211, 238, 0.15);
            border-color: rgba(34, 211, 238, 0.4);
        }
        /* Custom Scrolling styling for gaming console vibes */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(34, 211, 238, 0.3);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(34, 211, 238, 0.5);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden text-white antialiased" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#030712]/85 -z-20"></div>
    <div class="fixed inset-0 bg-gradient-to-tr from-purple-950/10 via-slate-950/40 to-cyan-950/10 -z-10"></div>

    <div class="absolute top-20 left-10 w-64 h-64 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none animate-pulse"></div>
    <div class="absolute bottom-20 right-10 w-72 h-72 rounded-full bg-purple-500/10 blur-3xl pointer-events-none"></div>

    <div class="relative z-10 flex min-h-screen">

        <aside class="hidden lg:flex flex-col w-72 p-6 glass border-r border-white/10 shrink-0">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,0.5)]">
                    <i class="fa-solid fa-gamepad text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black tracking-wide text-white">Guiz</h1>
                    <p class="text-cyan-400 text-xs font-bold uppercase tracking-widest">Adventure</p>
                </div>
            </div>

            <nav class="space-y-3 flex-1">
                <a href="/dashboard" class="flex items-center gap-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white p-4 rounded-2xl font-bold shadow-[0_0_20px_rgba(59,130,246,0.3)] transition">
                    <i class="fa-solid fa-columns text-lg w-6 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/game/level" class="flex items-center gap-4 text-white/70 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition font-semibold group">
                    <i class="fa-solid fa-play text-lg text-cyan-400 w-6 text-center group-hover:scale-110 transition-transform"></i>
                    <span>Mulai Game</span>
                </a>
                <a href="/leaderboard" class="flex items-center gap-4 text-white/70 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition font-semibold group">
                    <i class="fa-solid fa-ranking-star text-lg text-yellow-400 w-6 text-center group-hover:scale-110 transition-transform"></i>
                    <span>Peringkat Global</span>
                </a>
                <a href="/riwayat" class="flex items-center gap-4 text-white/70 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition font-semibold group">
                    <i class="fa-solid fa-clock-rotate-left text-lg text-purple-400 w-6 text-center group-hover:scale-110 transition-transform"></i>
                    <span>Riwayat Kuis</span>
                </a>
                <a href="/soal" class="flex items-center gap-4 text-white/70 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition font-semibold group">
                    <i class="fa-solid fa-book-open text-lg text-emerald-400 w-6 text-center group-hover:scale-110 transition-transform"></i>
                    <span>Kelola Bank Soal</span>
                </a>
            </nav>

            <div class="pt-4 border-t border-white/5">
                <a href="/logout" class="flex items-center justify-center gap-3 bg-red-500/10 hover:bg-red-500/20 text-red-400 p-4 rounded-2xl font-bold transition border border-red-500/20">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar Sistem</span>
                </a>
            </div>
        </aside>

        <main class="flex-1 p-4 lg:p-8 max-w-7xl mx-auto w-full overflow-y-auto pb-24">
            
            <div class="lg:hidden flex items-center justify-between mb-6 p-4 glass rounded-2xl border border-white/5">
                <div>
                    <h1 class="text-xl font-black">Guiz Adventure</h1>
                    <p class="text-cyan-400 text-xs font-medium">Main Hub Console</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl overflow-hidden bg-slate-900 border border-white/10 p-0.5">
                        <img src="https://api.dicebear.com/7.x/adventurer/svg?seed={{ Auth::user()->name }}" alt="Avatar" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <a href="/logout" class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center text-red-400 border border-red-500/20">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>

            <div class="glass rounded-[35px] p-6 lg:p-8 mb-8 relative overflow-hidden border border-cyan-500/20 shadow-[0_0_30px_rgba(34,211,238,0.05)]">
                <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-cyan-500/5 to-transparent pointer-events-none hidden lg:block"></div>
                
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 relative z-10">
                    <div class="space-y-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/20 text-cyan-300 text-xs font-bold uppercase tracking-wider border border-cyan-400/20">
                            <i class="fa-solid fa-wand-magic-sparkles text-[10px]"></i> {{ $greeting ?? 'Selamat Datang' }}
                        </span>
                        <h1 class="text-3xl lg:text-5xl font-black tracking-tight leading-tight">
                            Halo, <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-400 to-indigo-400">{{ Auth::user()->name }}</span>!<br>
                            Siap Memulai Petualangan?
                        </h1>
                        <p class="text-white/60 max-w-xl text-xs lg:text-sm leading-relaxed pt-1">
                            Jelajahi gerbang pengetahuan edukatif, taklukkan ribuan tantangan kuis berbasis logika kognitif, dan klaim posisi takhta terbaikmu di puncak peringkat global!
                        </p>
                        <div class="pt-3">
                            <a href="/game/level" class="inline-flex items-center gap-3 bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 hover:opacity-95 text-white px-6 py-4 rounded-2xl font-black text-sm shadow-xl shadow-blue-500/20 transition-all transform hover:-translate-y-0.5">
                                <i class="fa-solid fa-circle-play text-base"></i>
                                <span>MASUK ARENA PERMAINAN</span>
                            </a>
                        </div>
                    </div>

                    <div class="glass rounded-2xl p-5 min-w-[290px] w-full lg:w-auto border border-white/10 bg-slate-900/50 shadow-inner">
                        <div class="flex items-center gap-3.5 mb-4">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 p-0.5 shrink-0 shadow-[0_0_15px_rgba(34,211,238,0.3)]">
                                <img src="https://api.dicebear.com/7.x/adventurer/svg?seed={{ Auth::user()->name }}" alt="Avatar" class="w-full h-full object-cover rounded-lg bg-slate-950">
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-white font-black text-base truncate">{{ Auth::user()->name }}</h3>
                                <span class="px-2 py-0.5 rounded text-[10px] bg-cyan-500/20 text-cyan-300 font-extrabold border border-cyan-400/20 tracking-wider uppercase inline-block mt-0.5">
                                    {{ $title ?? 'Ksatria Kuis' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="space-y-1.5 border-t border-white/5 pt-3">
                            <div class="flex justify-between text-xs font-semibold">
                                <span class="text-white/50">Progres Menuju Level Selanjutnya</span>
                                <span class="text-cyan-400 font-bold">{{ $progressPercent ?? 0 }}%</span>
                            </div>
                            <div class="w-full h-2 rounded-full bg-white/10 overflow-hidden p-0.5">
                                <div class="h-full rounded-full bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500 transition-all duration-500" style="width: {{ $progressPercent ?? 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="glass rounded-2xl p-5 card-cyber border border-white/5 relative overflow-hidden group">
                    <div class="absolute right-0 bottom-0 translate-x-3 translate-y-3 text-white/[0.01] text-7xl font-black group-hover:scale-110 transition-transform pointer-events-none"><i class="fa-solid fa-bolt"></i></div>
                    <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 mb-4 shadow-[0_0_15px_rgba(34,211,238,0.1)]">
                        <i class="fa-solid fa-bolt text-base"></i>
                    </div>
                    <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest">Level Akun</p>
                    <h2 class="text-2xl font-black mt-1 text-white tracking-wide">{{ $level ?? 1 }}</h2>
                </div>

                <div class="glass rounded-2xl p-5 card-cyber border border-white/5 relative overflow-hidden group">
                    <div class="absolute right-0 bottom-0 translate-x-3 translate-y-3 text-white/[0.01] text-7xl font-black group-hover:scale-110 transition-transform pointer-events-none"><i class="fa-solid fa-fire"></i></div>
                    <div class="w-10 h-10 rounded-xl bg-pink-500/10 border border-pink-500/20 flex items-center justify-center text-pink-400 mb-4 shadow-[0_0_15px_rgba(244,63,94,0.1)]">
                        <i class="fa-solid fa-fire text-base"></i>
                    </div>
                    <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest">Akumulasi XP</p>
                    <h2 class="text-2xl font-black mt-1 text-pink-400 tracking-wide">{{ $xp ?? 0 }}</h2>
                </div>

                <div class="glass rounded-2xl p-5 card-cyber border border-white/5 relative overflow-hidden group">
                    <div class="absolute right-0 bottom-0 translate-x-3 translate-y-3 text-white/[0.01] text-7xl font-black group-hover:scale-110 transition-transform pointer-events-none"><i class="fa-solid fa-trophy"></i></div>
                    <div class="w-10 h-10 rounded-xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center text-yellow-400 mb-4 shadow-[0_0_15px_rgba(234,179,8,0.1)]">
                        <i class="fa-solid fa-trophy text-base"></i>
                    </div>
                    <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest">High Score</p>
                    <h2 class="text-2xl font-black mt-1 text-yellow-400 tracking-wide">{{ $progress->high_score }}</h2>
                </div>

                <div class="glass rounded-2xl p-5 card-cyber border border-white/5 relative overflow-hidden group">
                    <div class="absolute right-0 bottom-0 translate-x-3 translate-y-3 text-white/[0.01] text-7xl font-black group-hover:scale-110 transition-transform pointer-events-none"><i class="fa-solid fa-calendar-day"></i></div>
                    <div class="w-10 h-10 rounded-xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center text-orange-400 mb-4 shadow-[0_0_15px_rgba(249,115,22,0.1)]">
                        <i class="fa-solid fa-calendar-day text-base"></i>
                    </div>
                    <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest">Login Streak</p>
                    <h2 class="text-2xl font-black mt-1 text-orange-400 tracking-wide">🔥 {{ $progress->login_streak ?? 1 }} H</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="glass rounded-[30px] p-6 border border-white/5">
                        <h3 class="font-black text-lg mb-5 flex items-center gap-2.5">
                            <i class="fa-solid fa-bullseye text-pink-400 text-base"></i> Papan Misi Quest Harian
                        </h3>
                        
                        <div class="p-4 bg-white/5 border border-white/5 rounded-2xl space-y-3 card-cyber">
                            <div class="flex justify-between items-center">
                                <h4 class="text-sm font-bold text-white/90">Quiz Explorer Master</h4>
                                <span class="text-xs text-cyan-300 font-extrabold bg-cyan-500/10 px-2 py-0.5 rounded border border-cyan-400/20">+25 XP Multiplier</span>
                            </div>
                            <p class="text-xs text-white/50 leading-relaxed">Selesaikan minimal batas aman pengerjaan 5 tantangan soal kuis hari ini untuk mengklaim reward harian.</p>
                            <div class="space-y-1.5 pt-1">
                                <div class="w-full h-2 rounded-full bg-white/10 overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-cyan-400 to-blue-500 transition-all duration-300" style="width: {{ min(($progress->high_score / 5) * 100, 100) }}%"></div>
                                </div>
                                <div class="text-right text-[10px] text-white/40 font-bold tracking-wide">{{ min($progress->high_score, 5) }}/5 Soal Selesai</div>
                            </div>
                        </div>
                    </div>

                    <div class="glass rounded-[30px] p-6 border border-white/5">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-5 border-b border-white/5 pb-3">
                            <div>
                                <h3 class="font-black text-lg flex items-center gap-2.5">
                                    <i class="fa-solid fa-brain text-cyan-400 text-base"></i> Parameter Berpikir Kritis Siswa
                                </h3>
                                <p class="text-[11px] text-white/40 mt-0.5">Analisis instrumen indikator evaluasi kognitif siswa secara dinamis</p>
                            </div>
                            <span class="text-[10px] bg-cyan-400/10 text-cyan-300 font-extrabold px-3 py-1 rounded-full border border-cyan-400/20 uppercase text-center self-start">
                                {{ ($xp ?? 0) >= 100 ? 'Tingkat Kognitif: Tinggi' : 'Tingkat Kognitif: Dasar' }}
                            </span>
                        </div>

                        <div class="space-y-4">
                            <div class="space-y-1.5">
                                <div class="flex justify-between text-xs font-semibold"><span class="text-white/70">1. Aspek Analisis (Pemetaan Argumen Soal)</span><span class="text-cyan-400">80%</span></div>
                                <div class="w-full h-2 rounded-full bg-white/10 overflow-hidden p-0.5"><div class="h-full rounded-full bg-gradient-to-r from-cyan-400 to-cyan-500" style="width: 80%"></div></div>
                            </div>
                            <div class="space-y-1.5">
                                <div class="flex justify-between text-xs font-semibold"><span class="text-white/70">2. Aspek Evaluasi (Kredibilitas Argumen)</span><span class="text-purple-400">65%</span></div>
                                <div class="w-full h-2 rounded-full bg-white/10 overflow-hidden p-0.5"><div class="h-full rounded-full bg-gradient-to-r from-purple-400 to-purple-500" style="width: 65%"></div></div>
                            </div>
                            <div class="space-y-1.5">
                                <div class="flex justify-between text-xs font-semibold"><span class="text-white/70">3. Aspek Inferensi (Penarikan Kesimpulan Siswa)</span><span class="text-yellow-400">55%</span></div>
                                <div class="w-full h-2 rounded-full bg-white/10 overflow-hidden p-0.5"><div class="h-full rounded-full bg-gradient-to-r from-yellow-400 to-orange-500" style="width: 55%"></div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="glass rounded-[30px] p-5 border border-white/5">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="font-black text-sm tracking-wide">Adventure Pass Rewards</h3>
                                <p class="text-[10px] text-white/40 mt-0.5">Klaim item terbatas sesuai level</p>
                            </div>
                            <span class="px-2 py-0.5 rounded bg-purple-500/20 text-purple-300 text-[9px] font-bold border border-purple-400/20 tracking-wider uppercase">Tier Pass {{ $level ?? 1 }}</span>
                        </div>

                        <div class="space-y-2.5 max-h-56 overflow-y-auto pr-1">
                            <div class="flex items-center gap-3 p-2.5 rounded-xl bg-white/5 {{ ($level ?? 1) >= 1 ? 'border border-cyan-500/30 bg-cyan-500/5' : 'opacity-40' }}">
                                <div class="w-8 h-8 rounded-lg bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-xs font-black shrink-0">T1</div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold truncate text-white/90">Bronze Star Bundle</p>
                                    <p class="text-[9px] text-white/40">+50 Bonus Poin Ekstra</p>
                                </div>
                                @if(($level ?? 1) >= 1) <i class="fa-solid fa-circle-check text-cyan-400 text-base"></i> @endif
                            </div>

                            <div class="flex items-center gap-3 p-2.5 rounded-xl bg-white/5 {{ ($level ?? 1) >= 3 ? 'border border-emerald-500/30 bg-emerald-500/5' : 'opacity-40' }}">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center text-emerald-400 text-xs font-black shrink-0">T3</div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold truncate text-white/90">Magic Crystal Core</p>
                                    <p class="text-[9px] text-white/40">Lencana Koleksi Rare Badge</p>
                                </div>
                                @if(($level ?? 1) >= 3) <i class="fa-solid fa-circle-check text-emerald-400 text-base"></i> @endif
                            </div>

                            <div class="flex items-center gap-3 p-2.5 rounded-xl bg-white/5 {{ ($level ?? 1) >= 5 ? 'border border-yellow-500/30 bg-yellow-500/5' : 'opacity-40' }}">
                                <div class="w-8 h-8 rounded-lg bg-yellow-400/20 flex items-center justify-center text-yellow-400 text-xs font-black shrink-0">T5</div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold truncate text-white/90">Supreme Golden Crown</p>
                                    <p class="text-[9px] text-white/40">Gelar Reputasi Legenda Kuis</p>
                                </div>
                                @if(($level ?? 1) >= 5) <i class="fa-solid fa-circle-check text-yellow-400 text-base"></i> @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="glass rounded-[30px] p-6 border border-white/5">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-black text-base flex items-center gap-2">
                        <i class="fa-solid fa-crown text-yellow-400 text-sm"></i> Papan Skor Peringkat Global
                    </h3>
                    <a href="/leaderboard" class="text-xs text-cyan-400 hover:underline font-semibold tracking-wide">Lihat Seluruh Pemain <i class="fa-solid fa-arrow-right text-[10px] ml-0.5"></i></a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @if(isset($topPlayers) && count($topPlayers) > 0)
                        @foreach($topPlayers->take(3) as $index => $player)
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-white/5 border border-white/5 card-cyber">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="font-black text-xs w-5 text-center
                                        {{ $index == 0 ? 'text-yellow-400 drop-shadow-[0_0_6px_rgba(234,179,8,0.5)]' : '' }}
                                        {{ $index == 1 ? 'text-slate-300' : '' }}
                                        {{ $index == 2 ? 'text-amber-600' : '' }}
                                    ">#{{ $index + 1 }}</span>
                                    <p class="font-bold text-sm text-white/90 truncate">{{ $player->user->name ?? 'Explorer' }}</p>
                                </div>
                                <span class="font-black text-sm text-cyan-400 ml-2 shrink-0">{{ $player->high_score }} <span class="text-[10px] text-white/40 font-normal">Pts</span></span>
                            </div>
                        @endforeach
                    @else
                        <p class="text-xs text-white/40 text-center py-4 col-span-3">Belum ada pemain terdaftar di leaderboard global.</p>
                    @endif
                </div>
            </div>

        </main>
    </div>

    @include('components.loading')
    @include('components.sound')
    @include('components.level-up')

</body>
</html>