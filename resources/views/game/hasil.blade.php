<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Petualangan - Guiz Adventure</title>

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
        
        <div class="glass rounded-[35px] p-8 text-center border relative overflow-hidden shadow-xl
            {{ $isKalah ? 'border-red-500/20 bg-red-500/5' : 'border-yellow-500/20 bg-gradient-to-b from-yellow-500/5 to-transparent' }}
        ">
            <div class="absolute top-0 inset-x-0 flex justify-center"><div class="w-40 h-1 bg-gradient-to-r from-transparent via-cyan-400 to-transparent"></div></div>

            <div class="w-24 h-24 rounded-[30px] bg-gradient-to-br from-cyan-400 via-blue-500 to-indigo-600 flex items-center justify-center mx-auto mb-4 shadow-xl shadow-blue-500/20 border border-white/10">
                <span class="text-4xl font-black text-white tracking-wider drop-shadow-md">
                    {{ $grade ?? 'C' }}
                </span>
            </div>

            <h1 class="text-2xl font-black tracking-wide text-white">
                {{ $isKalah ? 'Petualangan Terhenti!' : 'Misi Berhasil Diselesaikan!' }}
            </h1>
            <p class="text-xs text-white/50 mt-1 max-w-md mx-auto leading-relaxed">
                Kamu telah menuntaskan evaluasi taktis penjelajahan level ini. Berikut adalah hasil performa kompetensi kognitif yang kamu peroleh.
            </p>

            <div class="flex justify-center gap-1.5 text-xl text-yellow-400 mt-5">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= ($stars ?? 1))
                        <i class="fa-solid fa-star drop-shadow-[0_0_8px_rgba(234,179,8,0.6)]"></i>
                    @else
                        <i class="fa-regular fa-star text-white/10"></i>
                    @endif
                @endfor
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="glass rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest mb-1">Skor Diperoleh</p>
                <span class="text-xl font-black text-cyan-400 tracking-wide">{{ $score ?? 0 }}<span class="text-xs font-normal text-white/40 ml-0.5"> XP</span></span>
            </div>
            <div class="glass rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest mb-1">Rasio Akurasi</p>
                <span class="text-xl font-black text-purple-400 tracking-wide">{{ $akurasi ?? 0 }}%</span>
            </div>
            <div class="glass rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest mb-1">Rekor Tertinggi</p>
                <span class="text-xl font-black text-yellow-400 tracking-wide">{{ $high_score ?? 0 }}<span class="text-xs font-normal text-white/40 ml-0.5"> Pts</span></span>
            </div>
        </div>

        <div class="glass rounded-[30px] p-6 border border-white/5 space-y-3.5">
            <div class="flex items-center gap-2.5 border-b border-white/5 pb-2.5">
                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 text-sm">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div>
                    <h3 class="text-xs font-black uppercase tracking-wider text-emerald-300">Rekomendasi Tindak Lanjut Siswa</h3>
                    <p class="text-[9px] text-white/40">Saran perbaikan kognitif berdasarkan capaian batas KKM akurasi kuis</p>
                </div>
            </div>

            @if(($akurasi ?? 0) >= 75)
                <div class="flex gap-3 items-start text-xs bg-emerald-500/5 p-3 rounded-xl border border-emerald-500/20">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-sm mt-0.5 shrink-0"></i>
                    <p class="text-white/70 leading-relaxed text-[11px]">
                        <strong class="text-emerald-300">Program Pengayaan:</strong> Pemahaman aspek analisis siswa sudah sangat matang dan melampaui ambang batas minimum. Direkomendasikan untuk langsung melanjutkan petualangan ke tingkat level kesulitan yang lebih tinggi guna mengasah strategi inferensi logis yang lebih kompleks!
                    </p>
                </div>
            @else
                <div class="flex gap-3 items-start text-xs bg-orange-500/5 p-3 rounded-xl border border-orange-500/20">
                    <i class="fa-solid fa-triangle-exclamation text-orange-400 text-sm mt-0.5 shrink-0"></i>
                    <p class="text-white/70 leading-relaxed text-[11px]">
                        <strong class="text-orange-300">Program Remedial:</strong> Tingkat ketelitian siswa masih berada di bawah target indikator kelulusan berpikir kritis. Disarankan untuk membaca ulang suplemen konstruksi pembahasan pada modul riwayat permainan, serta mencoba kembali kuis ini untuk memperbaiki pemetaan fakta dasar.
                    </p>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
            <a href="/game/level" class="w-full inline-flex items-center justify-center gap-2.5 bg-white/5 border border-white/10 text-white font-bold text-sm py-4 rounded-xl hover:bg-white/10 transition duration-200 uppercase tracking-wide">
                <i class="fa-solid fa-rotate-left text-xs text-white/60"></i>
                <span>Ulangi Tantangan</span>
            </a>
            <a href="/dashboard" class="w-full inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-cyan-400 via-blue-500 to-blue-600 text-white font-black text-sm py-4 rounded-xl shadow-lg shadow-blue-500/20 btn-hover transition duration-200 uppercase tracking-wide">
                <span>Selesai & Keluar</span>
                <i class="fa-solid fa-circle-chevron-right text-xs"></i>
            </a>
        </div>

    </div>

    @include('components.loading')
    @include('components.sound')

</body>
</html>