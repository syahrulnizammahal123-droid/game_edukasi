<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arena Kuis - Guiz Adventure</title>

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
            
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-white/10">
                <div class="flex items-center gap-2 text-rose-500 text-lg font-bold">
                    @for($i = 0; $i < $hearts; $i++)
                        <i class="fa-solid fa-heart animate-pulse"></i>
                    @endfor
                    @for($i = 0; $i < (3 - $hearts); $i++)
                        <i class="fa-regular fa-heart text-white/20"></i>
                    @endfor
                </div>
                <div class="text-right">
                    <span class="text-xs text-white/40 block font-bold uppercase tracking-wider">Skor Akumulasi</span>
                    <span class="text-xl font-black text-orange-400">{{ $progress->score }} <span class="text-xs text-white/40 font-normal">XP</span></span>
                </div>
            </div>

            <div class="bg-white/5 border border-white/5 rounded-[25px] p-6 lg:p-8 mb-8">
                <span class="px-3 py-1 rounded-xl bg-cyan-500/10 text-cyan-400 text-xs font-black border border-cyan-400/20 uppercase tracking-widest mb-3 inline-block">
                    Pertanyaan Ke-{{ session('index', 0) + 1 }}
                </span>
                <h1 class="text-lg lg:text-xl font-semibold leading-relaxed text-white">
                    {{ $soal->pertanyaan }}
                </h1>
            </div>

            <form id="form-kuis" action="{{ route('game.jawab') }}" method="POST">
                @csrf
                <input type="hidden" name="jawaban" id="jawaban-terpilih" value="">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <button type="button" onclick="verifikasiOpsi('A')" id="btn-opsi-A" class="group flex items-center gap-4 p-5 bg-white/5 border border-white/10 rounded-2xl text-left transition duration-200 hover:bg-white/10">
                        <div id="badge-opsi-A" class="w-12 h-12 rounded-xl bg-cyan-500 flex items-center justify-center text-white font-bold shrink-0 shadow-md">A</div>
                        <span class="text-sm font-medium text-white/80">{{ $soal->A }}</span>
                    </button>

                    <button type="button" onclick="verifikasiOpsi('B')" id="btn-opsi-B" class="group flex items-center gap-4 p-5 bg-white/5 border border-white/10 rounded-2xl text-left transition duration-200 hover:bg-white/10">
                        <div id="badge-opsi-B" class="w-12 h-12 rounded-xl bg-purple-500 flex items-center justify-center text-white font-bold shrink-0 shadow-md">B</div>
                        <span class="text-sm font-medium text-white/80">{{ $soal->B }}</span>
                    </button>

                    <button type="button" onclick="verifikasiOpsi('C')" id="btn-opsi-C" class="group flex items-center gap-4 p-5 bg-white/5 border border-white/10 rounded-2xl text-left transition duration-200 hover:bg-white/10">
                        <div id="badge-opsi-C" class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center text-white font-bold shrink-0 shadow-md">C</div>
                        <span class="text-sm font-medium text-white/80">{{ $soal->C }}</span>
                    </button>

                    <button type="button" onclick="verifikasiOpsi('D')" id="btn-opsi-D" class="group flex items-center gap-4 p-5 bg-white/5 border border-white/10 rounded-2xl text-left transition duration-200 hover:bg-white/10">
                        <div id="badge-opsi-D" class="w-12 h-12 rounded-xl bg-orange-500 flex items-center justify-center text-white font-bold shrink-0 shadow-md">D</div>
                        <span class="text-sm font-medium text-white/80">{{ $soal->D }}</span>
                    </button>

                </div>
            </form>

        </div>
    </div>

    <script>
        const kunciBenar = "{{ strtoupper($soal->jawaban) }}";
        let sudahKlik = false; 

        function verifikasiOpsi(opsiDipilih) {
            if (sudahKlik) return; 
            sudahKlik = true;

            const tombolTarget = document.getElementById(`btn-opsi-${opsiDipilih}`);
            const badgeTarget = document.getElementById(`badge-opsi-${opsiDipilih}`);
            
            document.getElementById('jawaban-terpilih').value = opsiDipilih;

            // Panggil elemen audio
            const sfxBenar = document.getElementById('audio-benar');
            const sfxSalah = document.getElementById('audio-salah');

            if (opsiDipilih === kunciBenar) {
                // Mainkan suara benar secara paksa
                sfxBenar.currentTime = 0;
                sfxBenar.play().catch(error => console.log("Play diblokir browser:", error));

                tombolTarget.className = "group flex items-center gap-4 p-5 bg-emerald-500/20 border-2 border-emerald-400 rounded-2xl text-left transition duration-200 shadow-[0_0_20px_rgba(16,185,129,0.3)]";
                badgeTarget.className = "w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center text-white font-black shrink-0 animate-bounce";
            } else {
                // Mainkan suara salah secara paksa
                sfxSalah.currentTime = 0;
                sfxSalah.play().catch(error => console.log("Play diblokir browser:", error));

                tombolTarget.className = "group flex items-center gap-4 p-5 bg-rose-500/20 border-2 border-rose-500 rounded-2xl text-left transition duration-200 shadow-[0_0_20px_rgba(244,63,94,0.3)] animate-shake";
                badgeTarget.className = "w-12 h-12 rounded-xl bg-rose-500 flex items-center justify-center text-white font-black shrink-0";

                const tombolBenarAsli = document.getElementById(`btn-opsi-${kunciBenar}`);
                if (tombolBenarAsli) {
                    tombolBenarAsli.className = "group flex items-center gap-4 p-5 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl text-left transition duration-200 opacity-60";
                }
            }

            // Jeda dinaikkan sedikit ke 1.4 detik agar file audio sempat berbunyi penuh sebelum submit form
            setTimeout(() => {
                document.getElementById('form-kuis').submit();
            }, 1400);
        }

        window.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'hidden' && !sudahKlik) {
                eksekusiGagalSesi();
            }
        });

        window.addEventListener('pagehide', function() {
            if (!sudahKlik) {
                eksekusiGagalSesi();
            }
        });

        function eksekusiGagalSesi() {
            sudahKlik = true;
            const urlTujuan = "{{ route('game.jawab') }}";
            
            const formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('jawaban', 'KABUR'); 

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