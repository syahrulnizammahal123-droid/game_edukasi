@extends('layouts.app')

@section('title', 'Tambah Soal Ulangan IPA - QuizKU')
@section('main_class', 'flex-1 overflow-x-hidden pb-28 lg:pb-8')

@push('styles')
<style>
body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .input-focus {
            transition: all 0.25s ease;
        }

        .input-focus:focus {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(34, 211, 238, 0.08);
        }
</style>
@endpush

@section('content')
<div class="max-w-3xl mx-auto space-y-6">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div
            class="flex
            flex-col
            sm:flex-row
            sm:items-center
            sm:justify-between
            gap-4"
        >

            <div>

                <span
                    class="inline-flex
                    items-center
                    gap-2
                    px-3 py-1
                    rounded-xl
                    bg-cyan-500/10
                    border border-cyan-400/20
                    text-cyan-400
                    text-[10px]
                    font-black
                    uppercase
                    tracking-widest
                    mb-2"
                >

                    <i class="fa-solid fa-flask"></i>

                    QuizKU â€¢ Ulangan IPA

                </span>


                <h1 class="text-2xl font-bold">
                    Tambah Soal Ulangan IPA
                </h1>


                <p class="text-xs text-white/40 mt-1">
                    Tambahkan soal baru untuk digunakan pada ulangan IPA.
                </p>

            </div>


            <a
                href="{{ route('soal.index') }}"
                class="px-4 py-2
                bg-white/10
                hover:bg-white/20
                text-white
                rounded-xl
                text-sm
                font-medium
                transition
                inline-flex
                items-center
                justify-center"
            >

                <i class="fa-solid fa-arrow-left mr-2"></i>

                Kembali ke Soal

            </a>

        </div>



        <!-- =====================================================
             PESAN ERROR VALIDASI
        ====================================================== -->

        @if($errors->any())

            <div
                class="bg-red-500/10
                border border-red-500/30
                text-red-300
                rounded-2xl
                p-4"
            >

                <div class="font-bold mb-2">

                    <i
                        class="fa-solid
                        fa-triangle-exclamation
                        mr-2"
                    ></i>

                    Terdapat kesalahan:

                </div>


                <ul
                    class="text-sm
                    space-y-1
                    list-disc
                    list-inside"
                >

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

        <form
            action="{{ route('soal.store') }}"
            method="POST"
            class="glass
            p-6
            rounded-3xl
            space-y-6"
        >

            @csrf



            <!-- =================================================
                 ULANGAN
            ================================================== -->

            <div>

                <label
                    class="block
                    text-sm
                    font-bold
                    text-slate-300
                    mb-2"
                >
                    Pilih Ulangan
                </label>


                <select
                    name="level"
                    required
                    class="input-focus
                    w-full
                    p-3
                    rounded-xl
                    bg-slate-900
                    border border-white/10
                    text-white
                    focus:outline-none
                    focus:border-cyan-500"
                >

                    <option
                        value="1"
                        {{ old('level', 1) == 1 ? 'selected' : '' }}
                    >
                        Ulangan 1
                    </option>


                    <option
                        value="2"
                        {{ old('level') == 2 ? 'selected' : '' }}
                    >
                        Ulangan 2
                    </option>


                    <option
                        value="3"
                        {{ old('level') == 3 ? 'selected' : '' }}
                    >
                        Ulangan 3
                    </option>

                </select>


                <p
                    class="text-xs
                    text-slate-500
                    mt-2"
                >
                    Pilih ulangan IPA tempat soal ini akan digunakan.
                </p>

            </div>



            <!-- =================================================
                 PERTANYAAN
            ================================================== -->

            <div>

                <label
                    class="block
                    text-sm
                    font-bold
                    text-slate-300
                    mb-2"
                >
                    Pertanyaan Ulangan IPA
                </label>


                <textarea
                    name="pertanyaan"
                    rows="4"
                    required
                    placeholder="Tuliskan pertanyaan soal IPA di sini..."
                    class="input-focus
                    w-full
                    p-3
                    rounded-xl
                    bg-slate-900
                    border border-white/10
                    text-white
                    placeholder:text-white/30
                    focus:outline-none
                    focus:border-cyan-500"
                >{{ old('pertanyaan') }}</textarea>


                <p
                    class="text-xs
                    text-slate-500
                    mt-2"
                >
                    Buat pertanyaan yang jelas dan sesuai dengan materi IPA.
                </p>

            </div>



            <!-- =================================================
                 OPSI JAWABAN
            ================================================== -->

            <div>

                <div
                    class="flex
                    items-center
                    gap-2
                    mb-4"
                >

                    <div
                        class="w-8 h-8
                        rounded-lg
                        bg-cyan-500/10
                        border border-cyan-500/20
                        flex items-center
                        justify-center
                        text-cyan-400"
                    >

                        <i class="fa-solid fa-list-check"></i>

                    </div>


                    <div>

                        <h3 class="text-sm font-bold text-white">
                            Pilihan Jawaban
                        </h3>

                        <p class="text-[10px] text-white/40">
                            Masukkan empat pilihan jawaban untuk soal.
                        </p>

                    </div>

                </div>



                <div
                    class="grid
                    grid-cols-1
                    md:grid-cols-2
                    gap-4"
                >


                    <!-- A -->

                    <div>

                        <label
                            class="block
                            text-sm
                            font-bold
                            text-slate-300
                            mb-2"
                        >
                            Pilihan A
                        </label>


                        <div class="relative">

                            <span
                                class="absolute
                                left-3
                                top-1/2
                                -translate-y-1/2
                                w-7 h-7
                                rounded-lg
                                bg-cyan-500/20
                                text-cyan-400
                                flex items-center
                                justify-center
                                text-xs
                                font-black"
                            >
                                A
                            </span>


                            <input
                                type="text"
                                name="A"
                                value="{{ old('A') }}"
                                required
                                placeholder="Opsi jawaban A"
                                class="input-focus
                                w-full
                                p-3
                                pl-12
                                rounded-xl
                                bg-slate-900
                                border border-white/10
                                text-white
                                placeholder:text-white/30
                                focus:outline-none
                                focus:border-cyan-500"
                            >

                        </div>

                    </div>



                    <!-- B -->

                    <div>

                        <label
                            class="block
                            text-sm
                            font-bold
                            text-slate-300
                            mb-2"
                        >
                            Pilihan B
                        </label>


                        <div class="relative">

                            <span
                                class="absolute
                                left-3
                                top-1/2
                                -translate-y-1/2
                                w-7 h-7
                                rounded-lg
                                bg-purple-500/20
                                text-purple-400
                                flex items-center
                                justify-center
                                text-xs
                                font-black"
                            >
                                B
                            </span>


                            <input
                                type="text"
                                name="B"
                                value="{{ old('B') }}"
                                required
                                placeholder="Opsi jawaban B"
                                class="input-focus
                                w-full
                                p-3
                                pl-12
                                rounded-xl
                                bg-slate-900
                                border border-white/10
                                text-white
                                placeholder:text-white/30
                                focus:outline-none
                                focus:border-purple-500"
                            >

                        </div>

                    </div>



                    <!-- C -->

                    <div>

                        <label
                            class="block
                            text-sm
                            font-bold
                            text-slate-300
                            mb-2"
                        >
                            Pilihan C
                        </label>


                        <div class="relative">

                            <span
                                class="absolute
                                left-3
                                top-1/2
                                -translate-y-1/2
                                w-7 h-7
                                rounded-lg
                                bg-emerald-500/20
                                text-emerald-400
                                flex items-center
                                justify-center
                                text-xs
                                font-black"
                            >
                                C
                            </span>


                            <input
                                type="text"
                                name="C"
                                value="{{ old('C') }}"
                                required
                                placeholder="Opsi jawaban C"
                                class="input-focus
                                w-full
                                p-3
                                pl-12
                                rounded-xl
                                bg-slate-900
                                border border-white/10
                                text-white
                                placeholder:text-white/30
                                focus:outline-none
                                focus:border-emerald-500"
                            >

                        </div>

                    </div>



                    <!-- D -->

                    <div>

                        <label
                            class="block
                            text-sm
                            font-bold
                            text-slate-300
                            mb-2"
                        >
                            Pilihan D
                        </label>


                        <div class="relative">

                            <span
                                class="absolute
                                left-3
                                top-1/2
                                -translate-y-1/2
                                w-7 h-7
                                rounded-lg
                                bg-orange-500/20
                                text-orange-400
                                flex items-center
                                justify-center
                                text-xs
                                font-black"
                            >
                                D
                            </span>


                            <input
                                type="text"
                                name="D"
                                value="{{ old('D') }}"
                                required
                                placeholder="Opsi jawaban D"
                                class="input-focus
                                w-full
                                p-3
                                pl-12
                                rounded-xl
                                bg-slate-900
                                border border-white/10
                                text-white
                                placeholder:text-white/30
                                focus:outline-none
                                focus:border-orange-500"
                            >

                        </div>

                    </div>


                </div>

            </div>



            <!-- =================================================
                 KUNCI JAWABAN
            ================================================== -->

            <div>

                <label
                    class="block
                    text-sm
                    font-bold
                    text-slate-300
                    mb-2"
                >
                    Kunci Jawaban Benar
                </label>


                <select
                    name="jawaban"
                    required
                    class="input-focus
                    w-full
                    p-3
                    rounded-xl
                    bg-slate-900
                    border border-white/10
                    text-white
                    focus:outline-none
                    focus:border-cyan-500"
                >

                    <option
                        value="A"
                        {{ old('jawaban', 'A') == 'A' ? 'selected' : '' }}
                    >
                        A
                    </option>


                    <option
                        value="B"
                        {{ old('jawaban') == 'B' ? 'selected' : '' }}
                    >
                        B
                    </option>


                    <option
                        value="C"
                        {{ old('jawaban') == 'C' ? 'selected' : '' }}
                    >
                        C
                    </option>


                    <option
                        value="D"
                        {{ old('jawaban') == 'D' ? 'selected' : '' }}
                    >
                        D
                    </option>

                </select>


                <p
                    class="text-xs
                    text-slate-500
                    mt-2"
                >
                    Pilih jawaban yang benar untuk soal tersebut.
                </p>

            </div>



            <!-- =================================================
                 PENJELASAN
            ================================================== -->

            <div>

                <label
                    class="block
                    text-sm
                    font-bold
                    text-slate-300
                    mb-2"
                >
                    Penjelasan Jawaban
                    <span
                        class="text-white/30
                        font-normal"
                    >
                        (Opsional)
                    </span>
                </label>


                <textarea
                    name="penjelasan"
                    rows="3"
                    placeholder="Tuliskan penjelasan atau pembahasan jawaban..."
                    class="input-focus
                    w-full
                    p-3
                    rounded-xl
                    bg-slate-900
                    border border-white/10
                    text-white
                    placeholder:text-white/30
                    focus:outline-none
                    focus:border-cyan-500"
                >{{ old('penjelasan') }}</textarea>


                <p
                    class="text-xs
                    text-slate-500
                    mt-2"
                >
                    Penjelasan dapat digunakan untuk membantu siswa memahami jawaban.
                </p>

            </div>



            <!-- =================================================
                 INFORMASI
            ================================================== -->

            <div
                class="rounded-2xl
                bg-cyan-500/5
                border border-cyan-500/20
                p-4"
            >

                <div
                    class="flex
                    items-start
                    gap-3"
                >

                    <i
                        class="fa-solid
                        fa-circle-info
                        text-cyan-400
                        mt-0.5"
                    ></i>


                    <div>

                        <p
                            class="text-xs
                            font-bold
                            text-cyan-300
                            mb-1"
                        >
                            Informasi Soal
                        </p>


                        <p
                            class="text-[11px]
                            text-white/50
                            leading-relaxed"
                        >
                            Soal yang disimpan akan digunakan sebagai bagian
                            dari ulangan IPA sesuai dengan ulangan yang dipilih.
                        </p>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 TOMBOL SIMPAN
            ================================================== -->

            <div
                class="flex
                flex-col-reverse
                sm:flex-row
                gap-3
                pt-2"
            >

                <a
                    href="{{ route('soal.index') }}"
                    class="w-full
                    sm:w-1/3
                    py-3
                    bg-white/5
                    hover:bg-white/10
                    border border-white/10
                    text-white
                    font-bold
                    rounded-xl
                    transition
                    text-center"
                >

                    Batal

                </a>


                <button
                    type="submit"
                    class="w-full
                    sm:w-2/3
                    py-3
                    bg-gradient-to-r
                    from-cyan-500
                    to-blue-600
                    hover:from-cyan-400
                    hover:to-blue-500
                    text-white
                    font-bold
                    rounded-xl
                    transition
                    shadow-lg
                    shadow-cyan-500/20"
                >

                    <i
                        class="fa-solid
                        fa-floppy-disk
                        mr-2"
                    ></i>

                    Simpan Soal Ulangan

                </button>

            </div>


        </form>

    </div>
@endsection

