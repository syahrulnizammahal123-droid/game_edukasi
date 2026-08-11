<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis Jawaban Kilat - Guiz Adventure</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
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
        .btn-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-hover:hover {
            transform: translateY(-4px);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden text-white antialiased flex flex-col justify-center p-4" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <!-- Overlay Gelap -->
    <div class="fixed inset-0 bg-[#030712]/85 -z-10"></div>

    <!-- MAIN EXPLANATION DISPLAY CONTAINER -->
    <div class="relative z-10 max-w-2xl w-full mx-auto space-y-5">
        
        <!-- 1. FEEDBACK BANNER STATUS (BENAR / SALAH / WAKTU HABIS) -->
        <div class="glass rounded-[30px] p-6 text-center border relative overflow-hidden shadow-lg 
            {{ $isCorrect ? 'border-emerald-500/30 bg-emerald-500/5 shadow-emerald-500/5' : 'border-rose-500/30 bg-rose-500/5 shadow-rose-500/5' }}
        ">
            <!-- Icon Status -->
            <div class="w-16 h-16 rounded-2xl mx-auto flex items-center justify-center text-3xl mb-4
                {{ $isCorrect ? 'bg-emerald-500/20 text-emerald-400' : 'bg-rose-500/20 text-rose-400' }}
            ">
                <i class="fa-solid {{ $isCorrect ? 'fa-circle-check animate-bounce' : 'fa-circle-xmark animate-pulse' }}"></i>
            </div>

            <!-- Teks Pesan Status dari Controller -->
            <h2 class="text-xl font-extrabold tracking-wide">
                {{ $status }}
            </h2>
        </div>

        <!-- 2. PERNYATAAN SOAL KILAT -->
        <div class="glass rounded-2xl p-5 border border-white/5">
            <span class="text-[10px] text-amber-400 uppercase font-bold tracking-widest block mb-2">Pernyataan Soal:</span>
            <p class="text-base font-semibold text-white/90 leading-relaxed">
                "{{ $soal->pernyataan }}"
            </p>
        </div>

        <!-- 3. REKAP STATUS PERNYATAAN SEBENARNYA -->
        <div class="glass rounded-2xl p-4 border border-white/5 flex items-center justify-between">
            <span class="text-xs text-white/60 font-medium">Status Validitas Pernyataan:</span>
            <span class="px-4 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider
                {{ $soal->jawaban_benar ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-rose-500/20 text-rose-400 border border-rose-500/30' }}
            ">
                {{ $soal->jawaban_benar ? 'BENAR (TRUE)' : 'SALAH (FALSE)' }}
            </span>
        </div>

        <!-- 4. KOTAK REFLEKSI PEMBAHASAN -->
        <div class="glass rounded-[35px] p-6 lg:p-8 border border-white/5 relative overflow-hidden shadow-inner">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-500 to-orange-500"></div>
            
            <div class="flex items-center gap-2.5 mb-3">
                <div class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-400 text-sm">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>
                <div>
                    <h3 class="text-xs font-black uppercase tracking-wider text-amber-300">Penjelasan & Analisis Logic</h3>
                    <p class="text-[9px] text-white/40">Suplemen pemahaman singkat untuk meningkatkan ketepatan berpikir kritis</p>
                </div>
            </div>

            <p class="text-sm text-white/80 leading-relaxed font-medium tracking-wide border-t border-white/5 pt-3">
                {{ $soal->penjelasan ?? 'Tidak ada pembahasan tertulis untuk soal kuis kilat ini.' }}
            </p>
        </div>

        <!-- 5. NAVIGATION CTA ROUTING (LANJUTKAN KE SOAL BERIKUTNYA) -->
        <div class="pt-2">
            <a href="{{ route('game-kilat.next') }}" class="w-full inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-amber-400 via-orange-500 to-red-600 text-white font-black text-md py-4 rounded-[22px] shadow-lg shadow-orange-500/20 btn-hover uppercase tracking-wider">
                <span>Soal Kilat Berikutnya</span>
                <i class="fa-solid fa-forward-step text-sm"></i>
            </a>
        </div>

    </div>

    <!-- CORE UTILITY INCLUDES -->
    @include('components.loading')
    @include('components.sound')

</body>
</html>