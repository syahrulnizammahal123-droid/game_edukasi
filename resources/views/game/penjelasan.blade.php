<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Jawaban</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

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

<body
    class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden"
    style="background-image:url('{{ asset('images/bg-login.jpg') }}')"
>

    <!-- Overlay -->
    <div class="fixed inset-0 bg-[#07111f]/80 -z-10"></div>

    <!-- Glow -->
    @if($status == 'benar')

        <div class="absolute top-0 left-0 w-72 h-72 bg-cyan-400/20 blur-3xl rounded-full"></div>

        <div class="absolute bottom-0 right-0 w-72 h-72 bg-green-500/20 blur-3xl rounded-full"></div>

    @else

        <div class="absolute top-0 left-0 w-72 h-72 bg-red-500/20 blur-3xl rounded-full"></div>

        <div class="absolute bottom-0 right-0 w-72 h-72 bg-orange-500/20 blur-3xl rounded-full"></div>

    @endif

    <!-- MAIN -->
    <div class="relative z-10 min-h-screen flex items-center justify-center p-5">

        <div class="w-full max-w-4xl">

            <!-- STATUS CARD -->
            <div
                class="rounded-[40px] p-8 lg:p-10 mb-6
                {{ $status == 'benar'
                    ? 'bg-gradient-to-br from-cyan-500/20 to-green-500/20 border border-cyan-400/20'
                    : 'bg-gradient-to-br from-red-500/20 to-orange-500/20 border border-red-400/20'
                }}"
            >

                <!-- TOP -->
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <!-- LEFT -->
                    <div class="flex items-center gap-5">

                        <!-- ICON -->
                        <div
                            class="w-24 h-24 rounded-[30px]
                            flex items-center justify-center
                            {{ $status == 'benar'
                                ? 'bg-gradient-to-br from-cyan-400 to-green-500'
                                : 'bg-gradient-to-br from-red-500 to-orange-500'
                            }}"
                        >

                            @if($status == 'benar')

                                <i class="fa-solid fa-check text-white text-4xl"></i>

                            @else

                                <i class="fa-solid fa-xmark text-white text-4xl"></i>

                            @endif

                        </div>

                        <!-- TEXT -->
                        <div>

                            <p class="text-white/60 font-semibold mb-2">
                                Hasil Jawaban
                            </p>

                            <h1 class="text-4xl lg:text-5xl font-extrabold text-white">

                                {{ $status == 'benar'
                                    ? 'Jawaban Benar'
                                    : 'Jawaban Salah'
                                }}

                            </h1>

                            <p class="text-white/70 mt-3">

                                {{ $message }}

                            </p>

                        </div>

                    </div>

                    <!-- COMBO -->
                    <div
                        class="glass rounded-[30px]
                        px-6 py-5 min-w-[180px]"
                    >

                        <div class="flex items-center gap-3 mb-3">

                            <div
                                class="w-12 h-12 rounded-2xl
                                bg-gradient-to-br from-pink-500 to-purple-600
                                flex items-center justify-center"
                            >

                                <i class="fa-solid fa-fire text-white"></i>

                            </div>

                            <div>

                                <p class="text-white/60 text-sm">
                                    Combo
                                </p>

                                <h2 class="text-white text-3xl font-bold">
                                    {{ $combo }}
                                </h2>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- DETAIL -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                <!-- JAWABAN PEMAIN -->
                <div
                    class="glass rounded-[35px] p-6"
                >

                    <div class="flex items-center gap-4 mb-5">

                        <div
                            class="w-14 h-14 rounded-2xl
                            bg-gradient-to-br from-purple-500 to-pink-600
                            flex items-center justify-center"
                        >

                            <i class="fa-solid fa-user text-white"></i>

                        </div>

                        <div>

                            <p class="text-white/60 text-sm">
                                Jawaban Kamu
                            </p>

                            <h2 class="text-white text-2xl font-bold">
                                Pilihan {{ $jawabanUser }}
                            </h2>

                        </div>

                    </div>

                    <div
                        class="bg-white/5 border border-white/10
                        rounded-3xl p-5"
                    >

                        <p class="text-white/80 leading-relaxed">

                            {{ $soal[$jawabanUser] ?? '-' }}

                        </p>

                    </div>

                </div>

                <!-- JAWABAN BENAR -->
                <div
                    class="glass rounded-[35px] p-6"
                >

                    <div class="flex items-center gap-4 mb-5">

                        <div
                            class="w-14 h-14 rounded-2xl
                            bg-gradient-to-br from-cyan-400 to-blue-600
                            flex items-center justify-center"
                        >

                            <i class="fa-solid fa-check text-white"></i>

                        </div>

                        <div>

                            <p class="text-white/60 text-sm">
                                Jawaban Benar
                            </p>

                            <h2 class="text-white text-2xl font-bold">
                                Pilihan {{ $benar }}
                            </h2>

                        </div>

                    </div>

                    <div
                        class="bg-white/5 border border-white/10
                        rounded-3xl p-5"
                    >

                        <p class="text-white/80 leading-relaxed">

                            {{ $soal[$benar] ?? '-' }}

                        </p>

                    </div>

                </div>

            </div>

            <!-- PENJELASAN -->
            <div
                class="glass rounded-[35px]
                p-6 lg:p-8 mb-6"
            >

                <!-- TITLE -->
                <div class="flex items-center gap-4 mb-6">

                    <div
                        class="w-16 h-16 rounded-3xl
                        bg-gradient-to-br from-cyan-400 to-blue-600
                        flex items-center justify-center"
                    >

                        <i class="fa-solid fa-book-open text-white text-xl"></i>

                    </div>

                    <div>

                        <p class="text-cyan-300 text-sm font-semibold">
                            Penjelasan
                        </p>

                        <h2 class="text-white text-3xl font-bold">
                            Pembahasan Soal
                        </h2>

                    </div>

                </div>

                <!-- CONTENT -->
                <div
                    class="bg-white/5 border border-white/10
                    rounded-[30px] p-6"
                >

                    <p class="text-white/80 text-lg leading-relaxed">

                        {{ $penjelasan }}

                    </p>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex justify-center">

                <a href="/game/next"
                    class="inline-flex items-center gap-4
                    bg-gradient-to-r from-cyan-400 to-blue-600
                    text-white px-8 py-5 rounded-[25px]
                    text-lg font-bold shadow-[0_0_35px_rgba(59,130,246,0.4)]
                    hover:scale-[1.03] transition duration-300"
                >

                    <i class="fa-solid fa-arrow-right"></i>

                    Lanjut Soal

                </a>

            </div>

        </div>

    </div>

</body>
</html>