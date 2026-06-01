<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Permainan</title>

    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
            transition:.3s;
        }

    </style>

</head>

<body
    class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden text-white"
    style="background-image:url('{{ asset('images/bg-login.jpg') }}')"
>

    <!-- OVERLAY -->
    <div class="fixed inset-0 bg-[#07111f]/80 -z-10"></div>

    <!-- GLOW EFFECT -->
    <div
        class="absolute top-0 left-0
        w-72 h-72
        bg-cyan-400/20
        blur-3xl rounded-full"
    ></div>

    <div
        class="absolute bottom-0 right-0
        w-72 h-72
        bg-purple-500/20
        blur-3xl rounded-full"
    ></div>

    <div class="max-w-7xl mx-auto p-5 lg:p-8">

        <!-- HEADER -->
        <div
            class="glass rounded-[35px]
            p-6 lg:p-8 mb-8"
        >

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div>

                    <p class="text-cyan-300 font-semibold mb-3">
                        Progress Pemain
                    </p>

                    <h1 class="text-4xl lg:text-6xl font-extrabold">
                        Riwayat Permainan
                    </h1>

                    <p class="text-white/60 mt-4">
                        Seluruh hasil quiz yang pernah kamu selesaikan akan tersimpan di halaman ini.
                    </p>

                </div>

                <a
                    href="/dashboard"
                    class="inline-flex items-center gap-3
                    bg-gradient-to-r from-cyan-400 to-blue-600
                    px-6 py-4 rounded-3xl
                    font-semibold shadow-xl"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Dashboard

                </a>

            </div>

        </div>

        <!-- STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <!-- TOTAL GAME -->
            <div
                class="glass rounded-[30px]
                p-6 card-hover"
            >

                <div
                    class="w-14 h-14 rounded-2xl
                    bg-gradient-to-br from-cyan-400 to-blue-600
                    flex items-center justify-center mb-5"
                >

                    <i class="fa-solid fa-gamepad text-white text-xl"></i>

                </div>

                <p class="text-white/60 text-sm mb-2">
                    Total Permainan
                </p>

                <h2 class="text-4xl font-extrabold text-cyan-300">
                    {{ $data->count() }}
                </h2>

            </div>

            <!-- HIGH SCORE -->
            <div
                class="glass rounded-[30px]
                p-6 card-hover"
            >

                <div
                    class="w-14 h-14 rounded-2xl
                    bg-gradient-to-br from-yellow-400 to-orange-500
                    flex items-center justify-center mb-5"
                >

                    <i class="fa-solid fa-trophy text-white text-xl"></i>

                </div>

                <p class="text-white/60 text-sm mb-2">
                    Skor Tertinggi
                </p>

                <h2 class="text-4xl font-extrabold text-yellow-400">
                    {{ $data->max('score') ?? 0 }}
                </h2>

            </div>

            <!-- RATA RATA -->
            <div
                class="glass rounded-[30px]
                p-6 card-hover"
            >

                <div
                    class="w-14 h-14 rounded-2xl
                    bg-gradient-to-br from-emerald-400 to-green-600
                    flex items-center justify-center mb-5"
                >

                    <i class="fa-solid fa-chart-line text-white text-xl"></i>

                </div>

                <p class="text-white/60 text-sm mb-2">
                    Rata-rata Score
                </p>

                <h2 class="text-4xl font-extrabold text-emerald-400">
                    {{ round($data->avg('score') ?? 0) }}
                </h2>

            </div>

        </div>

        <!-- LIST RIWAYAT -->
        <div
            class="glass rounded-[35px]
            p-6 lg:p-8"
        >

            <div class="flex items-center gap-4 mb-8">

                <div
                    class="w-16 h-16 rounded-3xl
                    bg-gradient-to-br from-cyan-400 to-blue-600
                    flex items-center justify-center"
                >

                    <i class="fa-solid fa-clock-rotate-left text-white text-2xl"></i>

                </div>

                <div>

                    <p class="text-cyan-300 text-sm font-semibold">
                        History
                    </p>

                    <h2 class="text-3xl font-bold">
                        Aktivitas Bermain
                    </h2>

                </div>

            </div>

            <div class="space-y-5">

                @forelse($data as $item)

                    <div
                        class="bg-white/5
                        border border-white/10
                        rounded-[30px]
                        p-6"
                    >

                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                            <div>

                                <h3 class="text-2xl font-bold mb-2">
                                    Level {{ $item->level }}
                                </h3>

                                <p class="text-white/50">

                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y - H:i') }}

                                </p>

                            </div>

                            <div class="flex gap-4">

                                <div
                                    class="px-5 py-3 rounded-2xl
                                    bg-cyan-500/20
                                    border border-cyan-400/20"
                                >

                                    <p class="text-cyan-300 text-sm">
                                        Score
                                    </p>

                                    <h2 class="text-2xl font-bold">
                                        {{ $item->score }}
                                    </h2>

                                </div>

                                <div
                                    class="px-5 py-3 rounded-2xl
                                    bg-yellow-500/20
                                    border border-yellow-400/20"
                                >

                                    <p class="text-yellow-300 text-sm">
                                        Grade
                                    </p>

                                    <h2 class="text-2xl font-bold">
                                        {{ $item->grade }}
                                    </h2>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div
                        class="text-center
                        py-16"
                    >

                        <div
                            class="w-24 h-24 rounded-full
                            bg-white/10
                            flex items-center justify-center
                            mx-auto mb-6"
                        >

                            <i class="fa-solid fa-clock-rotate-left text-4xl text-cyan-300"></i>

                        </div>

                        <h2 class="text-3xl font-bold mb-3">
                            Belum Ada Riwayat
                        </h2>

                        <p class="text-white/60 mb-6">
                            Mainkan quiz terlebih dahulu untuk menyimpan progress permainan.
                        </p>

                        <a
                            href="/game/level"
                            class="inline-flex items-center gap-3
                            bg-gradient-to-r from-cyan-400 to-blue-600
                            px-6 py-4 rounded-3xl
                            font-semibold"
                        >

                            <i class="fa-solid fa-play"></i>

                            Mulai Bermain

                        </a>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</body>

</html>