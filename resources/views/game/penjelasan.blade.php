<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Evaluasi Jawaban - Guiz Adventure</title>

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
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .btn-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(34, 211, 238, 0.25);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden text-white" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#07111f]/80 -z-10"></div>

    @if($status == 'benar')
        <div class="absolute top-0 left-0 w-80 h-80 bg-emerald-500/10 blur-3xl rounded-full pointer-events-none animate-pulse"></div>
    @else
        <div class="absolute top-0 left-0 w-80 h-80 bg-red-500/10 blur-3xl rounded-full pointer-events-none animate-pulse"></div>
    @endif
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-purple-500/10 blur-3xl rounded-full pointer-events-none"></div>

    <div class="relative z-10 min-h-screen p-5 lg:p-8 flex items-center justify-center">
        <div class="max-w-3xl w-full mx-auto space-y-6">

            <div class="glass rounded-[35px] p-6 lg:p-8 text-center border relative overflow-hidden
                {{ $status == 'benar' ? 'border-emerald-500/30 bg-gradient-to-b from-emerald-500/5 to-transparent' : 'border-red-500/30 bg-gradient-to-b from-red-500/5 to-transparent' }}
            ">
                
                <div class="flex flex-col items-center justify-center space-y-4">
                    @if($status == 'benar')
                        <div class="w-20 h-20 rounded-full bg-emerald-500/20 border border-emerald-400/40 flex items-center justify-center text-emerald-400 text-4xl drop-shadow-[0_0_15px_rgba(52,211,153,0.4)]">
                            <i class="fa-solid fa-circle-check animate-bounce"></i>
                        </div>
                    @else
                        <div class="w-20 h-20 rounded-full bg-red-500/20 border border-red-400/40 flex items-center justify-center text-red-400 text-4xl drop-shadow-[0_0_15px_rgba(239,68,68,0.4)]">
                            <i class="fa-solid fa-circle-xmark animate-shake"></i>
                        </div>
                    @endif

                    <h1 class="text-2xl lg:text-4xl font-black tracking-wide">
                        {{ $message }}
                    </h1>

                    @if($status == 'benar' && $combo >= 3)
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-500/20 text-orange-400 border border-orange-500/30 text-xs font-black tracking-widest uppercase animate-pulse">
                            <i class="fa-solid fa-fire"></i> {{ $combo }}x Combo Streak Fire!
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="glass rounded-2xl p-4 flex items-center gap-4 border border-white/5 bg-slate-900/30">
                    <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/60 font-bold text-sm">
                        User
                    </div>
                    <div>
                        <p class="text-[10px] text-white/40 uppercase font-bold tracking-wider">Jawaban Kamu</p>
                        <h4 class="text-sm font-bold mt-0.5 {{ $status == 'benar' ? 'text-emerald-400' : 'text-red-400' }}">
                            Opsi ({{ strtoupper($jawabanUser) }})
                        </h4>
                    </div>
                </div>

                <div class="glass rounded-2xl p-4 flex items-center gap-4 border border-white/5 bg-slate-900/30">
                    <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 font-bold text-sm">
                        Key
                    </div>
                    <div>
                        <p class="text-[10px] text-white/40 uppercase font-bold tracking-wider">Kunci Jawaban Benar</p>
                        <h4 class="text-sm font-bold text-cyan-400 mt-0.5">
                            Opsi ({{ strtoupper($benar) }})
                        </h4>
                    </div>
                </div>
            </div>

            <div class="glass rounded-[35px] p-6 lg:p-8 border border-white/5">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-brain text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="text-cyan-300 text-xs font-semibold uppercase tracking-wider">Analisis Berpikir Kritis</p>
                        <h3 class="text-white font-bold text-lg">Pembahasan Solusi</h3>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-5 lg:p-6 leading-relaxed text-xs lg:text-sm text-white/80 space-y-4">
                    <p class="font-bold text-white mb-2"><i class="fa-solid fa-quote-left text-cyan-400 mr-2 opacity-50"></i>Konteks Pertanyaan:</p>
                    <p class="italic bg-black/10 p-3 rounded-xl border border-white/5 mb-4 text-white/60">"{{ $soal->pertanyaan }}"</p>
                    
                    <p class="font-bold text-white pt-2 border-t border-white/5"><i class="fa-solid fa-circle-info text-cyan-400 mr-2 opacity-70"></i>Penjelasan Ilmiah:</p>
                    <p class="text-justify">
                        {{ $penjelasan ?? 'Tidak ada data penjelasan detail/pembahasan akademis untuk soal nomor kuis petualangan ini.' }}
                    </p>
                </div>
            </div>

            <div class="pt-2">
                @if($gameOver)
                    <a href="/game/hasil" class="w-full text-center inline-flex items-center justify-center gap-3 bg-gradient-to-r from-red-500 via-orange-600 to-red-700 text-white px-6 py-4 rounded-[24px] font-black tracking-wide text-md btn-hover shadow-lg shadow-red-500/20">
                        <i class="fa-solid fa-skull-crossbones text-lg"></i>
                        <span>LIHAT HASIL EVALUASI AKHIR</span>
                    </a>
                @else
                    <a href="/game/next" class="w-full text-center inline-flex items-center justify-center gap-3 bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 text-white px-6 py-4 rounded-[24px] font-black tracking-wide text-md btn-hover shadow-lg shadow-blue-500/20 group">
                        <span>LANJUTKAN PETUALANGAN KUIS</span>
                        <i class="fa-solid fa-circle-arrow-right text-lg transition-transform group-hover:translate-x-1"></i>
                    </a>
                @endif
            </div>

        </div>
    </div>

    @include('components.loading')
    @include('components.sound')
</body>
</html>