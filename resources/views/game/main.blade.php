<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Petualangan</title>

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

        .jawaban:hover{
            transform:translateY(-4px);
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
    <div class="relative z-10 min-h-screen p-5 lg:p-8">

        <div class="max-w-5xl mx-auto">

            <!-- TOP BAR -->
            <div
                class="glass rounded-[30px]
                p-5 mb-6"
            >

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                    <!-- LEFT -->
                    <div>

                        <p class="text-cyan-300 font-semibold mb-2">
                            Mode Petualangan
                        </p>

                        <h1 class="text-3xl lg:text-4xl font-extrabold text-white">
                            Level {{ session('level') }}
                        </h1>

                    </div>

                    <!-- RIGHT -->
                    <div class="grid grid-cols-3 gap-4">

                        <!-- SCORE -->
                        <div
                            class="glass rounded-2xl px-5 py-4 text-center"
                        >

                            <div class="text-yellow-300 mb-2">

                                <i class="fa-solid fa-trophy text-xl"></i>

                            </div>

                            <p class="text-white/60 text-xs">
                                Skor
                            </p>

                            <h2 class="text-white text-2xl font-bold">
                                {{ $progress->score }}
                            </h2>

                        </div>

                        <!-- COMBO -->
                        <div
                            class="glass rounded-2xl px-5 py-4 text-center"
                        >

                            <div class="text-pink-300 mb-2">

                                <i class="fa-solid fa-fire text-xl"></i>

                            </div>

                            <p class="text-white/60 text-xs">
                                Combo
                            </p>

                            <h2 class="text-white text-2xl font-bold">
                                {{ session('combo',0) }}
                            </h2>

                        </div>

                        <!-- SOAL -->
                        <div
                            class="glass rounded-2xl px-5 py-4 text-center"
                        >

                            <div class="text-cyan-300 mb-2">

                                <i class="fa-solid fa-book-open text-xl"></i>

                            </div>

                            <p class="text-white/60 text-xs">
                                Soal
                            </p>

                            <h2 class="text-white text-2xl font-bold">
                                {{ session('index') + 1 }}/{{ $total }}
                            </h2>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PROGRESS -->
            <div class="mb-6">

                <div class="flex justify-between mb-3">

                    <span class="text-white/60 text-sm">
                        Progres Quiz
                    </span>

                    <span class="text-cyan-300 text-sm font-semibold">
                        {{ round(((session('index') + 1) / $total) * 100) }}%
                    </span>

                </div>

                <div
                    class="w-full h-4 rounded-full
                    bg-white/10 overflow-hidden"
                >

                    <div
                        class="h-full rounded-full
                        bg-gradient-to-r from-cyan-400 to-blue-600"
                        style="width: {{ ((session('index') + 1) / $total) * 100 }}%"
                    ></div>

                </div>

            </div>

            <!-- CARD SOAL -->
            <div
                class="glass rounded-[40px]
                p-6 lg:p-8 mb-8"
            >

                <!-- LABEL -->
                <div class="flex items-center gap-3 mb-6">

                    <div
                        class="w-14 h-14 rounded-2xl
                        bg-gradient-to-br from-cyan-400 to-blue-600
                        flex items-center justify-center"
                    >

                        <i class="fa-solid fa-scroll text-white text-xl"></i>

                    </div>

                    <div>

                        <p class="text-cyan-300 text-sm font-semibold">
                            Pertanyaan
                        </p>

                        <h2 class="text-white text-2xl font-bold">
                            Quiz Petualangan
                        </h2>

                    </div>

                </div>

                <!-- SOAL -->
                <div
                    class="bg-white/5 border border-white/10
                    rounded-[30px] p-6"
                >

                    <h1 class="text-white text-2xl lg:text-3xl font-bold leading-relaxed">

                        {{ $soal['pertanyaan'] }}

                    </h1>

                </div>

            </div>

            <!-- FORM -->
            <form action="/game/jawab" method="POST">

                @csrf

                <!-- JAWABAN -->
                <div class="grid grid-cols-1 gap-5">

                    <!-- A -->
                    <button
                        type="submit"
                        name="jawaban"
                        value="A"
                        class="jawaban text-left
                        rounded-[30px]
                        bg-gradient-to-r from-cyan-500/20 to-blue-600/20
                        border border-cyan-400/20
                        p-5 lg:p-6
                        hover:from-cyan-500 hover:to-blue-600
                        transition duration-300"
                    >

                        <div class="flex items-center gap-5">

                            <!-- ICON -->
                            <div
                                class="w-14 h-14 rounded-2xl
                                bg-cyan-500
                                flex items-center justify-center
                                text-white font-bold text-xl"
                            >

                                A

                            </div>

                            <!-- TEXT -->
                            <div>

                                <p class="text-white text-lg lg:text-xl font-semibold">

                                    {{ $soal['A'] }}

                                </p>

                            </div>

                        </div>

                    </button>

                    <!-- B -->
                    <button
                        type="submit"
                        name="jawaban"
                        value="B"
                        class="jawaban text-left
                        rounded-[30px]
                        bg-gradient-to-r from-purple-500/20 to-pink-600/20
                        border border-purple-400/20
                        p-5 lg:p-6
                        hover:from-purple-500 hover:to-pink-600
                        transition duration-300"
                    >

                        <div class="flex items-center gap-5">

                            <!-- ICON -->
                            <div
                                class="w-14 h-14 rounded-2xl
                                bg-purple-500
                                flex items-center justify-center
                                text-white font-bold text-xl"
                            >

                                B

                            </div>

                            <!-- TEXT -->
                            <div>

                                <p class="text-white text-lg lg:text-xl font-semibold">

                                    {{ $soal['B'] }}

                                </p>

                            </div>

                        </div>

                    </button>

                    <!-- C -->
                    <button
                        type="submit"
                        name="jawaban"
                        value="C"
                        class="jawaban text-left
                        rounded-[30px]
                        bg-gradient-to-r from-green-500/20 to-emerald-600/20
                        border border-green-400/20
                        p-5 lg:p-6
                        hover:from-green-500 hover:to-emerald-600
                        transition duration-300"
                    >

                        <div class="flex items-center gap-5">

                            <!-- ICON -->
                            <div
                                class="w-14 h-14 rounded-2xl
                                bg-green-500
                                flex items-center justify-center
                                text-white font-bold text-xl"
                            >

                                C

                            </div>

                            <!-- TEXT -->
                            <div>

                                <p class="text-white text-lg lg:text-xl font-semibold">

                                    {{ $soal['C'] }}

                                </p>

                            </div>

                        </div>

                    </button>

                    <!-- D -->
                    <button
                        type="submit"
                        name="jawaban"
                        value="D"
                        class="jawaban text-left
                        rounded-[30px]
                        bg-gradient-to-r from-orange-500/20 to-red-600/20
                        border border-orange-400/20
                        p-5 lg:p-6
                        hover:from-orange-500 hover:to-red-600
                        transition duration-300"
                    >

                        <div class="flex items-center gap-5">

                            <!-- ICON -->
                            <div
                                class="w-14 h-14 rounded-2xl
                                bg-orange-500
                                flex items-center justify-center
                                text-white font-bold text-xl"
                            >

                                D

                            </div>

                            <!-- TEXT -->
                            <div>

                                <p class="text-white text-lg lg:text-xl font-semibold">

                                    {{ $soal['D'] }}

                                </p>

                            </div>

                        </div>

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>