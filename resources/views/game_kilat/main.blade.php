<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Attack - Guiz Adventure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass {
            background: rgba(11, 19, 35, 0.55);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="relative min-h-screen bg-cover bg-center text-white flex flex-col justify-center p-4" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">
    <div class="fixed inset-0 bg-[#030712]/85 -z-10"></div>

    <div class="max-w-xl w-full mx-auto space-y-6 relative z-10">
        
        <!-- TOP HUD TIME BAR -->
        <div class="glass rounded-2xl p-4 flex items-center justify-between border border-cyan-500/20">
            <span class="text-xs font-bold uppercase tracking-wider text-cyan-400">Mode: Benar / Salah Kilat</span>
            <!-- TIMER BULAT DETIK -->
            <div id="timerBox" class="w-12 h-12 rounded-full border-2 border-cyan-400 flex items-center justify-center text-lg font-black text-cyan-300 shadow-[0_0_15px_rgba(34,211,238,0.3)]">
                5
            </div>
            <span class="text-xs font-bold text-white/50">Soal {{ $index + 1 }}/{{ count($soalIds) }}</span>
        </div>

        <!-- PERNYATAAN SOAL -->
        <div class="glass rounded-[35px] p-8 text-center min-h-[180px] flex flex-col justify-center border border-white/5 shadow-inner">
            <p class="text-[10px] text-orange-400 font-bold uppercase tracking-widest mb-3 animate-pulse"><i class="fa-solid fa-triangle-exclamation"></i> Evaluasi Pernyataan Ini Sesuai Fakta:</p>
            <h2 class="text-lg md:text-xl font-bold leading-relaxed tracking-wide">
                "{{ $soal->pernyataan }}"
            </h2>
        </div>

        <!-- ACTION FORM INPUT BUTTON -->
        <form method="POST" action="{{ url('/game-kilat/jawab') }}" id="kilatForm">
            @csrf
            <input type="hidden" name="jawaban" id="answerField" value="">
            
            <div class="grid grid-cols-2 gap-4">
                <!-- Tombol BENAR (Hijau) -->
                <button type="button" onclick="submitKilat(1)" class="py-5 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-600 font-black text-lg shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all uppercase tracking-wider flex flex-col items-center justify-center gap-1">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                    <span>BENAR</span>
                </button>
                <!-- Tombol SALAH (Merah) -->
                <button type="button" onclick="submitKilat(0)" class="py-5 rounded-2xl bg-gradient-to-r from-red-500 to-pink-600 font-black text-lg shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all uppercase tracking-wider flex flex-col items-center justify-center gap-1">
                    <i class="fa-solid fa-circle-xmark text-xl"></i>
                    <span>SALAH</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        let timeLeft = 5; // Durasi waktu berfikir siswa per soal
        const timerBox = document.getElementById('timerBox');
        
        const countdown = setInterval(() => {
            timeLeft--;
            timerBox.innerText = timeLeft;
            
            if(timeLeft <= 2) {
                timerBox.className = "w-12 h-12 rounded-full border-2 border-red-500 flex items-center justify-center text-lg font-black text-red-400 shadow-[0_0_15px_rgba(239,68,68,0.5)] animate-ping";
            }

            if(timeLeft <= 0){
                clearInterval(countdown);
                // Jika waktu habis, otomatis dianggap menjawab salah (mengirim nilai random yang salah)
                submitKilat(9); 
            }
        }, 1000);

        function submitKilat(value) {
            clearInterval(countdown);
            document.getElementById('answerField').value = value;
            document.getElementById('kilatForm').submit();
        }
    </script>
</body>
</html>