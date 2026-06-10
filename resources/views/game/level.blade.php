<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Level - Guiz Adventure</title>

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

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover{
            transform:translateY(-6px);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden text-white" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#07111f]/80 -z-10"></div>

    <div class="absolute top-0 left-0 w-72 h-72 bg-cyan-400/20 blur-3xl rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-purple-500/20 blur-3xl rounded-full pointer-events-none"></div>

    <div class="relative z-10 min-h-screen p-5 lg:p-8 pb-32">
        <div class="max-w-7xl mx-auto">

            <div class="glass rounded-[35px] p-6 lg:p-8 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div>
                        <p class="text-cyan-300 font-semibold mb-3">
                            <i class="fa-solid fa-compass mr-1.5"></i> Mode Petualangan
                        </p>
                        <h1 class="text-4xl lg:text-6xl font-extrabold text-white">
                            Pilih Level
                        </h1>
                        <p class="text-white/60 mt-4 max-w-2xl text-sm leading-relaxed">
                            Selesaikan tantangan kuis berbasis logika berpikir kritis dan buka gerbang level baru seiring perkembangan kemampuanmu.
                        </p>
                    </div>

                    <div class="flex gap-4">
                        <a href="/dashboard" class="w-14 h-14 rounded-2xl glass flex items-center justify-center text-white hover:bg-white/10 transition shadow-lg">
                            <i class="fa-solid fa-house"></i>
                        </a>
                        <a href="/leaderboard" class="w-14 h-14 rounded-2xl bg-gradient-to-r from-cyan-400 to-blue-600 flex items-center justify-center text-white shadow-xl transition-transform hover:scale-105">
                            <i class="fa-solid fa-ranking-star"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="glass rounded-[35px] p-6 lg:p-8 mb-8">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                    <div class="bg-white/5 border border-white/10 rounded-[30px] p-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center mb-5 shadow-md shadow-cyan-500/20">
                            <i class="fa-solid fa-bolt text-white text-xl"></i>
                        </div>
                        <p class="text-white/60 text-xs font-medium uppercase tracking-wider">Level Player</p>
                        <h2 class="text-white text-3xl font-black mt-2">{{ $playerLevel ?? 1 }}</h2>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-[30px] p-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center mb-5 shadow-md shadow-pink-500/20">
                            <i class="fa-solid fa-fire text-white text-xl"></i>
                        </div>
                        <p class="text-white/60 text-xs font-medium uppercase tracking-wider">Total XP</p>
                        <h2 class="text-white text-3xl font-black mt-2">{{ $xp ?? 0 }}</h2>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-[30px] p-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center mb-5 shadow-md shadow-yellow-500/20">
                            <i class="fa-solid fa-trophy text-white text-xl"></i>
                        </div>
                        <p class="text-white/60 text-xs font-medium uppercase tracking-wider">Skor Tertinggi</p>
                        <h2 class="text-white text-3xl font-black mt-2">{{ $progress->high_score ?? 0 }}</h2>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-[30px] p-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center mb-5 shadow-md shadow-green-500/20">
                            <i class="fa-solid fa-layer-group text-white text-xl"></i>
                        </div>
                        <p class="text-white/60 text-xs font-medium uppercase tracking-wider">Stage Terbuka</p>
                        <h2 class="text-white text-3xl font-black mt-2">
                            {{ (isset($playerLevel) && $playerLevel >= 3) ? '3/3' : ((isset($playerLevel) && $playerLevel >= 2) ? '2/3' : '1/3') }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="rounded-[40px] bg-gradient-to-br from-cyan-500 to-blue-700 p-8 text-white shadow-[0_0_45px_rgba(59,130,246,0.25)] relative overflow-hidden card-hover border border-white/10">
                    <div class="absolute -top-16 -right-16 w-56 h-56 bg-white/10 blur-3xl rounded-full"></div>
                    <div class="w-24 h-24 rounded-[30px] bg-white/20 flex items-center justify-center mb-8 shadow-inner">
                        <i class="fa-solid fa-seedling text-5xl"></i>
                    </div>
                    <p class="text-cyan-100 text-xs font-semibold uppercase tracking-wider mb-2">Tahap Pemula</p>
                    <h2 class="text-4xl font-black mb-4">Level 1</h2>
                    <p class="text-cyan-100 text-xs leading-relaxed mb-8 h-12 overflow-hidden">Mulai perjalanan pertama dan selesaikan kuis dasar untuk meningkatkan kompetensi awalmu.</p>
                    
                    <div class="bg-white/10 rounded-[24px] p-4 mb-8 text-xs space-y-2">
                        <div class="flex justify-between"><span class="text-cyan-200">Kesulitan</span><span class="font-bold">Mudah</span></div>
                        <div class="flex justify-between"><span class="text-cyan-200">Status</span><span class="font-bold text-green-300">Terbuka</span></div>
                    </div>
                    
                    <a href="{{ route('game.start', ['level' => 1]) }}" class="flex items-center justify-center gap-3 bg-white text-cyan-700 py-4 rounded-[22px] font-black text-md hover:bg-slate-50 transition shadow-md">
                        <i class="fa-solid fa-circle-play"></i><span>Mainkan</span>
                    </a>
                </div>

                <div class="rounded-[40px] bg-gradient-to-br from-purple-500 to-pink-700 shadow-[0_0_45px_rgba(168,85,247,0.2)] p-8 text-white relative overflow-hidden card-hover border border-white/10 {{ ($playerLevel < 2) ? 'opacity-60 filter saturate-[0.8]' : '' }}">
                    <div class="absolute -top-16 -right-16 w-56 h-56 bg-white/10 blur-3xl rounded-full"></div>
                    <div class="w-24 h-24 rounded-[30px] bg-white/20 flex items-center justify-center mb-8 shadow-inner">
                        <i class="fa-solid {{ ($playerLevel >= 2) ? 'fa-dragon' : 'fa-lock' }} text-5xl"></i>
                    </div>
                    <p class="text-pink-100 text-xs font-semibold uppercase tracking-wider mb-2">Tahap Menengah</p>
                    <h2 class="text-4xl font-black mb-4">Level 2</h2>
                    <p class="text-pink-100 text-xs leading-relaxed mb-8 h-12 overflow-hidden">Tantangan taktis tingkat menengah dengan struktur soal analisis penalaran logis.</p>
                    
                    <div class="bg-white/10 rounded-[24px] p-4 mb-8 text-xs space-y-2">
                        <div class="flex justify-between"><span class="text-pink-200">Kesulitan</span><span class="font-bold">Menengah</span></div>
                        <div class="flex justify-between">
                            <span class="text-pink-200">Status</span>
                            <span class="font-bold {{ ($playerLevel >= 2) ? 'text-green-300' : 'text-amber-400' }}">
                                {{ ($playerLevel >= 2) ? 'Terbuka' : 'Butuh Player Lv. 2' }}
                            </span>
                        </div>
                    </div>
                    
                    @if($playerLevel >= 2)
                        <a href="{{ route('game.start', ['level' => 2]) }}" class="flex items-center justify-center gap-3 bg-white text-purple-700 py-4 rounded-[22px] font-black text-md hover:bg-slate-50 transition shadow-md">
                            <i class="fa-solid fa-circle-play"></i><span>Mainkan</span>
                        </a>
                    @else
                        <button disabled class="w-full flex items-center justify-center gap-3 bg-black/30 text-white/40 py-4 rounded-[22px] font-black text-md cursor-not-allowed border border-white/5">
                            <i class="fa-solid fa-lock"></i><span>Terkunci</span>
                        </button>
                    @endif
                </div>

                <div class="rounded-[40px] bg-gradient-to-br from-orange-500 to-red-700 shadow-[0_0_45px_rgba(249,115,22,0.2)] p-8 text-white relative overflow-hidden card-hover border border-white/10 {{ ($playerLevel < 3) ? 'opacity-60 filter saturate-[0.8]' : '' }}">
                    <div class="absolute -top-16 -right-16 w-56 h-56 bg-white/10 blur-3xl rounded-full"></div>
                    <div class="w-24 h-24 rounded-[30px] bg-white/20 flex items-center justify-center mb-8 shadow-inner">
                        <i class="fa-solid {{ ($playerLevel >= 3) ? 'fa-crown' : 'fa-lock' }} text-5xl"></i>
                    </div>
                    <p class="text-orange-100 text-xs font-semibold uppercase tracking-wider mb-2">Tahap Lanjutan</p>
                    <h2 class="text-4xl font-black mb-4">Level 3</h2>
                    <p class="text-orange-100 text-xs leading-relaxed mb-8 h-12 overflow-hidden">Evaluasi puncak dengan tingkat analisis komparatif tertinggi untuk menguji penalaran kritis.</p>
                    
                    <div class="bg-white/10 rounded-[24px] p-4 mb-8 text-xs space-y-2">
                        <div class="flex justify-between"><span class="text-orange-200">Kesulitan</span><span class="font-bold">Sulit</span></div>
                        <div class="flex justify-between">
                            <span class="text-orange-200">Status</span>
                            <span class="font-bold {{ ($playerLevel >= 3) ? 'text-green-300' : 'text-amber-400' }}">
                                {{ ($playerLevel >= 3) ? 'Terbuka' : 'Butuh Player Lv. 3' }}
                            </span>
                        </div>
                    </div>
                    
                    @if($playerLevel >= 3)
                        <a href="{{ route('game.start', ['level' => 3]) }}" class="flex items-center justify-center gap-3 bg-white text-orange-700 py-4 rounded-[22px] font-black text-md hover:bg-slate-50 transition shadow-md">
                            <i class="fa-solid fa-circle-play"></i><span>Mainkan</span>
                        </a>
                    @else
                        <button disabled class="w-full flex items-center justify-center gap-3 bg-black/30 text-white/40 py-4 rounded-[22px] font-black text-md cursor-not-allowed border border-white/5">
                            <i class="fa-solid fa-lock"></i><span>Terkunci</span>
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- Jika halaman macet total saat diklik, kamu bisa matikan/comment sementara kedua baris @include di bawah ini untuk mendeteksi letak bug --}}
    @include('components.loading')
    @include('components.sound')

</body>
</html>