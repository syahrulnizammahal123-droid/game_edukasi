<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Quiz</title>

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
            overflow-x:hidden;
        }

        .glass{
            background:rgba(255,255,255,0.08);
            backdrop-filter:blur(18px);
            border:1px solid rgba(255,255,255,0.08);
        }

        @keyframes floating {

            0%{
                transform:translateY(0px);
            }

            50%{
                transform:translateY(-15px);
            }

            100%{
                transform:translateY(0px);
            }

        }

        .floating{

            animation:floating 4s ease-in-out infinite;

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
    <div class="max-w-4xl mx-auto px-5 py-10">

        <!-- CARD -->
        <div
            class="glass floating rounded-[40px]
            p-8 lg:p-14 text-center"
        >

            <!-- ICON -->
            <div
                class="w-40 h-40 rounded-full
                bg-gradient-to-br from-yellow-400 to-orange-500
                flex items-center justify-center
                mx-auto mb-10
                shadow-[0_0_60px_rgba(251,191,36,0.4)]"
            >

                <i class="fa-solid fa-trophy text-white text-7xl"></i>

            </div>

            <!-- TITLE -->
            <p class="text-cyan-300 font-semibold mb-4">
                Quiz Selesai
            </p>

            <h1 class="text-5xl lg:text-7xl font-extrabold mb-8">
                HASIL QUIZ
            </h1>

            <!-- GRADE -->
            <div
                class="w-48 h-48 rounded-full
                bg-gradient-to-br from-cyan-400 to-blue-600
                flex items-center justify-center
                mx-auto mb-10
                shadow-[0_0_70px_rgba(34,211,238,0.45)]"
            >

                <span class="text-8xl font-extrabold">
                    {{ $grade }}
                </span>

            </div>

            <!-- STARS -->
            <div class="flex justify-center gap-3 mb-10">

                @for($i = 1; $i <= 5; $i++)

                    <i
                        class="fa-solid fa-star text-4xl
                        {{ $i <= $stars
                            ? 'text-yellow-400'
                            : 'text-white/20'
                        }}"
                    ></i>

                @endfor

            </div>

            <!-- SCORE -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">

                <!-- SCORE -->
                <div
                    class="rounded-[30px]
                    bg-white/5 border border-white/10
                    p-8"
                >

                    <p class="text-cyan-300 text-sm mb-3">
                        Total Score
                    </p>

                    <h2 class="text-6xl font-extrabold">
                        {{ $score }}
                    </h2>

                </div>

                <!-- HIGH SCORE -->
                <div
                    class="rounded-[30px]
                    bg-white/5 border border-white/10
                    p-8"
                >

                    <p class="text-cyan-300 text-sm mb-3">
                        High Score
                    </p>

                    <h2 class="text-6xl font-extrabold">
                        {{ $high_score }}
                    </h2>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

                <a
                    href="/dashboard"
                    class="rounded-[30px]
                    bg-white/10 border border-white/10
                    py-5 text-xl font-bold"
                >

                    Dashboard

                </a>

                <a
                    href="/game/level"
                    class="rounded-[30px]
                    bg-gradient-to-r from-cyan-400 to-blue-600
                    py-5 text-xl font-bold"
                >

                    Main Lagi 🚀

                </a>

            </div>

        </div>

    </div>

    @include('components.loading')

    @include('components.sound')

</body>
</html>