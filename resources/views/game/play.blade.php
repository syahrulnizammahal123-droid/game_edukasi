@extends('layouts.game')

@section('title', 'QuizKU - Ulangan IPA')

@push('styles')
<style>
* {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .option-btn {
            transition: all 0.2s ease;
        }

        .option-btn:hover {
            transform: translateY(-2px);
        }

        .option-btn.disabled {
            pointer-events: none;
        }

        .option-correct {
            background: rgba(16, 185, 129, 0.18) !important;
            border-color: rgb(16, 185, 129) !important;
            box-shadow: 0 0 25px rgba(16, 185, 129, 0.15);
        }

        .option-wrong {
            background: rgba(244, 63, 94, 0.18) !important;
            border-color: rgb(244, 63, 94) !important;
            box-shadow: 0 0 25px rgba(244, 63, 94, 0.15);
        }

        .letter-correct {
            background: rgb(16, 185, 129) !important;
            color: white !important;
        }

        .letter-wrong {
            background: rgb(244, 63, 94) !important;
            color: white !important;
        }

        .timer-danger {
            animation: pulseDanger 0.7s infinite;
        }

        @keyframes pulseDanger {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

        }

        .feedback-animation {
            animation: feedbackIn 0.35s ease;
        }

        @keyframes feedbackIn {

            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        #nextProgress {
            transition: width 1.5s linear;
        }
</style>
@endpush

@section('content')
<!-- =========================================================
         BACKGROUND
    ========================================================== -->

    <div
        class="fixed
        inset-0
        -z-10
        overflow-hidden"
    >

        <div
            class="absolute
            inset-0
            bg-[#070d19]"
        ></div>


        <div
            class="absolute
            top-0
            left-0
            w-96
            h-96
            bg-cyan-500/5
            rounded-full
            blur-3xl"
        ></div>


        <div
            class="absolute
            bottom-0
            right-0
            w-96
            h-96
            bg-purple-500/5
            rounded-full
            blur-3xl"
        ></div>

    </div>



    <!-- =========================================================
         DATA PHP
    ========================================================== -->

    @php

        $levelSaatIni =
            (int) (
                $level ??
                session('game_level', 1)
            );


        $currentIndex =
            (int) session('game_index', 0);


        $totalSoal =
            (int) session('game_total', 0);


        if (
            $totalSoal <= 0 &&
            isset($soals)
        ) {

            $totalSoal = count($soals);

        }


        if ($totalSoal <= 0) {

            $totalSoal = 1;

        }


        $feedbackMode =
            isset($feedbackMode)
                ? $feedbackMode
                : false;


        $nomorSoal =
            $currentIndex + 1;


        $pilihan = [

            'A' => $soal->A ?? '',
            'B' => $soal->B ?? '',
            'C' => $soal->C ?? '',
            'D' => $soal->D ?? '',

        ];


        $progress =
            $totalSoal > 0

                ? min(
                    100,
                    round(
                        ($nomorSoal / $totalSoal) * 100
                    )
                )

                : 0;

    @endphp



    <!-- =========================================================
         MAIN
    ========================================================== -->

    <main
        class="min-h-screen
        flex
        items-center
        justify-center
        p-4"
    >

        <div
            class="w-full
            max-w-4xl"
        >


            <!-- =================================================
                 CARD ULANGAN
            ================================================== -->

            <div
                class="bg-[#0d1527]
                border
                border-white/10
                rounded-[30px]
                shadow-2xl
                overflow-hidden"
            >


                <!-- =================================================
                     HEADER
                ================================================== -->

                <div
                    class="p-6
                    sm:p-8"
                >

                    <div
                        class="flex
                        items-center
                        justify-between
                        gap-4"
                    >


                        <!-- ULANGAN -->

                        <div>

                            <p
                                class="text-cyan-400
                                font-black
                                text-sm
                                uppercase
                                tracking-wider"
                            >

                                ULANGAN
                                {{ $levelSaatIni }}

                            </p>


                            <h1
                                class="text-2xl
                                sm:text-3xl
                                font-black
                                mt-1"
                            >

                                Soal
                                {{ $nomorSoal }}
                                /
                                {{ $totalSoal }}

                            </h1>

                        </div>



                        <!-- TIMER -->

                        <div
                            id="timerBox"
                            class="shrink-0
                            flex
                            items-center
                            gap-2
                            px-5
                            py-3
                            rounded-2xl
                            bg-amber-500/15
                            border
                            border-amber-500/40
                            text-amber-300
                            font-black
                            shadow-lg"
                        >

                            <i class="fa-solid fa-stopwatch"></i>

                            <span id="timer">
                                15
                            </span>

                            <span class="text-xs">
                                detik
                            </span>

                        </div>

                    </div>



                    <!-- PROGRESS -->

                    <div
                        class="border-t
                        border-white/10
                        mt-6
                        pt-6"
                    >

                        <div
                            class="flex
                            justify-between
                            text-xs
                            mb-2"
                        >

                            <span class="text-white/40">
                                Progres Ulangan
                            </span>


                            <span class="text-cyan-400 font-bold">
                                {{ $progress }}%
                            </span>

                        </div>


                        <div
                            class="w-full
                            h-3
                            bg-white/10
                            rounded-full
                            overflow-hidden"
                        >

                            <div
                                class="h-full
                                bg-gradient-to-r
                                from-cyan-400
                                via-emerald-400
                                to-amber-400
                                rounded-full"
                                style="width: {{ $progress }}%;"
                            ></div>

                        </div>

                    </div>

                </div>



                <!-- =================================================
                     CONTENT
                ================================================== -->

                <div
                    class="px-6
                    sm:px-8
                    pb-8"
                >


                    <!-- INFORMASI -->

                    <div
                        class="inline-flex
                        items-center
                        gap-3
                        px-4
                        py-2
                        rounded-xl
                        bg-cyan-500/10
                        border
                        border-cyan-400/20
                        text-cyan-300
                        text-xs
                        font-bold
                        mb-5"
                    >

                        <i class="fa-solid fa-flask"></i>

                        QuizKU â€¢ Ulangan IPA

                    </div>



                    <!-- PERTANYAAN -->

                    <div class="mb-8">

                        <p
                            class="text-xl
                            sm:text-2xl
                            font-bold
                            leading-relaxed
                            text-white/90"
                        >

                            {{ $soal->pertanyaan }}

                        </p>

                    </div>



                    <!-- =================================================
                         FEEDBACK
                    ================================================== -->

                    <div
                        id="feedbackBox"
                        class="hidden
                        feedback-animation
                        mb-6
                        p-4
                        rounded-2xl"
                    >

                        <div
                            class="flex
                            items-center
                            gap-3"
                        >

                            <div
                                id="feedbackIcon"
                                class="w-11
                                h-11
                                rounded-xl
                                flex
                                items-center
                                justify-center
                                text-lg"
                            ></div>


                            <div>

                                <p
                                    id="feedbackTitle"
                                    class="font-black
                                    text-lg"
                                ></p>


                                <p
                                    id="feedbackText"
                                    class="text-sm
                                    text-white/60
                                    mt-1"
                                ></p>

                            </div>

                        </div>

                    </div>



                    <!-- =================================================
                         FORM
                    ================================================== -->

                    <form
                        id="jawabanForm"
                        action="{{ route('game.jawab') }}"
                        method="POST"
                    >

                        @csrf


                        <input
                            type="hidden"
                            name="soal_id"
                            value="{{ $soal->id }}"
                        >


                        <input
                            type="hidden"
                            name="jawaban"
                            id="jawabanInput"
                            value=""
                        >



                        <!-- =================================================
                             PILIHAN
                        ================================================== -->

                        <div
                            id="optionsContainer"
                            class="space-y-4"
                        >

                            @foreach($pilihan as $huruf => $teks)

                                <button
                                    type="button"
                                    class="option-btn
                                    w-full
                                    text-left
                                    bg-[#182133]
                                    border
                                    border-white/10
                                    rounded-2xl
                                    p-4
                                    sm:p-5
                                    flex
                                    items-center
                                    gap-4
                                    cursor-pointer"
                                    data-answer="{{ $huruf }}"
                                >


                                    <!-- HURUF -->

                                    <span
                                        class="letter
                                        shrink-0
                                        w-10
                                        h-10
                                        rounded-xl
                                        bg-[#2a3448]
                                        flex
                                        items-center
                                        justify-center
                                        font-black
                                        text-white/90"
                                    >

                                        {{ $huruf }}

                                    </span>



                                    <!-- JAWABAN -->

                                    <span
                                        class="flex-1
                                        font-semibold
                                        text-base
                                        sm:text-lg
                                        text-white/90"
                                    >

                                        {{ $teks }}

                                    </span>



                                    <!-- ICON -->

                                    <span
                                        class="answer-icon
                                        hidden
                                        w-8
                                        h-8
                                        rounded-full
                                        items-center
                                        justify-center
                                        text-lg"
                                    ></span>


                                </button>

                            @endforeach

                        </div>


                    </form>



                    <!-- =================================================
                         AUTO NEXT
                    ================================================== -->

                    <div
                        id="nextArea"
                        class="hidden
                        mt-6
                        text-center"
                    >

                        <p
                            class="text-white/40
                            text-xs"
                        >
                            Soal berikutnya akan tampil otomatis...
                        </p>


                        <div
                            class="mt-3
                            w-full
                            h-1.5
                            bg-white/10
                            rounded-full
                            overflow-hidden"
                        >

                            <div
                                id="nextProgress"
                                class="h-full
                                bg-cyan-400"
                                style="width: 0%;"
                            ></div>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </main>



    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script>

        const form =
            document.getElementById('jawabanForm');


        const jawabanInput =
            document.getElementById('jawabanInput');


        const buttons =
            document.querySelectorAll('.option-btn');


        const timer =
            document.getElementById('timer');


        const timerBox =
            document.getElementById('timerBox');


        const feedbackBox =
            document.getElementById('feedbackBox');


        const feedbackIcon =
            document.getElementById('feedbackIcon');


        const feedbackTitle =
            document.getElementById('feedbackTitle');


        const feedbackText =
            document.getElementById('feedbackText');


        const nextArea =
            document.getElementById('nextArea');


        const nextProgress =
            document.getElementById('nextProgress');


        let sudahMenjawab =
            false;


        let timerInterval =
            null;



        /*
        |--------------------------------------------------------------------------
        | SUARA BENAR
        |--------------------------------------------------------------------------
        */

        function playCorrectSound() {

            try {

                const AudioContext =
                    window.AudioContext ||
                    window.webkitAudioContext;


                if (!AudioContext) {
                    return;
                }


                const audio =
                    new AudioContext();


                const oscillator =
                    audio.createOscillator();


                const gain =
                    audio.createGain();


                oscillator.type = 'sine';


                oscillator.frequency.setValueAtTime(
                    523.25,
                    audio.currentTime
                );


                oscillator.frequency.exponentialRampToValueAtTime(
                    783.99,
                    audio.currentTime + 0.12
                );


                gain.gain.setValueAtTime(
                    0.0001,
                    audio.currentTime
                );


                gain.gain.exponentialRampToValueAtTime(
                    0.25,
                    audio.currentTime + 0.02
                );


                gain.gain.exponentialRampToValueAtTime(
                    0.0001,
                    audio.currentTime + 0.30
                );


                oscillator.connect(gain);

                gain.connect(audio.destination);

                oscillator.start();

                oscillator.stop(
                    audio.currentTime + 0.30
                );

            } catch (error) {

                console.log(
                    'Audio benar:',
                    error
                );

            }

        }



        /*
        |--------------------------------------------------------------------------
        | SUARA SALAH
        |--------------------------------------------------------------------------
        */

        function playWrongSound() {

            try {

                const AudioContext =
                    window.AudioContext ||
                    window.webkitAudioContext;


                if (!AudioContext) {
                    return;
                }


                const audio =
                    new AudioContext();


                const oscillator =
                    audio.createOscillator();


                const gain =
                    audio.createGain();


                oscillator.type = 'sawtooth';


                oscillator.frequency.setValueAtTime(
                    300,
                    audio.currentTime
                );


                oscillator.frequency.exponentialRampToValueAtTime(
                    120,
                    audio.currentTime + 0.25
                );


                gain.gain.setValueAtTime(
                    0.0001,
                    audio.currentTime
                );


                gain.gain.exponentialRampToValueAtTime(
                    0.22,
                    audio.currentTime + 0.02
                );


                gain.gain.exponentialRampToValueAtTime(
                    0.0001,
                    audio.currentTime + 0.35
                );


                oscillator.connect(gain);

                gain.connect(audio.destination);

                oscillator.start();

                oscillator.stop(
                    audio.currentTime + 0.35
                );

            } catch (error) {

                console.log(
                    'Audio salah:',
                    error
                );

            }

        }



        /*
        |--------------------------------------------------------------------------
        | FEEDBACK
        |--------------------------------------------------------------------------
        */

        function showFeedback(
            isCorrect,
            jawabanUser,
            kunci
        ) {

            feedbackBox.classList.remove('hidden');


            if (isCorrect) {

                feedbackBox.className =
                    'mb-6 p-4 rounded-2xl feedback-animation ' +
                    'bg-emerald-500/10 ' +
                    'border border-emerald-500/30';


                feedbackIcon.className =
                    'w-11 h-11 rounded-xl ' +
                    'flex items-center justify-center ' +
                    'text-lg bg-emerald-500/20 ' +
                    'text-emerald-400';


                feedbackIcon.innerHTML =
                    '<i class="fa-solid fa-check"></i>';


                feedbackTitle.className =
                    'font-black text-lg text-emerald-400';


                feedbackTitle.textContent =
                    'Jawaban Benar!';


                feedbackText.className =
                    'text-sm text-white/60 mt-1';


                feedbackText.textContent =
                    'Bagus! Jawaban kamu benar.';

            } else {

                feedbackBox.className =
                    'mb-6 p-4 rounded-2xl feedback-animation ' +
                    'bg-rose-500/10 ' +
                    'border border-rose-500/30';


                feedbackIcon.className =
                    'w-11 h-11 rounded-xl ' +
                    'flex items-center justify-center ' +
                    'text-lg bg-rose-500/20 ' +
                    'text-rose-400';


                feedbackIcon.innerHTML =
                    '<i class="fa-solid fa-xmark"></i>';


                feedbackTitle.className =
                    'font-black text-lg text-rose-400';


                feedbackTitle.textContent =
                    'Jawaban Belum Tepat';


                feedbackText.className =
                    'text-sm text-white/60 mt-1';


                feedbackText.innerHTML =
                    'Jawaban yang benar adalah ' +
                    '<strong class="text-emerald-400">' +
                    kunci +
                    '</strong>.';

            }



            buttons.forEach(function(button) {

                const huruf =
                    button.dataset.answer;


                const letter =
                    button.querySelector('.letter');


                const icon =
                    button.querySelector('.answer-icon');


                button.classList.add('disabled');


                if (huruf === kunci) {

                    button.classList.remove(
                        'bg-[#182133]',
                        'border-white/10'
                    );


                    button.classList.add(
                        'option-correct'
                    );


                    if (letter) {

                        letter.classList.remove(
                            'bg-[#2a3448'
                        );

                        letter.classList.add(
                            'letter-correct'
                        );

                    }


                    if (icon) {

                        icon.classList.remove(
                            'hidden'
                        );

                        icon.classList.add(
                            'flex',
                            'text-emerald-400'
                        );

                        icon.innerHTML =
                            '<i class="fa-solid fa-check"></i>';

                    }

                }


                if (
                    huruf === jawabanUser &&
                    !isCorrect
                ) {

                    button.classList.remove(
                        'bg-[#182133]',
                        'border-white/10'
                    );


                    button.classList.add(
                        'option-wrong'
                    );


                    if (letter) {

                        letter.classList.remove(
                            'bg-[#2a3448'
                        );

                        letter.classList.add(
                            'letter-wrong'
                        );

                    }


                    if (icon) {

                        icon.classList.remove(
                            'hidden'
                        );

                        icon.classList.add(
                            'flex',
                            'text-rose-400'
                        );

                        icon.innerHTML =
                            '<i class="fa-solid fa-xmark"></i>';

                    }

                }

            });


            nextArea.classList.remove('hidden');


            setTimeout(function() {

                nextProgress.style.width =
                    '100%';

            }, 50);

        }



        /*
        |--------------------------------------------------------------------------
        | KIRIM JAWABAN
        |--------------------------------------------------------------------------
        */

        async function submitAnswer(
            selectedAnswer
        ) {

            if (sudahMenjawab) {
                return;
            }


            sudahMenjawab = true;


            if (timerInterval) {

                clearInterval(
                    timerInterval
                );

            }


            jawabanInput.value =
                selectedAnswer;


            buttons.forEach(function(button) {

                button.classList.add(
                    'disabled'
                );

            });


            try {

                const formData =
                    new FormData(form);


                const response =
                    await fetch(
                        form.action,
                        {
                            method: 'POST',

                            body: formData,

                            headers: {
                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        'Server mengembalikan status ' +
                        response.status
                    );

                }


                const data =
                    await response.json();


                if (!data.success) {

                    throw new Error(
                        data.message ||
                        'Gagal memproses jawaban.'
                    );

                }


                if (data.isCorrect) {

                    playCorrectSound();

                } else {

                    playWrongSound();

                }


                showFeedback(
                    data.isCorrect,
                    data.jawabanUser,
                    data.kunci
                );


                setTimeout(function() {

                    window.location.href =
                        "{{ route('game.next') }}";

                }, 1500);


            } catch (error) {

                console.error(error);


                sudahMenjawab = false;


                buttons.forEach(function(button) {

                    button.classList.remove(
                        'disabled'
                    );

                });


                alert(
                    'Terjadi kesalahan saat memproses jawaban. ' +
                    'Silakan coba lagi.'
                );

            }

        }



        /*
        |--------------------------------------------------------------------------
        | EVENT PILIHAN
        |--------------------------------------------------------------------------
        */

        buttons.forEach(function(button) {

            button.addEventListener(
                'click',
                function() {

                    const answer =
                        this.dataset.answer;


                    submitAnswer(answer);

                }
            );

        });



        /*
        |--------------------------------------------------------------------------
        | TIMER 15 DETIK
        |--------------------------------------------------------------------------
        */

        let waktu = 15;


        timerInterval =
            setInterval(function() {

                if (sudahMenjawab) {

                    clearInterval(
                        timerInterval
                    );

                    return;

                }


                waktu--;


                timer.textContent =
                    waktu;


                if (waktu <= 5) {

                    timerBox.classList.add(
                        'timer-danger'
                    );


                    timerBox.classList.remove(
                        'text-amber-300'
                    );


                    timerBox.classList.add(
                        'text-rose-400'
                    );

                }


                if (waktu <= 0) {

                    clearInterval(
                        timerInterval
                    );


                    submitAnswer('');

                }

            }, 1000);

    </script>



    @include('components.loading')

    @include('components.sound')
@endsection

