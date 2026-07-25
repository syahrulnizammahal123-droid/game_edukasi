<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Game - Level {{ $level ?? 1 }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="bg-[#070d19] text-white min-h-screen flex items-center justify-center p-4">

    @php
        // Ambil nomor urut soal saat ini dari session
        $currentIndex = (session('game_index', 0)) + 1;
        $totalSoal = session('game_total', 10);
        
        // Ambil kunci jawaban asli dari database
        $kunciDb = strtoupper($soal->jawaban ?? $soal->jawaban_benar ?? 'A');
    @endphp

    <div class="max-w-2xl w-full glass rounded-[30px] p-8 shadow-2xl border border-white/10 relative overflow-hidden">
        
        <!-- HEADER KUIS & TIMER -->
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/10">
            <div>
                <span class="text-xs font-bold text-cyan-400 tracking-wider uppercase">Level {{ $level ?? 1 }}</span>
                <h2 class="text-xl font-extrabold text-white">Soal {{ $currentIndex }} / {{ $totalSoal }}</h2>
            </div>

            <!-- TAMPILAN TIMER ANGKA -->
            <div id="timer-box" class="flex items-center gap-2 px-4 py-2 rounded-2xl bg-amber-500/20 border border-amber-500/40 text-amber-300 font-extrabold text-lg shadow-lg">
                <i class="fa-solid fa-stopwatch animate-pulse"></i>
                <span id="time-display">20</span>s
            </div>
        </div>

        <!-- PROGRESS BAR TIMER -->
        <div class="w-full bg-white/10 h-2.5 rounded-full overflow-hidden mb-8">
            <div id="timer-bar" class="bg-gradient-to-r from-cyan-400 to-amber-400 h-full w-full transition-all duration-1000 ease-linear"></div>
        </div>

        <!-- PERTANYAAN (DINAMIS DARI DATABASE) -->
        <div class="mb-8">
            <h3 class="text-lg font-bold text-white/90 leading-relaxed">
                {{ $soal->pertanyaan ?? 'Pertanyaan tidak ditemukan.' }}
            </h3>
        </div>

        <!-- FORM / PILIHAN JAWABAN (DINAMIS DARI DATABASE) -->
        <form id="quiz-form" action="{{ route('game.jawab') }}" method="POST" class="space-y-3">
            @csrf
            
            <!-- PILIHAN A -->
            <button type="button" onclick="pilihJawaban('A', this)" class="btn-jawaban w-full p-4 rounded-2xl bg-white/5 border border-white/10 hover:bg-cyan-500/20 hover:border-cyan-500/50 text-left font-medium transition flex items-center gap-3">
                <span class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center font-bold text-sm shrink-0">A</span>
                <span>{{ $soal->A ?? $soal->opsi_a ?? 'Pilihan A' }}</span>
            </button>

            <!-- PILIHAN B -->
            <button type="button" onclick="pilihJawaban('B', this)" class="btn-jawaban w-full p-4 rounded-2xl bg-white/5 border border-white/10 hover:bg-cyan-500/20 hover:border-cyan-500/50 text-left font-medium transition flex items-center gap-3">
                <span class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center font-bold text-sm shrink-0">B</span>
                <span>{{ $soal->B ?? $soal->opsi_b ?? 'Pilihan B' }}</span>
            </button>

            <!-- PILIHAN C -->
            <button type="button" onclick="pilihJawaban('C', this)" class="btn-jawaban w-full p-4 rounded-2xl bg-white/5 border border-white/10 hover:bg-cyan-500/20 hover:border-cyan-500/50 text-left font-medium transition flex items-center gap-3">
                <span class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center font-bold text-sm shrink-0">C</span>
                <span>{{ $soal->C ?? $soal->opsi_c ?? 'Pilihan C' }}</span>
            </button>

            <!-- PILIHAN D -->
            <button type="button" onclick="pilihJawaban('D', this)" class="btn-jawaban w-full p-4 rounded-2xl bg-white/5 border border-white/10 hover:bg-cyan-500/20 hover:border-cyan-500/50 text-left font-medium transition flex items-center gap-3">
                <span class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center font-bold text-sm shrink-0">D</span>
                <span>{{ $soal->D ?? $soal->opsi_d ?? 'Pilihan D' }}</span>
            </button>

            <!-- Input tersembunyi untuk menyimpan nilai jawaban & ID Soal -->
            <input type="hidden" name="jawaban" id="input-jawaban">
            <input type="hidden" name="soal_id" value="{{ $soal->id ?? 1 }}">
            <input type="hidden" name="kunci_jawaban" id="kunci-jawaban" value="{{ $kunciDb }}">
        </form>

        <!-- TOMBOL GANTI SOAL -->
        <div class="mt-6 pt-4 border-t border-white/10 flex justify-end">
            <button type="button" id="btn-skip" onclick="gantiSoal()" class="px-5 py-2.5 rounded-xl bg-purple-500/20 border border-purple-500/40 text-purple-300 hover:bg-purple-500/30 font-bold text-xs flex items-center gap-2 transition shadow-md">
                <i class="fa-solid fa-rotate"></i>
                <span>Lewati / Ganti Soal</span>
            </button>
        </div>

    </div>

    <!-- SCRIPT TIMER & PEMUTAR AUDIO -->
    <script>
        // Pemanggilan Audio
        const soundBenar = new Audio("{{ asset('sounds/benar.mp3') }}");
        const soundSalah = new Audio("{{ asset('sounds/salah.mp3') }}");

        // Preload kedua audio
        soundBenar.load();
        soundSalah.load();

        let sudahMenjawab = false;

        function kunciSemuaTombol() {
            sudahMenjawab = true;
            document.querySelectorAll('.btn-jawaban').forEach(btn => {
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed');
            });
            const btnSkip = document.getElementById('btn-skip');
            if(btnSkip) {
                btnSkip.disabled = true;
                btnSkip.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        function pilihJawaban(jawaban, element) {
            if (sudahMenjawab) return;
            kunciSemuaTombol();

            element.classList.remove('bg-white/5');
            element.classList.add('bg-cyan-500/30', 'border-cyan-400');

            document.getElementById('input-jawaban').value = jawaban;

            // Ambil kunci jawaban asli dari elemen hidden
            const kunciJawaban = document.getElementById('kunci-jawaban').value;

            // Penentuan audio benar / salah secara dinamis sesuai database
            if (jawaban.toUpperCase() === kunciJawaban.toUpperCase()) {
                soundBenar.currentTime = 0;
                soundBenar.play().catch(e => console.log('Error Sound Benar:', e));
            } else {
                soundSalah.currentTime = 0;
                soundSalah.play().catch(e => console.log('Error Sound Salah:', e));
            }

            // Jeda 600ms sebelum submit form
            setTimeout(function() {
                document.getElementById('quiz-form').submit();
            }, 600);
        }

        function gantiSoal() {
            if (sudahMenjawab) return;
            kunciSemuaTombol();

            document.getElementById('input-jawaban').value = 'SKIP';
            document.getElementById('quiz-form').submit();
        }

        // LOGIKA TIMER 20 DETIK
        document.addEventListener('DOMContentLoaded', function() {
            let totalTime = 20;
            let timeLeft = totalTime;
            
            const timeDisplay = document.getElementById('time-display');
            const timerBar = document.getElementById('timer-bar');
            const timerBox = document.getElementById('timer-box');
            const quizForm = document.getElementById('quiz-form');

            timeDisplay.textContent = timeLeft;

            const countdown = setInterval(function() {
                if (sudahMenjawab) {
                    clearInterval(countdown);
                    return;
                }

                timeLeft--;
                timeDisplay.textContent = timeLeft;

                let percentage = (timeLeft / totalTime) * 100;
                timerBar.style.width = percentage + '%';

                if (timeLeft <= 5) {
                    timerBox.classList.remove('bg-amber-500/20', 'border-amber-500/40', 'text-amber-300');
                    timerBox.classList.add('bg-rose-500/20', 'border-rose-500/50', 'text-rose-400', 'animate-bounce');
                    timerBar.classList.remove('from-cyan-400', 'to-amber-400');
                    timerBar.classList.add('bg-rose-500');
                }

                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    kunciSemuaTombol();
                    document.getElementById('input-jawaban').value = 'TIMEOUT';
                    quizForm.submit();
                }
            }, 1000);
        });
    </script>
</body>
</html>