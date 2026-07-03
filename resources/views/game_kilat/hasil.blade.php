<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Evaluasi - Game Kilat</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body{ font-family:'Poppins',sans-serif; }
        .glass{
            background:rgba(255,255,255,0.07);
            backdrop-filter:blur(20px);
            -webkit-backdrop-filter:blur(20px);
            border:1px solid rgba(255,255,255,0.08);
        }
        .glow-shadow {
            box-shadow: 0 0 35px rgba(34, 211, 238, 0.25);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden flex items-center p-4" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#060b14]/85 -z-10"></div>

    <div class="absolute top-1/4 left-1/4 w-80 h-80 bg-cyan-500/10 blur-3xl rounded-full"></div>
    <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-purple-500/15 blur-3xl rounded-full"></div>

    <div class="relative z-10 w-full max-w-2xl mx-auto my-6 animate-fade-in">
        <div class="glass rounded-[40px] p-6 lg:p-10 border border-white/10 shadow-2xl text-center">
            
            <div class="relative mx-auto w-24 h-24 rounded-3xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-white text-4xl mb-6 glow-shadow">
                <i class="fa-solid fa-trophy animate-bounce"></i>
            </div>

            <p class="text-cyan-400 text-xs font-black tracking-widest uppercase mb-1">Pertualangan Selesai</p>
            <h1 class="text-3xl lg:text-4xl font-extrabold text-white tracking-tight mb-2">Ringkasan Hasil Skor</h1>
            <p class="text-white/50 text-xs max-w-md mx-auto mb-8">Data aktivitas kognitif pengerjaan kuis logika kilat kamu telah direkam ke dalam sistem basis data riset.</p>

            <div class="grid grid-cols-2 gap-4 mb-8">
                
                <div class="bg-white/5 border border-white/5 rounded-2xl p-4 flex flex-col justify-center">
                    <span class="text-[10px] text-white/40 font-bold uppercase tracking-wider mb-1">Total Poin (XP)</span>
                    <span class="text-3xl font-black text-orange-400">+{{ $score }}</span>
                </div>

                <div class="bg-white/5 border border-white/5 rounded-2xl p-4 flex flex-col justify-center">
                    <span class="text-[10px] text-white/40 font-bold uppercase tracking-wider mb-1">Tingkat Akurasi</span>
                    <span class="text-3xl font-black text-cyan-400">{{ $akurasi }}%</span>
                </div>

            </div>

            <div class="glass border border-white/5 rounded-2xl p-5 mb-10 flex items-center justify-between text-left">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-3xl font-black text-cyan-300">
                        {{ $grade }}
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">Predikat Kemampuan</h3>
                        <p class="text-xs text-white/50 mt-0.5">
                            @if($akurasi >= 80)
                                Berpikir kritis sangat tajam dan tanggap mendeteksi malafungsi.
                            @elseif($akurasi >= 60)
                                Pemahaman analitis cukup baik, pertahankan fokusmu.
                            @else
                                Perlu meningkatkan literasi dan ketelitian analisis masalah.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <a href="/leaderboard" class="flex items-center justify-center gap-3 glass text-white py-4 px-6 rounded-2xl text-sm font-bold hover:bg-white/10 transition duration-200">
                    <i class="fa-solid fa-ranking-star text-cyan-400"></i> Lihat Papan Peringkat
                </a>

                <a href="/game-kilat/level" class="flex items-center justify-center gap-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white py-4 px-6 rounded-2xl text-sm font-bold shadow-[0_0_20px_rgba(59,130,246,0.3)] hover:opacity-90 transition duration-200">
                    <i class="fa-solid fa-rotate-left"></i> Main Lagi
                </a>

            </div>

        </div>
    </div>

</body>
</html>