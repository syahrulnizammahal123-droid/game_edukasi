@extends('layouts.auth')

@section('title', 'Login - QuizGo')

@push('styles')
<style>
* {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background:
                linear-gradient(
                    rgba(8, 17, 32, 0.82),
                    rgba(8, 17, 32, 0.88)
                ),
                url('{{ asset('images/bg-login.jpg') }}');

            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }


        .login-card {
            width: 420px;
            max-width: 100%;
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 30px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.35);
            overflow: hidden;
        }


        .logo-box {
            width: 90px;
            height: 90px;
            border-radius: 25px;
            background: linear-gradient(
                135deg,
                #22d3ee,
                #3b82f6
            );
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow:
                0 0 35px
                rgba(59,130,246,0.45);
        }


        .form-label-custom {
            color: rgba(255,255,255,0.85);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }


        .form-control-custom {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.10);
            color: white;
            border-radius: 15px;
            padding: 13px 16px;
        }


        .form-control-custom::placeholder {
            color: rgba(255,255,255,0.30);
        }


        .form-control-custom:focus {
            background: rgba(255,255,255,0.10);
            border-color: rgba(34,211,238,0.55);
            color: white;
            box-shadow:
                0 0 0 3px
                rgba(34,211,238,0.10);
        }


        .btn-login {
            border: none;
            border-radius: 15px;
            padding: 14px;
            width: 100%;
            background: linear-gradient(
                90deg,
                #22d3ee,
                #3b82f6
            );
            color: white;
            font-weight: 800;
            transition: all 0.25s ease;
        }


        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow:
                0 12px 25px
                rgba(59,130,246,0.25);
        }


        .info-text {
            color: rgba(255,255,255,0.45);
            font-size: 11px;
            line-height: 1.7;
        }
</style>
@endpush

@section('content')
<div
    class="d-flex
    justify-content-center
    align-items-center
    min-vh-100
    p-4"
>


    <div class="login-card">


        <!-- =================================================
             HEADER
        ================================================== -->

        <div
            class="p-4
            pt-5
            text-center"
        >

            <div class="logo-box">

                <i
                    class="fa-solid
                    fa-flask
                    text-white
                    fs-1"
                ></i>

            </div>


            <h1
                class="text-white
                fw-bold
                mt-4
                mb-1"
            >
                QuizGo
            </h1>


            <p
                class="text-info
                fw-semibold
                mb-2"
            >
                Ulangan IPA Interaktif
            </p>


            <p
                class="text-white-50
                small
                mb-0"
            >
                Belajar, bermain, dan uji pemahamanmu
                dengan cara yang menyenangkan.
            </p>

        </div>



        <!-- =================================================
             FORM
        ================================================== -->

        <div class="px-4 pb-4">


            <!-- ERROR SESSION -->

            @if(session('error'))

                <div
                    class="alert
                    alert-danger
                    border-0
                    rounded-4
                    small"
                >

                    <i
                        class="fa-solid
                        fa-triangle-exclamation
                        me-2"
                    ></i>

                    {{ session('error') }}

                </div>

            @endif



            <!-- ERROR VALIDASI -->

            @if($errors->any())

                <div
                    class="alert
                    alert-danger
                    border-0
                    rounded-4
                    small"
                >

                    @foreach($errors->all() as $error)

                        <div class="mb-1">

                            <i
                                class="fa-solid
                                fa-circle-exclamation
                                me-2"
                            ></i>

                            {{ $error }}

                        </div>

                    @endforeach

                </div>

            @endif



            <!-- LOGIN FORM -->

            <form
                method="POST"
                action="/login"
            >

                @csrf



                <!-- EMAIL -->

                <div class="mb-4">

                    <label
                        class="form-label-custom
                        mb-2"
                    >
                        Email
                    </label>


                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control
                        form-control-custom"
                        placeholder="Masukkan email siswa"
                        required
                    >

                </div>



                <!-- PASSWORD -->

                <div class="mb-4">

                    <label
                        class="form-label-custom
                        mb-2"
                    >
                        Password
                    </label>


                    <input
                        type="password"
                        name="password"
                        class="form-control
                        form-control-custom"
                        placeholder="Masukkan password"
                        required
                    >

                </div>



                <!-- BUTTON -->

                <button
                    type="submit"
                    class="btn-login"
                >

                    <i
                        class="fa-solid
                        fa-right-to-bracket
                        me-2"
                    ></i>

                    Masuk ke QuizGo

                </button>


            </form>



            <!-- REGISTER -->

            <p
                class="text-center
                text-white-50
                small
                mt-4
                mb-3"
            >

                Belum memiliki akun?

                <a
                    href="/register"
                    class="text-info
                    fw-bold
                    text-decoration-none"
                >
                    Daftar di sini
                </a>

            </p>



            <!-- INFO -->

            <div
                class="text-center
                border-top
                border-light
                border-opacity-10
                pt-3"
            >

                <p class="info-text mb-0">

                    QuizGo merupakan media pembelajaran
                    untuk membantu siswa mengerjakan
                    ulangan IPA secara interaktif dan menyenangkan.

                </p>

            </div>


        </div>


    </div>


</div>
@endsection

