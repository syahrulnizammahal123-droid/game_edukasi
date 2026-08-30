@extends('layouts.game')

@section('title', 'Hasil Ulangan - QuizGo')

@push('styles')
<style>
body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(11, 19, 35, 0.60);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .btn-hover {
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            transform: translateY(-3px);
        }
</style>
@endpush

@section('content')
<!-- OVERLAY -->

    <div class="fixed inset-0 bg-[#030712]/85"></div>


    @php

        /*
        |--------------------------------------------------------------------------
        | DATA HASIL ULANGAN
        |--------------------------------------------------------------------------
        */

        $akurasi = $akurasi ?? 0;

        $skor = $skor ?? $akurasi;

        $benar = $benar ?? 0;

        $salah = $salah ?? 0;

        $totalSoal = $totalSoal ?? ($benar + $salah);

        $isKalah = $isKalah ?? ($akurasi < 60);


        /*
        |--------------------------------------------------------------------------
        | GRADE
        |--------------------------------------------------------------------------
        */

        if ($akurasi >= 90) {

            $gradeTampilan = 'A';
            $stars = 5;

        } elseif ($akurasi >= 75) {

            $gradeTampilan = 'B';
            $stars = 4;

        } elseif ($akurasi >= 60) {

            $gradeTampilan = 'C';
            $stars = 3;

        } elseif ($akurasi >= 50) {

            $gradeTampilan = 'D';
            $stars = 2;

        } else {

            $gradeTampilan = 'E';
            $stars = 1;

        }


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE BENAR DAN SALAH
        |--------------------------------------------------------------------------
        */

        $persenBenar = $totalSoal > 0
            ? round(($benar / $totalSoal) * 100)
            : 0;

        $persenSalah = $totalSoal > 0
            ? round(($salah / $totalSoal) * 100)
            : 0;

    @endphp



    <!-- =========================================================
         CONTENT
    ========================================================== -->

    <div class="relative z-10 max-w-2xl w-full mx-auto space-y-5">


        <!-- =====================================================
             HEADER HASIL
        ====================================================== -->

        <div
            class="glass
            rounded-[35px]
            p-8
            text-center
            border
            relative
            overflow-hidden
            shadow-xl

            {{ $isKalah
                ? 'border-rose-500/20 bg-rose-500/5'
                : 'border-cyan-500/20 bg-gradient-to-b from-cyan-500/5 to-transparent'
            }}"
        >


            <!-- GARIS ATAS -->

            <div
                class="absolute
                top-0
                inset-x-0
                flex
                justify-center"
            >

                <div
                    class="w-40
                    h-1
                    bg-gradient-to-r
                    from-transparent
                    via-cyan-400
                    to-transparent"
                ></div>

            </div>



            <!-- ICON HASIL -->

            <div
                class="w-24
                h-24
                rounded-[30px]

                {{ $isKalah
                    ? 'bg-gradient-to-br from-rose-500 to-red-700'
                    : 'bg-gradient-to-br from-cyan-400 via-blue-500 to-indigo-600'
                }}

                flex
                items-center
                justify-center
                mx-auto
                mb-4
                shadow-xl
                border
                border-white/10"
            >

                @if($isKalah)

                    <i
                        class="fa-solid
                        fa-rotate-left
                        text-4xl
                        text-white"
                    ></i>

                @else

                    <i
                        class="fa-solid
                        fa-trophy
                        text-4xl
                        text-white"
                    ></i>

                @endif

            </div>



            <!-- GRADE -->

            <div
                class="text-4xl
                font-black
                tracking-wider
                mb-2"
            >

                Nilai {{ $gradeTampilan }}

            </div>



            <!-- JUDUL -->

            @if($isKalah)

                <h1
                    class="text-2xl
                    font-black
                    tracking-wide
                    text-white"
                >
                    Tetap Semangat!
                </h1>


                <p
                    class="text-xs
                    text-white/50
                    mt-2
                    max-w-md
                    mx-auto
                    leading-relaxed"
                >

                    Jangan menyerah.
                    Pelajari kembali materi IPA dan soal yang telah dikerjakan,
                    kemudian coba lagi untuk mendapatkan hasil yang lebih baik.

                </p>

            @else

                <h1
                    class="text-2xl
                    font-black
                    tracking-wide
                    text-white"
                >
                    Ulangan Selesai!
                </h1>


                <p
                    class="text-xs
                    text-white/50
                    mt-2
                    max-w-md
                    mx-auto
                    leading-relaxed"
                >

                    Selamat! Kamu telah menyelesaikan
                    seluruh soal pada ulangan IPA ini.
                    Berikut adalah hasil belajarmu.

                </p>

            @endif



            <!-- BINTANG -->

            <div
                class="flex
                justify-center
                gap-1.5
                text-xl
                text-amber-400
                mt-5"
            >

                @for($i = 1; $i <= 5; $i++)

                    @if($i <= $stars)

                        <i class="fa-solid fa-star"></i>

                    @else

                        <i class="fa-regular fa-star text-white/10"></i>

                    @endif

                @endfor

            </div>


        </div>



        <!-- =========================================================
             METRIK HASIL
        ========================================================== -->

        <div
            class="grid
            grid-cols-2
            md:grid-cols-4
            gap-3"
        >


            <!-- SKOR -->

            <div
                class="glass
                rounded-2xl
                p-4
                border border-white/5
                text-center"
            >

                <div
                    class="w-9 h-9
                    rounded-xl
                    bg-cyan-500/10
                    mx-auto mb-2
                    flex items-center
                    justify-center"
                >

                    <i
                        class="fa-solid
                        fa-star
                        text-cyan-400
                        text-sm"
                    ></i>

                </div>


                <p
                    class="text-[10px]
                    text-white/40
                    uppercase
                    font-bold
                    tracking-widest
                    mb-1"
                >
                    Skor
                </p>


                <span
                    class="text-xl
                    font-black
                    text-cyan-400"
                >
                    {{ $skor }}
                </span>

            </div>



            <!-- AKURASI -->

            <div
                class="glass
                rounded-2xl
                p-4
                border border-white/5
                text-center"
            >

                <div
                    class="w-9 h-9
                    rounded-xl
                    bg-purple-500/10
                    mx-auto mb-2
                    flex items-center
                    justify-center"
                >

                    <i
                        class="fa-solid
                        fa-bullseye
                        text-purple-400
                        text-sm"
                    ></i>

                </div>


                <p
                    class="text-[10px]
                    text-white/40
                    uppercase
                    font-bold
                    tracking-widest
                    mb-1"
                >
                    Akurasi
                </p>


                <span
                    class="text-xl
                    font-black
                    text-purple-400"
                >
                    {{ $akurasi }}%
                </span>

            </div>



            <!-- BENAR -->

            <div
                class="glass
                rounded-2xl
                p-4
                border border-white/5
                text-center"
            >

                <div
                    class="w-9 h-9
                    rounded-xl
                    bg-emerald-500/10
                    mx-auto mb-2
                    flex items-center
                    justify-center"
                >

                    <i
                        class="fa-solid
                        fa-check
                        text-emerald-400
                        text-sm"
                    ></i>

                </div>


                <p
                    class="text-[10px]
                    text-white/40
                    uppercase
                    font-bold
                    tracking-widest
                    mb-1"
                >
                    Benar
                </p>


                <span
                    class="text-xl
                    font-black
                    text-emerald-400"
                >
                    {{ $benar }}
                </span>

            </div>



            <!-- SALAH -->

            <div
                class="glass
                rounded-2xl
                p-4
                border border-white/5
                text-center"
            >

                <div
                    class="w-9 h-9
                    rounded-xl
                    bg-rose-500/10
                    mx-auto mb-2
                    flex items-center
                    justify-center"
                >

                    <i
                        class="fa-solid
                        fa-xmark
                        text-rose-400
                        text-sm"
                    ></i>

                </div>


                <p
                    class="text-[10px]
                    text-white/40
                    uppercase
                    font-bold
                    tracking-widest
                    mb-1"
                >
                    Salah
                </p>


                <span
                    class="text-xl
                    font-black
                    text-rose-400"
                >
                    {{ $salah }}
                </span>

            </div>


        </div>



        <!-- =========================================================
             DETAIL HASIL
        ========================================================== -->

        <div
            class="glass
            rounded-[30px]
            p-6
            border border-white/5"
        >


            <div
                class="flex
                items-center
                gap-3
                border-b
                border-white/5
                pb-4"
            >

                <div
                    class="w-10 h-10
                    rounded-xl
                    bg-blue-500/10
                    flex items-center
                    justify-center"
                >

                    <i
                        class="fa-solid
                        fa-chart-simple
                        text-blue-400"
                    ></i>

                </div>


                <div>

                    <h3
                        class="text-sm
                        font-black
                        uppercase
                        tracking-wider
                        text-cyan-300"
                    >
                        Ringkasan Ulangan
                    </h3>


                    <p
                        class="text-[10px]
                        text-white/40"
                    >
                        Hasil berdasarkan seluruh soal pada ulangan IPA.
                    </p>

                </div>

            </div>



            <!-- TOTAL SOAL -->

            <div
                class="flex
                justify-between
                items-center
                mt-5"
            >

                <span
                    class="text-xs
                    text-white/50"
                >
                    Total Soal
                </span>


                <span
                    class="text-sm
                    font-bold
                    text-white"
                >
                    {{ $totalSoal }} soal
                </span>

            </div>



            <!-- BENAR -->

            <div
                class="flex
                justify-between
                items-center
                mt-3"
            >

                <span
                    class="text-xs
                    text-white/50"
                >
                    Jawaban Benar
                </span>


                <span
                    class="text-sm
                    font-bold
                    text-emerald-400"
                >

                    {{ $benar }} soal
                    ({{ $persenBenar }}%)

                </span>

            </div>



            <!-- SALAH -->

            <div
                class="flex
                justify-between
                items-center
                mt-3"
            >

                <span
                    class="text-xs
                    text-white/50"
                >
                    Jawaban Salah
                </span>


                <span
                    class="text-sm
                    font-bold
                    text-rose-400"
                >

                    {{ $salah }} soal
                    ({{ $persenSalah }}%)

                </span>

            </div>



            <!-- PROGRESS -->

            <div class="mt-5">

                <div
                    class="flex
                    justify-between
                    text-[10px]
                    mb-2"
                >

                    <span class="text-white/40">
                        Tingkat Keberhasilan
                    </span>


                    <span
                        class="text-cyan-400
                        font-bold"
                    >
                        {{ $akurasi }}%
                    </span>

                </div>


                <div
                    class="w-full
                    h-2
                    rounded-full
                    bg-white/5
                    overflow-hidden"
                >

                    <div
                        class="h-full
                        rounded-full
                        bg-gradient-to-r
                        from-cyan-400
                        via-blue-500
                        to-purple-500"
                        style="width: {{ min(100, max(0, $akurasi)) }}%;"
                    ></div>

                </div>

            </div>


        </div>



        <!-- =========================================================
             REKOMENDASI
        ========================================================== -->

        <div
            class="glass
            rounded-[30px]
            p-6
            border border-white/5"
        >


            <div
                class="flex
                items-center
                gap-3
                border-b
                border-white/5
                pb-3"
            >

                <div
                    class="w-9 h-9
                    rounded-lg
                    bg-cyan-500/10
                    flex items-center
                    justify-center"
                >

                    <i
                        class="fa-solid
                        fa-lightbulb
                        text-cyan-400
                        text-sm"
                    ></i>

                </div>


                <div>

                    <h3
                        class="text-xs
                        font-black
                        uppercase
                        tracking-wider
                        text-cyan-300"
                    >
                        Evaluasi Ulangan
                    </h3>


                    <p
                        class="text-[9px]
                        text-white/40"
                    >
                        Rekomendasi berdasarkan hasil ulangan IPA.
                    </p>

                </div>

            </div>



            @if($akurasi >= 90)

                <div
                    class="mt-4
                    flex
                    gap-3
                    items-start
                    bg-emerald-500/5
                    p-4
                    rounded-xl
                    border border-emerald-500/20"
                >

                    <i
                        class="fa-solid
                        fa-circle-check
                        text-emerald-400
                        mt-0.5"
                    ></i>


                    <p
                        class="text-xs
                        text-white/70
                        leading-relaxed"
                    >

                        <strong class="text-emerald-300">
                            Sangat Baik!
                        </strong>

                        Pemahaman kamu terhadap materi IPA
                        sangat baik. Pertahankan hasil ini
                        dan terus belajar.

                    </p>

                </div>


            @elseif($akurasi >= 75)

                <div
                    class="mt-4
                    flex
                    gap-3
                    items-start
                    bg-blue-500/5
                    p-4
                    rounded-xl
                    border border-blue-500/20"
                >

                    <i
                        class="fa-solid
                        fa-thumbs-up
                        text-blue-400
                        mt-0.5"
                    ></i>


                    <p
                        class="text-xs
                        text-white/70
                        leading-relaxed"
                    >

                        <strong class="text-blue-300">
                            Hasil Bagus!
                        </strong>

                        Pemahaman kamu terhadap materi IPA
                        sudah cukup baik. Terus belajar
                        agar mendapatkan hasil yang lebih tinggi.

                    </p>

                </div>


            @elseif($akurasi >= 60)

                <div
                    class="mt-4
                    flex
                    gap-3
                    items-start
                    bg-amber-500/5
                    p-4
                    rounded-xl
                    border border-amber-500/20"
                >

                    <i
                        class="fa-solid
                        fa-lightbulb
                        text-amber-400
                        mt-0.5"
                    ></i>


                    <p
                        class="text-xs
                        text-white/70
                        leading-relaxed"
                    >

                        <strong class="text-amber-300">
                            Cukup Baik.
                        </strong>

                        Kamu sudah mencapai batas kelulusan.
                        Pelajari kembali materi yang masih sulit
                        dan coba tingkatkan hasil pada ulangan berikutnya.

                    </p>

                </div>


            @else

                <div
                    class="mt-4
                    flex
                    gap-3
                    items-start
                    bg-rose-500/5
                    p-4
                    rounded-xl
                    border border-rose-500/20"
                >

                    <i
                        class="fa-solid
                        fa-triangle-exclamation
                        text-rose-400
                        mt-0.5"
                    ></i>


                    <p
                        class="text-xs
                        text-white/70
                        leading-relaxed"
                    >

                        <strong class="text-rose-300">
                            Perlu Latihan.
                        </strong>

                        Pelajari kembali materi IPA
                        dan soal yang telah dikerjakan.
                        Setelah lebih siap, ulangi ulangan ini.

                    </p>

                </div>

            @endif


        </div>



        <!-- =========================================================
             TOMBOL NAVIGASI
        ========================================================== -->

        <div
            class="grid
            grid-cols-1
            sm:grid-cols-2
            gap-3
            pt-1"
        >


            <!-- KEMBALI KE ULANGAN -->

            <a
                href="{{ route('game.level') }}"
                class="w-full
                inline-flex
                items-center
                justify-center
                gap-2.5
                bg-white/5
                border border-white/10
                text-white
                font-bold
                text-sm
                py-4
                rounded-xl
                hover:bg-white/10
                transition
                duration-200
                uppercase
                tracking-wide
                btn-hover"
            >

                <i
                    class="fa-solid
                    fa-rotate-left
                    text-xs
                    text-white/60"
                ></i>


                <span>
                    Kembali ke Ulangan
                </span>

            </a>



            <!-- DASHBOARD -->

            <a
                href="{{ route('dashboard') }}"
                class="w-full
                inline-flex
                items-center
                justify-center
                gap-2.5
                bg-gradient-to-r
                from-cyan-400
                via-blue-500
                to-indigo-600
                text-white
                font-black
                text-sm
                py-4
                rounded-xl
                shadow-lg
                shadow-blue-500/20
                btn-hover
                transition
                duration-200
                uppercase
                tracking-wide"
            >

                <span>
                    Ke Dashboard
                </span>


                <i
                    class="fa-solid
                    fa-house
                    text-xs"
                ></i>

            </a>


        </div>


    </div>



    @include('components.sound')
@endsection

