@extends('layouts.app')

@section('title', 'Kelola Soal IPA - QuizGo')

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

        .card-hover {
            transition: all 0.25s ease;
        }

        .card-hover:hover {
            transform: translateY(-3px);
        }
</style>
@endpush

@section('content')
<div
            class="max-w-6xl
            mx-auto
            space-y-8"
        >


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div
                class="glass
                rounded-[30px]
                p-8
                relative
                overflow-hidden
                border border-white/10"
            >

                <div
                    class="relative
                    z-10"
                >

                    <span
                        class="px-3 py-1
                        rounded-xl
                        bg-cyan-500/10
                        text-cyan-400
                        text-[11px]
                        font-black
                        border border-cyan-400/20
                        uppercase
                        tracking-widest
                        mb-3
                        inline-block"
                    >

                        <i
                            class="fa-solid
                            fa-flask
                            mr-1"
                        ></i>

                        MEDIA PEMBELAJARAN IPA

                    </span>


                    <h2
                        class="text-3xl
                        font-extrabold
                        text-white"
                    >
                        Kelola Soal Ulangan IPA
                    </h2>


                    <p
                        class="text-white/60
                        text-sm
                        mt-1"
                    >
                        Tambahkan, ubah, atau hapus soal yang digunakan dalam ulangan IPA QuizGo.
                    </p>

                </div>

            </div>



            <!-- =================================================
                 PESAN SUCCESS
            ================================================== -->

            @if(session('success'))

                <div
                    class="rounded-2xl
                    bg-green-500/10
                    border border-green-500/30
                    text-green-300
                    px-5 py-4"
                >

                    <i
                        class="fa-solid
                        fa-circle-check
                        mr-2"
                    ></i>

                    {{ session('success') }}

                </div>

            @endif



            <!-- =================================================
                 PESAN ERROR
            ================================================== -->

            @if(session('error'))

                <div
                    class="rounded-2xl
                    bg-red-500/10
                    border border-red-500/30
                    text-red-300
                    px-5 py-4"
                >

                    <i
                        class="fa-solid
                        fa-triangle-exclamation
                        mr-2"
                    ></i>

                    {{ session('error') }}

                </div>

            @endif



            <!-- =================================================
                 TOMBOL KATEGORI + TAMBAH
            ================================================== -->

            <div
                class="flex
                flex-col
                sm:flex-row
                sm:items-center
                justify-between
                gap-4"
            >


                <!-- TAB -->

                <div
                    class="inline-flex
                    p-1.5
                    bg-[#0b1324]
                    rounded-2xl
                    border border-white/10
                    w-fit"
                >

                    <a
                        href="{{ route('soal.index') }}"
                        class="px-5 py-2.5
                        rounded-xl
                        bg-cyan-500
                        text-white
                        font-bold
                        text-xs
                        flex items-center
                        gap-2
                        shadow-md"
                    >

                        <i
                            class="fa-solid
                            fa-list-check"
                        ></i>

                        <span>
                            Soal Ulangan IPA
                        </span>

                    </a>

                </div>



                <!-- TAMBAH -->

                <a
                    href="{{ route('soal.create') }}"
                    class="px-6 py-3
                    rounded-2xl
                    bg-gradient-to-r
                    from-cyan-500
                    to-blue-600
                    text-white
                    font-extrabold
                    text-sm
                    shadow-lg
                    shadow-cyan-500/25
                    hover:brightness-110
                    active:scale-95
                    transition
                    flex items-center
                    justify-center
                    gap-2"
                >

                    <i
                        class="fa-solid
                        fa-plus
                        text-base"
                    ></i>

                    <span>
                        Tambah Soal Baru
                    </span>

                </a>

            </div>



            <!-- =================================================
                 INFORMASI ULANGAN
            ================================================== -->

            <div
                class="grid
                grid-cols-1
                md:grid-cols-3
                gap-4"
            >


                <!-- ULANGAN 1 -->

                <div
                    class="card-hover
                    bg-cyan-500/10
                    border border-cyan-500/20
                    rounded-2xl
                    p-5"
                >

                    <div
                        class="flex
                        items-center
                        justify-between"
                    >

                        <div>

                            <p
                                class="text-xs
                                text-cyan-300
                                uppercase
                                font-bold
                                tracking-wider"
                            >
                                Ulangan 1
                            </p>


                            <p
                                class="text-white/50
                                text-xs
                                mt-1"
                            >
                                Soal IPA
                            </p>

                        </div>


                        <div
                            class="w-11 h-11
                            rounded-xl
                            bg-cyan-500/20
                            flex items-center
                            justify-center"
                        >

                            <i
                                class="fa-solid
                                fa-flask
                                text-cyan-400"
                            ></i>

                        </div>

                    </div>


                    <p
                        class="text-white
                        text-2xl
                        font-black
                        mt-4"
                    >

                        {{ $soals->where('level', 1)->count() }}

                        <span
                            class="text-xs
                            text-white/40
                            font-normal"
                        >
                            soal
                        </span>

                    </p>

                </div>



                <!-- ULANGAN 2 -->

                <div
                    class="card-hover
                    bg-purple-500/10
                    border border-purple-500/20
                    rounded-2xl
                    p-5"
                >

                    <div
                        class="flex
                        items-center
                        justify-between"
                    >

                        <div>

                            <p
                                class="text-xs
                                text-purple-300
                                uppercase
                                font-bold
                                tracking-wider"
                            >
                                Ulangan 2
                            </p>


                            <p
                                class="text-white/50
                                text-xs
                                mt-1"
                            >
                                Soal IPA
                            </p>

                        </div>


                        <div
                            class="w-11 h-11
                            rounded-xl
                            bg-purple-500/20
                            flex items-center
                            justify-center"
                        >

                            <i
                                class="fa-solid
                                fa-atom
                                text-purple-400"
                            ></i>

                        </div>

                    </div>


                    <p
                        class="text-white
                        text-2xl
                        font-black
                        mt-4"
                    >

                        {{ $soals->where('level', 2)->count() }}

                        <span
                            class="text-xs
                            text-white/40
                            font-normal"
                        >
                            soal
                        </span>

                    </p>

                </div>



                <!-- ULANGAN 3 -->

                <div
                    class="card-hover
                    bg-orange-500/10
                    border border-orange-500/20
                    rounded-2xl
                    p-5"
                >

                    <div
                        class="flex
                        items-center
                        justify-between"
                    >

                        <div>

                            <p
                                class="text-xs
                                text-orange-300
                                uppercase
                                font-bold
                                tracking-wider"
                            >
                                Ulangan 3
                            </p>


                            <p
                                class="text-white/50
                                text-xs
                                mt-1"
                            >
                                Soal IPA
                            </p>

                        </div>


                        <div
                            class="w-11 h-11
                            rounded-xl
                            bg-orange-500/20
                            flex items-center
                            justify-center"
                        >

                            <i
                                class="fa-solid
                                fa-microscope
                                text-orange-400"
                            ></i>

                        </div>

                    </div>


                    <p
                        class="text-white
                        text-2xl
                        font-black
                        mt-4"
                    >

                        {{ $soals->where('level', 3)->count() }}

                        <span
                            class="text-xs
                            text-white/40
                            font-normal"
                        >
                            soal
                        </span>

                    </p>

                </div>


            </div>



            <!-- =================================================
                 TABEL SOAL
            ================================================== -->

            <div
                class="glass
                rounded-[25px]
                overflow-hidden
                border border-white/10
                shadow-2xl"
            >

                <div class="overflow-x-auto">

                    <table
                        class="w-full
                        text-left
                        border-collapse"
                    >


                        <!-- HEADER TABLE -->

                        <thead>

                            <tr
                                class="border-b
                                border-white/10
                                bg-white/5
                                text-white/40
                                text-[11px]
                                font-black
                                uppercase
                                tracking-wider"
                            >

                                <th
                                    class="p-5
                                    text-center
                                    w-24"
                                >
                                    Ulangan
                                </th>


                                <th class="p-5">
                                    Pertanyaan Ulangan IPA
                                </th>


                                <th
                                    class="p-5
                                    text-center
                                    w-32"
                                >
                                    Kunci Jawaban
                                </th>


                                <th
                                    class="p-5
                                    text-center
                                    w-36"
                                >
                                    Aksi
                                </th>

                            </tr>

                        </thead>



                        <!-- BODY TABLE -->

                        <tbody
                            class="divide-y
                            divide-white/5
                            text-sm"
                        >


                            @forelse($soals as $item)

                                <tr
                                    class="hover:bg-white/5
                                    transition"
                                >


                                    <!-- ULANGAN -->

                                    <td
                                        class="p-5
                                        text-center
                                        font-extrabold"
                                    >

                                        @if((int) $item->level === 1)

                                            <span
                                                class="px-3 py-1.5
                                                rounded-lg
                                                bg-cyan-500/20
                                                text-cyan-400
                                                text-xs
                                                border border-cyan-500/30
                                                font-bold"
                                            >
                                                Ulangan 1
                                            </span>

                                        @elseif((int) $item->level === 2)

                                            <span
                                                class="px-3 py-1.5
                                                rounded-lg
                                                bg-purple-500/20
                                                text-purple-400
                                                text-xs
                                                border border-purple-500/30
                                                font-bold"
                                            >
                                                Ulangan 2
                                            </span>

                                        @elseif((int) $item->level === 3)

                                            <span
                                                class="px-3 py-1.5
                                                rounded-lg
                                                bg-orange-500/20
                                                text-orange-400
                                                text-xs
                                                border border-orange-500/30
                                                font-bold"
                                            >
                                                Ulangan 3
                                            </span>

                                        @else

                                            <span
                                                class="px-3 py-1.5
                                                rounded-lg
                                                bg-white/10
                                                text-white/50
                                                text-xs"
                                            >
                                                -
                                            </span>

                                        @endif

                                    </td>



                                    <!-- PERTANYAAN -->

                                    <td
                                        class="p-5
                                        text-white/90
                                        font-medium
                                        leading-relaxed"
                                    >

                                        {{ $item->pertanyaan }}

                                    </td>



                                    <!-- KUNCI JAWABAN -->

                                    <td
                                        class="p-5
                                        text-center"
                                    >

                                        <span
                                            class="px-3 py-1
                                            rounded-xl
                                            bg-white/10
                                            text-white
                                            font-bold
                                            text-xs
                                            border border-white/10"
                                        >

                                            Opsi
                                            {{ strtoupper($item->jawaban_benar ?? $item->jawaban ?? 'A') }}

                                        </span>

                                    </td>



                                    <!-- AKSI -->

                                    <td
                                        class="p-5
                                        text-center"
                                    >

                                        <div
                                            class="flex
                                            items-center
                                            justify-center
                                            gap-2"
                                        >


                                            <!-- EDIT -->

                                            <a
                                                href="{{ route('soal.edit', $item->id) }}"
                                                class="w-9 h-9
                                                rounded-xl
                                                bg-amber-500/20
                                                border border-amber-500/30
                                                text-amber-400
                                                hover:bg-amber-500
                                                hover:text-white
                                                flex items-center
                                                justify-center
                                                transition
                                                shadow-sm"
                                                title="Edit Soal"
                                            >

                                                <i
                                                    class="fa-solid
                                                    fa-pen-to-square"
                                                ></i>

                                            </a>



                                            <!-- HAPUS -->

                                            <form
                                                action="{{ route('soal.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ulangan IPA ini?')"
                                            >

                                                @csrf

                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="w-9 h-9
                                                    rounded-xl
                                                    bg-rose-500/20
                                                    border border-rose-500/30
                                                    text-rose-400
                                                    hover:bg-rose-500
                                                    hover:text-white
                                                    flex items-center
                                                    justify-center
                                                    transition
                                                    shadow-sm"
                                                    title="Hapus Soal"
                                                >

                                                    <i
                                                        class="fa-solid
                                                        fa-trash-can"
                                                    ></i>

                                                </button>

                                            </form>


                                        </div>

                                    </td>


                                </tr>


                            @empty

                                <!-- TIDAK ADA SOAL -->

                                <tr>

                                    <td
                                        colspan="4"
                                        class="p-10
                                        text-center
                                        text-white/40
                                        font-medium"
                                    >

                                        <i
                                            class="fa-solid
                                            fa-flask
                                            text-3xl
                                            mb-3
                                            block
                                            opacity-30"
                                        ></i>


                                        Belum ada soal ulangan IPA yang ditambahkan.

                                        <br>


                                        Silakan klik tombol

                                        <b class="text-cyan-400">
                                            + Tambah Soal Baru
                                        </b>

                                        di atas.

                                    </td>

                                </tr>

                            @endforelse


                        </tbody>

                    </table>

                </div>

            </div>



            <!-- =================================================
                 RINGKASAN
            ================================================== -->

            <div
                class="text-center
                text-white/30
                text-xs"
            >

                Total soal ulangan IPA:

                <span
                    class="text-white/60
                    font-bold"
                >
                    {{ $soals->count() }}
                </span>

                soal

            </div>


        </div>
@endsection

