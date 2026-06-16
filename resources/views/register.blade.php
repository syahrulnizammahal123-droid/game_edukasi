<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Quiz - Pendaftaran Siswa</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-cover bg-center p-5 relative overflow-hidden" style="background-image: url('{{ asset('images/bg-login.jpg') }}');">

    <div class="absolute inset-0 bg-[#081120]/75 backdrop-blur-sm -z-10"></div>

    <div class="absolute top-[-10%] right-[-10%] w-96 h-96 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 rounded-full bg-purple-600/10 blur-3xl pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-md transition-all duration-300 my-auto">
        <div class="bg-white/10 border border-white/10 backdrop-blur-2xl rounded-[40px] shadow-[0_0_50px_rgba(59,130,246,0.35)] overflow-hidden">

            <div class="relative p-6 pt-8 text-center">
                <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-cyan-400/25 to-transparent pointer-events-none"></div>

                <div class="relative z-10 mx-auto w-24 h-24 rounded-[26px] bg-gradient-to-br from-cyan-400 via-blue-500 to-blue-600 flex items-center justify-center shadow-[0_0_40px_rgba(59,130,246,0.6)] transform hover:scale-105 transition-transform duration-300">
                    <i class="fa-solid fa-user-plus text-white text-4xl"></i>
                </div>

                <h1 class="mt-5 text-3xl font-extrabold text-white tracking-tight">
                    Buat Akun Baru
                </h1>
                <p class="mt-1 text-cyan-200/80 text-xs font-medium">
                    Daftarkan dirimu untuk memulai petualangan kuis
                </p>
            </div>

            <div class="px-8 pb-8">

                @if($errors->any())
                    <div class="mb-4 bg-red-500/20 border border-red-500/30 text-red-200 px-4 py-3 rounded-2xl text-xs font-medium space-y-1">
                        @foreach($errors->all() as $error)
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-exclamation text-red-400 text-[10px]"></i>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ url('/register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="text-white/90 text-xs font-semibold mb-1.5 block uppercase tracking-wider">
                            Nama Lengkap
                        </label>
                        <div class="relative group">
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap siswa"
                                required
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 pl-12 text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-white/10 transition-all duration-200 text-sm"
                            >
                            <i class="fa-solid fa-user absolute left-4.5 left-4 top-1/2 -translate-y-1/2 text-cyan-400 text-sm"></i>
                        </div>
                    </div>

                    <div>
                        <label class="text-white/90 text-xs font-semibold mb-1.5 block uppercase tracking-wider">
                            Email
                        </label>
                        <div class="relative group">
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan email siswa"
                                required
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 pl-12 text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-white/10 transition-all duration-200 text-sm"
                            >
                            <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-cyan-400 text-sm"></i>
                        </div>
                    </div>

                    <div>
                        <label class="text-white/90 text-xs font-semibold mb-1.5 block uppercase tracking-wider">
                            Password
                        </label>
                        <div class="relative group">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Buat password baru"
                                required
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 pl-12 text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-white/10 transition-all duration-200 text-sm"
                            >
                            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-cyan-400 text-sm"></i>
                        </div>
                    </div>

                    <div>
                        <label class="text-white/90 text-xs font-semibold mb-1.5 block uppercase tracking-wider">
                            Konfirmasi Password
                        </label>
                        <div class="relative group">
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                placeholder="Ulangi password"
                                required
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 pl-12 text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-white/10 transition-all duration-200 text-sm"
                            >
                            <i class="fa-solid fa-shield-check absolute left-4 top-1/2 -translate-y-1/2 text-cyan-400 text-sm"></i>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full py-4 rounded-2xl bg-gradient-to-r from-cyan-400 via-blue-500 to-blue-600 text-white font-extrabold text-sm shadow-[0_0_30px_rgba(59,130,246,0.4)] hover:shadow-[0_0_40px_rgba(59,130,246,0.6)] hover:scale-[1.01] active:scale-[0.99] transition-all duration-200 uppercase tracking-wide"
                        >
                            Daftar Sekarang <i class="fa-solid fa-circle-check text-xs ml-1"></i>
                        </button>
                    </div>
                </form>

                <p class="text-center text-white/50 text-xs font-medium mt-5">
                    Sudah memiliki akun petualang? 
                    <a
                        href="{{ url('/login') }}"
                        class="text-cyan-300 font-bold hover:text-cyan-200 underline underline-offset-4 transition-colors ml-1"
                    >
                        Login Di Sini
                    </a>
                </p>

            </div>
        </div>
    </div>

    @include('components.loading')
    @include('components.sound')
</body>
</html>