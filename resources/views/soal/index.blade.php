<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Soal</title>

    @vite('resources/css/app.css')

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <style>

        body{
            font-family:'Poppins',sans-serif;
        }

        .glass{
            background:rgba(255,255,255,0.08);
            backdrop-filter:blur(18px);
            border:1px solid rgba(255,255,255,0.08);
        }

    </style>

</head>

<body class="bg-[#07111f] text-white min-h-screen">

    <!-- BACKGROUND -->
    <div class="fixed inset-0 overflow-hidden -z-10">

        <div
            class="absolute top-0 left-0
            w-[500px] h-[500px]
            bg-cyan-500/10 blur-3xl rounded-full"
        ></div>

        <div
            class="absolute bottom-0 right-0
            w-[500px] h-[500px]
            bg-purple-500/10 blur-3xl rounded-full"
        ></div>

    </div>

    <!-- CONTAINER -->
    <div class="max-w-7xl mx-auto px-5 py-10">

        <!-- HEADER -->
        <div
            class="glass rounded-[35px]
            p-6 lg:p-8 mb-8"
        >

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div>

                    <p class="text-cyan-300 font-semibold mb-3">
                        Management System
                    </p>

                    <h1 class="text-4xl lg:text-5xl font-extrabold">
                        Kelola Soal Quiz
                    </h1>

                </div>

                <a
                    href="/soal/create"
                    class="rounded-[25px]
                    bg-gradient-to-r from-cyan-400 to-blue-600
                    px-6 py-4 text-lg font-bold"
                >

                    + Tambah Soal

                </a>

            </div>

        </div>

        <!-- FILTER -->
        <div
            class="glass rounded-[30px]
            p-5 mb-8"
        >

            <div class="flex flex-wrap gap-4">

                <button
                    onclick="filterLevel('all')"
                    class="filter-btn px-5 py-3 rounded-2xl
                    bg-cyan-500 text-white font-bold"
                >

                    Semua

                </button>

                <button
                    onclick="filterLevel('1')"
                    class="filter-btn px-5 py-3 rounded-2xl
                    bg-white/10 border border-white/10"
                >

                    Level 1

                </button>

                <button
                    onclick="filterLevel('2')"
                    class="filter-btn px-5 py-3 rounded-2xl
                    bg-white/10 border border-white/10"
                >

                    Level 2

                </button>

                <button
                    onclick="filterLevel('3')"
                    class="filter-btn px-5 py-3 rounded-2xl
                    bg-white/10 border border-white/10"
                >

                    Level 3

                </button>

            </div>

        </div>

        <!-- TABLE -->
        <div class="space-y-5">

            @foreach($data as $item)

                <div
                    class="soal-item glass rounded-[30px]
                    p-6"
                    data-level="{{ $item->level }}"
                >

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                        <!-- LEFT -->
                        <div class="flex-1">

                            <!-- LEVEL -->
                            <div
                                class="inline-flex items-center gap-3
                                px-4 py-2 rounded-2xl
                                bg-cyan-500/10 border border-cyan-400/20
                                text-cyan-300 text-sm font-bold mb-5"
                            >

                                <i class="fa-solid fa-layer-group"></i>

                                Level {{ $item->level }}

                            </div>

                            <!-- QUESTION -->
                            <h2 class="text-2xl font-bold mb-4 leading-relaxed">

                                {{ $item->pertanyaan }}

                            </h2>

                            <!-- ANSWER -->
                            <p class="text-white/60">

                                Jawaban Benar:
                                <span class="text-cyan-300 font-bold">
                                    {{ $item->jawaban }}
                                </span>

                            </p>

                        </div>

                        <!-- ACTION -->
                        <div class="flex gap-4">

                            <!-- EDIT -->
                            <a
                                href="/soal/edit/{{ $item->id }}"
                                class="rounded-2xl
                                bg-yellow-500/20
                                border border-yellow-400/20
                                px-5 py-4 font-bold text-yellow-300"
                            >

                                Edit

                            </a>

                            <!-- DELETE -->
                            <a
                                href="/soal/delete/{{ $item->id }}"
                                onclick="return confirm('Hapus soal ini?')"
                                class="rounded-2xl
                                bg-red-500/20
                                border border-red-400/20
                                px-5 py-4 font-bold text-red-300"
                            >

                                Hapus

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

    <!-- SCRIPT FILTER -->
    <script>

        function filterLevel(level){

            const items =
                document.querySelectorAll('.soal-item');

            items.forEach(item => {

                if(level === 'all'){

                    item.style.display = 'block';

                } else {

                    if(item.dataset.level === level){

                        item.style.display = 'block';

                    } else {

                        item.style.display = 'none';

                    }

                }

            });

        }

    </script>

</body>
</html>