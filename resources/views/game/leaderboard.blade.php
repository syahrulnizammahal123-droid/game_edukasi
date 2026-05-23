<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peringkat Pemain</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

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
            transform:translateY(-6px);
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
    <div class="absolute top-0 left-0 w-72 h-72 bg-cyan-400/20 blur-3xl rounded-full"></div>

    <div class="absolute bottom-0 right-0 w-72 h-72 bg-purple-500/20 blur-3xl rounded-full"></div>

    <!-- MAIN -->
    <div class="relative z-10 min-h-screen p-5 lg:p-8 pb-32">

        <div class="max-w-7xl mx-auto">

            <!-- HEADER -->
            <div
                class="glass rounded-[35px]
                p-6 lg:p-8 mb-8"
            >

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <!-- LEFT -->
                    <div>

                        <p class="text-cyan-300 font-semibold mb-3">
                            Kompetisi Pemain
                        </p>

                        <h1 class="text-4xl lg:text-6xl font-extrabold text-white">
                            Peringkat Terbaik
                        </h1>

                        <p class="text-white/60 mt-4 max-w-2xl">
                            Jadilah petualang terbaik dengan skor tertinggi di dunia quiz.
                        </p>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex gap-4">

                        <!-- DASHBOARD -->
                        <a href="/dashboard"
                            class="w-14 h-14 rounded-2xl
                            glass flex items-center justify-center
                            text-white hover:bg-white/10 transition"
                        >

                            <i class="fa-solid fa-house"></i>

                        </a>

                        <!-- MAIN -->
                        <a href="/game/level"
                            class="w-14 h-14 rounded-2xl
                            bg-gradient-to-r from-cyan-400 to-blue-600
                            flex items-center justify-center
                            text-white shadow-xl"
                        >

                            <i class="fa-solid fa-play"></i>

                        </a>

                    </div>

                </div>

            </div>

            <!-- PODIUM -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

                <!-- RANK 2 -->
                @if(isset($data[1]))

                    <div
                        class="mt-0 lg:mt-16
                        rounded-[40px]
                        bg-gradient-to-br from-slate-300 to-slate-600
                        p-8 text-white
                        shadow-[0_0_45px_rgba(255,255,255,0.2)]
                        relative overflow-hidden
                        card-hover"
                    >

                        <!-- GLOW -->
                        <div class="absolute -top-16 -right-16 w-52 h-52 bg-white/10 blur-3xl rounded-full"></div>

                        <!-- BADGE -->
                        <div
                            class="absolute top-5 right-5
                            w-14 h-14 rounded-2xl
                            bg-white/20 flex items-center justify-center"
                        >

                            <i class="fa-solid fa-medal text-2xl"></i>

                        </div>

                        <!-- AVATAR -->
                        <div
                            class="w-28 h-28 rounded-full
                            border-4 border-white/30
                            bg-white/20
                            flex items-center justify-center
                            mx-auto mb-6"
                        >

                            <i class="fa-solid fa-user text-5xl"></i>

                        </div>

                        <!-- INFO -->
                        <div class="text-center">

                            <p class="text-white/80 mb-2">
                                Peringkat 2
                            </p>

                            <h2 class="text-4xl font-extrabold">

                                {{ $data[1]->user->name }}

                            </h2>

                            <div
                                class="mt-6 bg-white/10 rounded-3xl
                                p-5"
                            >

                                <p class="text-white/70 text-sm mb-2">
                                    Skor Tertinggi
                                </p>

                                <h1 class="text-6xl font-extrabold">

                                    {{ $data[1]->high_score }}

                                </h1>

                            </div>

                        </div>

                    </div>

                @endif

                <!-- RANK 1 -->
                @if(isset($data[0]))

                    <div
                        class="rounded-[40px]
                        bg-gradient-to-br from-yellow-400 to-orange-500
                        p-8 text-white
                        shadow-[0_0_60px_rgba(251,191,36,0.35)]
                        relative overflow-hidden
                        scale-100 lg:scale-110
                        z-10 card-hover"
                    >

                        <!-- CROWN -->
                        <div
                            class="absolute top-5 left-1/2
                            -translate-x-1/2"
                        >

                            <div
                                class="w-20 h-20 rounded-full
                                bg-white/20
                                flex items-center justify-center"
                            >

                                <i class="fa-solid fa-crown text-4xl"></i>

                            </div>

                        </div>

                        <!-- GLOW -->
                        <div class="absolute -top-20 -right-20 w-60 h-60 bg-white/10 blur-3xl rounded-full"></div>

                        <!-- AVATAR -->
                        <div
                            class="w-36 h-36 rounded-full
                            border-[6px] border-white/30
                            bg-white/20
                            flex items-center justify-center
                            mx-auto mt-16 mb-8"
                        >

                            <i class="fa-solid fa-user text-6xl"></i>

                        </div>

                        <!-- INFO -->
                        <div class="text-center">

                            <p class="text-white/90 text-lg mb-2 font-semibold">
                                Juara 1
                            </p>

                            <h2 class="text-5xl font-extrabold">

                                {{ $data[0]->user->name }}

                            </h2>

                            <p class="text-white/80 mt-3">
                                Raja Petualangan Quiz
                            </p>

                            <div
                                class="mt-8 bg-white/10 rounded-[35px]
                                p-6"
                            >

                                <p class="text-white/80 text-sm mb-2">
                                    Skor Tertinggi
                                </p>

                                <h1 class="text-7xl font-extrabold">

                                    {{ $data[0]->high_score }}

                                </h1>

                            </div>

                        </div>

                    </div>

                @endif

                <!-- RANK 3 -->
                @if(isset($data[2]))

                    <div
                        class="mt-0 lg:mt-24
                        rounded-[40px]
                        bg-gradient-to-br from-orange-500 to-amber-800
                        p-8 text-white
                        shadow-[0_0_45px_rgba(251,146,60,0.2)]
                        relative overflow-hidden
                        card-hover"
                    >

                        <!-- GLOW -->
                        <div class="absolute -top-16 -right-16 w-52 h-52 bg-white/10 blur-3xl rounded-full"></div>

                        <!-- BADGE -->
                        <div
                            class="absolute top-5 right-5
                            w-14 h-14 rounded-2xl
                            bg-white/20 flex items-center justify-center"
                        >

                            <i class="fa-solid fa-award text-2xl"></i>

                        </div>

                        <!-- AVATAR -->
                        <div
                            class="w-28 h-28 rounded-full
                            border-4 border-white/30
                            bg-white/20
                            flex items-center justify-center
                            mx-auto mb-6"
                        >

                            <i class="fa-solid fa-user text-5xl"></i>

                        </div>

                        <!-- INFO -->
                        <div class="text-center">

                            <p class="text-white/80 mb-2">
                                Peringkat 3
                            </p>

                            <h2 class="text-4xl font-extrabold">

                                {{ $data[2]->user->name }}

                            </h2>

                            <div
                                class="mt-6 bg-white/10 rounded-3xl
                                p-5"
                            >

                                <p class="text-white/70 text-sm mb-2">
                                    Skor Tertinggi
                                </p>

                                <h1 class="text-6xl font-extrabold">

                                    {{ $data[2]->high_score }}

                                </h1>

                            </div>

                        </div>

                    </div>

                @endif

            </div>

            <!-- LIST PLAYER -->
            <div
                class="glass rounded-[35px]
                p-6 lg:p-8"
            >

                <!-- TITLE -->
                <div class="flex items-center gap-4 mb-8">

                    <div
                        class="w-16 h-16 rounded-3xl
                        bg-gradient-to-br from-cyan-400 to-blue-600
                        flex items-center justify-center"
                    >

                        <i class="fa-solid fa-ranking-star text-white text-2xl"></i>

                    </div>

                    <div>

                        <p class="text-cyan-300 text-sm font-semibold">
                            Daftar Pemain
                        </p>

                        <h2 class="text-white text-3xl font-bold">
                            Ranking Global
                        </h2>

                    </div>

                </div>

                <!-- LIST -->
                <div class="space-y-5">

                    @foreach($data as $index => $player)

                        <div
                            class="rounded-[30px]
                            p-5 lg:p-6
                            {{ $player->user_id == $myId
                                ? 'bg-gradient-to-r from-cyan-500/20 to-blue-600/20 border border-cyan-400/20'
                                : 'bg-white/5 border border-white/10'
                            }}
                            card-hover"
                        >

                            <div class="flex items-center justify-between gap-4">

                                <!-- LEFT -->
                                <div class="flex items-center gap-5">

                                    <!-- RANK -->
                                    <div
                                        class="w-14 h-14 rounded-2xl
                                        {{ $index == 0
                                            ? 'bg-gradient-to-br from-yellow-400 to-orange-500'
                                            : ($index == 1
                                                ? 'bg-gradient-to-br from-slate-300 to-slate-600'
                                                : ($index == 2
                                                    ? 'bg-gradient-to-br from-orange-500 to-amber-700'
                                                    : 'glass'))
                                        }}
                                        flex items-center justify-center
                                        text-white font-bold text-lg"
                                    >

                                        {{ $index + 1 }}

                                    </div>

                                    <!-- PROFILE -->
                                    <div
                                        class="w-16 h-16 rounded-3xl
                                        bg-gradient-to-br from-cyan-400 to-blue-600
                                        flex items-center justify-center"
                                    >

                                        <i class="fa-solid fa-user text-white text-xl"></i>

                                    </div>

                                    <!-- NAME -->
                                    <div>

                                        <div class="flex items-center gap-3">

                                            <h2 class="text-white text-xl font-bold">

                                                {{ $player->user->name }}

                                            </h2>

                                            @if($player->user_id == $myId)

                                                <span
                                                    class="px-3 py-1 rounded-xl
                                                    bg-cyan-500/20 border border-cyan-400/20
                                                    text-cyan-300 text-xs font-semibold"
                                                >

                                                    Kamu

                                                </span>

                                            @endif

                                        </div>

                                        <p class="text-white/50 text-sm mt-1">
                                            Pemain Petualangan
                                        </p>

                                    </div>

                                </div>

                                <!-- SCORE -->
                                <div class="text-right">

                                    <p class="text-white/50 text-sm mb-1">
                                        Skor
                                    </p>

                                    <h2 class="text-white text-3xl font-extrabold">

                                        {{ $player->high_score }}

                                    </h2>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

@include('components.loading')
@include('components.sound')
</body>
</html>