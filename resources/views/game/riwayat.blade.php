<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Ulangan - QuizGo</title>

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
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .menu-hover {
            transition: all 0.25s ease;
        }

        .menu-hover:hover {
            transform: translateX(3px);
        }

        .table-row {
            transition: all 0.25s ease;
        }

        .table-row:hover {
            background: rgba(255, 255, 255, 0.05);
        }

    </style>

</head>


<body
    class="bg-[#070d19]
    text-white
    min-h-screen
    flex
    selection:bg-cyan-500
    selection:text-white"
>


    <!-- =========================================================
         SIDEBAR NAVIGASI
    ========================================================== -->

    <aside
        class="w-64
        bg-[#0b1324]
        border-r border-white/10
        p-6
        flex flex-col
        justify-between
        shrink-0
        min-h-screen"
    >

        <div>


            <!-- =================================================
                 LOGO
            ================================================== -->

            <div
                class="flex items-center
                gap-3
                mb-10"
            >

                <div
                    class="w-10 h-10
                    rounded-xl
                    bg-cyan-500
                    flex items-center
                    justify-center
                    text-white
                    text-xl
                    font-black
                    shadow-lg
                    shadow-cyan-500/30"
                >

                    <i class="fa-solid fa-flask"></i>

                </div>


                <div>

                    <h1
                        class="font-extrabold
                        text-lg
                        leading-none
                        tracking-wide
                        text-white"
                    >
                        QuizGo
                    </h1>


                    <span
                        class="text-[10px]
                        font-black
                        text-cyan-400
                        tracking-widest
                        uppercase"
                    >
                        MEDIA PEMBELAJARAN IPA
                    </span>

                </div>

            </div>



            <!-- =================================================
                 MENU SIDEBAR
            ================================================== -->

            <nav class="space-y-2">


                <!-- DASHBOARD -->

                <a
                    href="{{ Route::has('dashboard') ? route('dashboard') : '#' }}"
                    class="menu-hover
                    flex items-center
                    gap-3
                    px-4 py-3
                    rounded-2xl
                    text-white/60
                    hover:text-white
                    hover:bg-white/5
                    transition
                    font-medium
                    text-sm"
                >

                    <i
                        class="fa-solid
                        fa-border-all
                        text-lg
                        w-6"
                    ></i>

                    <span>
                        Dashboard
                    </span>

                </a>



                <!-- ULANGAN -->

                <a
                    href="{{ Route::has('game.level') ? route('game.level') : '#' }}"
                    class="menu-hover
                    flex items-center
                    gap-3
                    px-4 py-3
                    rounded-2xl
                    text-white/60
                    hover:text-white
                    hover:bg-white/5
                    transition
                    font-medium
                    text-sm"
                >

                    <i
                        class="fa-solid
                        fa-file-pen
                        text-lg
                        w-6
                        text-cyan-400"
                    ></i>

                    <span>
                        Ulangan
                    </span>

                </a>



                <!-- RIWAYAT -->

                <a
                    href="{{ Route::has('riwayat') ? route('riwayat') : '#' }}"
                    class="flex items-center
                    gap-3
                    px-4 py-3
                    rounded-2xl
                    bg-cyan-500
                    text-white
                    font-bold
                    text-sm
                    shadow-lg
                    shadow-cyan-500/25"
                >

                    <i
                        class="fa-solid
                        fa-clock-rotate-left
                        text-lg
                        w-6"
                    ></i>

                    <span>
                        Riwayat Ulangan
                    </span>

                </a>



                <!-- PERINGKAT -->

                <a
                    href="{{ Route::has('leaderboard') ? route('leaderboard') : '#' }}"
                    class="menu-hover
                    flex items-center
                    gap-3
                    px-4 py-3
                    rounded-2xl
                    text-white/60
                    hover:text-white
                    hover:bg-white/5
                    transition
                    font-medium
                    text-sm"
                >

                    <i
                        class="fa-solid
                        fa-ranking-star
                        text-lg
                        w-6"
                    ></i>

                    <span>
                        Peringkat
                    </span>

                </a>



                <!-- KELOLA BANK SOAL -->

                <a
                    href="{{ Route::has('soal.index') ? route('soal.index') : '#' }}"
                    class="menu-hover
                    flex items-center
                    gap-3
                    px-4 py-3
                    rounded-2xl
                    text-white/60
                    hover:text-white
                    hover:bg-white/5
                    transition
                    font-medium
                    text-sm"
                >

                    <i
                        class="fa-solid
                        fa-book-open
                        text-lg
                        w-6"
                    ></i>

                    <span>
                        Kelola Soal IPA
                    </span>

                </a>


            </nav>

        </div>



        <!-- =========================================================
             USER / LOGOUT
        ========================================================== -->

        <div
            class="pt-4
            border-t
            border-white/10"
        >

            <div
                class="flex items-center
                gap-3
                px-2
                mb-4"
            >

                <div
                    class="w-9 h-9
                    rounded-xl
                    bg-white/10
                    flex items-center
                    justify-center
                    text-cyan-400
                    border border-white/10"
                >

                    <i class="fa-solid fa-user"></i>

                </div>


                <div class="overflow-hidden">

                    <p
                        class="text-xs
                        font-bold
                        text-white
                        truncate"
                    >
                        {{ Auth::user()->name ?? 'Peserta' }}
                    </p>


                    <p
                        class="text-[10px]
                        text-white/40
                        truncate"
                    >
                        {{ Auth::user()->email ?? 'user@app.com' }}
                    </p>

                </div>

            </div>


            <!-- LOGOUT -->

            <form
                action="{{ route('logout') }}"
                method="POST"
                class="w-full"
            >

                @csrf

                <button
                    type="submit"
                    class="w-full
                    flex items-center
                    gap-3
                    px-4 py-3
                    text-red-400
                    hover:bg-red-500/10
                    hover:text-red-300
                    rounded-2xl
                    font-bold
                    text-sm
                    transition
                    cursor-pointer
                    text-left"
                >

                    <i
                        class="fa-solid
                        fa-right-from-bracket"
                    ></i>

                    <span>
                        Logout
                    </span>

                </button>

            </form>

        </div>


    </aside>



    <!-- =========================================================
         KONTEN UTAMA
    ========================================================== -->

    <main
        class="flex-1
        p-8
        overflow-y-auto"
    >

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
                    class="flex
                    items-center
                    gap-4"
                >

                    <div
                        class="w-14 h-14
                        rounded-2xl
                        bg-cyan-500/20
                        border border-cyan-500/30
                        flex items-center
                        justify-center
                        text-cyan-400
                        text-2xl
                        font-black
                        shadow-lg"
                    >

                        <i
                            class="fa-solid
                            fa-clock-rotate-left"
                        ></i>

                    </div>


                    <div>

                        <h2
                            class="text-3xl
                            font-extrabold
                            text-white"
                        >
                            Riwayat Ulangan
                        </h2>


                        <p
                            class="text-white/60
                            text-sm
                            mt-0.5"
                        >
                            Daftar hasil dan nilai ulangan IPA yang telah kamu selesaikan.
                        </p>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 TABEL RIWAYAT
            ================================================== -->

            <div
                class="glass
                rounded-[25px]
                overflow-hidden
                border border-white/10
                shadow-2xl"
            >


                <!-- TABLE HEADER -->

                <div
                    class="p-6
                    border-b
                    border-white/10
                    flex
                    items-center
                    justify-between"
                >

                    <h3
                        class="font-bold
                        text-base
                        text-white
                        flex items-center
                        gap-2"
                    >

                        <i
                            class="fa-solid
                            fa-file-pen
                            text-cyan-400"
                        ></i>

                        Catatan Ulangan IPA

                    </h3>

                </div>



                <!-- TABLE -->

                <div class="overflow-x-auto">

                    <table
                        class="w-full
                        text-left
                        border-collapse"
                    >


                        <!-- THEAD -->

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
                                    w-16"
                                >
                                    No
                                </th>


                                <th class="p-5">
                                    Ulangan
                                </th>


                                <th
                                    class="p-5
                                    text-center"
                                >
                                    Nilai
                                </th>


                                <th
                                    class="p-5
                                    text-center"
                                >
                                    Status
                                </th>


                                <th
                                    class="p-5
                                    text-center"
                                >
                                    Tanggal
                                </th>

                            </tr>

                        </thead>



                        <!-- TBODY -->

                        <tbody
                            class="divide-y
                            divide-white/5
                            text-sm"
                        >


                            <!-- RIWAYAT ULANGAN -->

                            <tr class="table-row">


                                <!-- NO -->

                                <td
                                    class="p-5
                                    text-center
                                    font-bold
                                    text-white/40"
                                >
                                    1
                                </td>



                                <!-- ULANGAN -->

                                <td
                                    class="p-5
                                    font-bold
                                    text-white
                                    flex items-center
                                    gap-3"
                                >

                                    <div
                                        class="w-8 h-8
                                        rounded-lg
                                        bg-cyan-500/20
                                        text-cyan-400
                                        flex items-center
                                        justify-center
                                        text-xs
                                        font-black"
                                    >

                                        <i
                                            class="fa-solid
                                            fa-flask"
                                        ></i>

                                    </div>


                                    <div>

                                        <span>
                                            Ulangan 1
                                        </span>

                                        <p
                                            class="text-[10px]
                                            text-white/40
                                            font-normal
                                            mt-0.5"
                                        >
                                            Mata Pelajaran IPA
                                        </p>

                                    </div>

                                </td>



                                <!-- NILAI -->

                                <td
                                    class="p-5
                                    text-center
                                    font-black
                                    text-amber-400"
                                >
                                    125
                                </td>



                                <!-- STATUS -->

                                <td
                                    class="p-5
                                    text-center"
                                >

                                    <span
                                        class="px-3 py-1
                                        rounded-full
                                        bg-emerald-500/20
                                        text-emerald-400
                                        border
                                        border-emerald-500/30
                                        text-xs
                                        font-bold"
                                    >
                                        Selesai
                                    </span>

                                </td>



                                <!-- TANGGAL -->

                                <td
                                    class="p-5
                                    text-center
                                    text-white/50
                                    text-xs"
                                >
                                    25 Juli 2026
                                </td>


                            </tr>


                        </tbody>


                    </table>

                </div>

            </div>



            <!-- =================================================
                 INFORMASI
            ================================================== -->

            <div
                class="glass
                rounded-[25px]
                p-6
                border border-cyan-500/10"
            >

                <div
                    class="flex
                    items-start
                    gap-4"
                >

                    <div
                        class="w-10 h-10
                        rounded-xl
                        bg-cyan-500/10
                        border border-cyan-500/20
                        flex items-center
                        justify-center
                        text-cyan-400
                        shrink-0"
                    >

                        <i class="fa-solid fa-circle-info"></i>

                    </div>


                    <div>

                        <h3
                            class="text-sm
                            font-bold
                            text-white
                            mb-1"
                        >
                            Informasi Riwayat
                        </h3>


                        <p
                            class="text-xs
                            text-white/50
                            leading-relaxed"
                        >
                            Halaman ini digunakan untuk melihat kembali
                            hasil ulangan IPA yang telah dikerjakan.
                            Gunakan hasil sebelumnya sebagai bahan evaluasi
                            untuk meningkatkan pemahaman pada ulangan berikutnya.
                        </p>

                    </div>

                </div>

            </div>


        </div>

    </main>


</body>

</html>