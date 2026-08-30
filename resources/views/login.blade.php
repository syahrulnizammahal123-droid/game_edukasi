@extends('layouts.auth')

@section('title', 'Login - QuizGo')

@push('styles')
<style>
html {
            min-height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            min-height: 100dvh;
        }

        .login-page {
            min-height: 100vh;
            min-height: 100dvh;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        .login-shell {
            padding-top: clamp(10px, 2.5vh, 20px);
            padding-bottom: clamp(10px, 2.5vh, 20px);
        }

        @media (max-width: 480px) {
            .login-page {
                align-items: flex-start;
            }

            .login-shell {
                padding-top: 10px;
                padding-bottom: 10px;
            }

            .login-card {
                border-radius: 24px;
            }

            .login-header {
                padding: 20px 20px 12px;
            }

            .login-form-area {
                padding-left: 20px;
                padding-right: 20px;
                padding-bottom: 18px;
            }
        }

        @media (max-height: 760px) and (min-width: 481px) {
            .login-page {
                align-items: flex-start;
            }

            .login-shell {
                padding-top: 10px;
                padding-bottom: 10px;
            }

            .login-header {
                padding-top: 18px;
                padding-bottom: 10px;
            }

            .login-icon {
                width: 64px;
                height: 64px;
                border-radius: 18px;
            }

            .login-icon i {
                font-size: 28px;
            }

            .login-title {
                margin-top: 12px;
                font-size: 28px;
                line-height: 1.1;
            }

            .login-copy {
                display: none;
            }

            .login-form-area {
                padding-bottom: 18px;
            }

            .login-footer {
                display: none;
            }
        }
</style>
@endpush

@section('content')
<!-- =========================================================
         BACKGROUND OVERLAY
    ========================================================== -->

    <div
        class="absolute
        inset-0
        bg-[#081120]/75
        backdrop-blur-sm
        -z-10"
    ></div>


    <!-- BACKGROUND GLOW -->

    <div
        class="absolute
        top-[-10%]
        left-[-10%]
        w-96 h-96
        rounded-full
        bg-cyan-500/10
        blur-3xl
        pointer-events-none"
    ></div>


    <div
        class="absolute
        bottom-[-10%]
        right-[-10%]
        w-96 h-96
        rounded-full
        bg-blue-600/10
        blur-3xl
        pointer-events-none"
    ></div>



    <!-- =========================================================
         LOGIN CONTAINER
    ========================================================== -->

    <div
        class="login-shell
        relative
        z-10
        w-full
        max-w-sm
        transition-all
        duration-300"
    >

        <div
            class="login-card
            bg-white/10
            border border-white/10
            backdrop-blur-2xl
            rounded-[28px]
            shadow-[0_0_35px_rgba(59,130,246,0.3)]
            overflow-hidden"
        >


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div
                class="login-header
                relative
                px-6 pt-6 pb-4
                text-center"
            >


                <!-- GLOW HEADER -->

                <div
                    class="absolute
                    top-0
                    left-0
                    w-full
                    h-40
                    bg-gradient-to-b
                    from-cyan-400/25
                    to-transparent
                    pointer-events-none"
                ></div>



                <!-- =================================================
                     ICON
                ================================================== -->

                <div
                    class="login-icon
                    relative
                    z-10
                    mx-auto
                    w-20 h-20
                    rounded-2xl
                    bg-gradient-to-br
                    from-cyan-400
                    via-blue-500
                    to-blue-600
                    flex items-center
                    justify-center
                    shadow-[0_0_40px_rgba(59,130,246,0.6)]
                    transform
                    hover:rotate-3
                    transition-transform
                    duration-300"
                >

                    <i
                        class="fa-solid
                        fa-flask
                        text-white
                        text-3xl"
                    ></i>

                </div>



                <!-- =================================================
                     BRAND
                ================================================== -->

                <h1
                    class="login-title
                    mt-4
                    text-3xl
                    font-extrabold
                    text-white
                    tracking-tight"
                >
                    QuizGo
                </h1>


                <p
                    class="mt-2
                    max-w-xs
                    mx-auto
                    text-cyan-200
                    text-sm
                    leading-relaxed
                    font-semibold"
                >
                    Belajar, bermain, dan uji pemahamanmu
                    dengan cara yang menyenangkan.
                </p>


            </div>



            <!-- =================================================
                 FORM AREA
            ================================================== -->

            <div
                class="login-form-area
                px-6
                pb-5"
            >


                <!-- =================================================
                     ERROR SESSION
                ================================================== -->

                @if(session('error'))

                    <div
                        class="mb-5
                        bg-red-500/20
                        border border-red-500/30
                        text-red-200
                        px-4 py-3
                        rounded-2xl
                        text-xs
                        font-medium
                        flex items-center
                        gap-2"
                    >

                        <i
                            class="fa-solid
                            fa-triangle-exclamation
                            text-red-400"
                        ></i>


                        <span>
                            {{ session('error') }}
                        </span>

                    </div>

                @endif



                <!-- =================================================
                     VALIDATION ERROR
                ================================================== -->

                @if($errors->any())

                    <div
                        class="mb-5
                        bg-red-500/20
                        border border-red-500/30
                        text-red-200
                        px-4 py-3
                        rounded-2xl
                        text-xs
                        font-medium
                        space-y-1"
                    >

                        @foreach($errors->all() as $error)

                            <div
                                class="flex
                                items-center
                                gap-2"
                            >

                                <i
                                    class="fa-solid
                                    fa-circle-exclamation
                                    text-red-400
                                    text-[10px]"
                                ></i>


                                <span>
                                    {{ $error }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                @endif



                <!-- =================================================
                     LOGIN FORM
                ================================================== -->

                <form
                    method="POST"
                    action="{{ url('/login') }}"
                    class="space-y-4"
                >

                    @csrf



                    <!-- =================================================
                         EMAIL
                    ================================================== -->

                    <div>

                        <label
                            class="text-white/90
                            text-xs
                            font-semibold
                            mb-2
                            block
                            uppercase
                            tracking-wider"
                        >
                            Email
                        </label>


                        <div
                            class="relative
                            group"
                        >

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan email siswa"
                                required
                                autocomplete="email"
                                class="w-full
                                bg-white/5
                                border border-white/10
                                rounded-2xl
                                px-5 py-3
                                pl-14
                                text-white
                                placeholder:text-white/30
                                focus:outline-none
                                focus:ring-2
                                focus:ring-cyan-400/50
                                focus:border-cyan-400/50
                                focus:bg-white/10
                                transition-all
                                duration-200
                                text-sm"
                            >


                            <i
                                class="fa-solid
                                fa-envelope
                                absolute
                                left-5
                                top-1/2
                                -translate-y-1/2
                                text-cyan-400
                                text-sm
                                transition-transform
                                group-focus-within:scale-105"
                            ></i>

                        </div>

                    </div>



                    <!-- =================================================
                         PASSWORD
                    ================================================== -->

                    <div>

                        <label
                            class="text-white/90
                            text-xs
                            font-semibold
                            mb-2
                            block
                            uppercase
                            tracking-wider"
                        >
                            Password
                        </label>


                        <div
                            class="relative
                            group"
                            id="passwordGroup"
                        >

                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Masukkan password"
                                required
                                autocomplete="current-password"
                                class="w-full
                                bg-white/5
                                border border-white/10
                                rounded-2xl
                                px-5 py-3
                                pl-14
                                pr-14
                                text-white
                                placeholder:text-white/30
                                focus:outline-none
                                focus:ring-2
                                focus:ring-cyan-400/50
                                focus:border-cyan-400/50
                                focus:bg-white/10
                                transition-all
                                duration-200
                                text-sm"
                            >


                            <i
                                class="fa-solid
                                fa-lock
                                absolute
                                left-5
                                top-1/2
                                -translate-y-1/2
                                text-cyan-400
                                text-sm
                                transition-transform
                                group-focus-within:scale-105"
                            ></i>


                            <!-- TOGGLE PASSWORD -->

                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute
                                right-5
                                top-1/2
                                -translate-y-1/2
                                text-cyan-400/60
                                hover:text-cyan-300
                                transition-colors
                                focus:outline-none
                                p-1"
                                title="Lihat atau sembunyikan password"
                            >

                                <i
                                    class="fa-solid
                                    fa-eye"
                                    id="toggleIcon"
                                ></i>

                            </button>

                        </div>

                    </div>



                    <!-- =================================================
                         BUTTON MASUK
                    ================================================== -->

                    <div class="pt-2">

                        <button
                            type="submit"
                            class="w-full
                            py-3
                            rounded-2xl
                            bg-gradient-to-r
                            from-cyan-400
                            via-blue-500
                            to-blue-600
                            text-white
                            font-extrabold
                            text-md
                            shadow-[0_0_30px_rgba(59,130,246,0.4)]
                            hover:shadow-[0_0_40px_rgba(59,130,246,0.6)]
                            hover:scale-[1.01]
                            active:scale-[0.99]
                            transition-all
                            duration-200
                            uppercase
                            tracking-wide"
                        >

                            Masuk ke QuizGo

                            <i
                                class="fa-solid
                                fa-right-to-bracket
                                text-xs
                                ml-1"
                            ></i>

                        </button>

                    </div>


                </form>



                <!-- =================================================
                     REGISTER
                ================================================== -->

                <p
                    class="text-center
                    text-white/50
                    text-xs
                    font-medium
                    mt-4"
                >

                    Belum memiliki akun?

                    <a
                        href="{{ url('/register') }}"
                        class="text-cyan-300
                        font-bold
                        hover:text-cyan-200
                        underline
                        underline-offset-4
                        transition-colors
                        ml-1"
                    >
                        Daftar Di Sini
                    </a>

                </p>



                <!-- =================================================
                     FOOTER INFO
                ================================================== -->

                <div
                    class="login-footer
                    hidden
                    mt-4
                    pt-3
                    border-t
                    border-white/5
                    text-center"
                >

                    <p
                        class="text-[10px]
                        text-white/30
                        leading-relaxed"
                    >

                        QuizGo membantu siswa
                        mengerjakan ulangan IPA
                        secara interaktif dan menyenangkan.

                    </p>

                </div>


            </div>

        </div>

    </div>



    <!-- =========================================================
         SOUND
    ========================================================== -->

    @include('components.sound')



    <!-- =========================================================
         PASSWORD SCRIPT
    ========================================================== -->

    <script>

        function togglePassword() {

            const passwordField =
                document.getElementById('password');


            const toggleIcon =
                document.getElementById('toggleIcon');


            if (
                passwordField.type === 'password'
            ) {

                passwordField.type = 'text';

                toggleIcon.classList.remove(
                    'fa-eye'
                );

                toggleIcon.classList.add(
                    'fa-eye-slash'
                );

            } else {

                passwordField.type = 'password';

                toggleIcon.classList.remove(
                    'fa-eye-slash'
                );

                toggleIcon.classList.add(
                    'fa-eye'
                );

            }

        }

    </script>
@endsection

