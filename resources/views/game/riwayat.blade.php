<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Permainan - Guiz Adventure</title>

    @vite('resources/css/app.css')

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .row-cyber {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .row-cyber:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(34, 211, 238, 0.35);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(34, 211, 238, 0.1);
        }

        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(34, 211, 238, 0.3);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(34, 211, 238, 0.5);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat text-white overflow-x-hidden antialiased" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#07111f]/85 -z-10"></div>
    <div class="absolute top-10 left-10 w-72 h-72 bg-cyan-500/10 blur-3xl rounded-full pointer-events-none animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 bg-purple-500/10 blur-3xl rounded-full pointer-events-none"></div>

    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 relative z-10">

        <div class="glass rounded-[35px] p-6 lg:p-8 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-xl bg-cyan-500/10 text-cyan-300 text-xs font-bold border border-cyan-400/20 tracking-wider uppercase">
                        <i class="fa-solid fa-clock-rotate-left text-[10px]"></i> Data Aktivitas Battle
                    </div>
                    <h1 class="text-3xl lg:text-5xl font-black tracking-tight text-white mt-2">
                        Riwayat Permainan
                    </h1>
                    <p class="text-white/60 text-xs lg:text-sm max-w-xl leading-relaxed pt-1">
                        Evaluasi rekapitulasi data taktis dari petualangan kuis yang telah kamu taklukkan. Pantau performa bintang dan rasio akurasi belajarmu.
                    </p>
                </div>

                <div class="w-full md:w-auto">
                    <a href="/dashboard"
                        class="w-full md:w-auto inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-6 py-4 rounded-2xl font-bold text-sm shadow-xl shadow-blue-500/10 transition-all transform hover:-translate-y-0.5 group">
                        <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                        <span>Kembali ke Dashboard</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
            <div class="glass rounded-2xl p-5 flex items-center justify-between group">
                <div class="space-y-1">
                    <p class="text-[10px] text-white/50 uppercase font-bold tracking-widest">Total Pertempuran</p>
                    <h2 class="text-3xl lg:text-4xl font-black text-cyan-400 tracking-wide">{{ $data->count() }}</h2>
                </div>
                <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 shadow-[0_0_15px_rgba(34,211,238,0.1)]">
                    <i class="fa-solid fa-gamepad text-base"></i>
                </div>
            </div>

            <div class="glass rounded-2xl p-5 flex items-center justify-between group">
                <div class="space-y-1">
                    <p class="text-[10px] text-white/50 uppercase font-bold tracking-widest">Skor Tertinggi</p>
                    <h2 class="text-3xl lg:text-4xl font-black text-yellow-400 tracking-wide">{{ $data->max('score') ?? 0 }}</h2>
                </div>
                <div class="w-10 h-10 rounded-xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center text-yellow-400 shadow-[0_0_15px_rgba(234,179,8,0.1)]">
                    <i class="fa-solid fa-trophy text-base"></i>
                </div>
            </div>

            <div class="glass rounded-2xl p-5 flex items-center justify-between col-span-2 md:col-span-1 group">
                <div class="space-y-1">
                    <p class="text-[10px] text-white/50 uppercase font-bold tracking-widest">Rata-rata Skor</p>
                    <h2 class="text-3xl lg:text-4xl font-black text-emerald-400 tracking-wide">{{ round($data->avg('score') ?? 0) }}</h2>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-400/10 border border-emerald-400/20 flex items-center justify-center text-emerald-400 shadow-[0_0_15px_rgba(52,211,153,0.1)]">
                    <i class="fa-solid fa-chart-simple text-base"></i>
                </div>
            </div>
        </div>

        @if($data->count() > 0)
        <div class="glass rounded-[30px] p-6 mb-8 border border-white/5 bg-slate-900/40">
            <h3 class="font-black text-sm uppercase tracking-wider text-cyan-300 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-chart-line"></i> Grafik Grafik Perkembangan Penalaran Kognitif Siswa
            </h3>
            <div class="w-full relative h-64 md:h-72">
                <canvas id="growthChart"></canvas>
            </div>
        </div>
        @endif

        <div class="space-y-3">
            <div class="hidden md:grid grid-cols-12 px-6 text-[11px] text-white/40 font-bold uppercase tracking-wider mb-2">
                <div class="col-span-2">Token ID</div>
                <div class="col-span-3">Waktu Selesai</div>
                <div class="col-span-2 text-center">Stage Level</div>
                <div class="col-span-2 text-center">Skor Akhir</div>
                <div class="col-span-1 text-center">Grade</div>
                <div class="col-span-2 text-right">Apresiasi Bintang</div>
            </div>

            @if($data->count() > 0)
                @foreach($data as $index => $item)
                    <div class="glass rounded-2xl p-4 grid grid-cols-2 md:grid-cols-12 items-center row-cyber gap-y-3 gap-x-2">
                        <div class="col-span-1 md:col-span-2 flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-xs font-black text-white/70">
                                {{ $index + 1 }}
                            </div>
                            <i class="fa-solid fa-shield-halved text-xs
                                {{ in_array(strtoupper($item->grade), ['S','A']) ? 'text-yellow-400 drop-shadow-[0_0_8px_rgba(234,179,8,0.4)]' : '' }}
                                {{ strtoupper($item->grade) == 'B' ? 'text-cyan-400 drop-shadow-[0_0_8px_rgba(34,211,238,0.4)]' : '' }}
                                {{ in_array(strtoupper($item->grade), ['C','D','E','F']) ? 'text-white/30' : '' }}
                            "></i>
                            <span class="text-xs font-bold text-white/30 md:hidden ml-1">ID Token</span>
                        </div>

                        <div class="col-span-1 md:col-span-3 text-right md:text-left">
                            <span class="text-[10px] text-white/30 font-bold md:hidden block">Selesai Pada:</span>
                            <span class="text-xs font-medium text-white/70 tracking-wide">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y • H:i') }}
                            </span>
                        </div>

                        <div class="col-span-1 md:col-span-2 md:text-center flex md:justify-center items-center">
                            <span class="text-xs text-white/30 font-bold md:hidden mr-2">Stage:</span>
                            <span class="px-2.5 py-0.5 rounded-lg bg-cyan-500/10 text-cyan-300 text-[11px] font-bold border border-cyan-400/20 tracking-wide">
                                LVL {{ $item->level }}
                            </span>
                        </div>

                        <div class="col-span-1 md:col-span-2 text-right md:text-center">
                            <span class="text-[10px] text-white/30 font-bold md:hidden block">Skor:</span>
                            <span class="text-base font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-400 tracking-wider">
                                {{ $item->score }}<span class="text-[10px] font-normal text-white/40 ml-0.5">Pts</span>
                            </span>
                        </div>

                        <div class="col-span-1 md:col-span-1 md:text-center flex md:justify-center items-center">
                            <span class="text-xs text-white/30 font-bold md:hidden mr-2">Predikat:</span>
                            <span class="text-sm font-black tracking-widest
                                {{ in_array(strtoupper($item->grade), ['S','A']) ? 'text-yellow-400 drop-shadow-[0_0_5px_rgba(234,179,8,0.3)]' : '' }}
                                {{ strtoupper($item->grade) == 'B' ? 'text-purple-400' : '' }}
                                {{ in_array(strtoupper($item->grade), ['C','D','E','F']) ? 'text-white/40' : '' }}
                            ">
                                {{ strtoupper($item->grade ?? 'C') }}
                            </span>
                        </div>

                        <div class="col-span-1 md:col-span-2 text-right text-yellow-400">
                            <span class="text-[10px] text-white/30 font-bold md:hidden block mb-1">Apresiasi:</span>
                            <div class="inline-flex gap-0.5 text-[11px]">
                                @if(is_numeric($item->stars) && $item->stars > 0)
                                    @for($i = 0; $i < min($item->stars, 5); $i++)
                                        <i class="fa-solid fa-star drop-shadow-[0_0_6px_rgba(234,179,8,0.6)]"></i>
                                    @endfor
                                @else
                                    <span class="text-white/20 text-xs font-semibold tracking-wider">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="glass rounded-[32px] p-12 lg:p-20 text-center relative overflow-hidden">
                    <div class="w-16 h-16 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center mx-auto mb-5 text-white/20 animate-pulse">
                        <i class="fa-solid fa-shield-halved text-3xl"></i>
                    </div>
                    <h2 class="text-xl lg:text-2xl font-black tracking-wide">Belum Ada Rekam Aktivitas</h2>
                    <p class="text-white/50 text-xs max-w-xs mx-auto mt-2 leading-relaxed">
                        Arsip petualangan kosong. Selesaikan misi pertempuran kuis pertamamu untuk mulai merekam data log permainan.
                    </p>
                    <div class="pt-6">
                        <a href="/game/level"
                            class="bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 hover:from-cyan-500 hover:to-indigo-700 text-white text-xs px-6 py-3.5 rounded-xl font-bold shadow-lg shadow-blue-500/20 transition-all transform hover:-translate-y-0.5 inline-flex items-center gap-2">
                            <i class="fa-solid fa-wand-magic-sparkles text-xs"></i>
                            <span>Masuk Arena Kuis</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('components.loading')
    @include('components.sound')

    @if($data->count() > 0)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Mengambil 7 data riwayat kuis terakhir (diurutkan dari yang lama ke baru)
            const rawData = @json($data->take(7)->reverse()->values());
            
            const labels = rawData.map((item, index) => `Kuis #${index + 1}`);
            const scores = rawData.map(item => item.score);

            const ctx = document.getElementById('growthChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Skor Capaian Siswa (Pts)',
                        data: scores,
                        borderColor: '#22d3ee', // Warna Cyan khas Guiz Adventure
                        backgroundColor: 'rgba(34, 211, 238, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#0ea5e9',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.35, // Membuat garis melengkung estetik ala game
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            grid: { color: 'rgba(255, 255, 255, 0.05)' },
                            ticks: { color: 'rgba(255, 255, 255, 0.5)', font: { family: 'Poppins', size: 11 } },
                            min: 0
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: 'rgba(255, 255, 255, 0.5)', font: { family: 'Poppins', size: 11 } }
                        }
                    }
                }
            });
        });
    </script>
    @endif

</body>
</html>