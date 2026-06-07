<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Permainan</title>

    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(255,255,255,.08);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.08);
        }

        .card-hover {
            transition: .3s;
        }

        .card-hover:hover {
            transform: translateY(-4px);
        }
    </style>
</head>

<body
    class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat text-white"
    style="background-image:url('{{ asset('images/bg-login.jpg') }}')"
>

    <div class="fixed inset-0 bg-[#07111f]/85 -z-10"></div>

    <div class="max-w-7xl mx-auto p-5 lg:p-8">

        <!-- HEADER -->
        <div class="glass rounded-[35px] p-8 mb-8">

            <div class="flex flex-col lg:flex-row justify-between gap-6">

                <div>
                    <p class="text-cyan-300 font-semibold uppercase tracking-widest mb-3">
                        Data Aktivitas
                    </p>

                    <h1 class="text-4xl lg:text-6xl font-extrabold">
                        Riwayat Permainan
                    </h1>

                    <p class="text-white/60 mt-4 max-w-2xl">
                        Menampilkan seluruh riwayat permainan yang telah diselesaikan,
                        termasuk skor, level, dan pencapaian hasil belajar.
                    </p>
                </div>

                <div>
                    <a href="/dashboard"
                        class="inline-flex items-center bg-gradient-to-r from-cyan-500 to-blue-600 px-6 py-4 rounded-2xl font-semibold shadow-lg">
                        Kembali ke Dashboard
                    </a>
                </div>

            </div>

        </div>

        <!-- STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="glass rounded-[30px] p-6 card-hover">
                <p class="text-white/60 uppercase tracking-wider text-sm">
                    Total Permainan
                </p>

                <h2 class="text-5xl font-extrabold text-cyan-300 mt-3">
                    {{ $data->count() }}
                </h2>
            </div>

            <div class="glass rounded-[30px] p-6 card-hover">
                <p class="text-white/60 uppercase tracking-wider text-sm">
                    Skor Tertinggi
                </p>

                <h2 class="text-5xl font-extrabold text-yellow-400 mt-3">
                    {{ $data->max('score') ?? 0 }}
                </h2>
            </div>

            <div class="glass rounded-[30px] p-6 card-hover">
                <p class="text-white/60 uppercase tracking-wider text-sm">
                    Rata-rata Skor
                </p>

                <h2 class="text-5xl font-extrabold text-emerald-400 mt-3">
                    {{ round($data->avg('score') ?? 0) }}
                </h2>
            </div>

        </div>

        <!-- TABEL RIWAYAT -->
        <div class="glass rounded-[35px] overflow-hidden">

            <div class="p-6 border-b border-white/10">
                <h2 class="text-2xl font-bold">
                    Riwayat Aktivitas Pengguna
                </h2>

                <p class="text-white/50 mt-2">
                    Rekap seluruh permainan yang pernah dilakukan.
                </p>
            </div>

            @if($data->count() > 0)

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-white/5">

                            <tr>
                                <th class="p-4 text-left">No</th>
                                <th class="p-4 text-left">Tanggal</th>
                                <th class="p-4 text-center">Level</th>
                                <th class="p-4 text-center">Skor</th>
                                <th class="p-4 text-center">Grade</th>
                                <th class="p-4 text-center">Bintang</th>
                            </tr>

                        </thead>

                        <tbody>

                        @foreach($data as $index => $item)

                            <tr class="border-t border-white/10 hover:bg-white/5 transition">

                                <td class="p-4">
                                    {{ $index + 1 }}
                                </td>

                                <td class="p-4">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
                                </td>

                                <td class="p-4 text-center">
                                    {{ $item->level }}
                                </td>

                                <td class="p-4 text-center font-semibold text-cyan-300">
                                    {{ $item->score }}
                                </td>

                                <td class="p-4 text-center font-semibold text-yellow-400">
                                    {{ $item->grade }}
                                </td>

                                <td class="p-4 text-center">
                                    {{ $item->stars }}
                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-20">

                    <h2 class="text-3xl font-bold mb-4">
                        Belum Ada Riwayat Permainan
                    </h2>

                    <p class="text-white/60 mb-8">
                        Mulai permainan pertama untuk melihat riwayat aktivitas pada halaman ini.
                    </p>

                    <a href="/game/level"
                        class="bg-gradient-to-r from-cyan-500 to-blue-600 px-8 py-4 rounded-2xl font-semibold">
                        Mulai Bermain
                    </a>

                </div>

            @endif

        </div>

    </div>

</body>
</html>
