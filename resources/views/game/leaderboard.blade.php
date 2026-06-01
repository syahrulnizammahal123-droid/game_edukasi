<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Guiz Adventure</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

        body{
            font-family:'Poppins',sans-serif;
        }

        .glass{
            background:rgba(255,255,255,0.08);
            backdrop-filter:blur(18px);
            border:1px solid rgba(255,255,255,0.08);
        }

        .card-hover:hover{
            transform:translateY(-5px);
            transition:0.3s;
        }

    </style>
   

</head>

<body




    class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden"
    style="background-image:url('{{ asset('images/bg-login.jpg') }}')"
>

    <!-- Overlay -->
    <div class="fixed inset-0 bg-[#07111f]/80 -z-10"></div>

    <!-- Glow -->
    <!-- FLOATING PARTICLE -->
<div
    class="absolute top-20 left-10
    w-32 h-32 rounded-full
    bg-cyan-400/10 blur-3xl
    animate-pulse"
></div>

<div
    class="absolute top-1/3 right-10
    w-40 h-40 rounded-full
    bg-purple-500/10 blur-3xl
    animate-bounce"
></div>

<div
    class="absolute bottom-20 left-1/3
    w-52 h-52 rounded-full
    bg-pink-500/10 blur-3xl
    animate-pulse"
></div>

<div
    class="absolute bottom-10 right-1/4
    w-36 h-36 rounded-full
    bg-yellow-400/10 blur-3xl
    animate-bounce"
></div>
    <div class="absolute top-0 left-0 w-72 h-72 bg-cyan-400/20 blur-3xl rounded-full"></div>

    <div class="absolute bottom-0 right-0 w-72 h-72 bg-purple-500/20 blur-3xl rounded-full"></div>

    <!-- MAIN -->
    <div class="relative z-10 flex min-h-screen">

        <!-- SIDEBAR -->
        <aside
            class="hidden lg:flex flex-col w-72 p-6 glass border-r border-white/10"
        >

            <!-- LOGO -->
            <div class="flex items-center gap-4 mb-10">

                <div
                    class="w-16 h-16 rounded-3xl
                    bg-gradient-to-br from-cyan-400 to-blue-600
                    flex items-center justify-center
                    shadow-[0_0_25px_rgba(59,130,246,0.5)]"
                >

                    <i class="fa-solid fa-gamepad text-white text-2xl"></i>

                </div>

                <div>

                    <h1 class="text-2xl font-extrabold text-white">
                        Guiz Adventure
                    </h1>

                    <p class="text-cyan-300 text-sm">
                        Game Quiz Petualangan
                    </p>

                </div>

            </div>

            <!-- MENU -->
            <div class="space-y-4">

                <!-- Dashboard -->
                <a href="/dashboard"
                    class="flex items-center gap-4
                    bg-gradient-to-r from-cyan-500 to-blue-600
                    text-white p-4 rounded-3xl
                    shadow-[0_0_20px_rgba(59,130,246,0.4)]"
                >

               <img
                 src="https://api.dicebear.com/7.x/adventurer/svg?seed={{ Auth::user()->name }}"
                   alt="Avatar"
                   class="w-full h-full object-cover rounded-3xl"
                >



                </a>

                <!-- Game -->
                <a href="/game/level"
                    class="flex items-center gap-4
                    glass text-white p-4 rounded-3xl
                    hover:bg-white/10 transition"
                >

                    <i class="fa-solid fa-play text-lg"></i>

                    <span class="font-semibold">
                        Mulai Game
                    </span>

                </a>
                 <a
    href="/riwayat"
    class="glass rounded-[25px] p-5 block"
>
    <div class="text-4xl mb-3">
        📜
    </div>

    <h3 class="font-bold text-lg">
        Riwayat Permainan
    </h3>

    <p class="text-white/60 text-sm">
        Lihat seluruh hasil quiz yang pernah dimainkan
    </p>
</a>
                <!-- Leaderboard -->
                <a href="/leaderboard"
                    class="flex items-center gap-4
                    glass text-white p-4 rounded-3xl
                    hover:bg-white/10 transition"
                >

                    <i class="fa-solid fa-ranking-star text-lg"></i>

                    <span class="font-semibold">
                        Peringkat
                    </span>

                </a>

                <!-- Soal -->
                <a href="/soal"
                    class="flex items-center gap-4
                    glass text-white p-4 rounded-3xl
                    hover:bg-white/10 transition"
                >

                    <i class="fa-solid fa-book-open text-lg"></i>

                    <span class="font-semibold">
                        Kelola Soal
                    </span>

                </a>

            </div>

            <!-- LOGOUT -->
            <div class="mt-auto">

                <a href="/logout"
                    class="flex items-center justify-center gap-3
                    bg-gradient-to-r from-red-500 to-red-700
                    text-white p-4 rounded-3xl
                    shadow-xl"
                >

                    <i class="fa-solid fa-right-from-bracket"></i>

                    <span class="font-semibold">
                        Keluar
                    </span>

                </a>

            </div>

        </aside>

        <!-- CONTENT -->

        <main class="flex-1 p-5 lg:p-8 pb-32">

        
            <!-- MOBILE TOP -->
            <!-- BATTLE PASS -->
<div
    class="glass floating rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">

        <!-- LEFT -->
        <div class="flex items-center gap-4">

            <div
                class="w-16 h-16 rounded-3xl
                bg-gradient-to-br from-yellow-400 to-orange-500
                flex items-center justify-center
                shadow-[0_0_30px_rgba(251,191,36,0.35)]"
            >

                <i class="fa-solid fa-ticket text-white text-2xl"></i>

            </div>

            <div>

                <p class="text-cyan-300 text-sm font-semibold">
                    Season Progression
                </p>

                <h2 class="text-white text-3xl font-bold">
                    Adventure Pass
                </h2>

            </div>

        </div>

        <!-- LEVEL -->
        <div
            class="px-6 py-4 rounded-[25px]
            bg-gradient-to-r from-cyan-500/20 to-blue-600/20
            border border-cyan-400/20"
        >

            <p class="text-cyan-300 text-sm">
                Pass Level
            </p>

            <h2 class="text-white text-3xl font-extrabold">
                {{ $level }}
            </h2>

        </div>

    </div>

    <!-- PASS LIST -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">

        <!-- TIER 1 -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 1
                ? 'bg-gradient-to-br from-cyan-500/20 to-blue-600/20 border border-cyan-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-20 h-20 rounded-full
                bg-gradient-to-br from-cyan-400 to-blue-600
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-star text-white text-3xl"></i>

            </div>

            <h2 class="text-white text-2xl font-bold mb-2">
                Tier 1
            </h2>

            <p class="text-white/60 text-sm">
                +50 XP
            </p>

        </div>

        <!-- TIER 2 -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 2
                ? 'bg-gradient-to-br from-purple-500/20 to-pink-600/20 border border-purple-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-20 h-20 rounded-full
                bg-gradient-to-br from-purple-500 to-pink-600
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-medal text-white text-3xl"></i>

            </div>

            <h2 class="text-white text-2xl font-bold mb-2">
                Tier 2
            </h2>

            <p class="text-white/60 text-sm">
                Rare Badge
            </p>

        </div>

        <!-- TIER 3 -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 3
                ? 'bg-gradient-to-br from-emerald-500/20 to-cyan-600/20 border border-emerald-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-20 h-20 rounded-full
                bg-gradient-to-br from-emerald-400 to-cyan-500
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-gem text-white text-3xl"></i>

            </div>

            <h2 class="text-white text-2xl font-bold mb-2">
                Tier 3
            </h2>

            <p class="text-white/60 text-sm">
                Crystal Reward
            </p>

        </div>

        <!-- TIER 4 -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 5
                ? 'bg-gradient-to-br from-yellow-400/20 to-orange-500/20 border border-yellow-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-20 h-20 rounded-full
                bg-gradient-to-br from-yellow-400 to-orange-500
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-crown text-white text-3xl"></i>

            </div>

            <h2 class="text-white text-2xl font-bold mb-2">
                Tier 5
            </h2>

            <p class="text-white/60 text-sm">
                Gold Reward
            </p>

        </div>

        <!-- TIER 5 -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 10
                ? 'bg-gradient-to-br from-pink-500/20 to-purple-700/20 border border-pink-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-20 h-20 rounded-full
                bg-gradient-to-br from-pink-500 to-purple-700
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-dragon text-white text-3xl"></i>

            </div>

            <h2 class="text-white text-2xl font-bold mb-2">
                Tier 10
            </h2>

            <p class="text-white/60 text-sm">
                Mythic Reward
            </p>

        </div>

    </div>

</div>
            <!-- NOTIFICATION CENTER -->
<div
    class="glass floating rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">

        <div class="flex items-center gap-4">

            <div
                class="w-16 h-16 rounded-3xl
                bg-gradient-to-br from-cyan-400 to-blue-600
                flex items-center justify-center
                shadow-[0_0_30px_rgba(34,211,238,0.35)]"
            >

                <i class="fa-solid fa-bell text-white text-2xl"></i>

            </div>

            <div>

                <p class="text-cyan-300 text-sm font-semibold">
                    Notification Center
                </p>

                <h2 class="text-white text-3xl font-bold">
                    Notifikasi Player
                </h2>

            </div>

        </div>

        <!-- BADGE -->
        <div
            class="px-5 py-3 rounded-2xl
            bg-red-500/20 text-red-300
            font-bold"
        >

            4 Baru

        </div>

    </div>

    <!-- LIST -->
    <div class="space-y-4">

        <!-- ITEM -->
        <div
            class="flex items-start gap-5
            p-5 rounded-[30px]
            bg-white/5 border border-white/10"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-yellow-400 to-orange-500
                flex items-center justify-center shrink-0"
            >

                <i class="fa-solid fa-gift text-white text-xl"></i>

            </div>

            <div class="flex-1">

                <h2 class="text-white text-xl font-bold mb-2">
                    Daily Reward
                </h2>

                <p class="text-white/60">
                    Reward harian berhasil diklaim hari ini.
                </p>

            </div>

            <span class="text-cyan-300 text-sm">
                Baru saja
            </span>

        </div>

        <!-- ITEM -->
        <div
            class="flex items-start gap-5
            p-5 rounded-[30px]
            bg-white/5 border border-white/10"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-orange-500 to-red-600
                flex items-center justify-center shrink-0"
            >

                <i class="fa-solid fa-fire text-white text-xl"></i>

            </div>

            <div class="flex-1">

                <h2 class="text-white text-xl font-bold mb-2">
                    Login Streak
                </h2>

                <p class="text-white/60">
                    🔥 {{ $progress->login_streak }} hari login beruntun.
                </p>

            </div>

            <span class="text-orange-300 text-sm">
                Hari ini
            </span>

        </div>

        <!-- ITEM -->
        <div
            class="flex items-start gap-5
            p-5 rounded-[30px]
            bg-white/5 border border-white/10"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-cyan-400 to-blue-600
                flex items-center justify-center shrink-0"
            >

                <i class="fa-solid fa-bolt text-white text-xl"></i>

            </div>

            <div class="flex-1">

                <h2 class="text-white text-xl font-bold mb-2">
                    Level Player
                </h2>

                <p class="text-white/60">
                    Kamu sekarang berada di Level {{ $level }}.
                </p>

            </div>

            <span class="text-cyan-300 text-sm">
                Progress
            </span>

        </div>

        <!-- ITEM -->
        <div
            class="flex items-start gap-5
            p-5 rounded-[30px]
            bg-white/5 border border-white/10"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-purple-500 to-pink-600
                flex items-center justify-center shrink-0"
            >

                <i class="fa-solid fa-trophy text-white text-xl"></i>

            </div>

            <div class="flex-1">

                <h2 class="text-white text-xl font-bold mb-2">
                    Achievement
                </h2>

                <p class="text-white/60">
                    Progress achievement player meningkat.
                </p>

            </div>

            <span class="text-pink-300 text-sm">
                Reward
            </span>

        </div>

    </div>

</div>
            <div class="lg:hidden flex items-center justify-between mb-6">

                <div>

                    <h1 class="text-2xl font-extrabold text-white">
                        Guiz Adventure
                    </h1>

                    <p class="text-cyan-300 text-sm">
                        Game Quiz Petualangan
                    </p>

                </div>

                <a href="/logout"
                    class="w-12 h-12 rounded-2xl
                    bg-red-500/20 border border-red-400/20
                    flex items-center justify-center
                    text-red-300"
                >

                    <i class="fa-solid fa-right-from-bracket"></i>

                </a>

            </div>

            <!-- HERO -->
            <div
                class="glass rounded-[35px] p-6 lg:p-8 mb-8"
                class="glass rounded-[35px] floating"
            >

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <!-- LEFT -->
                    <div>

                        <p class="text-cyan-300 font-semibold mb-3">
                          {{ $greeting }} 
                        </p>

                        <h1 class="text-4xl lg:text-6xl font-extrabold text-white leading-tight">
                          {{ Auth::user()->name }},
<br>
Siap Memulai Petualangan?
                        </h1>

                        <p class="text-white/60 mt-4 max-w-xl">
                            Jelajahi dunia pengetahuan dan tingkatkan skor terbaikmu melalui tantangan quiz seru.
                        </p>

                        <a href="/game/level"
                            class="inline-flex items-center gap-3
                            mt-6 bg-gradient-to-r from-cyan-400 to-blue-600
                            text-white px-6 py-4 rounded-3xl
                            font-semibold shadow-xl"
                        >

                            <i class="fa-solid fa-play"></i>

                            Mulai Petualangan

                        </a>

                    </div>

                    <!-- PROFILE -->
                    <div
                        class="glass rounded-[30px]
                        p-5 min-w-[260px]"
                    >

                        <div class="flex items-center gap-4 mb-5">

                            <div
                                class="w-16 h-16 rounded-3xl
                                bg-gradient-to-br from-cyan-400 to-blue-600
                                flex items-center justify-center"
                            >

                                <i class="fa-solid fa-user text-white text-2xl"></i>

                            </div>

                            <div>

                                <h2 class="text-white text-xl font-bold">
                                    {{ Auth::user()->name }}
                                </h2>
                                <div
                   class="inline-flex items-center gap-3
                   px-5 py-3 rounded-2xl
                   bg-gradient-to-r from-cyan-500/20 to-blue-600/20
                   border border-cyan-400/20
                  text-cyan-300 font-semibold mb-5"
            >

            <i class="fa-solid fa-shield-halved"></i>

            {{ $title }}

            </div>

                                <p class="text-cyan-300 text-sm">
                                    Pemain Petualangan
                                </p>

                            </div>

                        </div>

                        <!-- PROGRESS -->
                        <div class="space-y-3">

                            <div class="flex justify-between text-sm">

                                <span class="text-white/60">
                                    Progres Level
                                </span>

                                <span class="text-cyan-300">
                                    {{ $progressPercent }}%
                                </span>

                            </div>

                            <div class="w-full h-3 rounded-full bg-white/10 overflow-hidden">

                                <div
                                    class="h-full rounded-full
                                    bg-gradient-to-r from-cyan-400 to-blue-600"
                                    style="width: {{ $progressPercent }}%"
                                ></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <!-- LOGIN STREAK -->
<div
    class="glass floating rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

        <!-- LEFT -->
        <div>

            <p class="text-orange-300 font-semibold mb-3">
                Daily Progress
            </p>

            <h2 class="text-5xl lg:text-6xl font-extrabold text-white mb-4">
                🔥 {{ $progress->login_streak }} Hari
            </h2>

            <p class="text-white/60">
                Login beruntun untuk mendapatkan bonus reward.
            </p>

        </div>

        <!-- RIGHT -->
        <div
            class="w-32 h-32 rounded-[35px]
            bg-gradient-to-br from-orange-500 to-red-600
            flex items-center justify-center
            shadow-[0_0_45px_rgba(249,115,22,0.35)]"
        >

            <i class="fa-solid fa-fire-flame-curved text-white text-6xl"></i>

        </div>

    </div>

</div>
            <!-- WEATHER WIDGET -->
<div
    class="glass floating rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

        <!-- LEFT -->
        <div>

            <p class="text-cyan-300 font-semibold mb-3">
                Atmosfer Dunia
            </p>

            <h2 class="text-5xl lg:text-6xl font-extrabold text-white mb-3">
                27°
            </h2>

            <p class="text-white/60">
                Cerah • Karanganyar
            </p>

        </div>

        <!-- RIGHT -->
        <div
            class="w-32 h-32 rounded-[35px]
            bg-gradient-to-br from-yellow-400 to-orange-500
            flex items-center justify-center
            shadow-[0_0_45px_rgba(251,191,36,0.35)]"
        >

            <i class="fa-solid fa-sun text-white text-6xl"></i>

        </div>

    </div>

</div>
    <!-- LIVE STATUS -->
<div
    class="glass floating rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

        <!-- LEFT -->
        <div>

            <p class="text-cyan-300 font-semibold mb-3">
                Status Player
            </p>

            <h2
                id="live-clock"
                class="text-5xl lg:text-6xl
                font-extrabold text-white"
            >
                00:00:00
            </h2>

            <p class="text-white/60 mt-3">
                Waktu realtime petualangan player.
            </p>

        </div>

        <!-- STATUS -->
        <div
            class="flex items-center gap-4
            px-6 py-5 rounded-[30px]
            bg-emerald-500/10
            border border-emerald-400/20"
        >

            <!-- DOT -->
            <div
                class="w-5 h-5 rounded-full
                bg-emerald-400
                animate-pulse
                shadow-[0_0_20px_rgba(74,222,128,0.8)]"
            ></div>

            <div>

                <h2 class="text-white text-2xl font-bold">
                    Online
                </h2>

                <p class="text-emerald-300 text-sm">
                    Player aktif sekarang
                </p>

            </div>

        </div>

    </div>

</div>        
<!-- PROFILE CARD -->
<div
    class="glass rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <div class="flex flex-col lg:flex-row gap-8 lg:items-center">

        <!-- AVATAR -->
        <div
            class="w-36 h-36 rounded-[35px]
            overflow-hidden
            border-4 border-cyan-400/20
            shadow-[0_0_35px_rgba(34,211,238,0.25)]"
        >

            <img
                src="https://api.dicebear.com/7.x/adventurer/svg?seed={{ Auth::user()->name }}"
                alt="Avatar"
                class="w-full h-full object-cover"
            >

        </div>

        <!-- INFO -->
        <div class="flex-1">

            <p class="text-cyan-300 font-semibold mb-3">
                Profile Player
            </p>

            <h2 class="text-4xl font-extrabold text-white mb-4">
                {{ Auth::user()->name }}
            </h2>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">

                <!-- LEVEL -->
                <div
                    class="bg-white/5 border border-white/10
                    rounded-3xl p-4"
                >

                    <p class="text-white/60 text-sm mb-2">
                        Level
                    </p>

                    <h2 class="text-white text-3xl font-bold">
                        {{ $level }}
                    </h2>

                </div>

                <!-- XP -->
                <div
                    class="bg-white/5 border border-white/10
                    rounded-3xl p-4"
                >

                    <p class="text-white/60 text-sm mb-2">
                        XP
                    </p>

                    <h2 class="text-white text-3xl font-bold">
                        {{ $xp }}
                    </h2>

                </div>

                <!-- SCORE -->
                <div
                    class="bg-white/5 border border-white/10
                    rounded-3xl p-4"
                >

                    <p class="text-white/60 text-sm mb-2">
                        High Score
                    </p>

                    <h2 class="text-white text-3xl font-bold">
                        {{ $progress->high_score }}
                    </h2>

                </div>

                <!-- RANK -->
                <div
                    class="bg-white/5 border border-white/10
                    rounded-3xl p-4"
                >

                    <p class="text-white/60 text-sm mb-2">
                        Rank
                    </p>

                    <h2 class="text-white text-3xl font-bold">
                        #{{ $rank }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- PROGRESS CHART -->
<div
    class="glass rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <!-- TITLE -->
    <div class="flex items-center gap-4 mb-8">

        <div
            class="w-16 h-16 rounded-3xl
            bg-gradient-to-br from-cyan-400 to-blue-600
            flex items-center justify-center
            shadow-[0_0_30px_rgba(34,211,238,0.35)]"
        >

            <i class="fa-solid fa-chart-line text-white text-2xl"></i>

        </div>

        <div>

            <p class="text-cyan-300 text-sm font-semibold">
                Statistik Progress
            </p>

            <h2 class="text-white text-3xl font-bold">
                XP Analytics
            </h2>

        </div>

    </div>

    <!-- CHART -->
    <div
        class="bg-white/5 border border-white/10
        rounded-[30px] p-5"
    >

        <canvas id="progressChart"></canvas>

    </div>

</div>
<!-- GLOBAL RANKING -->
<div
    class="glass rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <!-- TITLE -->
    <div class="flex items-center gap-4 mb-8">

        <div
            class="w-16 h-16 rounded-3xl
            bg-gradient-to-br from-yellow-400 to-orange-500
            flex items-center justify-center
            shadow-[0_0_30px_rgba(251,191,36,0.35)]"
        >

            <i class="fa-solid fa-crown text-white text-2xl"></i>

        </div>

        <div>

            <p class="text-cyan-300 text-sm font-semibold">
                Ranking Global
            </p>

            <h2 class="text-white text-3xl font-bold">
                Top Player
            </h2>

        </div>

    </div>

    <!-- PLAYER LIST -->
    <div class="space-y-4">

        @foreach($topPlayers as $index => $player)

            <div
                class="flex items-center justify-between
                p-5 rounded-[30px]
                bg-white/5 border border-white/10"
            >

                <!-- LEFT -->
                <div class="flex items-center gap-5">

                    <!-- RANK -->
                    <div
                        class="w-14 h-14 rounded-2xl
                        {{ $index == 0
                            ? 'bg-gradient-to-br from-yellow-400 to-orange-500'
                            : ($index == 1
                                ? 'bg-gradient-to-br from-slate-300 to-slate-500'
                                : ($index == 2
                                    ? 'bg-gradient-to-br from-amber-700 to-orange-800'
                                    : 'bg-gradient-to-br from-cyan-400 to-blue-600'
                                )
                            )
                        }}
                        flex items-center justify-center"
                    >

                        <span class="text-white font-bold text-xl">
                            #{{ $index + 1 }}
                        </span>

                    </div>

                    <!-- PLAYER -->
                    <div>

                        <h2 class="text-white text-xl font-bold">
                            {{ $player->user->name }}
                        </h2>

                        <p class="text-white/60 text-sm">
                            Level {{ floor(($player->high_score * 10) / 100) + 1 }}
                        </p>

                    </div>

                </div>

                <!-- SCORE -->
                <div class="text-right">

                    <h2 class="text-cyan-300 text-2xl font-extrabold">
                        {{ $player->high_score }}
                    </h2>

                    <p class="text-white/50 text-sm">
                        Score
                    </p>

                </div>

            </div>

        @endforeach

    </div>

</div>
<!-- ACTIVITY TIMELINE -->
<div
    class="glass rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <!-- TITLE -->
    <div class="flex items-center gap-4 mb-8">

        <div
            class="w-16 h-16 rounded-3xl
            bg-gradient-to-br from-cyan-400 to-blue-600
            flex items-center justify-center
            shadow-[0_0_30px_rgba(34,211,238,0.35)]"
        >

            <i class="fa-solid fa-clock-rotate-left text-white text-2xl"></i>

        </div>

        <div>

            <p class="text-cyan-300 text-sm font-semibold">
                Aktivitas Player
            </p>

            <h2 class="text-white text-3xl font-bold">
                Recent Activity
            </h2>

        </div>

    </div>

    <!-- TIMELINE -->
    <div class="space-y-5">

        <!-- ITEM -->
        <div
            class="flex items-start gap-5
            p-5 rounded-[30px]
            bg-white/5 border border-white/10"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-green-400 to-emerald-600
                flex items-center justify-center shrink-0"
            >

                <i class="fa-solid fa-check text-white text-xl"></i>

            </div>

            <div class="flex-1">

                <h2 class="text-white text-xl font-bold mb-2">
                    Quiz Selesai
                </h2>

                <p class="text-white/60">
                    Kamu berhasil menyelesaikan petualangan quiz terbaru.
                </p>

            </div>

            <span class="text-cyan-300 text-sm whitespace-nowrap">
                Baru saja
            </span>

        </div>

        <!-- ITEM -->
        <div
            class="flex items-start gap-5
            p-5 rounded-[30px]
            bg-white/5 border border-white/10"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-yellow-400 to-orange-500
                flex items-center justify-center shrink-0"
            >

                <i class="fa-solid fa-trophy text-white text-xl"></i>

            </div>

            <div class="flex-1">

                <h2 class="text-white text-xl font-bold mb-2">
                    Achievement Terbuka
                </h2>

                <p class="text-white/60">
                    Progress player meningkat dan reward baru berhasil dibuka.
                </p>

            </div>

            <span class="text-yellow-300 text-sm whitespace-nowrap">
                Hari ini
            </span>

        </div>

        <!-- ITEM -->
        <div
            class="flex items-start gap-5
            p-5 rounded-[30px]
            bg-white/5 border border-white/10"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-pink-500 to-purple-600
                flex items-center justify-center shrink-0"
            >

                <i class="fa-solid fa-fire text-white text-xl"></i>

            </div>

            <div class="flex-1">

                <h2 class="text-white text-xl font-bold mb-2">
                    Daily Reward
                </h2>

                <p class="text-white/60">
                    Reward harian berhasil diklaim dan XP bertambah.
                </p>

            </div>

            <span class="text-pink-300 text-sm whitespace-nowrap">
                Hari ini
            </span>

        </div>

    </div>

</div>
<!-- PLAYER STATISTICS -->
<div
    class="glass rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <!-- TITLE -->
    <div class="flex items-center gap-4 mb-8">

        <div
            class="w-16 h-16 rounded-3xl
            bg-gradient-to-br from-cyan-400 to-blue-600
            flex items-center justify-center
            shadow-[0_0_30px_rgba(34,211,238,0.35)]"
        >

            <i class="fa-solid fa-chart-simple text-white text-2xl"></i>

        </div>

        <div>

            <p class="text-cyan-300 text-sm font-semibold">
                Statistik Pemain
            </p>

            <h2 class="text-white text-3xl font-bold">
                Battle Record
            </h2>

        </div>

    </div>

    <!-- GRID -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-5">

        <!-- TOTAL GAME -->
        <div
            class="rounded-[30px]
            bg-gradient-to-br from-cyan-500/15 to-blue-600/15
            border border-cyan-400/20
            p-5"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-cyan-400 to-blue-600
                flex items-center justify-center mb-5"
            >

                <i class="fa-solid fa-gamepad text-white text-xl"></i>

            </div>

            <p class="text-white/60 text-sm mb-2">
                Total Game
            </p>

            <h2 class="text-white text-4xl font-extrabold">
                {{ floor($progress->high_score / 10) }}
            </h2>

        </div>

        <!-- BENAR -->
        <div
            class="rounded-[30px]
            bg-gradient-to-br from-green-500/15 to-emerald-600/15
            border border-green-400/20
            p-5"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-green-400 to-emerald-600
                flex items-center justify-center mb-5"
            >

                <i class="fa-solid fa-check text-white text-xl"></i>

            </div>

            <p class="text-white/60 text-sm mb-2">
                Jawaban Benar
            </p>

            <h2 class="text-white text-4xl font-extrabold">
                {{ $progress->high_score }}
            </h2>

        </div>

        <!-- SALAH -->
        <div
            class="rounded-[30px]
            bg-gradient-to-br from-red-500/15 to-orange-600/15
            border border-red-400/20
            p-5"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-red-500 to-orange-600
                flex items-center justify-center mb-5"
            >

                <i class="fa-solid fa-xmark text-white text-xl"></i>

            </div>

            <p class="text-white/60 text-sm mb-2">
                Jawaban Salah
            </p>

            <h2 class="text-white text-4xl font-extrabold">
                {{ floor($progress->high_score / 3) }}
            </h2>

        </div>

        <!-- WIN RATE -->
        <div
            class="rounded-[30px]
            bg-gradient-to-br from-purple-500/15 to-pink-600/15
            border border-purple-400/20
            p-5"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-purple-500 to-pink-600
                flex items-center justify-center mb-5"
            >

                <i class="fa-solid fa-chart-line text-white text-xl"></i>

            </div>

            <p class="text-white/60 text-sm mb-2">
                Win Rate
            </p>

            <h2 class="text-white text-4xl font-extrabold">
                {{ min(100, 70 + $level) }}%
            </h2>

        </div>

        <!-- TOTAL XP -->
        <div
            class="rounded-[30px]
            bg-gradient-to-br from-yellow-400/15 to-orange-500/15
            border border-yellow-400/20
            p-5"
        >

            <div
                class="w-14 h-14 rounded-2xl
                bg-gradient-to-br from-yellow-400 to-orange-500
                flex items-center justify-center mb-5"
            >

                <i class="fa-solid fa-fire text-white text-xl"></i>

            </div>

            <p class="text-white/60 text-sm mb-2">
                Total XP
            </p>

            <h2 class="text-white text-4xl font-extrabold">
                {{ $xp }}
            </h2>

        </div>

    </div>

</div>
<!-- INVENTORY -->
<div
    class="glass rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <!-- TITLE -->
    <div class="flex items-center gap-4 mb-8">

        <div
            class="w-16 h-16 rounded-3xl
            bg-gradient-to-br from-emerald-400 to-cyan-500
            flex items-center justify-center
            shadow-[0_0_30px_rgba(16,185,129,0.35)]"
        >

            <i class="fa-solid fa-box-open text-white text-2xl"></i>

        </div>

        <div>

            <p class="text-cyan-300 text-sm font-semibold">
                Koleksi Player
            </p>

            <h2 class="text-white text-3xl font-bold">
                Inventory Item
            </h2>

        </div>

    </div>

    <!-- GRID -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">

        <!-- ITEM 1 -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 2
                ? 'bg-gradient-to-br from-cyan-500/20 to-blue-600/20 border border-cyan-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-24 h-24 rounded-[30px]
                {{ $level >= 2
                    ? 'bg-gradient-to-br from-cyan-400 to-blue-600'
                    : 'bg-white/10'
                }}
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-gem text-white text-4xl"></i>

            </div>

            <h2 class="text-white text-xl font-bold mb-2">
                Crystal XP
            </h2>

            <p class="text-white/60 text-sm">
                Unlock Level 2
            </p>

        </div>

        <!-- ITEM 2 -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 3
                ? 'bg-gradient-to-br from-purple-500/20 to-pink-600/20 border border-purple-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-24 h-24 rounded-[30px]
                {{ $level >= 3
                    ? 'bg-gradient-to-br from-purple-500 to-pink-600'
                    : 'bg-white/10'
                }}
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-scroll text-white text-4xl"></i>

            </div>

            <h2 class="text-white text-xl font-bold mb-2">
                Magic Scroll
            </h2>

            <p class="text-white/60 text-sm">
                Unlock Level 3
            </p>

        </div>

        <!-- ITEM 3 -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 5
                ? 'bg-gradient-to-br from-yellow-400/20 to-orange-500/20 border border-yellow-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-24 h-24 rounded-[30px]
                {{ $level >= 5
                    ? 'bg-gradient-to-br from-yellow-400 to-orange-500'
                    : 'bg-white/10'
                }}
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-crown text-white text-4xl"></i>

            </div>

            <h2 class="text-white text-xl font-bold mb-2">
                Golden Crown
            </h2>

            <p class="text-white/60 text-sm">
                Unlock Level 5
            </p>

        </div>

        <!-- ITEM 4 -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 10
                ? 'bg-gradient-to-br from-emerald-400/20 to-cyan-500/20 border border-emerald-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-24 h-24 rounded-[30px]
                {{ $level >= 10
                    ? 'bg-gradient-to-br from-emerald-400 to-cyan-500'
                    : 'bg-white/10'
                }}
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-dragon text-white text-4xl"></i>

            </div>

            <h2 class="text-white text-xl font-bold mb-2">
                Mythic Dragon
            </h2>

            <p class="text-white/60 text-sm">
                Unlock Level 10
            </p>

        </div>

    </div>

</div>
<!-- QUEST SYSTEM -->
<div
    class="glass rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <!-- TITLE -->
    <div class="flex items-center gap-4 mb-8">

        <div
            class="w-16 h-16 rounded-3xl
            bg-gradient-to-br from-purple-500 to-pink-600
            flex items-center justify-center
            shadow-[0_0_30px_rgba(168,85,247,0.35)]"
        >

            <i class="fa-solid fa-scroll text-white text-2xl"></i>

        </div>

        <div>

            <p class="text-cyan-300 text-sm font-semibold">
                Sistem Misi
            </p>

            <h2 class="text-white text-3xl font-bold">
                Quest Harian
            </h2>

        </div>

    </div>

    <!-- QUEST GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        <!-- QUEST 1 -->
        <div
            class="rounded-[30px]
            bg-gradient-to-br from-cyan-500/15 to-blue-600/15
            border border-cyan-400/20
            p-6"
        >

            <!-- TOP -->
            <div class="flex items-center justify-between mb-6">

                <div
                    class="w-16 h-16 rounded-3xl
                    bg-gradient-to-br from-cyan-400 to-blue-600
                    flex items-center justify-center"
                >

                    <i class="fa-solid fa-book-open text-white text-2xl"></i>

                </div>

                <span
                    class="px-4 py-2 rounded-2xl
                    bg-cyan-400/20 text-cyan-300
                    text-sm font-bold"
                >

                    +20 XP

                </span>

            </div>

            <!-- CONTENT -->
            <h2 class="text-white text-2xl font-bold mb-3">
                Quiz Explorer
            </h2>

            <p class="text-white/60 mb-6">
                Selesaikan 5 soal quiz hari ini.
            </p>

            <!-- PROGRESS -->
            <div class="mb-3 flex justify-between">

                <span class="text-white/60 text-sm">
                    Progress
                </span>

                <span class="text-cyan-300 text-sm font-bold">
                    {{ min($progress->high_score,5) }}/5
                </span>

            </div>

            <div
                class="w-full h-4 rounded-full
                bg-white/10 overflow-hidden"
            >

                <div
                    class="h-full rounded-full
                    bg-gradient-to-r from-cyan-400 to-blue-600"
                    style="width: {{ min(($progress->high_score / 5) * 100,100) }}%"
                ></div>

            </div>

        </div>

        <!-- QUEST 2 -->
        <div
            class="rounded-[30px]
            bg-gradient-to-br from-pink-500/15 to-purple-600/15
            border border-pink-400/20
            p-6"
        >

            <!-- TOP -->
            <div class="flex items-center justify-between mb-6">

                <div
                    class="w-16 h-16 rounded-3xl
                    bg-gradient-to-br from-pink-500 to-purple-600
                    flex items-center justify-center"
                >

                    <i class="fa-solid fa-fire text-white text-2xl"></i>

                </div>

                <span
                    class="px-4 py-2 rounded-2xl
                    bg-pink-400/20 text-pink-300
                    text-sm font-bold"
                >

                    +10 Score

                </span>

            </div>

            <!-- CONTENT -->
            <h2 class="text-white text-2xl font-bold mb-3">
                Combo Hunter
            </h2>

            <p class="text-white/60 mb-6">
                Raih combo 3x tanpa kesalahan.
            </p>

            <!-- PROGRESS -->
            <div class="mb-3 flex justify-between">

                <span class="text-white/60 text-sm">
                    Progress
                </span>

                <span class="text-pink-300 text-sm font-bold">
                    {{ min(session('combo',0),3) }}/3
                </span>

            </div>

            <div
                class="w-full h-4 rounded-full
                bg-white/10 overflow-hidden"
            >

                <div
                    class="h-full rounded-full
                    bg-gradient-to-r from-pink-500 to-purple-600"
                    style="width: {{ min((session('combo',0) / 3) * 100,100) }}%"
                ></div>

            </div>

        </div>

        <!-- QUEST 3 -->
        <div
            class="rounded-[30px]
            bg-gradient-to-br from-yellow-400/15 to-orange-500/15
            border border-yellow-400/20
            p-6"
        >

            <!-- TOP -->
            <div class="flex items-center justify-between mb-6">

                <div
                    class="w-16 h-16 rounded-3xl
                    bg-gradient-to-br from-yellow-400 to-orange-500
                    flex items-center justify-center"
                >

                    <i class="fa-solid fa-crown text-white text-2xl"></i>

                </div>

                <span
                    class="px-4 py-2 rounded-2xl
                    bg-yellow-400/20 text-yellow-300
                    text-sm font-bold"
                >

                    Badge

                </span>

            </div>

            <!-- CONTENT -->
            <h2 class="text-white text-2xl font-bold mb-3">
                Rising Legend
            </h2>

            <p class="text-white/60 mb-6">
                Capai Level 5 untuk membuka reward spesial.
            </p>

            <!-- PROGRESS -->
            <div class="mb-3 flex justify-between">

                <span class="text-white/60 text-sm">
                    Progress
                </span>

                <span class="text-yellow-300 text-sm font-bold">
                    {{ min($level,5) }}/5
                </span>

            </div>

            <div
                class="w-full h-4 rounded-full
                bg-white/10 overflow-hidden"
            >

                <div
                    class="h-full rounded-full
                    bg-gradient-to-r from-yellow-400 to-orange-500"
                    style="width: {{ min(($level / 5) * 100,100) }}%"
                ></div>

            </div>

        </div>

    </div>

</div>
<!-- BADGE COLLECTION -->
<div
    class="glass rounded-[35px]
    p-6 lg:p-8 mb-8"
>

    <!-- TITLE -->
    <div class="flex items-center gap-4 mb-8">

        <div
            class="w-16 h-16 rounded-3xl
            bg-gradient-to-br from-yellow-400 to-orange-500
            flex items-center justify-center
            shadow-[0_0_30px_rgba(251,191,36,0.35)]"
        >

            <i class="fa-solid fa-medal text-white text-2xl"></i>

        </div>

        <div>

            <p class="text-cyan-300 text-sm font-semibold">
                Reward Collection
            </p>

            <h2 class="text-white text-3xl font-bold">
                Badge Player
            </h2>

        </div>

    </div>

    <!-- GRID -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">

        <!-- BRONZE -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 1
                ? 'bg-gradient-to-br from-amber-600/20 to-orange-700/20 border border-amber-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-20 h-20 rounded-full
                {{ $level >= 1
                    ? 'bg-gradient-to-br from-amber-500 to-orange-600'
                    : 'bg-white/10'
                }}
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-shield text-white text-3xl"></i>

            </div>

            <h2 class="text-white text-xl font-bold mb-2">
                Bronze
            </h2>

            <p class="text-white/60 text-sm">
                Adventurer
            </p>

        </div>

        <!-- SILVER -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 3
                ? 'bg-gradient-to-br from-slate-300/20 to-slate-500/20 border border-slate-300/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-20 h-20 rounded-full
                {{ $level >= 3
                    ? 'bg-gradient-to-br from-slate-300 to-slate-500'
                    : 'bg-white/10'
                }}
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-sword text-white text-3xl"></i>

            </div>

            <h2 class="text-white text-xl font-bold mb-2">
                Silver
            </h2>

            <p class="text-white/60 text-sm">
                Warrior
            </p>

        </div>

        <!-- GOLD -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 5
                ? 'bg-gradient-to-br from-yellow-400/20 to-orange-500/20 border border-yellow-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-20 h-20 rounded-full
                {{ $level >= 5
                    ? 'bg-gradient-to-br from-yellow-400 to-orange-500'
                    : 'bg-white/10'
                }}
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-crown text-white text-3xl"></i>

            </div>

            <h2 class="text-white text-xl font-bold mb-2">
                Gold
            </h2>

            <p class="text-white/60 text-sm">
                Legend
            </p>

        </div>

        <!-- MYTHIC -->
        <div
            class="rounded-[30px]
            p-5 text-center
            {{ $level >= 10
                ? 'bg-gradient-to-br from-cyan-400/20 to-blue-600/20 border border-cyan-400/20'
                : 'bg-white/5 border border-white/10 opacity-50'
            }}"
        >

            <div
                class="w-20 h-20 rounded-full
                {{ $level >= 10
                    ? 'bg-gradient-to-br from-cyan-400 to-blue-600'
                    : 'bg-white/10'
                }}
                flex items-center justify-center
                mx-auto mb-5"
            >

                <i class="fa-solid fa-gem text-white text-3xl"></i>

            </div>

            <h2 class="text-white text-xl font-bold mb-2">
                Mythic
            </h2>

            <p class="text-white/60 text-sm">
                Master
            </p>

        </div>

    </div>

</div>
            <!-- STATS -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

                <!-- HIGH SCORE -->
                <div class="glass rounded-[30px] p-5 card-hover">

                    <div
                        class="w-14 h-14 rounded-2xl
                        bg-gradient-to-br from-yellow-400 to-orange-500
                        flex items-center justify-center mb-5"
                    >

                        <i class="fa-solid fa-trophy text-white text-xl"></i>

                    </div>

                    <p class="text-white/60 text-sm">
                        Skor Tertinggi
                    </p>

                    <h2 class="text-white text-4xl font-extrabold mt-2">
                        {{ $progress->high_score }}
                    </h2>

                </div>

                <!-- LEVEL -->
                <div class="glass rounded-[30px] p-5 card-hover">

                    <div
                        class="w-14 h-14 rounded-2xl
                        bg-gradient-to-br from-cyan-400 to-blue-600
                        flex items-center justify-center mb-5"
                    >

                        <i class="fa-solid fa-bolt text-white text-xl"></i>

                    </div>

                    <p class="text-white/60 text-sm">
                        Level
                    </p>

                    <h2 class="text-white text-4xl font-extrabold mt-2">
                        {{ $level }}
                    </h2>

                </div>

                <!-- XP -->
                <div class="glass rounded-[30px] p-5 card-hover">

                    <div
                        class="w-14 h-14 rounded-2xl
                        bg-gradient-to-br from-pink-500 to-purple-600
                        flex items-center justify-center mb-5"
                    >

                        <i class="fa-solid fa-fire text-white text-xl"></i>

                    </div>

                    <p class="text-white/60 text-sm">
                        XP
                    </p>

                    <h2 class="text-white text-4xl font-extrabold mt-2">
                        {{ $xp }}
                    </h2>

                </div>

                <!-- RANK -->
                <div class="glass rounded-[30px] p-5 card-hover">

                    <div
                        class="w-14 h-14 rounded-2xl
                        bg-gradient-to-br from-green-400 to-emerald-600
                        flex items-center justify-center mb-5"
                    >

                        <i class="fa-solid fa-crown text-white text-xl"></i>

                    </div>

                    <p class="text-white/60 text-sm">
                        Peringkat
                    </p>

                    <h2 class="text-white text-4xl font-extrabold mt-2">
                        #{{ $rank }}
                    </h2>

                </div>

            </div>

        
        
        @include('components.achievement')
        </main>

    </div>

    <!-- SWEETALERT -->
    <script>

        @if(session('success'))

            Swal.fire({

                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                background: '#0f172a',
                color: '#fff',
                iconColor: '#22c55e'

            });

        @endif

        @if(session('error'))

            Swal.fire({

                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                background: '#0f172a',
                color: '#fff',
                iconColor: '#ef4444'

            });

        @endif

    </script>

@include('components.loading')
@include('components.sound')
@include('components.level-up')
<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const ctx = document
        .getElementById('progressChart');

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: [

                'Level 1',
                'Level 2',
                'Level 3',
                'Level 4',
                'Level 5',
                'Level 6'

            ],

            datasets: [{

                label: 'Progress XP',

                data: [

                    10,
                    35,
                    50,
                    70,
                    90,
                    {{ $xp }}

                ],

                borderWidth: 3,
                tension: 0.4,

            }]

        },

        options: {

            responsive: true,

            plugins: {

                legend: {

                    labels: {

                        color: '#ffffff'

                    }

                }

            },

            scales: {

                x: {

                    ticks: {

                        color: '#ffffff'

                    }

                },

                y: {

                    ticks: {

                        color: '#ffffff'

                    }

                }

            }

        }

    });

</script>


<script>

    function updateClock(){

        const now = new Date();

        const time = now.toLocaleTimeString('id-ID');

        document
            .getElementById('live-clock')
            .innerHTML = time;

    }

    setInterval(updateClock,1000);

    updateClock();

</script>
</body>
</html>