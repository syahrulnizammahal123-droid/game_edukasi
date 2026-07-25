<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Bank Soal - Guiz Adventure</title>

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

<body class="bg-[#070d19] text-white min-h-screen flex">

    <!-- SIDEBAR NAVIGASI -->
    <aside class="w-64 bg-[#0b1324] border-r border-white/10 p-6 flex flex-col justify-between shrink-0">
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

            <!-- MENU SIDEBAR (ROUTE LINK DI-UPDATE) -->
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">
                    <i class="fa-solid fa-border-all text-lg w-6"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('game.level') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">
                    <i class="fa-solid fa-play text-lg w-6"></i>
                    <span>Mulai Game</span>
                </a>

                <a href="{{ route('game-kilat.level') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">
                    <i class="fa-solid fa-bolt text-lg w-6"></i>
                    <span>Game Kilat (B/S)</span>
                </a>

                <a href="{{ route('leaderboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">
                    <i class="fa-solid fa-chart-simple text-lg w-6"></i>
                    <span>Peringkat Global</span>
                </a>

                <a href="{{ route('riwayat') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">
                    <i class="fa-solid fa-clock-rotate-left text-lg w-6"></i>
                    <span>Riwayat Kuis</span>
                </a>

                <a href="{{ route('soal.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-cyan-500 text-white font-bold text-sm shadow-lg shadow-cyan-500/25">
                    <i class="fa-solid fa-book-open text-lg w-6"></i>
                    <span>Kelola Bank Soal</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-6xl mx-auto space-y-8">

            <!-- HEADER PAGE BANNER -->
            <div class="glass rounded-[30px] p-8 relative overflow-hidden border border-white/10">
                <div class="relative z-10">
                    <span class="px-3 py-1 rounded-xl bg-cyan-500/10 text-cyan-400 text-[11px] font-black border border-cyan-400/20 uppercase tracking-widest mb-3 inline-block">
                        <i class="fa-solid fa-database mr-1"></i> CONTROL PANEL GURU
                    </span>
                    <h2 class="text-3xl font-extrabold text-white">Manajemen Bank Soal</h2>
                    <p class="text-white/60 text-sm mt-1">Perbarui, tambah, atau hapus instrumen kuis penelitian dengan mudah.</p>
                </div>
            </div>

            <!-- AREA TOMBOL TAB KATEGORI DAN TOMBOL + TAMBAH SOAL BARU -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                
                <!-- TAB PILIHAN KATEGORI SOAL -->
                <div class="inline-flex p-1.5 bg-[#0b1324] rounded-2xl border border-white/10 w-fit">
                    <a href="{{ route('soal.index') }}" class="px-5 py-2.5 rounded-xl bg-cyan-500 text-white font-bold text-xs flex items-center gap-2 shadow-md">
                        <i class="fa-solid fa-list-check"></i>
                        <span>Adventure Quiz (Pilihan Ganda)</span>
                    </a>
                    <a href="#" class="px-5 py-2.5 rounded-xl text-white/50 hover:text-white font-bold text-xs flex items-center gap-2 transition">
                        <i class="fa-solid fa-bolt"></i>
                        <span>Game Kilat (Benar / Salah)</span>
                    </a>
                </div>

                <!-- TOMBOL UTAMA TAMBAH SOAL BARU -->
                <a href="{{ route('soal.create') }}" class="px-6 py-3 rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-extrabold text-sm shadow-lg shadow-cyan-500/25 hover:brightness-110 active:scale-95 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus text-base"></i>
                    <span>Tambah Soal Baru</span>
                </a>

            </div>

            <!-- TABEL DAFTAR SOAL -->
            <div class="glass rounded-[25px] overflow-hidden border border-white/10 shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/10 bg-white/5 text-white/40 text-[11px] font-black uppercase tracking-wider">
                                <th class="p-5 text-center w-16">LVL</th>
                                <th class="p-5">PERTANYAAN BERPIKIR KRITIS</th>
                                <th class="p-5 text-center w-32">KUNCI PG</th>
                                <th class="p-5 text-center w-36">AKSI KONTROL</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-sm">
                            @forelse($soals as $item)
                            <tr class="hover:bg-white/5 transition">
                                <!-- KOLOM LEVEL -->
                                <td class="p-5 text-center font-extrabold">
                                    <span class="px-2.5 py-1 rounded-lg bg-cyan-500/20 text-cyan-400 text-xs border border-cyan-500/30">
                                        Lvl {{ $loop->iteration }}
                                    </span>
                                </td>

                                <!-- KOLOM TEKS PERTANYAAN -->
                                <td class="p-5 text-white/90 font-medium leading-relaxed">
                                    {{ $item->pertanyaan }}
                                </td>

                                <!-- KOLOM KUNCI JAWABAN -->
                                <td class="p-5 text-center">
                                    <span class="px-3 py-1 rounded-xl bg-white/10 text-white font-bold text-xs border border-white/10">
                                        Opsi {{ strtoupper($item->jawaban) }}
                                    </span>
                                </td>

                                <!-- KOLOM TOMBOL EDIT & HAPUS -->
                                <td class="p-5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- TOMBOL EDIT -->
                                        <a href="{{ route('soal.edit', $item->id) }}" class="w-9 h-9 rounded-xl bg-amber-500/20 border border-amber-500/30 text-amber-400 hover:bg-amber-500 hover:text-white flex items-center justify-center transition shadow-sm" title="Edit Soal">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- TOMBOL HAPUS -->
                                        <form action="{{ route('soal.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-9 h-9 rounded-xl bg-rose-500/20 border border-rose-500/30 text-rose-400 hover:bg-rose-500 hover:text-white flex items-center justify-center transition shadow-sm" title="Hapus Soal">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-10 text-center text-white/40 font-medium">
                                    <i class="fa-solid fa-folder-open text-3xl mb-3 block opacity-30"></i>
                                    Belum ada butir soal yang ditambahkan. Silakan klik tombol <b>+ Tambah Soal Baru</b> di atas!
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