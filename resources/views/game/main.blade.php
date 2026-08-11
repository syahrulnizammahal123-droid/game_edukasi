<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arena Kuis Kilat - Guiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden flex items-center" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#07111f]/85 -z-10"></div>

    <audio id="audio-benar" src="{{ asset('sounds/correct.mp3') }}" preload="auto"></audio>
    <audio id="audio-salah" src="{{ asset('sounds/wrong.mp3') }}" preload="auto"></audio>

    <div class="relative z-10 w-full p-4 lg:p-8 max-w-4xl mx-auto">
        <div class="glass rounded-[35px] p-6 lg:p-10 border border-white/10 shadow-2xl">
            
            <!-- HEADER TIMER & STATS -->
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/20 border border-amber-400/30 flex items-center justify-center text-amber-400 text-xl font-bold">
                        <i class="fa-solid fa-stopwatch animate-pulse"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-white/40 block font-bold uppercase tracking-wider">Sisa Waktu</span>
                        <span id="timer-display" class="text-2xl font-black text-amber-400">10s</span>
                    </div>
                </div>

                <div class="text-right">
                    <span class="text-[10px] text-white/40 block font-bold uppercase tracking-wider">Skor Sesi Kilat</span>
                    <span class="text-xl font-black text-emerald-400">{{ session('kilat_score', 0) }} <span class="text-xs text-white/40 font-normal">XP</span></span>
                </div>
            </div>

            <!-- PERNYATAAN KUIS KILAT -->
            <div class="bg-white/5 border border-white/5 rounded-[25px] p-6 lg:p-8 mb-8">
                <div class="flex justify-between items-center mb-3">
                    <span class="px-3 py-1 rounded-xl bg-amber-500/10 text-amber-400 text-xs font-black border border-amber-400/20 uppercase tracking-widest inline-block">
                        Soal Ke-{{ $index + 1 }} dari {{ count($soalIds) }}
                    </span>
                    <span class="text-xs text-white/50 font-semibold">
                        <i class="fa-solid fa-bolt text-amber-400 mr-1"></i> Mode Speed Run
                    </span>
                </div>
                <h1 class="text-lg lg:text-2xl font-bold leading-relaxed text-white">
                    "{{ $soal->pernyataan }}"
                </h1>
            </div>

            <!-- FORM PILIHAN BENAR / SALAH -->
            <form id="form-kuis" action="{{ route('game-kilat.jawab') }}" method="POST">
                @csrf
                <input type="hidden" name="jawaban" id="jawaban-terpilih" value="">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <!-- TOMBOL BENAR (Value = 1) -->
                    <button type="button" onclick="verifikasiOpsi(1)" id="btn-opsi-1" class="group flex items-center justify-between p-6 bg-emerald-500/10 border-2 border-emerald-500/30 rounded-2xl transition duration-200 hover:bg-emerald-500/20 hover:border-emerald-400">
                        <div class="flex items-center gap-4">
                            <div id="badge-opsi-1" class="w-14 h-14 rounded-2xl bg-emerald-500 flex items-center justify-center text-white text-2xl font-bold shrink-0 shadow-lg shadow-emerald-500/30">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="text-left">
                                <span class="text-lg font-black text-white block">BENAR</span>
                                <span class="text-xs text-emerald-300/70">Pernyataan ini Sesuai</span>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-white/20 group-hover:text-white transition-all"></i>
                    </button>

                    <!-- TOMBOL SALAH (Value = 0) -->
                    <button type="button" onclick="verifikasiOpsi(0)" id="btn-opsi-0" class="group flex items-center justify-between p-6 bg-rose-500/10 border-2 border-rose-500/30 rounded-2xl transition duration-200 hover:bg-rose-500/20 hover:border-rose-400">
                        <div class="flex items-center gap-4">
                            <div id="badge-opsi-0" class="w-14 h-14 rounded-2xl bg-rose-500 flex items-center justify-center text-white text-2xl font-bold shrink-0 shadow-lg shadow-rose-500/30">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <div class="text-left">
                                <span class="text-lg font-black text-white block">SALAH</span>
                                <span class="text-xs text-rose-300/70">Pernyataan Keliru</span>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-white/20 group-hover:text-white transition-all"></i>
                    </button>

                </div>
            </form>

        </div>
    </div>

    <script>
        const kunciBenar = {{ $soal->jawaban_benar ? 1 : 0 }};
        let sudahKlik = false; 

        // LOGIKA TIMER WAKTU MUNDUR
        let waktuSisa = 10; // 10 detik per soal
        const timerDisplay = document.getElementById('timer-display');

        const hitungMundur = setInterval(() => {
            if (sudahKlik) {
                clearInterval(hitungMundur);
                return;
            }

            waktuSisa--;
            timerDisplay.innerText = waktuSisa + 's';

            if (waktuSisa <= 3) {
                timerDisplay.className = "text-2xl font-black text-rose-500 animate-ping";
            }

            if (waktuSisa <= 0) {
                clearInterval(hitungMundur);
                waktuHabis();
            }
        }, 1000);

        function waktuHabis() {
            if (sudahKlik) return;
            sudahKlik = true;

            document.getElementById('jawaban-terpilih').value = 9; // Value 9 menandakan Waktu Habis ke Controller
            const sfxSalah = document.getElementById('audio-salah');
            sfxSalah.currentTime = 0;
            sfxSalah.play().catch(e => console.log(e));

            document.getElementById('form-kuis').submit();
        }

        function verifikasiOpsi(opsiDipilih) {
            if (sudahKlik) return; 
            sudahKlik = true;
            clearInterval(hitungMundur);

            const tombolTarget = document.getElementById(`btn-opsi-${opsiDipilih}`);
            const badgeTarget = document.getElementById(`badge-opsi-${opsiDipilih}`);
            
            document.getElementById('jawaban-terpilih').value = opsiDipilih;

            const sfxBenar = document.getElementById('audio-benar');
            const sfxSalah = document.getElementById('audio-salah');

            if (opsiDipilih === kunciBenar) {
                sfxBenar.currentTime = 0;
                sfxBenar.play().catch(error => console.log("Audio diblokir:", error));

                tombolTarget.className = "group flex items-center justify-between p-6 bg-emerald-500/30 border-2 border-emerald-400 rounded-2xl shadow-[0_0_25px_rgba(16,185,129,0.4)]";
                badgeTarget.className = "w-14 h-14 rounded-2xl bg-emerald-500 flex items-center justify-center text-white text-2xl font-black shrink-0 animate-bounce";
            } else {
                sfxSalah.currentTime = 0;
                sfxSalah.play().catch(error => console.log("Audio diblokir:", error));

                tombolTarget.className = "group flex items-center justify-between p-6 bg-rose-500/30 border-2 border-rose-500 rounded-2xl shadow-[0_0_25px_rgba(244,63,94,0.4)] animate-shake";
                badgeTarget.className = "w-14 h-14 rounded-2xl bg-rose-500 flex items-center justify-center text-white text-2xl font-black shrink-0";

                const tombolBenarAsli = document.getElementById(`btn-opsi-${kunciBenar}`);
                if (tombolBenarAsli) {
                    tombolBenarAsli.className = "group flex items-center justify-between p-6 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl opacity-60";
                }
            }

            setTimeout(() => {
                document.getElementById('form-kuis').submit();
            }, 1200);
        }

        window.addEventListener('visibilitychange', function() {
            if (document.document.visibilityState === 'hidden' && !sudahKlik) {
                eksekusiGagalSesi();
            }
        });

        function eksekusiGagalSesi() {
            sudahKlik = true;
            const urlTujuan = "{{ route('game-kilat.jawab') }}";
            const formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('jawaban', '9'); 

            navigator.sendBeacon(urlTujuan, formData);
        }
    </script>

    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            75% { transform: translateX(6px); }
        }
        .animate-shake { animation: shake 0.2s ease-in-out 2; }
    </style>

</body>
</html>