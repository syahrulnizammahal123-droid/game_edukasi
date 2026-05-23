<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Soal</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>

        body{
            font-family:'Poppins',sans-serif;
        }

        .glass{
            background:rgba(255,255,255,0.08);
            backdrop-filter:blur(18px);
            border:1px solid rgba(255,255,255,0.08);
        }

    </style>

</head>

<body
    class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden"
    style="background-image:url('{{ asset('images/bg-login.jpg') }}')"
>

    <!-- Overlay -->
    <div class="fixed inset-0 bg-[#07111f]/80 -z-10"></div>

    <!-- Glow -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-cyan-400/20 blur-3xl rounded-full"></div>

    <div class="absolute bottom-0 right-0 w-72 h-72 bg-purple-500/20 blur-3xl rounded-full"></div>

    <!-- MAIN -->
    <div class="relative z-10 min-h-screen p-5 lg:p-8 pb-32">

        <div class="max-w-5xl mx-auto">

            <!-- HEADER -->
            <div
                class="glass rounded-[35px]
                p-6 lg:p-8 mb-8"
            >

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <!-- LEFT -->
                    <div>

                        <p class="text-cyan-300 font-semibold mb-3">
                            Manajemen Quiz
                        </p>

                        <h1 class="text-4xl lg:text-6xl font-extrabold text-white">
                            Tambah Soal
                        </h1>

                        <p class="text-white/60 mt-4 max-w-2xl">
                            Tambahkan soal baru untuk petualangan quiz pemain.
                        </p>

                    </div>

                    <!-- BUTTON -->
                    <a href="/soal"
                        class="w-14 h-14 rounded-2xl
                        glass flex items-center justify-center
                        text-white hover:bg-white/10 transition"
                    >

                        <i class="fa-solid fa-arrow-left"></i>

                    </a>

                </div>

            </div>

            <!-- ERROR -->
            @if($errors->any())

                <div
                    class="mb-6 rounded-[30px]
                    bg-red-500/20 border border-red-400/20
                    p-5"
                >

                    @foreach($errors->all() as $error)

                        <div class="text-red-200 mb-2">

                            {{ $error }}

                        </div>

                    @endforeach

                </div>

            @endif

            <!-- FORM -->
            <form action="/soal/store" method="POST">

                @csrf

                <!-- PERTANYAAN -->
                <div
                    class="glass rounded-[35px]
                    p-6 lg:p-8 mb-8"
                >

                    <!-- TITLE -->
                    <div class="flex items-center gap-4 mb-6">

                        <div
                            class="w-16 h-16 rounded-3xl
                            bg-gradient-to-br from-cyan-400 to-blue-600
                            flex items-center justify-center"
                        >

                            <i class="fa-solid fa-book-open text-white text-xl"></i>

                        </div>

                        <div>

                            <p class="text-cyan-300 text-sm font-semibold">
                                Pertanyaan
                            </p>

                            <h2 class="text-white text-3xl font-bold">
                                Isi Soal Quiz
                            </h2>

                        </div>

                    </div>

                    <!-- TEXTAREA -->
                    <textarea
                        name="pertanyaan"
                        rows="5"
                        required
                        placeholder="Masukkan pertanyaan soal..."
                        class="w-full bg-white/5 border border-white/10
                        rounded-[30px] p-6
                        text-white placeholder:text-white/40
                        focus:outline-none focus:ring-2
                        focus:ring-cyan-400"
                    ></textarea>

                </div>

                <!-- PILIHAN -->
                <div
                    class="glass rounded-[35px]
                    p-6 lg:p-8 mb-8"
                >

                    <!-- TITLE -->
                    <div class="flex items-center gap-4 mb-8">

                        <div
                            class="w-16 h-16 rounded-3xl
                            bg-gradient-to-br from-purple-500 to-pink-600
                            flex items-center justify-center"
                        >

                            <i class="fa-solid fa-list text-white text-xl"></i>

                        </div>

                        <div>

                            <p class="text-cyan-300 text-sm font-semibold">
                                Pilihan Jawaban
                            </p>

                            <h2 class="text-white text-3xl font-bold">
                                Opsi Jawaban
                            </h2>

                        </div>

                    </div>

                    <!-- GRID -->
                    <div class="grid grid-cols-1 gap-6">

                        <!-- A -->
                        <div>

                            <label class="text-white font-semibold mb-3 block">
                                Pilihan A
                            </label>

                            <div class="flex gap-4">

                                <div
                                    class="w-14 h-14 rounded-2xl
                                    bg-cyan-500
                                    flex items-center justify-center
                                    text-white font-bold shrink-0"
                                >

                                    A

                                </div>

                                <input
                                    type="text"
                                    name="A"
                                    required
                                    placeholder="Masukkan pilihan A"
                                    class="flex-1 bg-white/5 border border-white/10
                                    rounded-2xl px-5
                                    text-white placeholder:text-white/40
                                    focus:outline-none focus:ring-2
                                    focus:ring-cyan-400"
                                >

                            </div>

                        </div>

                        <!-- B -->
                        <div>

                            <label class="text-white font-semibold mb-3 block">
                                Pilihan B
                            </label>

                            <div class="flex gap-4">

                                <div
                                    class="w-14 h-14 rounded-2xl
                                    bg-purple-500
                                    flex items-center justify-center
                                    text-white font-bold shrink-0"
                                >

                                    B

                                </div>

                                <input
                                    type="text"
                                    name="B"
                                    required
                                    placeholder="Masukkan pilihan B"
                                    class="flex-1 bg-white/5 border border-white/10
                                    rounded-2xl px-5
                                    text-white placeholder:text-white/40
                                    focus:outline-none focus:ring-2
                                    focus:ring-purple-400"
                                >

                            </div>

                        </div>

                        <!-- C -->
                        <div>

                            <label class="text-white font-semibold mb-3 block">
                                Pilihan C
                            </label>

                            <div class="flex gap-4">

                                <div
                                    class="w-14 h-14 rounded-2xl
                                    bg-green-500
                                    flex items-center justify-center
                                    text-white font-bold shrink-0"
                                >

                                    C

                                </div>

                                <input
                                    type="text"
                                    name="C"
                                    required
                                    placeholder="Masukkan pilihan C"
                                    class="flex-1 bg-white/5 border border-white/10
                                    rounded-2xl px-5
                                    text-white placeholder:text-white/40
                                    focus:outline-none focus:ring-2
                                    focus:ring-green-400"
                                >

                            </div>

                        </div>

                        <!-- D -->
                        <div>

                            <label class="text-white font-semibold mb-3 block">
                                Pilihan D
                            </label>

                            <div class="flex gap-4">

                                <div
                                    class="w-14 h-14 rounded-2xl
                                    bg-orange-500
                                    flex items-center justify-center
                                    text-white font-bold shrink-0"
                                >

                                    D

                                </div>

                                <input
                                    type="text"
                                    name="D"
                                    required
                                    placeholder="Masukkan pilihan D"
                                    class="flex-1 bg-white/5 border border-white/10
                                    rounded-2xl px-5
                                    text-white placeholder:text-white/40
                                    focus:outline-none focus:ring-2
                                    focus:ring-orange-400"
                                >

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SETTING -->
                <div
                    class="glass rounded-[35px]
                    p-6 lg:p-8 mb-8"
                >

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- JAWABAN -->
                        <div>

                            <label class="text-white font-semibold mb-3 block">
                                Jawaban Benar
                            </label>

                            <select
                                name="jawaban"
                                required
                                class="w-full bg-white/5 border border-white/10
                                rounded-2xl px-5 py-4
                                text-white focus:outline-none
                                focus:ring-2 focus:ring-cyan-400"
                            >

                                <option class="bg-[#0b1020]" value="">
                                    Pilih Jawaban
                                </option>

                                <option class="bg-[#0b1020]" value="A">
                                    Pilihan A
                                </option>

                                <option class="bg-[#0b1020]" value="B">
                                    Pilihan B
                                </option>

                                <option class="bg-[#0b1020]" value="C">
                                    Pilihan C
                                </option>

                                <option class="bg-[#0b1020]" value="D">
                                    Pilihan D
                                </option>

                            </select>

                        </div>

                        <!-- LEVEL -->
                        <div>

                            <label class="text-white font-semibold mb-3 block">
                                Level Soal
                            </label>

                            <select
                                name="level"
                                required
                                class="w-full bg-white/5 border border-white/10
                                rounded-2xl px-5 py-4
                                text-white focus:outline-none
                                focus:ring-2 focus:ring-cyan-400"
                            >

                                <option class="bg-[#0b1020]" value="">
                                    Pilih Level
                                </option>

                                <option class="bg-[#0b1020]" value="1">
                                    Level 1
                                </option>

                                <option class="bg-[#0b1020]" value="2">
                                    Level 2
                                </option>

                                <option class="bg-[#0b1020]" value="3">
                                    Level 3
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                <!-- PENJELASAN -->
                <div
                    class="glass rounded-[35px]
                    p-6 lg:p-8 mb-8"
                >

                    <!-- TITLE -->
                    <div class="flex items-center gap-4 mb-6">

                        <div
                            class="w-16 h-16 rounded-3xl
                            bg-gradient-to-br from-green-400 to-emerald-600
                            flex items-center justify-center"
                        >

                            <i class="fa-solid fa-lightbulb text-white text-xl"></i>

                        </div>

                        <div>

                            <p class="text-cyan-300 text-sm font-semibold">
                                Penjelasan
                            </p>

                            <h2 class="text-white text-3xl font-bold">
                                Pembahasan Jawaban
                            </h2>

                        </div>

                    </div>

                    <!-- TEXTAREA -->
                    <textarea
                        name="penjelasan"
                        rows="5"
                        required
                        placeholder="Masukkan penjelasan jawaban..."
                        class="w-full bg-white/5 border border-white/10
                        rounded-[30px] p-6
                        text-white placeholder:text-white/40
                        focus:outline-none focus:ring-2
                        focus:ring-green-400"
                    ></textarea>

                </div>

                <!-- BUTTON -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

                    <!-- KEMBALI -->
                    <a href="/soal"
                        class="flex items-center justify-center gap-4
                        glass text-white py-5 rounded-[30px]
                        text-lg font-bold hover:bg-white/10 transition"
                    >

                        <i class="fa-solid fa-arrow-left"></i>

                        Kembali

                    </a>

                    <!-- SIMPAN -->
                    <button
                        type="submit"
                        class="flex items-center justify-center gap-4
                        bg-gradient-to-r from-cyan-400 to-blue-600
                        text-white py-5 rounded-[30px]
                        text-lg font-bold
                        shadow-[0_0_35px_rgba(59,130,246,0.35)]
                        hover:scale-[1.02] transition duration-300"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        Simpan Soal

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>