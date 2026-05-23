<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Adventure Quiz Login</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>

        body{
            font-family: 'Poppins', sans-serif;
        }

    </style>

</head>

<body
    class="min-h-screen flex items-center justify-center bg-cover bg-center p-5"
    style="background-image: url('{{ asset('images/bg-login.jpg') }}');"
>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-[#081120]/70 backdrop-blur-sm"></div>

    <!-- LOGIN CARD -->
    <div class="relative z-10 w-full max-w-md">

        <div
            class="bg-white/10 border border-white/10
            backdrop-blur-2xl rounded-[40px]
            shadow-[0_0_50px_rgba(59,130,246,0.35)]
            overflow-hidden"
        >

            <!-- TOP -->
            <div class="relative p-8 text-center">

                <!-- Glow -->
                <div class="absolute top-0 left-0 w-full h-40
                    bg-gradient-to-b from-cyan-400/20 to-transparent">
                </div>

                <!-- LOGO -->
                <div
                    class="relative z-10 mx-auto w-28 h-28 rounded-[30px]
                    bg-gradient-to-br from-cyan-400 to-blue-600
                    flex items-center justify-center
                    shadow-[0_0_40px_rgba(59,130,246,0.6)]"
                >

                    <i class="fa-solid fa-gamepad text-white text-5xl"></i>

                </div>

                <!-- TITLE -->
                <h1 class="mt-6 text-4xl font-extrabold text-white">
                    Adventure Quiz
                </h1>

                <p class="mt-2 text-cyan-200 text-sm">
                    Login untuk memulai petualanganmu
                </p>

            </div>

            <!-- FORM -->
            <div class="px-6 pb-8">

                <!-- ERROR -->
                @if(session('error'))

                    <div class="mb-4 bg-red-500/20 border border-red-400/20
                        text-red-200 px-4 py-3 rounded-2xl text-sm">

                        {{ session('error') }}

                    </div>

                @endif

                <!-- VALIDATION -->
                @if($errors->any())

                    <div class="mb-4 bg-red-500/20 border border-red-400/20
                        text-red-200 px-4 py-3 rounded-2xl text-sm">

                        @foreach($errors->all() as $error)

                            <div>{{ $error }}</div>

                        @endforeach

                    </div>

                @endif

                <form method="POST" action="{{ url('/login') }}">

                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-5">

                        <label class="text-white text-sm font-medium mb-2 block">
                            Email
                        </label>

                        <div class="relative">

                            <input
                                type="email"
                                name="email"
                                placeholder="Masukkan email"
                                required
                                class="w-full bg-white/10 border border-white/10
                                rounded-2xl px-5 py-4 pl-14
                                text-white placeholder:text-white/50
                                focus:outline-none focus:ring-2
                                focus:ring-cyan-400"
                            >

                            <i class="fa-solid fa-envelope
                                absolute left-5 top-1/2 -translate-y-1/2
                                text-cyan-300">
                            </i>

                        </div>

                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-6">

                        <label class="text-white text-sm font-medium mb-2 block">
                            Password
                        </label>

                        <div class="relative">

                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Masukkan password"
                                required
                                class="w-full bg-white/10 border border-white/10
                                rounded-2xl px-5 py-4 pl-14 pr-14
                                text-white placeholder:text-white/50
                                focus:outline-none focus:ring-2
                                focus:ring-cyan-400"
                            >

                            <i class="fa-solid fa-lock
                                absolute left-5 top-1/2 -translate-y-1/2
                                text-cyan-300">
                            </i>

                            <!-- SHOW PASSWORD -->
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-5 top-1/2 -translate-y-1/2
                                text-cyan-300"
                            >

                                <i class="fa-solid fa-eye"></i>

                            </button>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full py-4 rounded-2xl
                        bg-gradient-to-r from-cyan-400 to-blue-600
                        text-white font-bold text-lg
                        shadow-[0_0_30px_rgba(59,130,246,0.5)]
                        hover:scale-[1.02]
                        transition duration-300"
                    >

                        Masuk Game

                    </button>

                </form>

                <!-- REGISTER -->
                <p class="text-center text-white/70 text-sm mt-6">

                    Belum punya akun?

                    <a
                        href="{{ url('/register') }}"
                        class="text-cyan-300 font-semibold hover:text-cyan-200"
                    >
                        Register
                    </a>

                </p>

            </div>

        </div>

    </div>

    <!-- SCRIPT -->
    <script>

        function togglePassword() {

            const password =
                document.getElementById('password');

            if(password.type === 'password'){

                password.type = 'text';

            }else{

                password.type = 'password';

            }

        }

    </script>

@include('components.loading')
@include('components.sound')
</body>
</html>