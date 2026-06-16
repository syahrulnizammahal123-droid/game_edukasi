<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Logika - Guiz Adventure Kilat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass {
            background: rgba(11, 19, 35, 0.55);
            backdrop-filter: blur(20px);
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
<body class="relative min-h-screen bg-cover bg-center flex flex-col justify-center p-4 animate-fade-in" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">
    <div class="fixed inset-0 bg-[#030712]/85 -z-10"></div>

    <div class="max-w-xl w-full mx-auto space-y-5 relative z-10">
        
        <!-- 1. FEEDBACK STATUS SCREEN (BENAR / SALAH) -->
        <div class="glass rounded-[30px] p-6 text-center border relative overflow-hidden shadow-xl 
            {{ $isCorrect ? 'border-emerald-500/30 bg-emerald-500/5 shadow-emerald-500/5' : 'border-red-500/30 bg-red-500/5 shadow-red-500/5' }}
        ">
            <!-- Icon Glow Status -->
            <div class="w-16 h-16 rounded-2xl mx-auto flex items-center justify-center text-3xl mb-4
                {{ $isCorrect ? 'bg-emerald-500/20 text-emerald-400 drop-shadow-[0_0_10px_rgba(16,185,129,0.4)]' : 'bg-red-500/20 text-red-400 drop-shadow-[0_0_10px_rgba(239,68,68,0.4)]' }}
            ">
                <i class="fa-solid {{ $isCorrect ? 'fa-circle-check animate-bounce' : 'fa-circle-xmark animate-pulse' }}"></i>
            </div>

            <!-- Teks Status Hasil -->
            <h2 class="text-2xl font-black tracking-wide {{ $isCorrect ? 'text-emerald-400' : 'text-red-400' }}">
                {{ $status }}
            </h2>
        </div>

        <!-- 2. REKAP PERNYATAAN YANG DIEVALUASI -->
        <div class="glass rounded-[24px] p-5 border border-white/5 space-y-2">
            <p class="text-[10px] text-white/40 font-bold uppercase tracking-widest">Pernyataan Sebelumnya:</p>
            <p class="text-sm text-white/90 italic font-medium leading-relaxed">
                "{{ $soal->pernyataan }}"
            </p>
            <div class="pt-2 flex items-center gap-2">
                <span class="text-[11px] text-white/50">Kunci Jawaban yang Benar:</span>
                <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-black uppercase tracking-wider {{ $soal->jawaban_benar ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/20' : 'bg-red-500/20 text-red-400 border border-red-500/20' }}">
                    {{ $soal->jawaban_benar ? 'BENAR' : 'SALAH' }}
                </span>
            </div>
        </div>

        <!-- 3. KOTAK REFLEKSI PEMBAHASAN (KOGNITIF SUPLEMENT) -->
        <div class="glass rounded-[32px] p-6 border border-white/5 relative overflow-hidden shadow-inner">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-400 to-amber-500"></div>
            
            <div class="flex items-center gap-2.5 mb-3">
                <div class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-400 text-sm">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>
                <div>
                    <h3 class="text-xs font-black uppercase tracking-wider text-amber-300">Konstruksi Penalaran Kilat</h3>
                    <p class="text-[9px] text-white/40">Analisis cepat untuk meminimalkan miskonsepsi berpikir</p>
                </div>
            </div>

            <p class="text-xs md:text-sm text-white/80 leading-relaxed font-medium tracking-wide border-t border-white/5 pt-3">
                {{ $soal->penjelasan ?? 'Tidak ada pembahasan tertulis untuk pernyataan kuis kilat ini.' }}
            </p>
        </div>

        <!-- 4. CONTINUOUS ACTION BUTTON -->
        <div class="pt-1">
            <a href="{{ url('/game-kilat/next') }}" class="w-full inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 text-white font-black text-sm py-4 rounded-2xl shadow-lg shadow-blue-500/20 btn-hover uppercase tracking-wider">
                <span>Lanjutkan Gerakan</span>
                <i class="fa-solid fa-bolt text-xs text-yellow-300"></i>
            </a>
        </div>

    </div>
</body>
</html>