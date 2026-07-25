<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Soal Baru - Guiz Adventure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-[#070d19] text-white min-h-screen p-6">

    <div class="max-w-3xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Tambah Soal Baru</h1>
            <a href="{{ route('soal.index') }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-medium transition">
                <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <form action="{{ route('soal.store') }}" method="POST" class="bg-[#0b1324] border border-white/10 p-6 rounded-3xl space-y-4">
            @csrf

            <!-- LEVEL SOAL -->
            <div>
                <label class="block text-sm font-bold text-slate-300 mb-1">Pilih Level Game</label>
                <select name="level" required class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">
                    <option value="1">Level 1 (Mudah)</option>
                    <option value="2">Level 2 (Sedang)</option>
                    <option value="3">Level 3 (Sulit)</option>
                </select>
            </div>

            <!-- PERTANYAAN -->
            <div>
                <label class="block text-sm font-bold text-slate-300 mb-1">Pertanyaan / Soal</label>
                <textarea name="pertanyaan" rows="3" required placeholder="Tuliskan pertanyaan di sini..." class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500"></textarea>
            </div>

            <!-- OPSI JAWABAN (A, B, C, D) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-300 mb-1">Pilihan A</label>
                    <input type="text" name="A" required placeholder="Opsi A" class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-300 mb-1">Pilihan B</label>
                    <input type="text" name="B" required placeholder="Opsi B" class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-300 mb-1">Pilihan C</label>
                    <input type="text" name="C" required placeholder="Opsi C" class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-300 mb-1">Pilihan D</label>
                    <input type="text" name="D" required placeholder="Opsi D" class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">
                </div>
            </div>

            <!-- KUNCI JAWABAN -->
            <div>
                <label class="block text-sm font-bold text-slate-300 mb-1">Kunci Jawaban Benar</label>
                <select name="jawaban" required class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>

            <!-- PENJELASAN -->
            <div>
                <label class="block text-sm font-bold text-slate-300 mb-1">Penjelasan (Opsional)</label>
                <textarea name="penjelasan" rows="2" placeholder="Penjelasan pembahasan soal..." class="w-full p-3 rounded-xl bg-slate-900 border border-white/10 text-white focus:outline-none focus:border-cyan-500"></textarea>
            </div>

            <button type="submit" class="w-full py-3 bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold rounded-xl transition shadow-lg shadow-cyan-500/20">
                Simpan Soal Baru
            </button>
        </form>

    </div>

</body>
</html>