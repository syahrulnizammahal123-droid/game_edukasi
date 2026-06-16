<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Zona Tantangan - Guiz Adventure Kilat</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .glass {
            background: rgba(11, 19, 35, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .level-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .level-card:hover {
            transform: translateY(-8px);
            border-color: rgba(34, 211, 238, 0.4);
            box-shadow: 0 20px 40px rgba(34, 211, 238, 0.15);
        }
    </style>
</head>
<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden text-white antialiased flex flex-col justify-center p-4 sm:p-6 md:p-8" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <!-- Ambient Overlay -->
    <div class="fixed inset-0 bg-[#030712]/85 -z-20"></div>
    <div class="absolute top-10 right-10 w-80 h-80 rounded-full bg-orange-500/10 blur-3xl pointer-events-none animate-pulse"></div>

    <div class="max-w-5xl w-full mx-auto space-y-8 relative z-10">
        
        <!-- HEADER ZONE -->
        <div class="glass rounded-[35px] p-6 lg:p-8 border border-white/5 relative overflow-hidden">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-xl bg-orange-500/10 text-orange-400 text-xs font-bold border border-orange-400/20 tracking-wider uppercase">
                        <i class="fa-solid fa-bolt text-[10px]"></i> Mode Time Attack
                    </div>
                    <h1 class="text-3xl lg:text-5xl font-black tracking-tight text-white mt-2">
                        Pilih Tingkat Sensoris
                    </h1>
                    <p class="text-white/60 text-xs lg:text-sm max-w-xl leading-relaxed pt-1">
                        Uji spontanitas penalaran logika kognitif kamu di bawah tekanan waktu mundur kilat. Putuskan skenario BENAR atau SALAH secara instan!
                    </p>
                </div>

                <div class="w-full md:w-auto">
                    <a href="/dashboard"
                        class="w-full md:w-auto inline-flex items-center justify-center gap-2.5 bg-white/5 hover:bg-white/10 border border-white/10 text-white px-6 py-4 rounded-2xl font-bold text-sm transition-all transform hover:-translate-y-0.5 group">
                        <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                        <span>Kembali ke Hub</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- LEVEL SELECTION GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- LEVEL 1 CARD -->
            <div class="glass rounded-[32px] p-6 border border-white/5 flex flex-col justify-between level-card relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 text-white/[0.02] text-8xl font-black group-hover:scale-110 transition-transform pointer-events-none">01</div>
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 font-black text-lg shadow-[0_0_15px_rgba(34,211,238,0.1)]">
                        01
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold tracking-wide text-white">Stage Pemula: Identifikasi</h3>
                        <p class="text-xs text-white/50 leading-relaxed mt-1">Fokus pada aspek analisis dasar untuk memisahkan kebenaran fakta sederhana dari bias informasi.</p>
                    </div>
                    <!-- KKM TARGET INDICATOR -->
                    <div class="bg-white/5 p-3 rounded-xl border border-white/5 text-[11px] text-white/60 space-y-1">
                        <div class="flex justify-between font-medium"><span>Target Kelulusan:</span><span class="text-cyan-400 font-bold">Min. 75% Akurasi</span></div>
                        <div class="flex justify-between font-medium"><span>Waktu Berpikir:</span><span class="text-white/80">5 Detik / Soal</span></div>
                    </div>
                </div>
                <div class="pt-6">
                    <a href="{{ url('/game-kilat/start/1') }}" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-cyan-400 to-blue-500 hover:opacity-95 text-white font-bold text-xs py-3.5 rounded-xl transition shadow-lg shadow-blue-500/10">
                        <span>MASUK ARENA</span> <i class="fa-solid fa-circle-play text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- LEVEL 2 CARD -->
            <div class="glass rounded-[32px] p-6 border border-white/5 flex flex-col justify-between level-card relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 text-white/[0.02] text-8xl font-black group-hover:scale-110 transition-transform pointer-events-none">02</div>
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 font-black text-lg shadow-[0_0_15px_rgba(168,85,247,0.1)]">
                        02
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold tracking-wide text-white">Stage Menengah: Evaluasi</h3>
                        <p class="text-xs text-white/50 leading-relaxed mt-1">Menguji ketajaman argumentasi kognitif kompleks dengan pola pengecoh yang lebih samar.</p>
                    </div>
                    <!-- KKM TARGET INDICATOR -->
                    <div class="bg-white/5 p-3 rounded-xl border border-white/5 text-[11px] text-white/60 space-y-1">
                        <div class="flex justify-between font-medium"><span>Target Kelulusan:</span><span class="text-purple-400 font-bold">Min. 80% Akurasi</span></div>
                        <div class="flex justify-between font-medium"><span>Waktu Berpikir:</span><span class="text-white/80">5 Detik / Soal</span></div>
                    </div>
                </div>
                <div class="pt-6">
                    <a href="{{ url('/game-kilat/start/2') }}" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-500 to-indigo-600 hover:opacity-95 text-white font-bold text-xs py-3.5 rounded-xl transition shadow-lg shadow-purple-500/10">
                        <span>MASUK ARENA</span> <i class="fa-solid fa-lock-open text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- LEVEL 3 CARD -->
            <div class="glass rounded-[32px] p-6 border border-white/5 flex flex-col justify-between level-card relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 text-white/[0.02] text-8xl font-black group-hover:scale-110 transition-transform pointer-events-none">03</div>
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center text-orange-400 font-black text-lg shadow-[0_0_15px_rgba(249,115,22,0.1)]">
                        03
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold tracking-wide text-white">Stage Ahli: Inferensi</h3>
                        <p class="text-xs text-white/50 leading-relaxed mt-1">Tingkat penarikan kesimpulan ekstrem yang membutuhkan sinkronisasi logika super cepat.</p>
                    </div>
                    <!-- KKM TARGET INDICATOR -->
                    <div class="bg-white/5 p-3 rounded-xl border border-white/5 text-[11px] text-white/60 space-y-1">
                        <div class="flex justify-between font-medium"><span>Target Kelulusan:</span><span class="text-orange-400 font-bold">Min. 85% Akurasi</span></div>
                        <div class="flex justify-between font-medium"><span>Waktu Berpikir:</span><span class="text-white/80">4 Detik / Soal</span></div>
                    </div>
                </div>
                <div class="pt-6">
                    <a href="{{ url('/game-kilat/start/3') }}" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-orange-400 to-pink-600 hover:opacity-95 text-white font-bold text-xs py-3.5 rounded-xl transition shadow-lg shadow-orange-500/10">
                        <span>MASUK ARENA</span> <i class="fa-solid fa-bolt text-[10px]"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>

    @include('components.loading')
    @include('components.sound')

    <script>
        // Opsional: Clear cache lokal saat berpindah stage kuis demi performa transisi game
        console.log("Guiz Adventure Kilat Level Router Activated.");
    </script>
</body>
</html>