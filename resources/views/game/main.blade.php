<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arena Pertempuran - Guiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .glass {
            background: rgba(11, 19, 35, 0.55);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .option-card {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .option-card:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(34, 211, 238, 0.4);
            transform: scale(1.01);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden text-white antialiased flex flex-col justify-center p-4" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#030712]/85 -z-10"></div>

    <div class="relative z-10 max-w-3xl w-full mx-auto space-y-4">
        
        <div class="glass rounded-[26px] p-5 flex items-center justify-between border border-cyan-500/20 shadow-lg">
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-white/50 uppercase tracking-wider mr-1">Sisa HP:</span>
                <div class="flex gap-1.5 text-lg text-red-500">
                    @for($i = 1; $i <= 3; $i++)
                        @if($i <= ($hearts ?? 3))
                            <i class="fa-solid fa-heart drop-shadow-[0_0_6px_rgba(239,68,68,0.6)] animate-pulse"></i>
                        @else
                            <i class="fa-regular fa-heart text-white/20"></i>
                        @endif
                    @endfor
                </div>
            </div>

            @if(session('combo', 0) > 0)
            <div class="flex items-center gap-2 animate-bounce">
                <span class="px-3 py-1 rounded-full bg-orange-500/20 border border-orange-400/30 text-orange-400 text-[10px] font-black uppercase tracking-widest">
                    🔥 {{ session('combo') }} Combo Streak!
                </span>
            </div>
            @endif

            <div class="text-right">
                <span class="px-3 py-1 rounded-xl bg-cyan-500/20 text-cyan-300 text-xs font-bold border border-cyan-400/20">
                    STAGE {{ session('game_level', 1) }}
                </span>
            </div>
        </div>

        <div class="w-full space-y-1.5">
            <div class="flex justify-between text-[11px] text-white/40 font-bold uppercase tracking-wider px-1">
                <span>Kemajuan Tantangan</span>
                <span>Soal {{ (session('index', 0) + 1) }} dari {{ $total ?? 1 }}</span>
            </div>
            <div class="w-full h-2 rounded-full bg-white/10 p-0.5 border border-white/5 overflow-hidden">
                <div class="h-full rounded-full bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500 transition-all duration-300" 
                     style="width: {{ (($自由 = session('index', 0) + 1) / ($total ?? 1)) * 100 }}%"></div>
            </div>
        </div>

        <div class="glass rounded-[35px] p-8 border border-white/5 min-h-[160px] flex flex-col justify-center relative overflow-hidden shadow-inner">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 to-blue-500"></div>
            <p class="text-white/40 text-[10px] font-black uppercase tracking-widest mb-2"><i class="fa-solid fa-circle-question text-cyan-400"></i> Pertanyaan Logika Kognitif</p>
            <h2 class="text-lg lg:text-xl font-bold leading-relaxed tracking-wide text-white/95">
                {{ $soal->pertanyaan }}
            </h2>
        </div>

        <form method="POST" action="{{ url('/game/jawab') }}" id="quizForm">
            @csrf
            <input type="hidden" name="jawaban" id="selectedAnswer" value="">

            <div class="grid grid-cols-1 gap-3">
                <button type="button" onclick="submitAnswer('A')" class="option-card w-full glass rounded-2xl p-5 text-left border border-white/5 flex items-center gap-4 group">
                    <span class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-xs font-black text-cyan-400 group-hover:bg-cyan-500 group-hover:text-white transition-colors">A</span>
                    <p class="text-sm font-medium text-white/80 group-hover:text-white transition-colors flex-1">{{ $soal->A }}</p>
                </button>

                <button type="button" onclick="submitAnswer('B')" class="option-card w-full glass rounded-2xl p-5 text-left border border-white/5 flex items-center gap-4 group">
                    <span class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-xs font-black text-cyan-400 group-hover:bg-cyan-500 group-hover:text-white transition-colors">B</span>
                    <p class="text-sm font-medium text-white/80 group-hover:text-white transition-colors flex-1">{{ $soal->B }}</p>
                </button>

                <button type="button" onclick="submitAnswer('C')" class="option-card w-full glass rounded-2xl p-5 text-left border border-white/5 flex items-center gap-4 group">
                    <span class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-xs font-black text-cyan-400 group-hover:bg-cyan-500 group-hover:text-white transition-colors">C</span>
                    <p class="text-sm font-medium text-white/80 group-hover:text-white transition-colors flex-1">{{ $soal->C }}</p>
                </button>

                <button type="button" onclick="submitAnswer('D')" class="option-card w-full glass rounded-2xl p-5 text-left border border-white/5 flex items-center gap-4 group">
                    <span class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-xs font-black text-cyan-400 group-hover:bg-cyan-500 group-hover:text-white transition-colors">D</span>
                    <p class="text-sm font-medium text-white/80 group-hover:text-white transition-colors flex-1">{{ $soal->D }}</p>
                </button>
            </div>
        </form>

    </div>

    @include('components.loading')
    @include('components.sound')

    <script>
        function submitAnswer(letter) {
            document.getElementById('selectedAnswer').value = letter;
            document.getElementById('quizForm').submit();
        }
    </script>
</body>
</html>