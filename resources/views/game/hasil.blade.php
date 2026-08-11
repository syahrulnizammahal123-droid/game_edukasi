<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuis Kilat - Guiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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

    <div class="fixed inset-0 bg-[#030712]/85 -z-10"></div>

    <div class="relative z-10 max-w-2xl w-full mx-auto space-y-5">
        
        <!-- LOGIKA VARIABEL TAMBAHAN BINTANG & GRADE -->
        @php
            $isKalah = ($akurasi < 60);
            if ($akurasi >= 85) { $grade = 'S'; $stars = 5; }
            elseif ($akurasi >= 70) { $grade = 'A'; $stars = 4; }
            elseif ($akurasi >= 50) { $grade = 'B'; $stars = 3; }
            else { $grade = 'C'; $stars = 1; }
        @endphp

        <!-- 1. HEADER GRADE & EVALUASI SIKAP KILAT -->
        <div class="glass rounded-[35px] p-8 text-center border relative overflow-hidden shadow-xl
            {{ $isKalah ? 'border-rose-500/20 bg-rose-500/5' : 'border-amber-500/20 bg-gradient-to-b from-amber-500/5 to-transparent' }}
        ">
            <div class="absolute top-0 inset-x-0 flex justify-center"><div class="w-40 h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent"></div></div>

            <!-- Grade Badge -->
            <div class="w-24 h-24 rounded-[30px] bg-gradient-to-br from-amber-400 via-orange-500 to-red-600 flex items-center justify-center mx-auto mb-4 shadow-xl shadow-orange-500/20 border border-white/10">
                <span class="text-4xl font-black text-white tracking-wider drop-shadow-md">
                    {{ $grade }}
                </span>
            </div>

            <h1 class="text-2xl font-black tracking-wide text-white">
                {{ $isKalah ? 'Sesi Kilat Berakhir!' : 'Uji Kecepatan Selesai!' }}
            </h1>
            <p class="text-xs text-white/50 mt-1 max-w-md mx-auto leading-relaxed">
                Kamu telah menuntaskan evaluasi kuis kilat berkecepatan tinggi. Berikut adalah ringkasan kecepatan dan akurasi analisis yang kamu peroleh.
            </p>

            <!-- Bintang Pencapaian -->
            <div class="flex justify-center gap-1.5 text-xl text-amber-400 mt-5">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $stars)
                        <i class="fa-solid fa-star drop-shadow-[0_0_8px_rgba(245,158,11,0.6)]"></i>
                    @else
                        <i class="fa-regular fa-star text-white/10"></i>
                    @endif
                @endfor
            </div>
        </div>

        <!-- 2. GRID METRIK PERFORMA (SKOR, AKURASI, DETAIL BENAR/SALAH) -->
        <div class="grid grid-cols-3 gap-4">
            <div class="glass rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest mb-1">Skor Diperoleh</p>
                <span class="text-xl font-black text-amber-400 tracking-wide">{{ $score ?? 0 }}<span class="text-xs font-normal text-white/40 ml-0.5"> XP</span></span>
            </div>
            <div class="glass rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest mb-1">Rasio Akurasi</p>
                <span class="text-xl font-black text-purple-400 tracking-wide">{{ $akurasi ?? 0 }}%</span>
            </div>
            <div class="glass rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest mb-1">Jawaban Benar</p>
                <span class="text-xl font-black text-emerald-400 tracking-wide">{{ $correct ?? 0 }}<span class="text-xs font-normal text-white/40 ml-0.5"> / {{ ($correct ?? 0) + ($wrong ?? 0) }}</span></span>
            </div>
        </div>

        <!-- 3. REKOMENDASI TINDAK LANJUT KOGNITIF -->
        <div class="glass rounded-[30px] p-6 border border-white/5 space-y-3.5">
            <div class="flex items-center gap-2.5 border-b border-white/5 pb-2.5">
                <div class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-400 text-sm">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div>
                    <h3 class="text-xs font-black uppercase tracking-wider text-amber-300">Rekomendasi Analisis Refleks Siswa</h3>
                    <p class="text-[9px] text-white/40">Saran pengembangan daya tangkap berdasarkan rasio jawaban kuis kilat</p>
                </div>
            </div>

            @if(($akurasi ?? 0) >= 70)
                <div class="flex gap-3 items-start text-xs bg-emerald-500/5 p-3 rounded-xl border border-emerald-500/20">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-sm mt-0.5 shrink-0"></i>
                    <p class="text-white/70 leading-relaxed text-[11px]">
                        <strong class="text-emerald-300">Penguasaan Refleks Luar Biasa:</strong> Kemampuan siswa dalam membedakan validitas fakta secara cepat sangat tajam dan melampaui batas ambang minimum kuis kilat. Sangat siap untuk mencoba tantangan level berkecepatan lebih tinggi!
                    </p>
                </div>
            @else
                <div class="flex gap-3 items-start text-xs bg-rose-500/5 p-3 rounded-xl border border-rose-500/20">
                    <i class="fa-solid fa-triangle-exclamation text-rose-400 text-sm mt-0.5 shrink-0"></i>
                    <p class="text-white/70 leading-relaxed text-[11px]">
                        <strong class="text-rose-300">Perlu Peningkatan Ketelitian:</strong> Kecepatan merespons siswa sudah baik, namun tingkat ketelitian analisis fakta masih perlu dilatih. Disarankan mencoba kembali level ini untuk membiasakan pembacaan kata kunci secara efektif.
                    </p>
                </div>
            @endif
        </div>

        <!-- 4. CTA ROUTING TOMBOL NAVIGASI -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
            <a href="{{ route('game-kilat.level') }}" class="w-full inline-flex items-center justify-center gap-2.5 bg-white/5 border border-white/10 text-white font-bold text-sm py-4 rounded-xl hover:bg-white/10 transition duration-200 uppercase tracking-wide">
                <i class="fa-solid fa-rotate-left text-xs text-white/60"></i>
                <span>Coba Lagi Level Kilat</span>
            </a>
            <a href="{{ route('dashboard') }}" class="w-full inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-amber-400 via-orange-500 to-red-600 text-white font-black text-sm py-4 rounded-xl shadow-lg shadow-orange-500/20 btn-hover transition duration-200 uppercase tracking-wide">
                <span>Selesai & Keluar</span>
                <i class="fa-solid fa-circle-chevron-right text-xs"></i>
            </a>
        </div>

    </div>

    @include('components.loading')
    @include('components.sound')

</body>
</html>