<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Bank Soal - Guiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass {
            background: rgba(11, 19, 35, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .row-hover:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(34, 211, 238, 0.2);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat text-white antialiased flex" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">
    <div class="fixed inset-0 bg-[#030712]/85 -z-20"></div>

    <div class="relative z-10 flex w-full min-h-screen">

        <aside class="hidden lg:flex flex-col w-72 p-6 glass border-r border-white/10 shrink-0">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,0.5)]">
                    <i class="fa-solid fa-gamepad text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black tracking-wide text-white">Guiz</h1>
                    <p class="text-cyan-400 text-xs font-bold uppercase tracking-widest">Adventure</p>
                </div>
            </div>

            <nav class="space-y-3 flex-1">
                <a href="/dashboard" class="flex items-center gap-4 text-white/70 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition font-semibold">
                    <i class="fa-solid fa-columns text-lg text-cyan-400 w-6 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/game/level" class="flex items-center gap-4 text-white/70 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition font-semibold">
                    <i class="fa-solid fa-play text-lg text-cyan-400 w-6 text-center"></i>
                    <span>Mulai Game</span>
                </a>
                <a href="/game-kilat/level" class="flex items-center gap-4 text-white/70 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition font-semibold">
                    <i class="fa-solid fa-bolt text-lg text-orange-400 w-6 text-center"></i>
                    <span>Game Kilat (B/S)</span>
                </a>
                <a href="/soal" class="flex items-center gap-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white p-4 rounded-2xl font-bold shadow-[0_0_20px_rgba(59,130,246,0.3)]">
                    <i class="fa-solid fa-book-open text-lg w-6 text-center"></i>
                    <span>Kelola Bank Soal</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-4 lg:p-8 max-w-7xl mx-auto w-full overflow-y-auto pb-24">
            
            <div class="glass rounded-[35px] p-6 lg:p-8 mb-6 border border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-xl bg-cyan-500/10 text-cyan-300 text-xs font-bold border border-cyan-400/20 tracking-wider uppercase mb-2">
                        <i class="fa-solid fa-database text-[10px]"></i> Control Panel Guru
                    </div>
                    <h1 class="text-3xl font-black tracking-tight">Manajemen Bank Soal</h1>
                    <p class="text-xs text-white/50 mt-1">Perbarui, tambah, atau hapus instrumen kuis penelitian dengan mudah.</p>
                </div>
            </div>

            <div class="flex gap-2 mb-6 bg-white/5 p-1.5 rounded-2xl border border-white/5 w-fit">
                <button onclick="switchTab('pilihan-ganda')" id="btnTabPG" class="px-5 py-2.5 rounded-xl text-xs font-bold transition bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-md">
                    <i class="fa-solid fa-list-check mr-1"></i> Adventure Quiz (Pilihan Ganda)
                </button>
                <button onclick="switchTab('benar-salah')" id="btnTabBS" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-white/60 hover:text-white transition">
                    <i class="fa-solid fa-bolt mr-1"></i> Game Kilat (Benar / Salah)
                </button>
            </div>

            <div id="panelPG" class="space-y-3">
                <div class="hidden md:grid grid-cols-12 px-6 text-[11px] text-white/40 font-bold uppercase tracking-wider mb-2">
                    <div class="col-span-1">LVL</div>
                    <div class="col-span-6">Pertanyaan Berpikir Kritis</div>
                    <div class="col-span-3 text-center">Kunci PG</div>
                    <div class="col-span-2 text-right">Aksi Kontrol</div>
                </div>

                @if(isset($soals) && $soals->count() > 0)
                    @foreach($soals as $item)
                    <div class="glass rounded-2xl p-4 grid grid-cols-1 md:grid-cols-12 items-center border border-white/5 row-hover transition duration-200 gap-3">
                        <div class="col-span-1"><span class="px-2.5 py-0.5 rounded bg-cyan-500/10 border border-cyan-400/20 text-cyan-300 text-xs font-black">Lvl {{ $item->level }}</span></div>
                        <div class="col-span-6"><p class="text-xs font-medium text-white/80 line-clamp-2 pr-4">{{ $item->pertanyaan }}</p></div>
                        <div class="col-span-3 text-center"><span class="px-3 py-1 rounded-xl bg-white/5 border border-white/10 text-xs font-bold text-cyan-300">Opsi {{ strtoupper($item->jawaban) }}</span></div>
                        <div class="col-span-2 flex justify-end gap-2">
                            <a href="{{ route('soal.edit', $item->id) }}" class="w-8 h-8 rounded-lg bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 hover:bg-yellow-500/20 flex items-center justify-center text-xs transition"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('soal.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus soal pilihan ganda ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 flex items-center justify-center text-xs transition"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="glass rounded-2xl p-8 text-center text-xs text-white/40">Belum ada instrumen kuis pilihan ganda.</div>
                @endif
            </div>

            <div id="panelBS" class="space-y-3 hidden">
                <div class="hidden md:grid grid-cols-12 px-6 text-[11px] text-white/40 font-bold uppercase tracking-wider mb-2">
                    <div class="col-span-1">LVL</div>
                    <div class="col-span-6">Pernyataan Logika Kilat</div>
                    <div class="col-span-3 text-center">Validitas Kunci</div>
                    <div class="col-span-2 text-right">Aksi Kontrol</div>
                </div>

                @if(isset($soalKilats) && $soalKilats->count() > 0)
                    @foreach($soalKilats as $item)
                    <div class="glass rounded-2xl p-4 grid grid-cols-1 md:grid-cols-12 items-center border border-white/5 row-hover transition duration-200 gap-3">
                        <div class="col-span-1"><span class="px-2.5 py-0.5 rounded bg-orange-500/10 border border-orange-400/20 text-orange-400 text-xs font-black">Lvl {{ $item->level }}</span></div>
                        <div class="col-span-6"><p class="text-xs font-medium text-white/80 line-clamp-2 pr-4">"{{ $item->pernyataan }}"</p></div>
                        <div class="col-span-3 text-center">
                            <span class="px-3 py-1 rounded-xl text-xs font-bold {{ $item->jawaban_benar ? 'bg-emerald-500/10 border border-emerald-500/20 text-emerald-400' : 'bg-red-500/10 border border-red-500/20 text-red-400' }}">
                                {{ $item->jawaban_benar ? 'BENAR (True)' : 'SALAH (False)' }}
                            </span>
                        </div>
                        <div class="col-span-2 flex justify-end gap-2">
                            <a href="{{ route('soal-kilat.edit', $item->id) }}" class="w-8 h-8 rounded-lg bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 hover:bg-yellow-500/20 flex items-center justify-center text-xs transition"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('soal-kilat.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus soal kilat ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 flex items-center justify-center text-xs transition"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="glass rounded-2xl p-8 text-center text-xs text-white/40">Belum ada instrumen soal logika kilat (B/S).</div>
                @endif
            </div>

        </main>
    </div>

    <script>
        function switchTab(mode) {
            const panelPG = document.getElementById('panelPG');
            const panelBS = document.getElementById('panelBS');
            const btnTabPG = document.getElementById('btnTabPG');
            const btnTabBS = document.getElementById('btnTabBS');

            if(mode === 'pilihan-ganda') {
                panelPG.classList.remove('hidden');
                panelBS.classList.add('hidden');
                btnTabPG.className = "px-5 py-2.5 rounded-xl text-xs font-bold transition bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-md";
                btnTabBS.className = "px-5 py-2.5 rounded-xl text-xs font-semibold text-white/60 hover:text-white transition";
            } else {
                panelPG.classList.add('hidden');
                panelBS.classList.remove('hidden');
                btnTabPG.className = "px-5 py-2.5 rounded-xl text-xs font-semibold text-white/60 hover:text-white transition";
                btnTabBS.className = "px-5 py-2.5 rounded-xl text-xs font-bold transition bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-md";
            }
        }
    </script>
</body>
</html>