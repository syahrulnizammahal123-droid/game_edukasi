<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Soal Kilat - Guiz Adventure</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body{ font-family:'Poppins',sans-serif; }
        .glass{
            background:rgba(255,255,255,0.08);
            backdrop-filter:blur(18px);
            border:1px solid rgba(255,255,255,0.08);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat overflow-x-hidden" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">

    <div class="fixed inset-0 bg-[#07111f]/80 -z-10"></div>

    <div class="absolute top-0 left-0 w-72 h-72 bg-amber-400/10 blur-3xl rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-purple-500/20 blur-3xl rounded-full"></div>

    <div class="relative z-10 min-h-screen p-5 lg:p-8 pb-32">
        <div class="max-w-5xl mx-auto">

            <div class="glass rounded-[35px] p-6 lg:p-8 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div>
                        <p class="text-amber-400 font-semibold mb-3">Manajemen Game Kilat - Mode Koreksi</p>
                        <h1 class="text-4xl lg:text-6xl font-extrabold text-white">Edit Soal Kilat</h1>
                        <p class="text-white/60 mt-4 max-w-2xl">Perbarui instrumen pernyataan logika Benar / Salah agar tetap akurat sebagai instrumen uji kognitif.</p>
                    </div>
                    <a href="/soal" class="w-14 h-14 rounded-2xl glass flex items-center justify-center text-white hover:bg-white/10 transition">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
            </div>

            @if($errors->any())
                <div class="mb-6 rounded-[30px] bg-red-500/20 border border-red-400/20 p-5">
                    @foreach($errors->all() as $error)
                        <div class="text-red-200 mb-2"><i class="fa-solid fa-triangle-exclamation mr-2"></i>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('soal-kilat.update', $soal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="glass rounded-[35px] p-6 lg:p-8 mb-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center">
                            <i class="fa-solid fa-pen-to-square text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-amber-400 text-sm font-semibold">Butir Instrumen</p>
                            <h2 class="text-white text-3xl font-bold">Edit Pernyataan</h2>
                        </div>
                    </div>
                    <textarea name="pernyataan" rows="4" required placeholder="Masukkan butir pernyataan logika kuis kilat..." class="w-full bg-white/5 border border-white/10 rounded-[30px] p-6 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">{{ old('pernyataan', $soal->pernyataan) }}</textarea>
                </div>

                <div class="glass rounded-[35px] p-6 lg:p-8 mb-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="text-white font-semibold mb-3 block">Validitas Jawaban Kunci</label>
                            <select name="jawaban_benar" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                                <option class="bg-[#0b1020]" value="1" {{ old('jawaban_benar', $soal->jawaban_benar) == true ? 'selected' : '' }}>BENAR (True)</option>
                                <option class="bg-[#0b1020]" value="0" {{ old('jawaban_benar', $soal->jawaban_benar) == false ? 'selected' : '' }}>SALAH (False)</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-white font-semibold mb-3 block">Level Target Tingkat</label>
                            <select name="level" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                                <option class="bg-[#0b1020]" value="1" {{ old('level', $soal->level) == '1' ? 'selected' : '' }}>Level 1</option>
                                <option class="bg-[#0b1020]" value="2" {{ old('level', $soal->level) == '2' ? 'selected' : '' }}>Level 2</option>
                                <option class="bg-[#0b1020]" value="3" {{ old('level', $soal->level) == '3' ? 'selected' : '' }}>Level 3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="glass rounded-[35px] p-6 lg:p-8 mb-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center">
                            <i class="fa-solid fa-lightbulb text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-amber-400 text-sm font-semibold">Edukasi Balikan</p>
                            <h2 class="text-white text-3xl font-bold">Edit Pembahasan</h2>
                        </div>
                    </div>
                    <textarea name="penjelasan" rows="4" required placeholder="Masukkan penjelasan analisis ilmiah balikan siswa..." class="w-full bg-white/5 border border-white/10 rounded-[30px] p-6 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">{{ old('penjelasan', $soal->penjelasan) }}</textarea>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                    <a href="/soal" class="flex items-center justify-center gap-4 glass text-white py-5 rounded-[30px] text-lg font-bold hover:bg-white/10 transition">
                        <i class="fa-solid fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="flex items-center justify-center gap-4 bg-gradient-to-r from-amber-500 to-orange-600 text-white py-5 rounded-[30px] text-lg font-bold shadow-[0_0_35px_rgba(245,158,11,0.25)] hover:scale-[1.02] transition duration-300">
                        <i class="fa-solid fa-arrows-rotate"></i> Perbarui Soal Kilat
                    </button>
                </div>
            </form>

        </div>
    </div>
</body>
</html>