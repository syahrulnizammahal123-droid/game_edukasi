<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Soal Ulangan IPA - QuizGo</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />


    <style>

        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .input-focus {
            transition: all 0.25s ease;
        }

        .input-focus:focus {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.08);
        }

    </style>

</head>


<body
    class="relative min-h-screen
    bg-cover bg-center bg-fixed
    bg-no-repeat overflow-x-hidden"
    style="background-image:url('{{ asset('images/bg-login.jpg') }}')"
>


    <!-- OVERLAY -->

    <div
        class="fixed inset-0
        bg-[#07111f]/80
        -z-10"
    ></div>


    <!-- DECORATION -->

    <div
        class="absolute top-0 left-0
        w-72 h-72
        bg-amber-400/10
        blur-3xl
        rounded-full"
    ></div>


    <div
        class="absolute bottom-0 right-0
        w-72 h-72
        bg-purple-500/20
        blur-3xl
        rounded-full"
    ></div>



    <!-- MAIN -->

    <div
        class="relative z-10
        min-h-screen
        p-5 lg:p-8
        pb-32"
    >

        <div class="max-w-5xl mx-auto">


            <!-- =====================================================
                 HEADER
            ====================================================== -->

            <div
                class="glass
                rounded-[35px]
                p-6 lg:p-8
                mb-8"
            >

                <div
                    class="flex flex-col
                    lg:flex-row
                    lg:items-center
                    lg:justify-between
                    gap-6"
                >

                    <div>


                        <p
                            class="text-amber-400
                            font-semibold
                            mb-3"
                        >

                            <i class="fa-solid fa-flask mr-1.5"></i>

                            QuizGo • Manajemen Soal IPA

                        </p>


                        <h1
                            class="text-4xl
                            lg:text-6xl
                            font-extrabold
                            text-white"
                        >
                            Edit Soal Ulangan
                        </h1>


                        <p
                            class="text-white/60
                            mt-4
                            max-w-2xl"
                        >
                            Perbarui pertanyaan dan pilihan jawaban
                            agar soal ulangan IPA tetap sesuai dengan
                            materi pembelajaran.
                        </p>

                    </div>


                    <!-- KEMBALI -->

                    <a
                        href="{{ route('soal.index') }}"
                        class="w-14 h-14
                        rounded-2xl
                        glass
                        flex items-center
                        justify-center
                        text-white
                        hover:bg-white/10
                        transition"
                        title="Kembali ke Soal IPA"
                    >

                        <i class="fa-solid fa-arrow-left"></i>

                    </a>

                </div>

            </div>



            <!-- =====================================================
                 ERROR VALIDASI
            ====================================================== -->

            @if($errors->any())

                <div
                    class="mb-6
                    rounded-[30px]
                    bg-red-500/20
                    border border-red-400/20
                    p-5"
                >

                    @foreach($errors->all() as $error)

                        <div
                            class="text-red-200
                            mb-2
                            flex
                            items-center
                            gap-2"
                        >

                            <i
                                class="fa-solid
                                fa-triangle-exclamation"
                            ></i>

                            <span>
                                {{ $error }}
                            </span>

                        </div>

                    @endforeach

                </div>

            @endif



            <!-- =====================================================
                 PESAN ERROR SESSION
            ====================================================== -->

            @if(session('error'))

                <div
                    class="mb-6
                    rounded-[30px]
                    bg-red-500/20
                    border border-red-400/20
                    p-5"
                >

                    <div
                        class="text-red-200
                        flex items-center
                        gap-2"
                    >

                        <i
                            class="fa-solid
                            fa-triangle-exclamation"
                        ></i>

                        <span>
                            {{ session('error') }}
                        </span>

                    </div>

                </div>

            @endif



            <!-- =====================================================
                 FORM EDIT SOAL
            ====================================================== -->

            <form
                action="{{ route('soal.update', $soal->id) }}"
                method="POST"
            >

                @csrf

                @method('PUT')



                <!-- =================================================
                     SECTION 1: PERTANYAAN
                ================================================== -->

                <div
                    class="glass
                    rounded-[35px]
                    p-6 lg:p-8
                    mb-8"
                >

                    <div
                        class="flex
                        items-center
                        gap-4
                        mb-6"
                    >

                        <div
                            class="w-16 h-16
                            rounded-3xl
                            bg-gradient-to-br
                            from-amber-400
                            to-orange-600
                            flex items-center
                            justify-center
                            shrink-0
                            shadow-lg
                            shadow-amber-500/20"
                        >

                            <i
                                class="fa-solid
                                fa-pen-to-square
                                text-white
                                text-xl"
                            ></i>

                        </div>


                        <div>

                            <p
                                class="text-amber-400
                                text-sm
                                font-semibold"
                            >
                                Soal Ulangan IPA
                            </p>


                            <h2
                                class="text-white
                                text-3xl
                                font-bold"
                            >
                                Edit Pertanyaan
                            </h2>

                        </div>

                    </div>


                    <textarea
                        name="pertanyaan"
                        rows="4"
                        required
                        class="input-focus
                        w-full
                        bg-white/5
                        border border-white/10
                        rounded-[30px]
                        p-6
                        text-white
                        focus:outline-none
                        focus:ring-2
                        focus:ring-amber-400
                        font-medium
                        leading-relaxed
                        placeholder:text-white/30"
                        placeholder="Tulis pertanyaan soal IPA di sini..."
                    >{{ old('pertanyaan', $soal->pertanyaan ?? '') }}</textarea>

                </div>



                <!-- =================================================
                     SECTION 2: OPSI JAWABAN
                ================================================== -->

                <div
                    class="glass
                    rounded-[35px]
                    p-6 lg:p-8
                    mb-8"
                >

                    <div
                        class="flex
                        items-center
                        gap-4
                        mb-8"
                    >

                        <div
                            class="w-16 h-16
                            rounded-3xl
                            bg-gradient-to-br
                            from-purple-500
                            to-pink-600
                            flex items-center
                            justify-center
                            shrink-0
                            shadow-lg
                            shadow-purple-500/20"
                        >

                            <i
                                class="fa-solid
                                fa-list-check
                                text-white
                                text-xl"
                            ></i>

                        </div>


                        <div>

                            <p
                                class="text-amber-400
                                text-sm
                                font-semibold"
                            >
                                Pilihan Jawaban
                            </p>


                            <h2
                                class="text-white
                                text-3xl
                                font-bold"
                            >
                                Ubah Opsi Jawaban
                            </h2>

                        </div>

                    </div>



                    <div
                        class="grid
                        grid-cols-1
                        gap-6"
                    >


                        <!-- PILIHAN A -->

                        <div>

                            <label
                                class="text-white
                                font-semibold
                                mb-3
                                block"
                            >
                                Pilihan A
                            </label>


                            <div
                                class="flex
                                gap-4"
                            >

                                <div
                                    class="w-14 h-14
                                    rounded-2xl
                                    bg-cyan-500
                                    flex items-center
                                    justify-center
                                    text-white
                                    font-extrabold
                                    text-lg
                                    shrink-0
                                    shadow-md
                                    shadow-cyan-500/20"
                                >
                                    A
                                </div>


                                <input
                                    type="text"
                                    name="A"
                                    required
                                    value="{{ old('A', $soal->A ?? $soal->opsi_a ?? '') }}"
                                    class="input-focus
                                    flex-1
                                    bg-white/5
                                    border border-white/10
                                    rounded-2xl
                                    px-5
                                    text-white
                                    placeholder:text-white/30
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-amber-400
                                    font-medium"
                                    placeholder="Teks pilihan A"
                                >

                            </div>

                        </div>



                        <!-- PILIHAN B -->

                        <div>

                            <label
                                class="text-white
                                font-semibold
                                mb-3
                                block"
                            >
                                Pilihan B
                            </label>


                            <div
                                class="flex
                                gap-4"
                            >

                                <div
                                    class="w-14 h-14
                                    rounded-2xl
                                    bg-purple-500
                                    flex items-center
                                    justify-center
                                    text-white
                                    font-extrabold
                                    text-lg
                                    shrink-0
                                    shadow-md
                                    shadow-purple-500/20"
                                >
                                    B
                                </div>


                                <input
                                    type="text"
                                    name="B"
                                    required
                                    value="{{ old('B', $soal->B ?? $soal->opsi_b ?? '') }}"
                                    class="input-focus
                                    flex-1
                                    bg-white/5
                                    border border-white/10
                                    rounded-2xl
                                    px-5
                                    text-white
                                    placeholder:text-white/30
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-amber-400
                                    font-medium"
                                    placeholder="Teks pilihan B"
                                >

                            </div>

                        </div>



                        <!-- PILIHAN C -->

                        <div>

                            <label
                                class="text-white
                                font-semibold
                                mb-3
                                block"
                            >
                                Pilihan C
                            </label>


                            <div
                                class="flex
                                gap-4"
                            >

                                <div
                                    class="w-14 h-14
                                    rounded-2xl
                                    bg-emerald-500
                                    flex items-center
                                    justify-center
                                    text-white
                                    font-extrabold
                                    text-lg
                                    shrink-0
                                    shadow-md
                                    shadow-emerald-500/20"
                                >
                                    C
                                </div>


                                <input
                                    type="text"
                                    name="C"
                                    required
                                    value="{{ old('C', $soal->C ?? $soal->opsi_c ?? '') }}"
                                    class="input-focus
                                    flex-1
                                    bg-white/5
                                    border border-white/10
                                    rounded-2xl
                                    px-5
                                    text-white
                                    placeholder:text-white/30
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-amber-400
                                    font-medium"
                                    placeholder="Teks pilihan C"
                                >

                            </div>

                        </div>



                        <!-- PILIHAN D -->

                        <div>

                            <label
                                class="text-white
                                font-semibold
                                mb-3
                                block"
                            >
                                Pilihan D
                            </label>


                            <div
                                class="flex
                                gap-4"
                            >

                                <div
                                    class="w-14 h-14
                                    rounded-2xl
                                    bg-orange-500
                                    flex items-center
                                    justify-center
                                    text-white
                                    font-extrabold
                                    text-lg
                                    shrink-0
                                    shadow-md
                                    shadow-orange-500/20"
                                >
                                    D
                                </div>


                                <input
                                    type="text"
                                    name="D"
                                    required
                                    value="{{ old('D', $soal->D ?? $soal->opsi_d ?? '') }}"
                                    class="input-focus
                                    flex-1
                                    bg-white/5
                                    border border-white/10
                                    rounded-2xl
                                    px-5
                                    text-white
                                    placeholder:text-white/30
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-amber-400
                                    font-medium"
                                    placeholder="Teks pilihan D"
                                >

                            </div>

                        </div>


                    </div>

                </div>



                <!-- =================================================
                     SECTION 3: JAWABAN & ULANGAN
                ================================================== -->

                <div
                    class="glass
                    rounded-[35px]
                    p-6 lg:p-8
                    mb-8"
                >

                    <div
                        class="grid
                        grid-cols-1
                        lg:grid-cols-2
                        gap-6"
                    >


                        <!-- KUNCI JAWABAN -->

                        <div>

                            <label
                                class="text-white
                                font-semibold
                                mb-3
                                block"
                            >
                                Jawaban Benar
                            </label>


                            @php

                                $kunciAktif = strtoupper(
                                    old(
                                        'jawaban',
                                        $soal->jawaban ??
                                        $soal->jawaban_benar ??
                                        'A'
                                    )
                                );

                            @endphp


                            <select
                                name="jawaban"
                                required
                                class="input-focus
                                w-full
                                bg-white/5
                                border border-white/10
                                rounded-2xl
                                px-5 py-4
                                text-white
                                focus:outline-none
                                focus:ring-2
                                focus:ring-amber-400
                                font-semibold"
                            >

                                <option
                                    class="bg-[#0b1020]"
                                    value="A"
                                    {{ $kunciAktif == 'A' ? 'selected' : '' }}
                                >
                                    Pilihan A
                                </option>


                                <option
                                    class="bg-[#0b1020]"
                                    value="B"
                                    {{ $kunciAktif == 'B' ? 'selected' : '' }}
                                >
                                    Pilihan B
                                </option>


                                <option
                                    class="bg-[#0b1020]"
                                    value="C"
                                    {{ $kunciAktif == 'C' ? 'selected' : '' }}
                                >
                                    Pilihan C
                                </option>


                                <option
                                    class="bg-[#0b1020]"
                                    value="D"
                                    {{ $kunciAktif == 'D' ? 'selected' : '' }}
                                >
                                    Pilihan D
                                </option>

                            </select>

                        </div>



                        <!-- ULANGAN -->

                        <div>

                            <label
                                class="text-white
                                font-semibold
                                mb-3
                                block"
                            >
                                Ulangan
                            </label>


                            @php

                                $levelAktif = (int) old(
                                    'level',
                                    $soal->level ?? 1
                                );

                            @endphp


                            <select
                                name="level"
                                required
                                class="input-focus
                                w-full
                                bg-white/5
                                border border-white/10
                                rounded-2xl
                                px-5 py-4
                                text-white
                                focus:outline-none
                                focus:ring-2
                                focus:ring-amber-400
                                font-semibold"
                            >

                                <option
                                    class="bg-[#0b1020]"
                                    value="1"
                                    {{ $levelAktif === 1 ? 'selected' : '' }}
                                >
                                    Ulangan 1
                                </option>


                                <option
                                    class="bg-[#0b1020]"
                                    value="2"
                                    {{ $levelAktif === 2 ? 'selected' : '' }}
                                >
                                    Ulangan 2
                                </option>


                                <option
                                    class="bg-[#0b1020]"
                                    value="3"
                                    {{ $levelAktif === 3 ? 'selected' : '' }}
                                >
                                    Ulangan 3
                                </option>

                            </select>


                            <p
                                class="text-xs
                                text-slate-500
                                mt-2"
                            >
                                Tentukan ulangan IPA tempat soal ini digunakan.
                            </p>

                        </div>


                    </div>

                </div>



                <!-- =================================================
                     SECTION 4: PEMBAHASAN
                ================================================== -->

                <div
                    class="glass
                    rounded-[35px]
                    p-6 lg:p-8
                    mb-8"
                >

                    <div
                        class="flex
                        items-center
                        gap-4
                        mb-6"
                    >

                        <div
                            class="w-16 h-16
                            rounded-3xl
                            bg-gradient-to-br
                            from-green-400
                            to-emerald-600
                            flex items-center
                            justify-center
                            shrink-0
                            shadow-lg
                            shadow-emerald-500/20"
                        >

                            <i
                                class="fa-solid
                                fa-lightbulb
                                text-white
                                text-xl"
                            ></i>

                        </div>


                        <div>

                            <p
                                class="text-emerald-400
                                text-sm
                                font-semibold"
                            >
                                Penjelasan Jawaban
                            </p>


                            <h2
                                class="text-white
                                text-3xl
                                font-bold"
                            >
                                Edit Pembahasan
                            </h2>

                        </div>

                    </div>


                    <textarea
                        name="penjelasan"
                        rows="4"
                        class="input-focus
                        w-full
                        bg-white/5
                        border border-white/10
                        rounded-[30px]
                        p-6
                        text-white
                        focus:outline-none
                        focus:ring-2
                        focus:ring-amber-400
                        font-medium
                        leading-relaxed
                        placeholder:text-white/30"
                        placeholder="Tulis penjelasan pembahasan soal di sini (opsional)..."
                    >{{ old('penjelasan', $soal->penjelasan ?? '') }}</textarea>


                    <p
                        class="text-xs
                        text-slate-500
                        mt-2"
                    >
                        Penjelasan dapat membantu siswa memahami alasan dari jawaban yang benar.
                    </p>

                </div>



                <!-- =================================================
                     TOMBOL AKSI
                ================================================== -->

                <div
                    class="grid
                    grid-cols-1
                    lg:grid-cols-2
                    gap-5"
                >


                    <!-- BATAL -->

                    <a
                        href="{{ route('soal.index') }}"
                        class="flex
                        items-center
                        justify-center
                        gap-3
                        glass
                        text-white
                        py-5
                        rounded-[30px]
                        text-lg
                        font-bold
                        hover:bg-white/10
                        transition"
                    >

                        <i class="fa-solid fa-arrow-left"></i>

                        Batal

                    </a>



                    <!-- UPDATE -->

                    <button
                        type="submit"
                        class="flex
                        items-center
                        justify-center
                        gap-3
                        bg-gradient-to-r
                        from-amber-500
                        to-orange-600
                        text-white
                        py-5
                        rounded-[30px]
                        text-lg
                        font-bold
                        shadow-[0_0_35px_rgba(245,158,11,0.25)]
                        hover:scale-[1.02]
                        active:scale-95
                        transition
                        duration-300"
                    >

                        <i
                            class="fa-solid
                            fa-arrows-rotate"
                        ></i>

                        Perbarui Soal

                    </button>


                </div>


            </form>


        </div>

    </div>


</body>

</html>