<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peringkat Global - Guiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>

<body class="bg-[#070d19] text-white min-h-screen flex selection:bg-cyan-500 selection:text-white">

    <!-- SIDEBAR NAVIGASI -->
    <aside class="w-64 bg-[#0b1324] border-r border-white/10 p-6 flex flex-col justify-between shrink-0 min-h-screen">
        <div>
            <!-- LOGO APLIKASI -->
            <div class="flex items-center gap-3 mb-10">
                <div class="w-10 h-10 rounded-xl bg-cyan-500 flex items-center justify-center text-white text-xl font-black shadow-lg shadow-cyan-500/30">
                    <i class="fa-solid fa-gamepad"></i>
                </div>
                <div>
                    <h1 class="font-extrabold text-lg leading-none tracking-wide text-white">Guiz</h1>
                    <span class="text-[10px] font-black text-cyan-400 tracking-widest uppercase">ADVENTURE</span>
                </div>
            </div>

            <!-- MENU SIDEBAR -->
            <nav class="space-y-2">
                <a href="{{ Route::has('dashboard') ? route('dashboard') : '#' }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">
                    <i class="fa-solid fa-border-all text-lg w-6"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ Route::has('game.level') ? route('game.level') : '#' }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">
                    <i class="fa-solid fa-play text-lg w-6"></i>
                    <span>Mulai Game</span>
                </a>

                <a href="{{ Route::has('game-kilat.level') ? route('game-kilat.level') : '#' }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">
                    <i class="fa-solid fa-bolt text-lg w-6"></i>
                    <span>Game Kilat (B/S)</span>
                </a>

                <a href="{{ Route::has('riwayat') ? route('riwayat') : '#' }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">
                    <i class="fa-solid fa-clock-rotate-left text-lg w-6"></i>
                    <span>Riwayat Kuis</span>
                </a>

                <a href="{{ Route::has('leaderboard') ? route('leaderboard') : '#' }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-cyan-500 text-white font-bold text-sm shadow-lg shadow-cyan-500/25">
                    <i class="fa-solid fa-chart-simple text-lg w-6"></i>
                    <span>Peringkat Global</span>
                </a>

                <a href="{{ Route::has('soal.index') ? route('soal.index') : '#' }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">
                    <i class="fa-solid fa-book-open text-lg w-6"></i>
                    <span>Kelola Bank Soal</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-6xl mx-auto space-y-8">

            <!-- HEADER BANNER -->
            <div class="glass rounded-[30px] p-8 relative overflow-hidden border border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center text-amber-400 text-2xl font-black shadow-lg">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-white">Global Leaderboard</h2>
                        <p class="text-white/60 text-sm mt-0.5">Panggung kehormatan peserta kuis dengan skor tertinggi.</p>
                    </div>
                </div>

                <div class="inline-flex p-1 bg-[#0b1324] rounded-2xl border border-white/10 self-start md:self-auto">
                    <button class="px-5 py-2.5 rounded-xl bg-cyan-500 text-white font-bold text-xs shadow-md">Semua Peserta</button>
                </div>
            </div>

            <!-- PODIUM PERINGKAT 1, 2, DAN 3 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end pt-4">
                
                <!-- JUARA 2 (PERAK) -->
                @if(isset($users[1]))
                    @php
                        $u2 = $users[1];
                        $name2 = is_array($u2) ? ($u2['name'] ?? 'Pemain') : ($u2->name ?? 'Pemain');
                        $xp2 = is_array($u2) ? ($u2['total_xp'] ?? $u2['score'] ?? 0) : ($u2->total_xp ?? $u2->score ?? 0);
                    @endphp
                    <div class="glass rounded-[25px] p-6 text-center border border-slate-400/30 relative order-2 md:order-1 transform hover:-translate-y-2 transition shadow-xl bg-slate-900/40">
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 rounded-full bg-slate-300 text-slate-900 font-black flex items-center justify-center text-sm shadow-md border-2 border-slate-100">
                            2
                        </div>
                        <div class="w-16 h-16 rounded-2xl bg-slate-400/20 border border-slate-300/40 mx-auto mb-3 flex items-center justify-center text-2xl text-slate-200 mt-2 font-black shadow-inner">
                            {{ strtoupper(substr($name2, 0, 1)) }}
                        </div>
                        <h3 class="font-bold text-lg text-white truncate" title="{{ $name2 }}">{{ $name2 }}</h3>
                        <p class="text-xs text-slate-300/80 mb-3 font-semibold">Runner Up #2</p>
                        <div class="inline-block px-4 py-1.5 rounded-xl bg-slate-400/20 text-slate-200 font-black text-sm border border-slate-400/30">
                            {{ number_format($xp2) }} XP
                        </div>
                    </div>
                @else
                    <div class="glass rounded-[25px] p-6 text-center border border-white/5 order-2 md:order-1 opacity-40">
                        <p class="text-xs text-white/50">Belum Ada Peserta #2</p>
                    </div>
                @endif

                <!-- JUARA 1 (EMAS) -->
                @if(isset($users[0]))
                    @php
                        $u1 = $users[0];
                        $name1 = is_array($u1) ? ($u1['name'] ?? 'Pemain') : ($u1->name ?? 'Pemain');
                        $xp1 = is_array($u1) ? ($u1['total_xp'] ?? $u1['score'] ?? 0) : ($u1->total_xp ?? $u1->score ?? 0);
                    @endphp
                    <div class="glass rounded-[25px] p-8 text-center border-2 border-amber-400/70 relative order-1 md:order-2 transform hover:-translate-y-2 transition shadow-2xl shadow-amber-500/20 bg-gradient-to-b from-amber-500/15 via-slate-900/80 to-slate-900/90">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-300 text-amber-950 font-black flex items-center justify-center text-xl shadow-lg border-2 border-yellow-200">
                            <i class="fa-solid fa-crown"></i>
                        </div>
                        <div class="w-20 h-20 rounded-2xl bg-amber-500/20 border-2 border-amber-400/60 mx-auto mb-3 flex items-center justify-center text-4xl font-black text-amber-300 mt-3 shadow-inner">
                            {{ strtoupper(substr($name1, 0, 1)) }}
                        </div>
                        <h3 class="font-extrabold text-2xl text-yellow-300 truncate" title="{{ $name1 }}">{{ $name1 }}</h3>
                        <p class="text-xs text-amber-400 font-bold mb-4 tracking-wider uppercase"><i class="fa-solid fa-trophy mr-1"></i> Juara Utama #1</p>
                        <div class="inline-block px-6 py-2 rounded-xl bg-amber-500/30 text-yellow-300 font-black text-lg border border-amber-400/50 shadow-lg shadow-amber-500/20">
                            {{ number_format($xp1) }} XP
                        </div>
                    </div>
                @else
                    <div class="glass rounded-[25px] p-8 text-center border border-white/5 order-1 md:order-2 opacity-40">
                        <p class="text-xs text-white/50">Belum Ada Peserta #1</p>
                    </div>
                @endif

                <!-- JUARA 3 (PERUNGGU) -->
                @if(isset($users[2]))
                    @php
                        $u3 = $users[2];
                        $name3 = is_array($u3) ? ($u3['name'] ?? 'Pemain') : ($u3->name ?? 'Pemain');
                        $xp3 = is_array($u3) ? ($u3['total_xp'] ?? $u3['score'] ?? 0) : ($u3->total_xp ?? $u3->score ?? 0);
                    @endphp
                    <div class="glass rounded-[25px] p-6 text-center border border-amber-700/40 relative order-3 transform hover:-translate-y-2 transition shadow-xl bg-slate-900/40">
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 rounded-full bg-amber-700 text-amber-100 font-black flex items-center justify-center text-sm shadow-md border-2 border-amber-600">
                            3
                        </div>
                        <div class="w-16 h-16 rounded-2xl bg-amber-800/20 border border-amber-700/40 mx-auto mb-3 flex items-center justify-center text-2xl text-amber-500 mt-2 font-black shadow-inner">
                            {{ strtoupper(substr($name3, 0, 1)) }}
                        </div>
                        <h3 class="font-bold text-lg text-white truncate" title="{{ $name3 }}">{{ $name3 }}</h3>
                        <p class="text-xs text-amber-600/80 mb-3 font-semibold">Peringkat #3</p>
                        <div class="inline-block px-4 py-1.5 rounded-xl bg-amber-800/20 text-amber-500 font-black text-sm border border-amber-700/30">
                            {{ number_format($xp3) }} XP
                        </div>
                    </div>
                @else
                    <div class="glass rounded-[25px] p-6 text-center border border-white/5 order-3 opacity-40">
                        <p class="text-xs text-white/50">Belum Ada Peserta #3</p>
                    </div>
                @endif

            </div>

            <!-- TABEL DAFTAR KLASEMEN SEMUA PESERTA -->
            <div class="glass rounded-[25px] overflow-hidden border border-white/10 shadow-2xl">
                <div class="p-6 border-b border-white/10 flex items-center justify-between">
                    <h3 class="font-bold text-base text-white flex items-center gap-2">
                        <i class="fa-solid fa-users text-cyan-400"></i> Daftar Seluruh Nama Peserta
                    </h3>
                    <span class="text-xs text-white/40 font-medium">Diperbarui secara real-time</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/10 bg-white/5 text-white/40 text-[11px] font-black uppercase tracking-wider">
                                <th class="p-5 text-center w-20">RANK</th>
                                <th class="p-5">NAMA LENGKAP PESERTA</th>
                                <th class="p-5 text-center w-40">PEROLEHAN SKOR</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-sm">
                            @forelse($users as $index => $user)
                            @php
                                $userName = is_array($user) ? ($user['name'] ?? 'Pemain') : ($user->name ?? 'Pemain');
                                $userXp = is_array($user) ? ($user['total_xp'] ?? $user['score'] ?? 0) : ($user->total_xp ?? $user->score ?? 0);
                            @endphp
                            <tr class="hover:bg-white/5 transition {{ $index == 0 ? 'bg-amber-500/5' : '' }}">
                                <!-- RANK -->
                                <td class="p-5 text-center font-extrabold">
                                    @if($index == 0)
                                        <span class="w-8 h-8 rounded-xl bg-yellow-400 text-yellow-950 flex items-center justify-center mx-auto text-xs font-black shadow">1</span>
                                    @elseif($index == 1)
                                        <span class="w-8 h-8 rounded-xl bg-slate-300 text-slate-900 flex items-center justify-center mx-auto text-xs font-black shadow">2</span>
                                    @elseif($index == 2)
                                        <span class="w-8 h-8 rounded-xl bg-amber-700 text-amber-100 flex items-center justify-center mx-auto text-xs font-black shadow">3</span>
                                    @else
                                        <span class="text-white/40 font-bold">#{{ $index + 1 }}</span>
                                    @endif
                                </td>

                                <!-- NAMA PESERTA -->
                                <td class="p-5 font-bold text-white flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 flex items-center justify-center text-sm font-black shrink-0">
                                        {{ strtoupper(substr($userName, 0, 1)) }}
                                    </div>
                                    <span class="text-base">{{ $userName }}</span>
                                </td>

                                <!-- SKOR -->
                                <td class="p-5 text-center font-black text-cyan-400 text-base">
                                    {{ number_format($userXp) }} XP
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="p-10 text-center text-white/40 font-medium">
                                    Belum ada data nama peserta kuis.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>