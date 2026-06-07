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

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#07111f]/80 -z-10"></div>

    <div class="absolute top-0 left-0 w-72 h-72 bg-cyan-400/20 blur-3xl rounded-full"></div>

    <div class="absolute bottom-0 right-0 w-72 h-72 bg-purple-500/20 blur-3xl rounded-full"></div>

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
                        <p class="text-white/60 mt-4 max-w-2xl">
                            Selesaikan tantangan quiz dan buka level baru seiring perkembangan kemampuanmu.
                        </p>
                    </div>

                    <div class="flex gap-4">
                        <a href="/dashboard" class="w-14 h-14 rounded-2xl glass flex items-center justify-center text-white hover:bg-white/10 transition">
                            <i class="fa-solid fa-house"></i>
                        </a>
                        <a href="/leaderboard" class="w-14 h-14 rounded-2xl bg-gradient-to-r from-cyan-400 to-blue-600 flex items-center justify-center text-white shadow-xl">
                            <i class="fa-solid fa-ranking-star"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="glass rounded-[35px] p-6 lg:p-8 mb-8">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                    <div class="bg-white/5 border border-white/10 rounded-[30px] p-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center mb-5">
                            <i class="fa-solid fa-bolt text-white text-xl"></i>
                        </div>
                        <p class="text-white/60 text-sm">Level Player</p>
                        <h2 class="text-white text-4xl font-extrabold mt-2">{{ $playerLevel }}</h2>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-[30px] p-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center mb-5">
                            <i class="fa-solid fa-fire text-white text-xl"></i>
                        </div>
                        <p class="text-white/60 text-sm">XP</p>
                        <h2 class="text-white text-4xl font-extrabold mt-2">{{ $xp }}</h2>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-[30px] p-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center mb-5">
                            <i class="fa-solid fa-trophy text-white text-xl"></i>
                        </div>
                        <p class="text-white/60 text-sm">Skor Tertinggi</p>
                        <h2 class="text-white text-4xl font-extrabold mt-2">{{ $progress->high_score }}</h2>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-[30px] p-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center mb-5">
                            <i class="fa-solid fa-layer-group text-white text-xl"></i>
                        </div>
                        <p class="text-white/60 text-sm">Stage Terbuka</p>
                        <h2 class="text-white text-4xl font-extrabold mt-2">
                            {{ ($playerLevel >= 3) ? '3/3' : (($playerLevel >= 2) ? '2/3' : '1/3') }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="rounded-[40px] bg-gradient-to-br from-cyan-500 to-blue-700 p-8 text-white shadow-[0_0_45px_rgba(59,130,246,0.3)] relative overflow-hidden card-hover">
                    <div class="absolute -top-16 -right-16 w-56 h-56 bg-white/10 blur-3xl rounded-full"></div>
                    <div class="w-24 h-24 rounded-[30px] bg-white/20 flex items-center justify-center mb-8">
                        <i class="fa-solid fa-seedling text-5xl"></i>
                    </div>
                    <p class="text-cyan-100 mb-3">Tahap Pemula</p>
                    <h2 class="text-5xl font-extrabold mb-5">Level 1</h2>
                    <p class="text-cyan-100 leading-relaxed mb-8">Mulai perjalanan pertama dan selesaikan quiz dasar untuk meningkatkan kemampuanmu.</p>
                    
                    <div class="bg-white/10 rounded-[30px] p-5 mb-8">
                        <div class="flex justify-between mb-3"><span class="text-cyan-100">Kesulitan</span><span class="font-bold">Mudah</span></div>
                        <div class="flex justify-between"><span class="text-cyan-100">Status</span><span class="font-bold text-green-300">Terbuka</span></div>
                    </div>
                    
                    <a href="/game/start/1" class="flex items-center justify-center gap-4 bg-white text-cyan-700 py-5 rounded-[30px] text-lg font-bold hover:bg-slate-100 transition shadow-md">
                        <i class="fa-solid fa-play"></i><span>Mainkan</span>
                    </a>
                </div>

                <div class="rounded-[40px] bg-gradient-to-br from-purple-500 to-pink-700 shadow-[0_0_45px_rgba(168,85,247,0.3)] p-8 text-white relative overflow-hidden card-hover {{ ($playerLevel < 2) ? 'opacity-65 filter saturate-[0.85]' : '' }}">
                    <div class="absolute -top-16 -right-16 w-56 h-56 bg-white/10 blur-3xl rounded-full"></div>
                    <div class="w-24 h-24 rounded-[30px] bg-white/20 flex items-center justify-center mb-8">
                        <i class="fa-solid {{ ($playerLevel >= 2) ? 'fa-dragon' : 'fa-lock' }} text-5xl"></i>
                    </div>
                    <p class="text-pink-100 mb-3">Tahap Menengah</p>
                    <h2 class="text-5xl font-extrabold mb-5">Level 2</h2>
                    <p class="text-pink-100 leading-relaxed mb-8">Tantangan lebih sulit dengan soal yang membutuhkan ketelitian dan strategi penjelajahan.</p>
                    
                    <div class="bg-white/10 rounded-[30px] p-5 mb-8">
                        <div class="flex justify-between mb-3"><span class="text-pink-100">Kesulitan</span><span class="font-bold">Menengah</span></div>
                        <div class="flex justify-between">
                            <span class="text-pink-100">Status</span>
                            <span class="font-bold {{ ($playerLevel >= 2) ? 'text-green-300' : 'text-amber-400' }}">
                                {{ ($playerLevel >= 2) ? 'Terbuka' : 'Butuh Player Lv. 2' }}
                            </span>
                        </div>
                    </div>
                    
                    @if($playerLevel >= 2)
                        <a href="/game/start/2" class="flex items-center justify-center gap-4 bg-white text-purple-700 py-5 rounded-[30px] text-lg font-bold hover:bg-slate-100 transition shadow-md">
                            <i class="fa-solid fa-play"></i><span>Mainkan</span>
                        </a>
                    @else
                        <button disabled class="w-full flex items-center justify-center gap-4 bg-black/30 text-white/50 py-5 rounded-[30px] text-lg font-bold cursor-not-allowed border border-white/5">
                            <i class="fa-solid fa-lock"></i><span>Terkunci</span>
                        </button>
                    @endif
                </div>

                <div class="rounded-[40px] bg-gradient-to-br from-orange-500 to-red-700 shadow-[0_0_45px_rgba(249,115,22,0.3)] p-8 text-white relative overflow-hidden card-hover {{ ($playerLevel < 3) ? 'opacity-65 filter saturate-[0.85]' : '' }}">
                    <div class="absolute -top-16 -right-16 w-56 h-56 bg-white/10 blur-3xl rounded-full"></div>
                    <div class="w-24 h-24 rounded-[30px] bg-white/20 flex items-center justify-center mb-8">
                        <i class="fa-solid {{ ($playerLevel >= 3) ? 'fa-crown' : 'fa-lock' }} text-5xl"></i>
                    </div>
                    <p class="text-orange-100 mb-3">Tahap Lanjutan</p>
                    <h2 class="text-5xl font-extrabold mb-5">Level 3</h2>
                    <p class="text-orange-100 leading-relaxed mb-8">Ujian terakhir untuk petualang sejati dengan tingkat kesulitan komparasi tertinggi.</p>
                    
                    <div class="bg-white/10 rounded-[30px] p-5 mb-8">
                        <div class="flex justify-between mb-3"><span class="text-orange-100">Kesulitan</span><span class="font-bold">Sulit</span></div>
                        <div class="flex justify-between">
                            <span class="text-orange-100">Status</span>
                            <span class="font-bold {{ ($playerLevel >= 3) ? 'text-green-300' : 'text-amber-400' }}">
                                {{ ($playerLevel >= 3) ? 'Terbuka' : 'Butuh Player Lv. 3' }}
                            </span>
                        </div>
                    </div>
                    
                    @if($playerLevel >= 3)
                        <a href="/game/start/3" class="flex items-center justify-center gap-4 bg-white text-orange-700 py-5 rounded-[30px] text-lg font-bold hover:bg-slate-100 transition shadow-md">
                            <i class="fa-solid fa-play"></i><span>Mainkan</span>
                        </a>
                    @else
                        <button disabled class="w-full flex items-center justify-center gap-4 bg-black/30 text-white/50 py-5 rounded-[30px] text-lg font-bold cursor-not-allowed border border-white/5">
                            <i class="fa-solid fa-lock"></i><span>Terkunci</span>
                        </button>
                    @endif
                </div>

            </div>

        </div>

    </div>

    @include('components.loading')
    @include('components.sound')

</body>
</html>