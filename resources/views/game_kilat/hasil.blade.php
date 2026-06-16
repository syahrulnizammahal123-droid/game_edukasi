<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Evaluasi Kilat - Guiz Adventure</title>

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

    <!-- MAIN RESULT CONTAINER -->
    <div class="relative z-10 max-w-2xl w-full mx-auto space-y-5">
        
        <!-- 1. RAPOR UTAMA SUMMARY CARD -->
        <div class="glass rounded-[35px] p-8 text-center border border-orange-500/20 bg-gradient-to-b from-orange-500/5 to-transparent relative overflow-hidden shadow-xl">
            <!-- Top Radial Glow -->
            <div class="absolute top-0 inset-x-0 flex justify-center"><div class="w-40 h-1 bg-gradient-to-r from-transparent via-orange-400 to-transparent"></div></div>

            <!-- APRESIASI TIER GRADE (S / A / B / C) -->
            <div class="w-24 h-24 rounded-[30px] bg-gradient-to-br from-orange-400 via-amber-500 to-red-600 flex items-center justify-center mx-auto mb-4 shadow-xl shadow-orange-500/20 border border-white/10 animate-bounce">
                <span class="text-4xl font-black text-white tracking-wider drop-shadow-md">
                    {{ $grade ?? 'B' }}
                </span>
            </div>

            <h1 class="text-2xl font-black tracking-wide text-white">
                Latihan Kilat Selesai!
            </h1>
            <p class="text-xs text-white/50 mt-1 max-w-md mx-auto leading-relaxed">
                Kamu telah menuntaskan simulasi berpikir kritis mode *Time Attack*. Berikut adalah hasil pemetaan respons sensorik logika kamu.
            </p>
        </div>

        <!-- 2. DATA HUD METRICS GRID -->
        <div class="grid grid-cols-2 gap-4">
            <div class="glass rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest mb-1">Total Skor Kilat</p>
                <span class="text-xl font-black text-orange-400 tracking-wide">{{ $score ?? 0 }}<span class="text-xs font-normal text-white/40 ml-0.5"> XP</span></span>
            </div>
            <div class="glass rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest mb-1">Akurasi Spontanitas</p>
                <span class="text-xl font-black text-cyan-400 tracking-wide">{{ $akurasi ?? 0 }}%</span>
            </div>
        </div>

        <!-- 3. ADVANCED REKOR MONITORING (METODOLOGI ARSIP) -->
        <div class="glass rounded-[30px] p-6 border border-white/5 space-y-3.5">
            <div class="flex items-center gap-2.5 border-b border-white/5 pb-2.5">
                <div class="w-8 h-8 rounded-lg bg-orange-500/10 flex items-center justify-center text-orange-400 text-sm">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div>
                    <h3 class="text-xs font-black uppercase tracking-wider text-orange-300">Hasil Rekomendasi Instruktur</h3>
                    <p class="text-[9px] text-white/40">Interpretasi kecepatan tanggap kognitif berdasarkan data kuantitatif</p>
                </div>
            </div>

            @if(($akurasi ?? 0) >= 80)
                <div class="flex gap-3 items-start text-xs bg-emerald-500/5 p-3 rounded-xl border border-emerald-500/20">
                    <i class="fa-solid fa-bolt-lightning text-emerald-400 text-sm mt-0.5 shrink-0"></i>
                    <p class="text-white/70 leading-relaxed text-[11px]">
                        <strong class="text-emerald-300">Respons Kognitif Unggul:</strong> Siswa memiliki ketajaman instink logika yang sangat luar biasa bawah tekanan waktu mundur. Mampu mengenali miskonsepsi data secara spontan tanpa ragu-grap!
                    </p>
                </div>
            @else
                <div class="flex gap-3 items-start text-xs bg-red-500/5 p-3 rounded-xl border border-red-500/20">
                    <i class="fa-solid fa-hourglass-empty text-orange-400 text-sm mt-0.5 shrink-0"></i>
                    <p class="text-white/70 leading-relaxed text-[11px]">
                        <strong class="text-orange-300">Butuh Latihan Refleksi:</strong> Siswa cenderung panik atau kurang teliti ketika membaca instrumen di bawah tekanan waktu mundur. Direkomendasikan melakukan simulasi ulang untuk mengasah ketepatan pemetaan fakta.
                    </p>
                </div>
            @endif
        </div>

        <!-- 4. NAVIGATION CONTROLS CONTROLLER -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
            <a href="/game-kilat/level" class="w-full inline-flex items-center justify-center gap-2.5 bg-white/5 border border-white/10 text-white font-bold text-sm py-4 rounded-xl hover:bg-white/10 transition duration-200 uppercase tracking-wide">
                <i class="fa-solid fa-rotate-left text-xs text-white/60"></i>
                <span>Coba Lagi</span>
            </a>
            <a href="/dashboard" class="w-full inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-orange-400 via-amber-500 to-red-600 text-white font-black text-sm py-4 rounded-xl shadow-lg shadow-orange-500/20 btn-hover transition duration-200 uppercase tracking-wide">
                <span>Kembali Ke Hub</span>
                <i class="fa-solid fa-house text-xs ml-1"></i>
            </a>
        </div>

    </div>

</body>
</html>