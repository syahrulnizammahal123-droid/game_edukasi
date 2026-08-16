
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Soal Baru - Quiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>


<body class="bg-[#070d19] text-white min-h-screen p-6">

    <div class="max-w-3xl mx-auto space-y-6">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div class="flex items-center justify-between">

            <h1 class="text-2xl font-bold">
                Tambah Soal Baru
            </h1>

            <a href="{{ route('soal.index') }}"
               class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-medium transition">

                <i class="fa-solid fa-arrow-left mr-2"></i>

                Kembali

            </a>

        </div>


        <!-- =====================================================
             PESAN ERROR VALIDASI
        ====================================================== -->

        @if($errors->any())

            <div class="bg-red-500/10 border border-red-500/30 text-red-300 rounded-2xl p-4">

                <div class="font-bold mb-2">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                    Terdapat kesalahan:
                </div>

                <ul class="text-sm space-y-1 list-disc list-inside">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- =====================================================
             FORM TAMBAH SOAL
        ====================================================== -->

        <form action="{{ route('soal.store') }}"
              method="POST"
              class="bg-[#0b1324] border border-white/10 p-6 rounded-3xl space-y-5">

            @csrf


            <!-- =================================================
                 LEVEL SOAL
            ================================================== -->

            <div>

                <label class="block text-sm font-bold text-slate-300 mb-1">
                    Pilih Level Game
                </label>

                <select
                    name="level"
                    required
                    class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">

                    <option value="1"
                        {{ old('level', 1) == 1 ? 'selected' : '' }}>
                        Level 1 (Mudah)
                    </option>

                    <option value="2"
                        {{ old('level') == 2 ? 'selected' : '' }}>
                        Level 2 (Sedang)
                    </option>

                    <option value="3"
                        {{ old('level') == 3 ? 'selected' : '' }}>
                        Level 3 (Sulit)
                    </option>

                </select>

                <p class="text-xs text-slate-500 mt-2">
                    Level yang dipilih akan menjadi level aktif setelah soal berhasil disimpan.
                </p>

            </div>


            <!-- =================================================
                 PERTANYAAN
            ================================================== -->

            <div>

                <label class="block text-sm font-bold text-slate-300 mb-1">
                    Pertanyaan / Soal
                </label>

                <textarea
                    name="pertanyaan"
                    rows="3"
                    required
                    placeholder="Tuliskan pertanyaan di sini..."
                    class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">{{ old('pertanyaan') }}</textarea>

            </div>


            <!-- =================================================
                 OPSI JAWABAN
            ================================================== -->

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                <!-- A -->
                <div>

                    <label class="block text-sm font-bold text-slate-300 mb-1">
                        Pilihan A
                    </label>

                    <input
                        type="text"
                        name="A"
                        value="{{ old('A') }}"
                        required
                        placeholder="Opsi A"
                        class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">

                </div>


                <!-- B -->
                <div>

                    <label class="block text-sm font-bold text-slate-300 mb-1">
                        Pilihan B
                    </label>

                    <input
                        type="text"
                        name="B"
                        value="{{ old('B') }}"
                        required
                        placeholder="Opsi B"
                        class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">

                </div>


                <!-- C -->
                <div>

                    <label class="block text-sm font-bold text-slate-300 mb-1">
                        Pilihan C
                    </label>

                    <input
                        type="text"
                        name="C"
                        value="{{ old('C') }}"
                        required
                        placeholder="Opsi C"
                        class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">

                </div>


                <!-- D -->
                <div>

                    <label class="block text-sm font-bold text-slate-300 mb-1">
                        Pilihan D
                    </label>

                    <input
                        type="text"
                        name="D"
                        value="{{ old('D') }}"
                        required
                        placeholder="Opsi D"
                        class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">

                </div>

            </div>


            <!-- =================================================
                 KUNCI JAWABAN
            ================================================== -->

            <div>

                <label class="block text-sm font-bold text-slate-300 mb-1">
                    Kunci Jawaban Benar
                </label>

                <select
                    name="jawaban"
                    required
                    class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">

                    <option value="A"
                        {{ old('jawaban', 'A') == 'A' ? 'selected' : '' }}>
                        A
                    </option>

                    <option value="B"
                        {{ old('jawaban') == 'B' ? 'selected' : '' }}>
                        B
                    </option>

                    <option value="C"
                        {{ old('jawaban') == 'C' ? 'selected' : '' }}>
                        C
                    </option>

                    <option value="D"
                        {{ old('jawaban') == 'D' ? 'selected' : '' }}>
                        D
                    </option>

                </select>

            </div>


            <!-- =================================================
                 PENJELASAN
            ================================================== -->

            <div>

                <label class="block text-sm font-bold text-slate-300 mb-1">
                    Penjelasan (Opsional)
                </label>

                <textarea
                    name="penjelasan"
                    rows="2"
                    placeholder="Penjelasan pembahasan soal..."
                    class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">{{ old('penjelasan') }}</textarea>

            </div>


            <!-- =================================================
                 TOMBOL SIMPAN
            ================================================== -->

            <button
                type="submit"
                class="w-full py-3 bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold rounded-xl transition shadow-lg shadow-cyan-500/20">

                <i class="fa-solid fa-floppy-disk mr-2"></i>

                Simpan Soal Baru

            </button>

        </form>

    </div>

</body>

</html>
```
