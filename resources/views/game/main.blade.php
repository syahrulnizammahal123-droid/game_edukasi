<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Petualangan - Guiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body{
            font-family:'Poppins',sans-serif;
        }

        .glass{
            background:rgba(255,255,255,0.08);
            backdrop-filter:blur(18px);
            -webkit-backdrop-filter:blur(18px);
            border:1px solid rgba(255,255,255,0.08);
        }

        .jawaban:hover{
            transform:translateY(-4px);
            transition:0.3s;
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden text-white" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#07111f]/80 -z-10"></div>

    <div class="absolute top-0 Bash left-0 w-72 h-72 bg-cyan-400/20 blur-3xl rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-purple-500/20 blur-3xl rounded-full"></div>

    <div class="relative z-10 min-h-screen p-5 lg:p-8">
        <div class="max-w-5xl mx-auto">

            <div class="glass rounded-[30px] p-5 mb-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                    
                    <div class="flex items-center justify-between lg:justify-start gap-6 w-full lg:w-auto">
                        <div>
                            <p class="text-cyan-300 font-semibold mb-1">Mode Petualangan</p>
                            <h1 class="text-3xl lg:text-4xl font-extrabold text-white">
                                Level {{ session('game_level', 1) }}
                            </h1>
                        </div>
                        
                        <div class="flex items-center gap-1.5 bg-red-500/10 border border-red-500/20 px-4 py-2 rounded-2xl">
                            @for($i = 0; $i < 3; $i++)
                                <i class="fa-solid fa-heart text-lg {{ $i < $hearts ? 'text-red-500 drop-shadow-[0_0_6px_rgba(239,68,68,0.6)]' : 'text-white/20' }}"></i>
                            @endfor
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 w-full lg:w-auto">

                        <div class="glass rounded-2xl px-5 py-4 text-center">
                            <div class="text-yellow-300 mb-2">
                                <i class="fa-solid fa-trophy text-xl"></i>
                            </div>
                            <p class="text-white/60 text-xs">Skor Sesi</p>
                            <h2 class="text-white text-2xl font-bold">{{ $progress->score }}</h2>
                        </div>

                        <div class="glass rounded-2xl px-5 py-4 text-center">
                            <div class="text-pink-300 mb-2">
                                <i class="fa-solid fa-fire text-xl animate-pulse"></i>
                            </div>
                            <p class="text-white/60 text-xs">Combo</p>
                            <h2 class="text-white text-2xl font-bold">{{ session('combo', 0) }}</h2>
                        </div>

                        <div class="glass rounded-2xl px-5 py-4 text-center">
                            <div class="text-cyan-300 mb-2">
                                <i class="fa-solid fa-book-open text-xl"></i>
                            </div>
                            <p class="text-white/60 text-xs">Soal</p>
                            <h2 class="text-white text-2xl font-bold">
                                {{ session('index', 0) + 1 }}/{{ $total }}
                            </h2>
                        </div>

                    </div>
                </div>
            </div>

            <div class="mb-6">
                <div class="flex justify-between mb-3">
                    <span class="text-white/60 text-sm">Progres Jalur Kuis</span>
                    <span class="text-cyan-300 text-sm font-semibold">
                        {{ round(((session('index', 0) + 1) / $total) * 100) }}%
                    </span>
                </div>
                <div class="w-full h-4 rounded-full bg-white/10 overflow-hidden p-0.5 border border-white/5">
                    <div class="h-full rounded-full bg-gradient-to-r from-cyan-400 to-blue-600 transition-all duration-300" 
                         style="width: {{ ((session('index', 0) + 1) / $total) * 100 }}%"></div>
                </div>
            </div>

            <div class="glass rounded-[40px] p-6 lg:p-8 mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/20">
                        <i class="fa-solid fa-scroll text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="text-cyan-300 text-sm font-semibold">Pertanyaan Aktif</p>
                        <h2 class="text-white text-2xl font-bold">Quiz Petualangan</h2>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-[30px] p-6">
                    <h1 class="text-white text-2xl lg:text-3xl font-bold leading-relaxed">
                        {{ $soal->pertanyaan }}
                    </h1>
                </div>
            </div>

            <form action="/game/jawab" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-5">

                    <button type="submit" name="jawaban" value="A" class="jawaban text-left rounded-[30px] bg-gradient-to-r from-cyan-500/20 to-blue-600/20 border border-cyan-400/20 p-5 lg:p-6 hover:from-cyan-500 hover:to-blue-600 transition duration-300 group">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-cyan-500 flex items-center justify-center text-white font-bold text-xl group-hover:bg-white group-hover:text-cyan-600 transition duration-300 shadow-md">
                                A
                            </div>
                            <div>
                                <p class="text-white text-lg lg:text-xl font-semibold">
                                    {{ $soal->A }}
                                </p>
                            </div>
                        </div>
                    </button>

                    <button type="submit" name="jawaban" value="B" class="jawaban text-left rounded-[30px] bg-gradient-to-r from-purple-500/20 to-pink-600/20 border border-purple-400/20 p-5 lg:p-6 hover:from-purple-500 hover:to-pink-600 transition duration-300 group">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-purple-500 flex items-center justify-center text-white font-bold text-xl group-hover:bg-white group-hover:text-purple-600 transition duration-300 shadow-md">
                                B
                            </div>
                            <div>
                                <p class="text-white text-lg lg:text-xl font-semibold">
                                    {{ $soal->B }}
                                </p>
                            </div>
                        </div>
                    </button>

                    <button type="submit" name="jawaban" value="C" class="jawaban text-left rounded-[30px] bg-gradient-to-r from-green-500/20 to-emerald-600/20 border border-green-400/20 p-5 lg:p-6 hover:from-green-500 hover:to-emerald-600 transition duration-300 group">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-green-500 flex items-center justify-center text-white font-bold text-xl group-hover:bg-white group-hover:text-green-600 transition duration-300 shadow-md">
                                C
                            </div>
                            <div>
                                <p class="text-white text-lg lg:text-xl font-semibold">
                                    {{ $soal->C }}
                                </p>
                            </div>
                        </div>
                    </button>

                    <button type="submit" name="jawaban" value="D" class="jawaban text-left rounded-[30px] bg-gradient-to-r from-orange-500/20 to-red-600/20 border border-orange-400/20 p-5 lg:p-6 hover:from-orange-500 hover:to-red-600 transition duration-300 group">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-orange-500 flex items-center justify-center text-white font-bold text-xl group-hover:bg-white group-hover:text-orange-600 transition duration-300 shadow-md">
                                D
                            </div>
                            <div>
                                <p class="text-white text-lg lg:text-xl font-semibold">
                                    {{ $soal->D }}
                                </p>
                            </div>
                        </div>
                    </button>

                </div>
            </form>

        </div>
    </div>

    @include('components.loading')
    @include('components.sound')
</body>
</html>