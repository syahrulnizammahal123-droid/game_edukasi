@extends('layouts.guest')

@section('title', 'QuizGo - Ulangan IPA Interaktif')
@section('body_class', 'min-h-screen bg-cover bg-center bg-fixed text-white overflow-x-hidden')
@section('body_style')
    background-image:url('{{ asset('images/bg-login.jpg') }}')
@endsection

@push('styles')
<style>
body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,0.10);
        }

        .floating {
            animation: floating 4s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

        }

        .hero-glow {
            animation: glow 4s ease-in-out infinite;
        }

        @keyframes glow {

            0%,
            100% {
                opacity: 0.35;
            }

            50% {
                opacity: 0.65;
            }

        }
</style>
@endpush

@section('content')
<!-- =========================================================
         BACKGROUND OVERLAY
    ========================================================== -->

    <div
        class="fixed
        inset-0
        bg-[#07111f]/85
        -z-10"
    ></div>


    <div
        class="fixed
        top-[-120px]
        left-[-120px]
        w-96
        h-96
        rounded-full
        bg-cyan-400/10
        blur-3xl
        hero-glow
        -z-10"
    ></div>


    <div
        class="fixed
        bottom-[-120px]
        right-[-120px]
        w-96
        h-96
        rounded-full
        bg-blue-500/10
        blur-3xl
        hero-glow
        -z-10"
    ></div>



    <!-- =========================================================
         NAVBAR
    ========================================================== -->

    <header
        class="relative
        z-20
        max-w-7xl
        mx-auto
        px-5
        lg:px-8
        pt-6"
    >

        <nav
            class="glass
            rounded-[25px]
            px-5
            py-4
            flex
            items-center
            justify-between"
        >


            <!-- BRAND -->

            <div
                class="flex
                items-center
                gap-3"
            >

                <div
                    class="w-11
                    h-11
                    rounded-2xl
                    bg-gradient-to-br
                    from-cyan-400
                    to-blue-600
                    flex
                    items-center
                    justify-center
                    shadow-lg
                    shadow-cyan-500/20"
                >

                    <i
                        class="fa-solid
                        fa-flask
                        text-white
                        text-lg"
                    ></i>

                </div>


                <div>

                    <h1
                        class="text-white
                        font-extrabold
                        text-lg
                        leading-none"
                    >
                        QuizGo
                    </h1>


                    <p
                        class="text-cyan-400
                        text-[9px]
                        uppercase
                        tracking-[0.18em]
                        font-bold
                        mt-1"
                    >
                        Ulangan IPA
                    </p>

                </div>

            </div>



            <!-- NAVIGASI -->

            <div
                class="flex
                items-center
                gap-2"
            >

                @auth

                    <a
                        href="{{ url('/dashboard') }}"
                        class="px-4
                        py-2.5
                        rounded-xl
                        bg-white/10
                        hover:bg-white/20
                        text-white
                        text-xs
                        font-bold
                        transition"
                    >

                        <i
                            class="fa-solid
                            fa-house
                            mr-1.5"
                        ></i>

                        Dashboard

                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="px-4
                        py-2.5
                        rounded-xl
                        bg-white/10
                        hover:bg-white/20
                        text-white
                        text-xs
                        font-bold
                        transition"
                    >

                        Masuk

                    </a>


                    @if(Route::has('register'))

                        <a
                            href="{{ route('register') }}"
                            class="px-4
                            py-2.5
                            rounded-xl
                            bg-cyan-500
                            hover:bg-cyan-400
                            text-white
                            text-xs
                            font-bold
                            transition
                            shadow-lg
                            shadow-cyan-500/20"
                        >

                            Daftar

                        </a>

                    @endif

                @endauth

            </div>

        </nav>

    </header>



    <!-- =========================================================
         HERO
    ========================================================== -->

    <main
        class="relative
        z-10
        max-w-7xl
        mx-auto
        px-5
        lg:px-8"
    >

        <section
            class="min-h-[calc(100vh-110px)]
            flex
            items-center
            py-16
            lg:py-20"
        >

            <div
                class="grid
                grid-cols-1
                lg:grid-cols-2
                gap-12
                lg:gap-20
                items-center
                w-full"
            >


                <!-- =================================================
                     LEFT
                ================================================== -->

                <div>

                    <div
                        class="inline-flex
                        items-center
                        gap-2
                        px-4
                        py-2
                        rounded-full
                        bg-cyan-500/10
                        border
                        border-cyan-400/20
                        text-cyan-300
                        text-xs
                        font-bold
                        mb-6"
                    >

                        <i
                            class="fa-solid
                            fa-flask"
                        ></i>

                        Media Pembelajaran IPA

                    </div>


                    <h2
                        class="text-5xl
                        sm:text-6xl
                        lg:text-7xl
                        font-black
                        leading-[1.05]
                        tracking-tight"
                    >

                        Belajar IPA

                        <span
                            class="block
                            text-transparent
                            bg-clip-text
                            bg-gradient-to-r
                            from-cyan-300
                            via-blue-400
                            to-purple-400"
                        >
                            Jadi Lebih Menyenangkan.
                        </span>

                    </h2>


                    <p
                        class="text-white/60
                        text-base
                        lg:text-lg
                        leading-relaxed
                        mt-6
                        max-w-xl"
                    >

                        <strong class="text-white">
                            QuizGo
                        </strong>

                        adalah media pembelajaran interaktif
                        yang membantu siswa menguji pemahaman
                        materi IPA melalui ulangan yang menarik,
                        sederhana, dan menyenangkan.

                    </p>



                    <!-- CTA -->

                    <div
                        class="flex
                        flex-col
                        sm:flex-row
                        gap-3
                        mt-8"
                    >

                        @auth

                            <a
                                href="{{ url('/dashboard') }}"
                                class="px-7
                                py-4
                                rounded-2xl
                                bg-gradient-to-r
                                from-cyan-400
                                to-blue-600
                                text-white
                                font-extrabold
                                text-sm
                                shadow-xl
                                shadow-blue-500/20
                                hover:scale-[1.02]
                                transition"
                            >

                                <i
                                    class="fa-solid
                                    fa-house
                                    mr-2"
                                ></i>

                                Masuk ke Dashboard

                            </a>

                        @else

                            <a
                                href="{{ route('login') }}"
                                class="px-7
                                py-4
                                rounded-2xl
                                bg-gradient-to-r
                                from-cyan-400
                                to-blue-600
                                text-white
                                font-extrabold
                                text-sm
                                shadow-xl
                                shadow-blue-500/20
                                hover:scale-[1.02]
                                transition"
                            >

                                <i
                                    class="fa-solid
                                    fa-right-to-bracket
                                    mr-2"
                                ></i>

                                Mulai Belajar

                            </a>


                            @if(Route::has('register'))

                                <a
                                    href="{{ route('register') }}"
                                    class="px-7
                                    py-4
                                    rounded-2xl
                                    bg-white/5
                                    border
                                    border-white/10
                                    text-white
                                    font-bold
                                    text-sm
                                    hover:bg-white/10
                                    transition"
                                >

                                    Buat Akun

                                </a>

                            @endif

                        @endauth

                    </div>



                    <!-- MINI INFO -->

                    <div
                        class="grid
                        grid-cols-3
                        gap-3
                        max-w-lg
                        mt-10"
                    >

                        <div
                            class="glass
                            rounded-2xl
                            p-4"
                        >

                            <div
                                class="text-cyan-400
                                text-lg
                                mb-2"
                            >

                                <i class="fa-solid fa-book-open"></i>

                            </div>


                            <p
                                class="text-white
                                font-bold
                                text-sm"
                            >
                                IPA
                            </p>


                            <p
                                class="text-white/40
                                text-[10px]
                                mt-1"
                            >
                                Materi
                            </p>

                        </div>



                        <div
                            class="glass
                            rounded-2xl
                            p-4"
                        >

                            <div
                                class="text-purple-400
                                text-lg
                                mb-2"
                            >

                                <i class="fa-solid fa-pen-to-square"></i>

                            </div>


                            <p
                                class="text-white
                                font-bold
                                text-sm"
                            >
                                3 Ulangan
                            </p>


                            <p
                                class="text-white/40
                                text-[10px]
                                mt-1"
                            >
                                Interaktif
                            </p>

                        </div>



                        <div
                            class="glass
                            rounded-2xl
                            p-4"
                        >

                            <div
                                class="text-amber-400
                                text-lg
                                mb-2"
                            >

                                <i class="fa-solid fa-trophy"></i>

                            </div>


                            <p
                                class="text-white
                                font-bold
                                text-sm"
                            >
                                Peringkat
                            </p>


                            <p
                                class="text-white/40
                                text-[10px]
                                mt-1"
                            >
                                Motivasi
                            </p>

                        </div>

                    </div>

                </div>



                <!-- =================================================
                     RIGHT VISUAL
                ================================================== -->

                <div
                    class="relative
                    flex
                    justify-center
                    lg:justify-end"
                >


                    <!-- DECORATION -->

                    <div
                        class="absolute
                        w-80
                        h-80
                        rounded-full
                        bg-cyan-400/10
                        blur-3xl"
                    ></div>


                    <!-- MAIN CARD -->

                    <div
                        class="relative
                        floating
                        w-full
                        max-w-md
                        glass
                        rounded-[40px]
                        p-7
                        border
                        border-white/10
                        shadow-2xl"
                    >


                        <!-- HEADER CARD -->

                        <div
                            class="flex
                            items-center
                            justify-between
                            mb-6"
                        >

                            <div>

                                <p
                                    class="text-cyan-300
                                    text-xs
                                    font-bold
                                    uppercase
                                    tracking-wider"
                                >
                                    QuizGo
                                </p>


                                <h3
                                    class="text-white
                                    text-xl
                                    font-extrabold
                                    mt-1"
                                >
                                    Ulangan IPA
                                </h3>

                            </div>


                            <div
                                class="w-12
                                h-12
                                rounded-2xl
                                bg-gradient-to-br
                                from-cyan-400
                                to-blue-600
                                flex
                                items-center
                                justify-center"
                            >

                                <i
                                    class="fa-solid
                                    fa-atom
                                    text-white"
                                ></i>

                            </div>

                        </div>



                        <!-- QUESTION CARD -->

                        <div
                            class="rounded-[28px]
                            bg-white/5
                            border
                            border-white/10
                            p-5"
                        >

                            <div
                                class="flex
                                items-center
                                justify-between
                                mb-5"
                            >

                                <span
                                    class="px-3
                                    py-1.5
                                    rounded-xl
                                    bg-cyan-500/10
                                    text-cyan-300
                                    text-[10px]
                                    font-bold"
                                >
                                    SOAL 01
                                </span>


                                <span
                                    class="text-amber-400
                                    text-xs
                                    font-bold"
                                >

                                    <i
                                        class="fa-solid
                                        fa-stopwatch
                                        mr-1"
                                    ></i>

                                    15 detik

                                </span>

                            </div>


                            <p
                                class="text-white
                                font-bold
                                text-lg
                                leading-relaxed
                                mb-5"
                            >
                                Bagian tumbuhan yang berfungsi
                                menyerap air dan mineral dari tanah adalah...
                            </p>



                            <!-- OPTIONS -->

                            <div class="space-y-2">

                                <div
                                    class="rounded-xl
                                    bg-cyan-500/10
                                    border
                                    border-cyan-400/30
                                    p-3
                                    flex
                                    items-center
                                    gap-3"
                                >

                                    <span
                                        class="w-8
                                        h-8
                                        rounded-lg
                                        bg-cyan-500
                                        flex
                                        items-center
                                        justify-center
                                        text-xs
                                        font-black"
                                    >
                                        A
                                    </span>


                                    <span
                                        class="text-sm
                                        text-white/80
                                        font-medium"
                                    >
                                        Akar
                                    </span>

                                </div>


                                <div
                                    class="rounded-xl
                                    bg-white/5
                                    border
                                    border-white/10
                                    p-3
                                    flex
                                    items-center
                                    gap-3"
                                >

                                    <span
                                        class="w-8
                                        h-8
                                        rounded-lg
                                        bg-white/10
                                        flex
                                        items-center
                                        justify-center
                                        text-xs
                                        font-black"
                                    >
                                        B
                                    </span>


                                    <span
                                        class="text-sm
                                        text-white/60"
                                    >
                                        Batang
                                    </span>

                                </div>


                                <div
                                    class="rounded-xl
                                    bg-white/5
                                    border
                                    border-white/10
                                    p-3
                                    flex
                                    items-center
                                    gap-3"
                                >

                                    <span
                                        class="w-8
                                        h-8
                                        rounded-lg
                                        bg-white/10
                                        flex
                                        items-center
                                        justify-center
                                        text-xs
                                        font-black"
                                    >
                                        C
                                    </span>


                                    <span
                                        class="text-sm
                                        text-white/60"
                                    >
                                        Daun
                                    </span>

                                </div>

                            </div>

                        </div>



                        <!-- PROGRESS -->

                        <div class="mt-5">

                            <div
                                class="flex
                                justify-between
                                mb-2"
                            >

                                <span
                                    class="text-[10px]
                                    text-white/40"
                                >
                                    Progres Ulangan
                                </span>


                                <span
                                    class="text-[10px]
                                    text-cyan-300
                                    font-bold"
                                >
                                    65%
                                </span>

                            </div>


                            <div
                                class="h-2
                                bg-white/10
                                rounded-full
                                overflow-hidden"
                            >

                                <div
                                    class="h-full
                                    w-[65%]
                                    rounded-full
                                    bg-gradient-to-r
                                    from-cyan-400
                                    to-blue-600"
                                ></div>

                            </div>

                        </div>


                    </div>

                </div>


            </div>

        </section>



        <!-- =========================================================
             FITUR
        ========================================================== -->

        <section
            class="pb-20"
        >

            <div
                class="text-center
                mb-10"
            >

                <p
                    class="text-cyan-400
                    text-xs
                    font-bold
                    uppercase
                    tracking-widest"
                >
                    Kenapa QuizGo?
                </p>


                <h2
                    class="text-3xl
                    lg:text-4xl
                    font-extrabold
                    mt-2"
                >
                    Ulangan Jadi Lebih Menarik
                </h2>

            </div>


            <div
                class="grid
                grid-cols-1
                md:grid-cols-3
                gap-5"
            >


                <!-- FITUR 1 -->

                <div
                    class="glass
                    rounded-[30px]
                    p-6"
                >

                    <div
                        class="w-14
                        h-14
                        rounded-2xl
                        bg-cyan-500/10
                        border
                        border-cyan-400/20
                        flex
                        items-center
                        justify-center
                        text-cyan-400
                        text-xl
                        mb-5"
                    >

                        <i class="fa-solid fa-circle-question"></i>

                    </div>


                    <h3
                        class="text-white
                        text-lg
                        font-bold
                        mb-2"
                    >
                        Soal Interaktif
                    </h3>


                    <p
                        class="text-white/50
                        text-sm
                        leading-relaxed"
                    >

                        Siswa dapat mengerjakan soal IPA
                        dengan tampilan sederhana dan interaktif.

                    </p>

                </div>



                <!-- FITUR 2 -->

                <div
                    class="glass
                    rounded-[30px]
                    p-6"
                >

                    <div
                        class="w-14
                        h-14
                        rounded-2xl
                        bg-purple-500/10
                        border
                        border-purple-400/20
                        flex
                        items-center
                        justify-center
                        text-purple-400
                        text-xl
                        mb-5"
                    >

                        <i class="fa-solid fa-chart-line"></i>

                    </div>


                    <h3
                        class="text-white
                        text-lg
                        font-bold
                        mb-2"
                    >
                        Hasil Belajar
                    </h3>


                    <p
                        class="text-white/50
                        text-sm
                        leading-relaxed"
                    >

                        Hasil ulangan dapat digunakan untuk
                        melihat perkembangan pemahaman siswa.

                    </p>

                </div>



                <!-- FITUR 3 -->

                <div
                    class="glass
                    rounded-[30px]
                    p-6"
                >

                    <div
                        class="w-14
                        h-14
                        rounded-2xl
                        bg-amber-500/10
                        border
                        border-amber-400/20
                        flex
                        items-center
                        justify-center
                        text-amber-400
                        text-xl
                        mb-5"
                    >

                        <i class="fa-solid fa-trophy"></i>

                    </div>


                    <h3
                        class="text-white
                        text-lg
                        font-bold
                        mb-2"
                    >
                        Peringkat
                    </h3>


                    <p
                        class="text-white/50
                        text-sm
                        leading-relaxed"
                    >

                        Sistem peringkat memberikan motivasi
                        kepada siswa untuk meningkatkan hasil ulangan.

                    </p>

                </div>


            </div>

        </section>

    </main>



    <!-- =========================================================
         FOOTER
    ========================================================== -->

    <footer
        class="border-t
        border-white/10
        py-6"
    >

        <div
            class="max-w-7xl
            mx-auto
            px-5
            lg:px-8
            flex
            flex-col
            sm:flex-row
            items-center
            justify-between
            gap-3"
        >

            <p
                class="text-white/30
                text-xs"
            >
                Â© {{ date('Y') }} QuizGo
            </p>


            <p
                class="text-white/30
                text-xs"
            >
                Media Pembelajaran Ulangan IPA Interaktif
            </p>

        </div>

    </footer>
@endsection

