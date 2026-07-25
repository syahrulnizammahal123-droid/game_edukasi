<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kuis - Guiz Adventure</title>

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

                <a href="{{ Route::has('riwayat') ? route('riwayat') : '#' }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-cyan-500 text-white font-bold text-sm shadow-lg shadow-cyan-500/25">
                    <i class="fa-solid fa-clock-rotate-left text-lg w-6"></i>
                    <span>Riwayat Kuis</span>
                </a>

                <a href="{{ Route::has('leaderboard') ? route('leaderboard') : '#' }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">
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
                    <div class="w-14 h-14 rounded-2xl bg-cyan-500/20 border border-cyan-500/30 flex items-center justify-center text-cyan-400 text-2xl font-black shadow-lg">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-white">Riwayat Permainan</h2>
                        <p class="text-white/60 text-sm mt-0.5">Daftar pencapaian dan skor kuis yang telah kamu selesaikan.</p>
                    </div>
                </div>
            </div>

            <!-- TABEL DAFTAR RIWAYAT -->
            <div class="glass rounded-[25px] overflow-hidden border border-white/10 shadow-2xl">
                <div class="p-6 border-b border-white/10 flex items-center justify-between">
                    <h3 class="font-bold text-base text-white flex items-center gap-2">
                        <i class="fa-solid fa-gamepad text-cyan-400"></i> Catatan Aktivitas Kuis
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/10 bg-white/5 text-white/40 text-[11px] font-black uppercase tracking-wider">
                                <th class="p-5 text-center w-16">NO</th>
                                <th class="p-5">MODE PERMAINAN</th>
                                <th class="p-5 text-center">SKOR DIDEAPAT</th>
                                <th class="p-5 text-center">STATUS</th>
                                <th class="p-5 text-center">TANGGAL</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-sm">
                            <tr class="hover:bg-white/5 transition">
                                <td class="p-5 text-center font-bold text-white/40">1</td>
                                <td class="p-5 font-bold text-white flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-xs font-black">
                                        <i class="fa-solid fa-gamepad"></i>
                                    </div>
                                    <span>Pilihan Ganda - Informatika SMK</span>
                                </td>
                                <td class="p-5 text-center font-black text-amber-400">+125 XP</td>
                                <td class="p-5 text-center">
                                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-xs font-bold">Lulus</span>
                                </td>
                                <td class="p-5 text-center text-white/50 text-xs">25 Juli 2026</td>
                            </tr>
                            <tr class="hover:bg-white/5 transition">
                                <td class="p-5 text-center font-bold text-white/40">2</td>
                                <td class="p-5 font-bold text-white flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-yellow-500/20 text-yellow-400 flex items-center justify-center text-xs font-black">
                                        <i class="fa-solid fa-bolt"></i>
                                    </div>
                                    <span>Game Kilat (B/S)</span>
                                </td>
                                <td class="p-5 text-center font-black text-amber-400">+80 XP</td>
                                <td class="p-5 text-center">
                                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-xs font-bold">Lulus</span>
                                </td>
                                <td class="p-5 text-center text-white/50 text-xs">24 Juli 2026</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>