@extends('layouts.game')

@section('title', 'Ulangan IPA - QuizKU')

@push('styles')
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

        .answer-btn {
            transition: all 0.3s ease;
        }

        .answer-btn:hover {
            transform: translateY(-4px);
        }
</style>
@endpush

@section('content')
<!-- OVERLAY -->

    <div
        class="fixed inset-0
        bg-[#07111f]/85
        -z-10"
    ></div>


    <!-- GLOW -->

    <div
        class="absolute top-0 left-0
        w-72 h-72
        bg-cyan-400/20
        blur-3xl
        rounded-full"
    ></div>


    <div
        class="absolute bottom-0 right-0
        w-72 h-72
        bg-purple-500/20
        blur-3xl
        rounded-full"
    ></div>



    <!-- MAIN -->

    <div
        class="relative z-10
        min-h-screen
        p-5 lg:p-8
        pb-32"
    >

        <div class="max-w-6xl mx-auto">


            <!-- =====================================================
                 TOPBAR
            ====================================================== -->

            <div
                class="glass
                rounded-[35px]
                p-5 lg:p-6
                mb-8"
            >

                <div
                    class="grid
                    grid-cols-2
                    lg:grid-cols-5
                    gap-5"
                >


                    <!-- ULANGAN -->

                    <div
                        class="bg-white/5
                        border border-white/10
                        rounded-3xl
                        p-5"
                    >

                        <div
                            class="flex items-center gap-4"
                        >

                            <div
                                class="w-14 h-14
                                rounded-2xl
                                bg-gradient-to-br
                                from-cyan-400
                                to-blue-600
                                flex items-center
                                justify-center"
                            >

                                <i
                                    class="fa-solid
                                    fa-file-pen
                                    text-white
                                    text-xl"
                                ></i>

                            </div>


                            <div>

                                <p class="text-white/60 text-sm">
                                    Ulangan
                                </p>

                                <h2
                                    class="text-white
                                    text-2xl
                                    font-bold"
                                >

                                    {{ session('level') }}

                                </h2>

                            </div>

                        </div>

                    </div>



                    <!-- SKOR -->

                    <div
                        class="bg-white/5
                        border border-white/10
                        rounded-3xl
                        p-5"
                    >

                        <div
                            class="flex items-center gap-4"
                        >

                            <div
                                class="w-14 h-14
                                rounded-2xl
                                bg-gradient-to-br
                                from-yellow-400
                                to-orange-500
                                flex items-center
                                justify-center"
                            >

                                <i
                                    class="fa-solid
                                    fa-trophy
                                    text-white
                                    text-xl"
                                ></i>

                            </div>


                            <div>

                                <p class="text-white/60 text-sm">
                                    Skor
                                </p>

                                <h2
                                    class="text-white
                                    text-2xl
                                    font-bold"
                                >

                                    {{ session('score', 0) }}

                                </h2>

                            </div>

                        </div>

                    </div>



                    <!-- COMBO -->

                    <div
                        class="bg-white/5
                        border border-white/10
                        rounded-3xl
                        p-5"
                    >

                        <div
                            class="flex items-center gap-4"
                        >

                            <div
                                class="w-14 h-14
                                rounded-2xl
                                bg-gradient-to-br
                                from-pink-500
                                to-purple-600
                                flex items-center
                                justify-center"
                            >

                                <i
                                    class="fa-solid
                                    fa-fire
                                    text-white
                                    text-xl"
                                ></i>

                            </div>


                            <div>

                                <p class="text-white/60 text-sm">
                                    Streak
                                </p>

                                <h2
                                    class="text-white
                                    text-2xl
                                    font-bold"
                                >

                                    {{ session('combo', 0) }}

                                </h2>

                            </div>

                        </div>

                    </div>



                    <!-- XP -->

                    <div
                        class="bg-white/5
                        border border-white/10
                        rounded-3xl
                        p-5"
                    >

                        <div
                            class="flex items-center gap-4"
                        >

                            <div
                                class="w-14 h-14
                                rounded-2xl
                                bg-gradient-to-br
                                from-green-400
                                to-emerald-600
                                flex items-center
                                justify-center"
                            >

                                <i
                                    class="fa-solid
                                    fa-bolt
                                    text-white
                                    text-xl"
                                ></i>

                            </div>


                            <div>

                                <p class="text-white/60 text-sm">
                                    XP
                                </p>

                                <h2
                                    class="text-white
                                    text-2xl
                                    font-bold"
                                >

                                    {{ session('score', 0) * 10 }}

                                </h2>

                            </div>

                        </div>

                    </div>



                    <!-- SOAL -->

                    <div
                        class="bg-white/5
                        border border-white/10
                        rounded-3xl
                        p-5"
                    >

                        <div
                            class="flex items-center gap-4"
                        >

                            <div
                                class="w-14 h-14
                                rounded-2xl
                                bg-gradient-to-br
                                from-cyan-500
                                to-blue-700
                                flex items-center
                                justify-center"
                            >

                                <i
                                    class="fa-solid
                                    fa-book-open
                                    text-white
                                    text-xl"
                                ></i>

                            </div>


                            <div>

                                <p class="text-white/60 text-sm">
                                    Soal
                                </p>

                                <h2
                                    class="text-white
                                    text-2xl
                                    font-bold"
                                >

                                    {{ session('soal_ke', 1) }}

                                </h2>

                            </div>

                        </div>

                    </div>


                </div>

            </div>



            <!-- =====================================================
                 ULANGAN CARD
            ====================================================== -->

            <div
                class="glass
                rounded-[40px]
                p-6 lg:p-10
                mb-8"
            >


                <!-- HEADER -->

                <div class="mb-8">

                    <div
                        class="inline-flex
                        items-center gap-3
                        px-5 py-3
                        rounded-2xl
                        bg-cyan-500/20
                        border border-cyan-400/20
                        text-cyan-300
                        font-semibold
                        mb-6"
                    >

                        <i class="fa-solid fa-flask"></i>

                        <span>
                            Ulangan IPA
                        </span>

                    </div>


                    <h1
                        class="text-3xl
                        lg:text-5xl
                        font-extrabold
                        text-white
                        leading-relaxed"
                    >

                        {{ $soal->pertanyaan }}

                    </h1>

                </div>



                <!-- FORM JAWABAN -->

                <form
                    action="/game/jawab"
                    method="POST"
                >

                    @csrf


                    <!-- ANSWERS -->

                    <div class="grid grid-cols-1 gap-5">


                        <!-- A -->

                        <button
                            type="submit"
                            name="jawaban"
                            value="A"
                            class="answer-btn
                            text-left
                            bg-white/5
                            border border-white/10
                            hover:border-cyan-400/30
                            hover:bg-cyan-500/10
                            rounded-[30px]
                            p-5"
                        >

                            <div
                                class="flex
                                items-center
                                gap-5"
                            >

                                <div
                                    class="w-16 h-16
                                    rounded-2xl
                                    bg-gradient-to-br
                                    from-cyan-400
                                    to-blue-600
                                    flex items-center
                                    justify-center
                                    text-white
                                    font-bold
                                    text-2xl
                                    shrink-0"
                                >

                                    A

                                </div>


                                <div>

                                    <p
                                        class="text-white
                                        text-xl
                                        font-semibold"
                                    >
                                        {{ $soal->A }}
                                    </p>

                                </div>

                            </div>

                        </button>



                        <!-- B -->

                        <button
                            type="submit"
                            name="jawaban"
                            value="B"
                            class="answer-btn
                            text-left
                            bg-white/5
                            border border-white/10
                            hover:border-purple-400/30
                            hover:bg-purple-500/10
                            rounded-[30px]
                            p-5"
                        >

                            <div
                                class="flex
                                items-center
                                gap-5"
                            >

                                <div
                                    class="w-16 h-16
                                    rounded-2xl
                                    bg-gradient-to-br
                                    from-purple-500
                                    to-pink-600
                                    flex items-center
                                    justify-center
                                    text-white
                                    font-bold
                                    text-2xl
                                    shrink-0"
                                >

                                    B

                                </div>


                                <div>

                                    <p
                                        class="text-white
                                        text-xl
                                        font-semibold"
                                    >
                                        {{ $soal->B }}
                                    </p>

                                </div>

                            </div>

                        </button>



                        <!-- C -->

                        <button
                            type="submit"
                            name="jawaban"
                            value="C"
                            class="answer-btn
                            text-left
                            bg-white/5
                            border border-white/10
                            hover:border-green-400/30
                            hover:bg-green-500/10
                            rounded-[30px]
                            p-5"
                        >

                            <div
                                class="flex
                                items-center
                                gap-5"
                            >

                                <div
                                    class="w-16 h-16
                                    rounded-2xl
                                    bg-gradient-to-br
                                    from-green-400
                                    to-emerald-600
                                    flex items-center
                                    justify-center
                                    text-white
                                    font-bold
                                    text-2xl
                                    shrink-0"
                                >

                                    C

                                </div>


                                <div>

                                    <p
                                        class="text-white
                                        text-xl
                                        font-semibold"
                                    >
                                        {{ $soal->C }}
                                    </p>

                                </div>

                            </div>

                        </button>



                        <!-- D -->

                        <button
                            type="submit"
                            name="jawaban"
                            value="D"
                            class="answer-btn
                            text-left
                            bg-white/5
                            border border-white/10
                            hover:border-orange-400/30
                            hover:bg-orange-500/10
                            rounded-[30px]
                            p-5"
                        >

                            <div
                                class="flex
                                items-center
                                gap-5"
                            >

                                <div
                                    class="w-16 h-16
                                    rounded-2xl
                                    bg-gradient-to-br
                                    from-orange-500
                                    to-red-600
                                    flex items-center
                                    justify-center
                                    text-white
                                    font-bold
                                    text-2xl
                                    shrink-0"
                                >

                                    D

                                </div>


                                <div>

                                    <p
                                        class="text-white
                                        text-xl
                                        font-semibold"
                                    >
                                        {{ $soal->D }}
                                    </p>

                                </div>

                            </div>

                        </button>


                    </div>

                </form>

            </div>



            <!-- =====================================================
                 PROGRESS
            ====================================================== -->

            <div
                class="glass
                rounded-[35px]
                p-6"
            >

                <div
                    class="flex
                    items-center
                    justify-between
                    mb-4"
                >

                    <p
                        class="text-white
                        font-semibold"
                    >
                        Progres Ulangan
                    </p>


                    <p
                        class="text-cyan-300
                        font-bold"
                    >

                        {{ min(session('score', 0), 100) }}%

                    </p>

                </div>


                <div
                    class="w-full
                    h-5
                    rounded-full
                    bg-white/10
                    overflow-hidden"
                >

                    <div
                        class="h-full
                        rounded-full
                        bg-gradient-to-r
                        from-cyan-400
                        via-blue-500
                        to-purple-600"
                        style="width: {{ min(session('score', 0), 100) }}%"
                    ></div>

                </div>

            </div>


        </div>

    </div>


    <!-- SOUND -->

    @include('components.sound')
@endsection

