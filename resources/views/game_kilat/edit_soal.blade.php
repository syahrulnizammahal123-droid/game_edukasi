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
        body { font-family: 'Poppins', sans-serif; }
        .glass {
            background: rgba(11, 19, 35, 0.55);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>

<body class="relative min-h-screen bg-cover bg-center bg-fixed bg-no-repeat text-white antialiased flex items-center justify-center p-4" style="background-image:url('{{ asset('images/bg-login.jpg') }}')">
    
    <div class="fixed inset-0 bg-[#030712]/85 -z-10"></div>

    <div class="glass max-w-xl w-full rounded-[30px] p-6 lg:p-8 border border-white/10 shadow-2xl">
        
        <div class="flex items-center gap-3 border-b border-white/10 pb-4 mb-6">
            <div class="w-10 h-10 rounded-xl bg-orange-500/10 flex items-center justify-center text-orange-400">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div>
                <h1 class="text-xl font-black tracking-wide">Edit Instrumen Soal Kilat</h1>
                <p class="text-[11px] text-white/50">Modifikasi data pernyataan logika Benar/Salah</p>
            </div>
        </div>

        <form action="{{ route('soal-kilat.update', $soal->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-white/60 mb-2">Target Level Kuis</label>
                <input type="number" name="level" value="{{ $soal->level }}" required
                    class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500 transition text-white">
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-white/60 mb-2">Pernyataan Logika (Kognitif)</label>
                <textarea name="pernyataan" rows="3" required
                    class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500 transition text-white resize-none">{{ $soal->pernyataan }}</textarea>
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-white/60 mb-2">Kunci Jawaban Valid</label>
                <select name="jawaban_benar" required
                    class="w-full bg-[#0b1323] border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500 transition text-white">
                    <option value="1" {{ $soal->jawaban_benar == 1 ? 'selected' : '' }}>BENAR (True)</option>
                    <option value="0" {{ $soal->jawaban_benar == 0 ? 'selected' : '' }}>SALAH (False)</option>
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-white/60 mb-2">Ulasan Pembahasan Analisis</label>
                <textarea name="penjelasan" rows="3"
                    class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500 transition text-white resize-none" 
                    placeholder="Masukkan alasan ilmiah atau pembahasan soal...">{{ $soal->penjelasan }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-3 pt-2">
                <a href="{{ route('soal.index') }}" class="w-full text-center bg-white/5 border border-white/10 text-white font-bold text-xs py-3.5 rounded-xl hover:bg-white/10 transition uppercase tracking-wide flex items-center justify-center gap-1">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-600 text-white font-black text-xs py-3.5 rounded-xl shadow-lg shadow-orange-500/10 hover:opacity-90 transition uppercase tracking-wide">
                    Simpan Perubahan <i class="fa-solid fa-floppy-disk ml-1"></i>
                </button>
            </div>

        </form>
    </div>

</body>
</html> 