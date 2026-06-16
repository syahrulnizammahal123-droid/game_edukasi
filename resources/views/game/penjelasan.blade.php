<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis Jawaban - Guiz Adventure</title>

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

    <!-- MAIN EXPLANATION DISPLAY CONTAINER -->
    <div class="relative z-10 max-w-2xl w-full mx-auto space-y-5">
        
        <!-- 1. FEEDBACK BANNER STATUS (BENAR / SALAH / GAME OVER) -->
        <div class="glass rounded-[30px] p-6 text-center border relative overflow-hidden shadow-lg 
            {{ $status == 'benar' ? 'border-green-500/30 bg-green-500/5 shadow-green-500/5' : 'border-red-500/30 bg-red-500/5 shadow-red-500/5' }}
        ">
            <!-- Icon Status -->
            <div class="w-16 h-16 rounded-2xl mx-auto flex items-center justify-center text-3xl mb-4
                {{ $status == 'benar' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}
            ">
                <i class="fa-solid {{ $status == 'benar' ? 'fa-circle-check animate-bounce' : 'fa-circle-xmark animate-pulse' }}"></i>
            </div>

            <!-- Teks Pesan Dinamis dari Session Game -->
            <h2 class="text-xl font-extrabold tracking-wide">
                {{ $message }}
            </h2>
        </div>

        <!-- 2. REKAP JAWABAN SISWA VS KUNCI JAWABAN -->
        <div class="grid grid-cols-2 gap-4">
            <div class="glass rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest mb-1">Jawaban Kamu</p>
                <span class="text-xl font-black {{ strtoupper($jawabanUser) == strtoupper($benar) ? 'text-green-400' : 'text-red-400' }}">
                    Pilihan {{ strtoupper($jawabanUser) }}
                </span>
            </div>
            <div class="glass rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest mb-1">Kunci Jawaban</p>
                <span class="text-xl font-black text-green-400">
                    Pilihan {{ strtoupper($benar) }}
                </span>
            </div>
        </div>

        <!-- 3. KOTAK REFLEKSI PEMBAHASAN KOGNITIF (SANGAT BAGUS UNTUK DATA SKRIPSI) -->
        <div class="glass rounded-[35px] p-6 lg:p-8 border border-white/5 relative overflow-hidden shadow-inner">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-indigo-500"></div>
            
            <div class="flex items-center gap-2.5 mb-3">
                <div class="w-8 h-8 rounded-lg bg-purple-500/10 flex items-center justify-center text-purple-400 text-sm">
                    <i class="fa-solid fa-book-open-reader"></i>
                </div>
                <div>
                    <h3 class="text-xs font-black uppercase tracking-wider text-purple-300">Konstruksi Pembahasan Masalah</h3>
                    <p class="text-[9px] text-white/40">Suplemen literasi untuk mengasah ketajaman evaluasi berpikir kritis</p>
                </div>
            </div>

            <p class="text-sm text-white/80 leading-relaxed font-medium tracking-wide border-t border-white/5 pt-3">
                {{ $penjelasan ?? 'Tidak ada pembahasan tertulis untuk soal kuis ini.' }}
            </p>
        </div>

        <!-- 4. NAVIGATION CTA ROUTING (LANJUTKAN / SELESAI) -->
        <div class="pt-2">
            @if($gameOver)
                <!-- Jika Nyawa Habis, Arahkan ke Hasil Akhir -->
                <a href="{{ url('/game/hasil') }}" class="w-full inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-red-500 to-pink-600 text-white font-black text-md py-4.5 py-4 rounded-[22px] shadow-lg shadow-red-500/10 btn-hover uppercase tracking-wider">
                    <span>Lihat Rapor Hasil</span>
                    <i class="fa-solid fa-square-poll-vertical text-sm"></i>
                </a>
            @else
                <!-- Jika Masih Ada Nyawa, Lanjut ke Soal Berikutnya -->
                <a href="{{ url('/game/next') }}" class="w-full inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 text-white font-black text-md py-4.5 py-4 rounded-[22px] shadow-lg shadow-blue-500/20 btn-hover uppercase tracking-wider">
                    <span>Lanjutkan Petualangan</span>
                    <i class="fa-solid fa-circle-chevron-right text-sm"></i>
                </a>
            @endif
        </div>

    </div>

    <!-- CORE UTILITY INCLUDES -->
    @include('components.loading')
    @include('components.sound')

</body>
</html>