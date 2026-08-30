@extends('layouts.auth')

@section('title', 'Daftar - QuizGo')

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

        .register-page {
            min-height: 100vh;
            min-height: 100dvh;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .register-shell {
            padding-top: clamp(8px, 2vh, 16px);
            padding-bottom: clamp(8px, 2vh, 16px);
        }

        @media (max-width: 480px), (max-height: 760px) {
            .register-page {
                align-items: flex-start;
            }

            .register-shell {
                padding-top: 8px;
                padding-bottom: 8px;
            }

            .register-card {
                border-radius: 22px;
            }

            .register-header {
                padding: 16px 18px 10px;
            }

            .register-icon {
                width: 52px;
                height: 52px;
                border-radius: 16px;
            }

            .register-icon i {
                font-size: 22px;
            }

            .register-title {
                margin-top: 10px;
                font-size: 24px;
                line-height: 1.1;
            }

            .register-form-area {
                padding-left: 18px;
                padding-right: 18px;
                padding-bottom: 16px;
            }
        }
</style>
@endpush

@section('content')
<!-- =========================================================
         BACKGROUND
    ========================================================== -->

    <div
        class="absolute
        inset-0
        bg-[#081120]/75
        backdrop-blur-sm
        -z-10"
    ></div>


    <div
        class="absolute
        top-[-10%]
        right-[-10%]
        w-96 h-96
        rounded-full
        bg-cyan-500/10
        blur-3xl
        pointer-events-none"
    ></div>


    <div
        class="absolute
        bottom-[-10%]
        left-[-10%]
        w-96 h-96
        rounded-full
        bg-blue-600/10
        blur-3xl
        pointer-events-none"
    ></div>



    <!-- =========================================================
         REGISTER CONTAINER
    ========================================================== -->

    <div
        class="register-shell
        relative
        z-10
        w-full
        max-w-sm
        transition-all
        duration-300"
    >

        <div
            class="register-card
            bg-white/10
            border border-white/10
            backdrop-blur-2xl
            rounded-[26px]
            shadow-[0_0_35px_rgba(59,130,246,0.3)]
            overflow-hidden"
        >


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div
                class="register-header
                relative
                px-6 pt-5 pb-3
                text-center"
            >

                <!-- GLOW -->

                <div
                    class="absolute
                    top-0
                    left-0
                    w-full
                    h-32
                    bg-gradient-to-b
                    from-cyan-400/25
                    to-transparent
                    pointer-events-none"
                ></div>


                <!-- ICON -->

                <div
                    class="register-icon
                    relative
                    z-10
                    mx-auto
                    w-16 h-16
                    rounded-2xl
                    bg-gradient-to-br
                    from-cyan-400
                    via-blue-500
                    to-blue-600
                    flex items-center
                    justify-center
                    shadow-[0_0_40px_rgba(59,130,246,0.6)]
                    transform
                    hover:scale-105
                    transition-transform
                    duration-300"
                >

                    <i
                        class="fa-solid
                        fa-user-plus
                        text-white
                        text-2xl"
                    ></i>

                </div>


                <!-- BRAND -->

                <h1
                    class="register-title
                    mt-3
                    text-2xl
                    font-extrabold
                    text-white
                    tracking-tight"
                >
                    Buat Akun QuizGo
                </h1>


                <p
                    class="mt-1
                    max-w-xs
                    mx-auto
                    text-cyan-200
                    text-xs
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
                class="register-form-area
                px-6
                pb-5"
            >


                <!-- =================================================
                     VALIDATION ERROR
                ================================================== -->

                @if($errors->any())

                    <div
                        class="mb-4
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
                     REGISTER FORM
                ================================================== -->

                <form
                    method="POST"
                    action="{{ url('/register') }}"
                    class="space-y-3"
                >

                    @csrf



                    <!-- =================================================
                         NAMA
                    ================================================== -->

                    <div>

                        <label
                            class="text-white/90
                            text-xs
                            font-semibold
                            mb-1.5
                            block
                            uppercase
                            tracking-wider"
                        >
                            Nama Lengkap
                        </label>


                        <div
                            class="relative
                            group"
                        >

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap siswa"
                                required
                                autocomplete="name"
                                class="w-full
                                bg-white/5
                                border border-white/10
                                rounded-2xl
                                px-5 py-2.5
                                pl-12
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
                                fa-user
                                absolute
                                left-4
                                top-1/2
                                -translate-y-1/2
                                text-cyan-400
                                text-sm"
                            ></i>

                        </div>

                    </div>



                    <!-- =================================================
                         EMAIL
                    ================================================== -->

                    <div>

                        <label
                            class="text-white/90
                            text-xs
                            font-semibold
                            mb-1.5
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
                                px-5 py-2.5
                                pl-12
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
                                left-4
                                top-1/2
                                -translate-y-1/2
                                text-cyan-400
                                text-sm"
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
                            mb-1.5
                            block
                            uppercase
                            tracking-wider"
                        >
                            Password
                        </label>


                        <div
                            class="relative
                            group"
                        >

                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Buat password baru"
                                required
                                autocomplete="new-password"
                                class="w-full
                                bg-white/5
                                border border-white/10
                                rounded-2xl
                                px-5 py-2.5
                                pl-12
                                pr-12
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
                                left-4
                                top-1/2
                                -translate-y-1/2
                                text-cyan-400
                                text-sm"
                            ></i>


                            <button
                                type="button"
                                onclick="togglePassword('password', 'passwordIcon')"
                                class="absolute
                                right-4
                                top-1/2
                                -translate-y-1/2
                                text-cyan-400/60
                                hover:text-cyan-300
                                transition-colors
                                focus:outline-none"
                                title="Lihat atau sembunyikan password"
                            >

                                <i
                                    id="passwordIcon"
                                    class="fa-solid fa-eye"
                                ></i>

                            </button>

                        </div>

                    </div>



                    <!-- =================================================
                         KONFIRMASI PASSWORD
                    ================================================== -->

                    <div>

                        <label
                            class="text-white/90
                            text-xs
                            font-semibold
                            mb-1.5
                            block
                            uppercase
                            tracking-wider"
                        >
                            Konfirmasi Password
                        </label>


                        <div
                            class="relative
                            group"
                        >

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                placeholder="Ulangi password"
                                required
                                autocomplete="new-password"
                                class="w-full
                                bg-white/5
                                border border-white/10
                                rounded-2xl
                                px-5 py-2.5
                                pl-12
                                pr-12
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
                                fa-shield
                                absolute
                                left-4
                                top-1/2
                                -translate-y-1/2
                                text-cyan-400
                                text-sm"
                            ></i>


                            <button
                                type="button"
                                onclick="togglePassword('password_confirmation', 'confirmationIcon')"
                                class="absolute
                                right-4
                                top-1/2
                                -translate-y-1/2
                                text-cyan-400/60
                                hover:text-cyan-300
                                transition-colors
                                focus:outline-none"
                                title="Lihat atau sembunyikan password"
                            >

                                <i
                                    id="confirmationIcon"
                                    class="fa-solid fa-eye"
                                ></i>

                            </button>

                        </div>

                    </div>



                    <!-- =================================================
                         BUTTON
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
                            text-sm
                            shadow-[0_0_30px_rgba(59,130,246,0.4)]
                            hover:shadow-[0_0_40px_rgba(59,130,246,0.6)]
                            hover:scale-[1.01]
                            active:scale-[0.99]
                            transition-all
                            duration-200
                            uppercase
                            tracking-wide"
                        >

                            Daftar di QuizGo

                            <i
                                class="fa-solid
                                fa-circle-check
                                text-xs
                                ml-1"
                            ></i>

                        </button>

                    </div>


                </form>



                <!-- =================================================
                     LOGIN LINK
                ================================================== -->

                <p
                    class="text-center
                    text-white/50
                    text-xs
                    font-medium
                    mt-4"
                >

                    Sudah memiliki akun?

                    <a
                        href="{{ url('/login') }}"
                        class="text-cyan-300
                        font-bold
                        hover:text-cyan-200
                        underline
                        underline-offset-4
                        transition-colors
                        ml-1"
                    >
                        Masuk di Sini
                    </a>

                </p>



                <!-- =================================================
                     FOOTER INFO
                ================================================== -->

                <div
                    class="hidden
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

                        Buat akun untuk mulai menggunakan
                        QuizGo sebagai media ulangan IPA
                        yang interaktif dan menyenangkan.

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

        function togglePassword(
            fieldId,
            iconId
        ) {

            const passwordField =
                document.getElementById(fieldId);


            const toggleIcon =
                document.getElementById(iconId);


            if (!passwordField || !toggleIcon) {
                return;
            }


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

