<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quiz Battle</title>

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

        /*
        |--------------------------------------------------------------------------
        | TIMER
        |--------------------------------------------------------------------------
        */

        .timer-warning{

            animation:pulseTimer 1s infinite;

        }

        @keyframes pulseTimer{

            0%{
                transform:scale(1);
            }

            50%{
                transform:scale(1.08);
            }

            100%{
                transform:scale(1);
            }

        }

        /*
        |--------------------------------------------------------------------------
        | OPTION
        |--------------------------------------------------------------------------
        */

        .option-card{

            transition:0.3s;

        }

        .option-card:hover{

            transform:translateY(-5px) scale(1.02);

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
    <div class="max-w-5xl mx-auto px-5 py-10">

        <!-- TOP -->
        <div
            class="glass rounded-[35px]
            p-6 lg:p-8 mb-8"
        >

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                <!-- LEFT -->
                <div>

                    <p class="text-cyan-300 font-semibold mb-3">
                        Quiz Adventure
                    </p>

                    <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">
                        Jawab Pertanyaan
                        <br>
                        Dengan Cepat ⚡
                    </h1>

                </div>

                <!-- TIMER -->
                <div class="flex justify-center">

                    <div
                        id="timer-box"
                        class="w-36 h-36 rounded-full
                        bg-gradient-to-br from-cyan-400 to-blue-600
                        flex flex-col items-center justify-center
                        shadow-[0_0_45px_rgba(34,211,238,0.4)]"
                    >

                        <span
                            id="timer"
                            class="text-5xl font-extrabold"
                        >
                            15
                        </span>

                        <span class="text-sm text-cyan-100 mt-2">
                            Detik
                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- QUESTION -->
        <div
            class="glass rounded-[35px]
            p-6 lg:p-10"
        >

            <!-- NUMBER -->
            <div
                class="inline-flex items-center gap-3
                px-5 py-3 rounded-2xl
                bg-cyan-500/10 border border-cyan-400/20
                text-cyan-300 font-bold mb-8"
            >

                <i class="fa-solid fa-book-open"></i>

                Pertanyaan Quiz

            </div>

            <!-- SOAL -->
            <h2 class="text-3xl lg:text-4xl font-bold leading-relaxed mb-10">

                {{ $soal->pertanyaan }}

            </h2>

            <!-- FORM -->
            <form
                id="quiz-form"
                action="{{ route('jawab.proses',$soal->id) }}"
                method="POST"
            >

                @csrf

                <!-- OPTIONS -->
                <div class="grid grid-cols-1 gap-5">

                    <!-- A -->
                    <label
                        class="option-card cursor-pointer
                        rounded-[30px]
                        bg-white/5 border border-white/10
                        p-6 flex items-center gap-5"
                    >

                        <input
                            type="radio"
                            name="jawaban"
                            value="a"
                            class="w-6 h-6"
                            required
                        >

                        <div>

                            <p class="text-cyan-300 text-sm mb-2">
                                Pilihan A
                            </p>

                            <h2 class="text-xl font-semibold">
                                {{ $soal->pilihan_a }}
                            </h2>

                        </div>

                    </label>

                    <!-- B -->
                    <label
                        class="option-card cursor-pointer
                        rounded-[30px]
                        bg-white/5 border border-white/10
                        p-6 flex items-center gap-5"
                    >

                        <input
                            type="radio"
                            name="jawaban"
                            value="b"
                            class="w-6 h-6"
                        >

                        <div>

                            <p class="text-cyan-300 text-sm mb-2">
                                Pilihan B
                            </p>

                            <h2 class="text-xl font-semibold">
                                {{ $soal->pilihan_b }}
                            </h2>

                        </div>

                    </label>

                    <!-- C -->
                    <label
                        class="option-card cursor-pointer
                        rounded-[30px]
                        bg-white/5 border border-white/10
                        p-6 flex items-center gap-5"
                    >

                        <input
                            type="radio"
                            name="jawaban"
                            value="c"
                            class="w-6 h-6"
                        >

                        <div>

                            <p class="text-cyan-300 text-sm mb-2">
                                Pilihan C
                            </p>

                            <h2 class="text-xl font-semibold">
                                {{ $soal->pilihan_c }}
                            </h2>

                        </div>

                    </label>

                    <!-- D -->
                    <label
                        class="option-card cursor-pointer
                        rounded-[30px]
                        bg-white/5 border border-white/10
                        p-6 flex items-center gap-5"
                    >

                        <input
                            type="radio"
                            name="jawaban"
                            value="d"
                            class="w-6 h-6"
                        >

                        <div>

                            <p class="text-cyan-300 text-sm mb-2">
                                Pilihan D
                            </p>

                            <h2 class="text-xl font-semibold">
                                {{ $soal->pilihan_d }}
                            </h2>

                        </div>

                    </label>

                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="mt-10 w-full
                    rounded-[30px]
                    bg-gradient-to-r from-cyan-400 to-blue-600
                    py-5 text-2xl font-bold
                    hover:scale-[1.02]
                    transition duration-300"
                >

                    Kirim Jawaban 🚀

                </button>

            </form>

        </div>

    </div>

    <!-- SCRIPT -->
    <script>

        /*
        |--------------------------------------------------------------------------
        | TIMER SYSTEM
        |--------------------------------------------------------------------------
        */

        let timeLeft = 15;

        const timer = document.getElementById('timer');

        const timerBox = document.getElementById('timer-box');

        const quizForm = document.getElementById('quiz-form');

        const countdown = setInterval(() => {

            timeLeft--;

            timer.innerHTML = timeLeft;

            /*
            |--------------------------------------------------------------------------
            | WARNING
            |--------------------------------------------------------------------------
            */

            if(timeLeft <= 5){

                timerBox.classList.remove(
                    'from-cyan-400',
                    'to-blue-600'
                );

                timerBox.classList.add(
                    'from-red-500',
                    'to-orange-500',
                    'timer-warning'
                );

            }

            /*
            |--------------------------------------------------------------------------
            | AUTO SUBMIT
            |--------------------------------------------------------------------------
            */

            if(timeLeft <= 0){

                clearInterval(countdown);

                quizForm.submit();

            }

        },1000);

    </script>

    @include('components.loading')

    @include('components.sound')

</body>
</html>