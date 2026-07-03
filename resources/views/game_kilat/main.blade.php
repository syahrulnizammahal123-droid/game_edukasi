<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Kilat - Mode Benar / Salah</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body{ font-family:'Poppins',sans-serif; }
        .glass{
            background:rgba(255,255,255,0.08);
            backdrop-filter:blur(18px);
            border:1px solid rgba(255,255,255,0.08);
        }
        .progress-bar-animate {
            transition: width 1s linear;
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden flex items-center" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#07111f]/85 -z-10"></div>

    <div class="absolute top-0 left-0 w-72 h-72 bg-orange-400/10 blur-3xl rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-blue-500/20 blur-3xl rounded-full"></div>

    <div class="relative z-10 w-full p-4 lg:p-8 max-w-4xl mx-auto">
        <div class="glass rounded-[35px] p-6 lg:p-10 border border-white/10 shadow-2xl">
            
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-500/20 border border-orange-400/30 flex items-center justify-center text-orange-400">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold tracking-wider uppercase text-white/50">Game Kilat Logika</h2>
                        <span class="text-xs font-black text-orange-400">Tingkat Pertualangan {{ session('kilat_level', 1) }}</span>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-xs text-white/40 block font-semibold uppercase tracking-wider">Soal Aktif</span>
                    <span class="text-xl font-black text-cyan-400">{{ $index + 1 }} <span class="text-xs text-white/30 font-medium">/ {{ count($soalIds) }}</span></span>
                </div>
            </div>

            <div class="mb-8 space-y-2">
                <div class="flex items-center justify-between text-xs font-bold uppercase tracking-wide">
                    <span class="text-white/40"><i class="fa-solid fa-hourglass-half mr-1.5 text-cyan-400"></i>Sisa Waktu Analisis</span>
                    <span id="text-timer" class="text-cyan-400 font-mono text-base">30s</span>
                </div>
                <div class="w-full h-3 bg-white/5 rounded-full overflow-hidden border border-white/5">
                    <div id="visual-timer" class="h-full bg-gradient-to-r from-cyan-400 to-blue-500 w-full progress-bar-animate"></div>
                </div>
            </div>

            <div class="bg-white/5 border border-white/5 rounded-[25px] p-6 lg:p-8 text-center mb-10 shadow-inner">
                <p class="text-white/40 text-xs font-bold tracking-widest uppercase mb-4"><i class="fa-solid fa-quote-left mr-1"></i> Pernyataan Masalah</p>
                <h1 class="text-xl lg:text-2xl font-semibold leading-relaxed text-white">
                    "{{ $soal->pernyataan }}"
                </h1>
            </div>

            <form id="form-kilat-action" action="{{ route('game-kilat.jawab') }}" method="POST">
                @csrf
                <input type="hidden" name="jawaban" id="input-jawaban-val" value="">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <button type="button" onclick="submitJawabanKilat(1)" class="group flex flex-col items-center justify-center p-6 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 hover:border-emerald-400/40 rounded-[25px] transition duration-300 transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center text-white text-xl font-bold mb-3 shadow-[0_0_15px_rgba(16,185,129,0.3)] group-hover:scale-110 transition">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <span class="text-lg font-bold text-emerald-400 tracking-wide">BENAR</span>
                        <span class="text-[11px] text-emerald-500/70 font-medium mt-1">Pernyataan Valid / Akurat</span>
                    </button>

                    <button type="button" onclick="submitJawabanKilat(0)" class="group flex flex-col items-center justify-center p-6 bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/20 hover:border-rose-400/40 rounded-[25px] transition duration-300 transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-rose-500 rounded-2xl flex items-center justify-center text-white text-xl font-bold mb-3 shadow-[0_0_15px_rgba(244,63,94,0.3)] group-hover:scale-110 transition">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <span class="text-lg font-bold text-rose-400 tracking-wide">SALAH</span>
                        <span class="text-[11px] text-rose-500/70 font-medium mt-1">Pernyataan Cacat Logika</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        let durasiAwal = 30; // <-- DIATUR MENJADI 30 DETIK AGAR TIDAK TERLALU CEPAT
        let timeLeft = durasiAwal;
        const textTimer = document.getElementById('text-timer');
        const visualTimer = document.getElementById('visual-timer');

        const countdown = setInterval(() => {
            timeLeft--;
            if (timeLeft >= 0) {
                textTimer.innerText = timeLeft + "s";
                // Menghitung sisa bar secara linear
                let hitungPersen = (timeLeft / durasiAwal) * 100;
                visualTimer.style.width = hitungPersen + "%";
                
                // Mengubah warna bar menjadi merah jika kritis di bawah 7 detik
                if (timeLeft <= 7) {
                    visualTimer.className = "h-full bg-gradient-to-r from-red-500 to-rose-600 progress-bar-animate";
                    textTimer.className = "text-rose-500 font-mono text-base animate-pulse";
                }
            } else {
                clearInterval(countdown);
                // Jika waktu habis, otomatis set value 9 (Penanda waktu habis di GameKilatController)
                document.getElementById('input-jawaban-val').value = 9;
                document.getElementById('form-kilat-action').submit();
            }
        }, 1000);

        function submitJawabanKilat(nilaiJawaban) {
            clearInterval(countdown);
            document.getElementById('input-jawaban-val').value = nilaiJawaban;
            document.getElementById('form-kilat-action').submit();
        }
    </script>

</body>
</html>