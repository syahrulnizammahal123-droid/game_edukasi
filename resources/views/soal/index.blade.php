<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manajemen Bank Soal - Quiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>


<body class="bg-[#070d19] text-white min-h-screen flex">


    <!-- =========================================================
         SIDEBAR
    ========================================================== -->

    <aside class="w-64 bg-[#0b1324] border-r border-white/10 p-6 flex flex-col justify-between shrink-0">

        <div>

            <!-- LOGO -->
            <div class="flex items-center gap-3 mb-10">

                <div class="w-10 h-10 rounded-xl bg-cyan-500 flex items-center justify-center text-white text-xl font-black shadow-lg shadow-cyan-500/30">

                    <i class="fa-solid fa-gamepad"></i>

                </div>

                <div>

                    <h1 class="font-extrabold text-lg leading-none tracking-wide text-white">
                        Guiz
                    </h1>

                    <span class="text-[10px] font-black text-cyan-400 tracking-widest uppercase">
                        ADVENTURE
                    </span>

                </div>

            </div>


            <!-- MENU -->
            <nav class="space-y-2">


                <!-- DASHBOARD -->
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">

                    <i class="fa-solid fa-border-all text-lg w-6"></i>

                    <span>
                        Dashboard
                    </span>

                </a>


                <!-- MULAI GAME -->
                <a href="{{ route('game.level') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">

                    <i class="fa-solid fa-play text-lg w-6"></i>

                    <span>
                        Mulai Game
                    </span>

                </a>


                <!-- LEADERBOARD -->
                <a href="{{ route('leaderboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">

                    <i class="fa-solid fa-chart-simple text-lg w-6"></i>

                    <span>
                        Peringkat Global
                    </span>

                </a>


                <!-- RIWAYAT -->
                <a href="{{ route('riwayat') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/60 hover:text-white hover:bg-white/5 transition font-medium text-sm">

                    <i class="fa-solid fa-clock-rotate-left text-lg w-6"></i>

                    <span>
                        Riwayat Kuis
                    </span>

                </a>


                <!-- BANK SOAL -->
                <a href="{{ route('soal.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-cyan-500 text-white font-bold text-sm shadow-lg shadow-cyan-500/25">

                    <i class="fa-solid fa-book-open text-lg w-6"></i>

                    <span>
                        Kelola Bank Soal
                    </span>

                </a>

            </nav>

        </div>


        <!-- FOOTER SIDEBAR -->
        <div class="text-center text-white/30 text-[10px]">

            Quiz Adventure

        </div>

    </aside>


    <!-- =========================================================
         KONTEN UTAMA
    ========================================================== -->

    <main class="flex-1 p-8 overflow-y-auto">

        <div class="max-w-6xl mx-auto space-y-8">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="glass rounded-[30px] p-8 relative overflow-hidden border border-white/10">

                <div class="relative z-10">

                    <span class="px-3 py-1 rounded-xl bg-cyan-500/10 text-cyan-400 text-[11px] font-black border border-cyan-400/20 uppercase tracking-widest mb-3 inline-block">

                        <i class="fa-solid fa-database mr-1"></i>

                        CONTROL PANEL GURU & ADMIN

                    </span>


                    <h2 class="text-3xl font-extrabold text-white">
                        Manajemen Bank Soal
                    </h2>


                    <p class="text-white/60 text-sm mt-1">
                        Perbarui, tambah, atau hapus instrumen kuis penelitian dengan mudah.
                    </p>

                </div>

            </div>


            <!-- =================================================
                 PESAN SUCCESS
            ================================================== -->

            @if(session('success'))

                <div class="rounded-2xl bg-green-500/10 border border-green-500/30 text-green-300 px-5 py-4">

                    <i class="fa-solid fa-circle-check mr-2"></i>

                    {{ session('success') }}

                </div>

            @endif


            <!-- =================================================
                 PESAN ERROR
            ================================================== -->

            @if(session('error'))

                <div class="rounded-2xl bg-red-500/10 border border-red-500/30 text-red-300 px-5 py-4">

                    <i class="fa-solid fa-triangle-exclamation mr-2"></i>

                    {{ session('error') }}

                </div>

            @endif


            <!-- =================================================
                 TOMBOL KATEGORI + TAMBAH
            ================================================== -->

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">


                <!-- TAB -->
                <div class="inline-flex p-1.5 bg-[#0b1324] rounded-2xl border border-white/10 w-fit">

                    <a href="{{ route('soal.index') }}"
                       class="px-5 py-2.5 rounded-xl bg-cyan-500 text-white font-bold text-xs flex items-center gap-2 shadow-md">

                        <i class="fa-solid fa-list-check"></i>

                        <span>
                            Adventure Quiz (Pilihan Ganda)
                        </span>

                    </a>

                </div>


                <!-- TAMBAH -->
                <a href="{{ route('soal.create') }}"
                   class="px-6 py-3 rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-extrabold text-sm shadow-lg shadow-cyan-500/25 hover:brightness-110 active:scale-95 transition flex items-center justify-center gap-2">

                    <i class="fa-solid fa-plus text-base"></i>

                    <span>
                        Tambah Soal Baru
                    </span>

                </a>

            </div>


            <!-- =================================================
                 INFORMASI LEVEL
            ================================================== -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


                <!-- LEVEL 1 -->
                <div class="bg-cyan-500/10 border border-cyan-500/20 rounded-2xl p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-xs text-cyan-300 uppercase font-bold tracking-wider">
                                Level 1
                            </p>

                            <p class="text-white/50 text-xs mt-1">
                                Mudah
                            </p>

                        </div>

                        <div class="w-11 h-11 rounded-xl bg-cyan-500/20 flex items-center justify-center">

                            <i class="fa-solid fa-seedling text-cyan-400"></i>

                        </div>

                    </div>

                    <p class="text-white text-2xl font-black mt-4">

                        {{ $soals->where('level', 1)->count() }}

                        <span class="text-xs text-white/40 font-normal">
                            soal
                        </span>

                    </p>

                </div>


                <!-- LEVEL 2 -->
                <div class="bg-purple-500/10 border border-purple-500/20 rounded-2xl p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-xs text-purple-300 uppercase font-bold tracking-wider">
                                Level 2
                            </p>

                            <p class="text-white/50 text-xs mt-1">
                                Sedang
                            </p>

                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-500/20 flex items-center justify-center">

                            <i class="fa-solid fa-dragon text-purple-400"></i>

                        </div>

                    </div>

                    <p class="text-white text-2xl font-black mt-4">

                        {{ $soals->where('level', 2)->count() }}

                        <span class="text-xs text-white/40 font-normal">
                            soal
                        </span>

                    </p>

                </div>


                <!-- LEVEL 3 -->
                <div class="bg-orange-500/10 border border-orange-500/20 rounded-2xl p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-xs text-orange-300 uppercase font-bold tracking-wider">
                                Level 3
                            </p>

                            <p class="text-white/50 text-xs mt-1">
                                Sulit
                            </p>

                        </div>

                        <div class="w-11 h-11 rounded-xl bg-orange-500/20 flex items-center justify-center">

                            <i class="fa-solid fa-crown text-orange-400"></i>

                        </div>

                    </div>

                    <p class="text-white text-2xl font-black mt-4">

                        {{ $soals->where('level', 3)->count() }}

                        <span class="text-xs text-white/40 font-normal">
                            soal
                        </span>

                    </p>

                </div>

            </div>


            <!-- =================================================
                 TABEL SOAL
            ================================================== -->

            <div class="glass rounded-[25px] overflow-hidden border border-white/10 shadow-2xl">

                <div class="overflow-x-auto">

                    <table class="w-full text-left border-collapse">


                        <!-- HEADER TABLE -->
                        <thead>

                            <tr class="border-b border-white/10 bg-white/5 text-white/40 text-[11px] font-black uppercase tracking-wider">

                                <th class="p-5 text-center w-16">
                                    LVL
                                </th>

                                <th class="p-5">
                                    PERTANYAAN BERPIKIR KRITIS
                                </th>

                                <th class="p-5 text-center w-32">
                                    KUNCI PG
                                </th>

                                <th class="p-5 text-center w-36">
                                    AKSI KONTROL
                                </th>

                            </tr>

                        </thead>


                        <!-- BODY TABLE -->
                        <tbody class="divide-y divide-white/5 text-sm">


                            @forelse($soals as $item)

                                <tr class="hover:bg-white/5 transition">


                                    <!-- =================================================
                                         LEVEL
                                    ================================================== -->

                                    <td class="p-5 text-center font-extrabold">

                                        @if((int) $item->level === 1)

                                            <span class="px-2.5 py-1 rounded-lg bg-cyan-500/20 text-cyan-400 text-xs border border-cyan-500/30">

                                                Lvl 1

                                            </span>

                                        @elseif((int) $item->level === 2)

                                            <span class="px-2.5 py-1 rounded-lg bg-purple-500/20 text-purple-400 text-xs border border-purple-500/30">

                                                Lvl 2

                                            </span>

                                        @elseif((int) $item->level === 3)

                                            <span class="px-2.5 py-1 rounded-lg bg-orange-500/20 text-orange-400 text-xs border border-orange-500/30">

                                                Lvl 3

                                            </span>

                                        @else

                                            <span class="px-2.5 py-1 rounded-lg bg-white/10 text-white/50 text-xs">

                                                -

                                            </span>

                                        @endif

                                    </td>


                                    <!-- =================================================
                                         PERTANYAAN
                                    ================================================== -->

                                    <td class="p-5 text-white/90 font-medium leading-relaxed">

                                        {{ $item->pertanyaan }}

                                    </td>


                                    <!-- =================================================
                                         KUNCI JAWABAN
                                    ================================================== -->

                                    <td class="p-5 text-center">

                                        <span class="px-3 py-1 rounded-xl bg-white/10 text-white font-bold text-xs border border-white/10">

                                            Opsi {{ strtoupper($item->jawaban_benar ?? $item->jawaban ?? 'A') }}

                                        </span>

                                    </td>


                                    <!-- =================================================
                                         AKSI
                                    ================================================== -->

                                    <td class="p-5 text-center">

                                        <div class="flex items-center justify-center gap-2">


                                            <!-- EDIT -->
                                            <a href="{{ route('soal.edit', $item->id) }}"
                                               class="w-9 h-9 rounded-xl bg-amber-500/20 border border-amber-500/30 text-amber-400 hover:bg-amber-500 hover:text-white flex items-center justify-center transition shadow-sm"
                                               title="Edit Soal">

                                                <i class="fa-solid fa-pen-to-square"></i>

                                            </a>


                                            <!-- HAPUS -->
                                            <form
                                                action="{{ route('soal.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini?')"
                                            >

                                                @csrf

                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="w-9 h-9 rounded-xl bg-rose-500/20 border border-rose-500/30 text-rose-400 hover:bg-rose-500 hover:text-white flex items-center justify-center transition shadow-sm"
                                                    title="Hapus Soal"
                                                >

                                                    <i class="fa-solid fa-trash-can"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <!-- TIDAK ADA SOAL -->
                                <tr>

                                    <td
                                        colspan="4"
                                        class="p-10 text-center text-white/40 font-medium"
                                    >

                                        <i class="fa-solid fa-folder-open text-3xl mb-3 block opacity-30"></i>

                                        Belum ada butir soal yang ditambahkan.

                                        <br>

                                        Silakan klik tombol

                                        <b class="text-cyan-400">
                                            + Tambah Soal Baru
                                        </b>

                                        di atas!

                                    </td>

                                </tr>

                            @endforelse


                        </tbody>

                    </table>

                </div>

            </div>


            <!-- =================================================
                 RINGKASAN
            ================================================== -->

            <div class="text-center text-white/30 text-xs">

                Total soal:

                <span class="text-white/60 font-bold">
                    {{ $soals->count() }}
                </span>

                soal

            </div>


        </div>

    </main>


</body>

</html> 