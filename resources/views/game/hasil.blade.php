<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Evaluasi Pertempuran - Guiz Adventure</title>

    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: floating 4s ease-in-out infinite;
        }

        .btn-active transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-active:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(34, 211, 238, 0.2);
        }
    </style>
</head>

<body class="bg-[#07111f] text-white min-h-screen relative bg-cover bg-center bg-fixed bg-no-repeat" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#07111f]/80 -z-10"></div>
    <div class="fixed inset-0 overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-cyan-500/10 blur-3xl rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-purple-500/10 blur-3xl rounded-full"></div>
    </div>

    <div class="max-w-4xl mx-auto px-5 py-10 relative z-10">

        <div class="glass floating rounded-[40px] p-8 lg:p-14 text-center border border-white/5 shadow-2xl">

            <div class="w-40 h-40 rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl relative overflow-hidden
                {{ $isKalah ? 'bg-gradient-to-br from-red-500 to-rose-700 shadow-red-500/20' : 'bg-gradient-to-br from-yellow-400 to-orange-500 shadow-yellow-500/20' }}
            ">
                @if($isKalah)
                    <i class="fa-solid fa-skull-crossbones text-white text-6xl"></i>
                @else
                    <i class="fa-solid fa-trophy text-white text-6xl drop-shadow-[0_4px_10px_rgba(0,0,0,0.3)]"></i>
                @endif
            </div>

            <p class="text-cyan-300 font-semibold uppercase tracking-widest text-sm mb-2">
                {{ $isKalah ? 'Pertempuran Usai' : 'Misi Penjelajahan Selesai' }}
            </p>

            <h1 class="text-4xl lg:text-6xl font-black mb-8 tracking-tight">
                {{ $isKalah ? 'GAME OVER' : 'HASIL QUIZ' }}
            </h1>

            <p class="text-[11px] text-white/40 uppercase font-bold tracking-wider mb-2">Predikat Kelulusan</p>
            <div class="w-44 h-44 rounded-full bg-gradient-to-br from-cyan-400 via-blue-500 to-indigo-600 flex items-center justify-center mx-auto mb-8 shadow-[0_0_5px_rgba(34,211,238,0.3)] border border-cyan-400/30">
                <span class="text-7xl font-black tracking-tight drop-shadow-[0_4px_12px_rgba(0,0,0,0.4)]">
                    {{ $grade }}
                </span>
            </div>

            <div class="flex justify-center gap-3 mb-8">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fa-solid fa-star text-3xl transition-transform duration-300
                        {{ $i <= $stars ? 'text-yellow-400 drop-shadow-[0_0_8px_rgba(234,179,8,0.7)] scale-110' : 'text-white/10' }}
                    "></i>
                @endfor
            </div>

            <div class="max-w-md mx-auto mb-10 space-y-2 bg-black/20 p-5 rounded-2xl border border-white/5">
                <div class="flex justify-between text-xs font-semibold">
                    <span class="text-white/50">Rasio Ketepatan Akurasi Jawaban</span>
                    <span class="text-cyan-400 font-bold">{{ $akurasi }}%</span>
                </div>
                <div class="w-full h-3 rounded-full bg-white/10 overflow-hidden p-0.5 border border-white/5">
                    <div class="h-full rounded-full bg-gradient-to-r from-cyan-400 to-blue-500 transition-all duration-500" 
                         style="width: {{ $akurasi }}%"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-10">
                
                <div class="rounded-[24px] bg-white/5 border border-white/10 p-6 flex flex-col justify-center">
                    <p class="text-white/40 text-xs font-bold uppercase tracking-wider mb-1">Skor Sesi Ini</p>
                    <h2 class="text-4xl font-black text-cyan-400 tracking-wide">
                        {{ $score }}
                    </h2>
                </div>

                <div class="rounded-[24px] bg-white/5 border border-white/10 p-6 flex flex-col justify-center">
                    <p class="text-white/40 text-xs font-bold uppercase tracking-wider mb-1">High Score Akun</p>
                    <h2 class="text-4xl font-black text-yellow-400 tracking-wide">
                        {{ $high_score }}
                    </h2>
                </div>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <a href="/dashboard" class="rounded-[24px] bg-white/10 border border-white/10 py-4.5 text-lg font-bold btn-active transition flex items-center justify-center gap-2 text-white/90">
                    <i class="fa-solid fa-house text-sm"></i>
                    <span>Dashboard</span>
                </a>

                <a href="/game/level" class="rounded-[24px] bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 py-4.5 text-lg font-bold btn-active transition flex items-center justify-center gap-2 shadow-lg shadow-blue-500/10">
                    <span>Main Lagi</span>
                    <i class="fa-solid fa-rotate-right text-sm"></i>
                </a>

            </div>

        </div>
    </div>

    @include('components.loading')
    @include('components.sound')

</body>
</html>