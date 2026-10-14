<!-- =========================================================
     QuizKU - PENCAPAIAN ULANGAN IPA
========================================================= -->

<div
    class="glass
    rounded-[40px]
    p-6 lg:p-8"
>


    <!-- =====================================================
         TITLE
    ====================================================== -->

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
            from-yellow-400
            to-orange-500
            flex items-center
            justify-center
            shadow-[0_0_30px_rgba(251,191,36,0.35)]"
        >

            <i
                class="fa-solid
                fa-trophy
                text-white
                text-2xl"
            ></i>

        </div>


        <div>

            <p
                class="text-cyan-300
                text-sm
                font-semibold"
            >
                Pencapaian Ulangan
            </p>


            <h2
                class="text-white
                text-3xl
                font-bold"
            >
                Pencapaian QuizKU
            </h2>

        </div>

    </div>



    <!-- =====================================================
         GRID PENCAPAIAN
    ====================================================== -->

    <div
        class="grid
        grid-cols-1
        lg:grid-cols-3
        gap-5"
    >


        <!-- =================================================
             PENCAPAIAN 1
        ================================================== -->

        <div
            class="rounded-[35px]
            p-6
            relative
            overflow-hidden

            {{ $progress->high_score >= 50
                ? 'bg-gradient-to-br from-yellow-400/20 to-orange-500/20 border border-yellow-400/20'
                : 'bg-white/5 border border-white/10 opacity-60'
            }}"
        >

            <!-- GLOW -->

            <div
                class="absolute
                -top-10
                -right-10
                w-40 h-40
                bg-yellow-400/10
                blur-3xl
                rounded-full
                pointer-events-none"
            ></div>


            <!-- ICON -->

            <div
                class="w-20 h-20
                rounded-[28px]

                {{ $progress->high_score >= 50
                    ? 'bg-gradient-to-br from-yellow-400 to-orange-500'
                    : 'bg-white/10'
                }}

                flex items-center
                justify-center
                mb-6"
            >

                <i
                    class="fa-solid
                    fa-medal
                    text-white
                    text-3xl"
                ></i>

            </div>


            <!-- CONTENT -->

            <h2
                class="text-white
                text-2xl
                font-bold
                mb-3"
            >
                Peraih Skor 50
            </h2>


            <p
                class="text-white/60
                leading-relaxed
                mb-5"
            >
                Raih skor minimal 50 poin dalam ulangan IPA.
            </p>


            <!-- STATUS -->

            <div
                class="inline-flex
                items-center
                gap-3
                px-4 py-3
                rounded-2xl

                {{ $progress->high_score >= 50
                    ? 'bg-yellow-400/20 text-yellow-300'
                    : 'bg-white/10 text-white/50'
                }}"
            >

                <i
                    class="fa-solid
                    {{ $progress->high_score >= 50
                        ? 'fa-lock-open'
                        : 'fa-lock'
                    }}"
                ></i>


                <span class="font-semibold">

                    {{ $progress->high_score >= 50
                        ? 'Terbuka'
                        : 'Terkunci'
                    }}

                </span>

            </div>

        </div>



        <!-- =================================================
             PENCAPAIAN 2
        ================================================== -->

        <div
            class="rounded-[35px]
            p-6
            relative
            overflow-hidden

            {{ $level >= 3
                ? 'bg-gradient-to-br from-cyan-400/20 to-blue-600/20 border border-cyan-400/20'
                : 'bg-white/5 border border-white/10 opacity-60'
            }}"
        >

            <!-- GLOW -->

            <div
                class="absolute
                -top-10
                -right-10
                w-40 h-40
                bg-cyan-400/10
                blur-3xl
                rounded-full
                pointer-events-none"
            ></div>


            <!-- ICON -->

            <div
                class="w-20 h-20
                rounded-[28px]

                {{ $level >= 3
                    ? 'bg-gradient-to-br from-cyan-400 to-blue-600'
                    : 'bg-white/10'
                }}

                flex items-center
                justify-center
                mb-6"
            >

                <i
                    class="fa-solid
                    fa-graduation-cap
                    text-white
                    text-3xl"
                ></i>

            </div>


            <!-- CONTENT -->

            <h2
                class="text-white
                text-2xl
                font-bold
                mb-3"
            >
                Ulangan Lengkap
            </h2>


            <p
                class="text-white/60
                leading-relaxed
                mb-5"
            >
                Selesaikan Ulangan 1, Ulangan 2, dan Ulangan 3.
            </p>


            <!-- STATUS -->

            <div
                class="inline-flex
                items-center
                gap-3
                px-4 py-3
                rounded-2xl

                {{ $level >= 3
                    ? 'bg-cyan-400/20 text-cyan-300'
                    : 'bg-white/10 text-white/50'
                }}"
            >

                <i
                    class="fa-solid
                    {{ $level >= 3
                        ? 'fa-lock-open'
                        : 'fa-lock'
                    }}"
                ></i>


                <span class="font-semibold">

                    {{ $level >= 3
                        ? 'Terbuka'
                        : 'Terkunci'
                    }}

                </span>

            </div>

        </div>



        <!-- =================================================
             PENCAPAIAN 3
        ================================================== -->

        <div
            class="rounded-[35px]
            p-6
            relative
            overflow-hidden

            {{ session('combo', 0) >= 5
                ? 'bg-gradient-to-br from-pink-500/20 to-purple-600/20 border border-pink-400/20'
                : 'bg-white/5 border border-white/10 opacity-60'
            }}"
        >

            <!-- GLOW -->

            <div
                class="absolute
                -top-10
                -right-10
                w-40 h-40
                bg-pink-400/10
                blur-3xl
                rounded-full
                pointer-events-none"
            ></div>


            <!-- ICON -->

            <div
                class="w-20 h-20
                rounded-[28px]

                {{ session('combo', 0) >= 5
                    ? 'bg-gradient-to-br from-pink-500 to-purple-600'
                    : 'bg-white/10'
                }}

                flex items-center
                justify-center
                mb-6"
            >

                <i
                    class="fa-solid
                    fa-fire
                    text-white
                    text-3xl"
                ></i>

            </div>


            <!-- CONTENT -->

            <h2
                class="text-white
                text-2xl
                font-bold
                mb-3"
            >
                Jawaban Tepat Beruntun
            </h2>


            <p
                class="text-white/60
                leading-relaxed
                mb-5"
            >
                Jawab 5 soal berturut-turut dengan benar dalam ulangan.
            </p>


            <!-- STATUS -->

            <div
                class="inline-flex
                items-center
                gap-3
                px-4 py-3
                rounded-2xl

                {{ session('combo', 0) >= 5
                    ? 'bg-pink-400/20 text-pink-300'
                    : 'bg-white/10 text-white/50'
                }}"
            >

                <i
                    class="fa-solid
                    {{ session('combo', 0) >= 5
                        ? 'fa-lock-open'
                        : 'fa-lock'
                    }}"
                ></i>


                <span class="font-semibold">

                    {{ session('combo', 0) >= 5
                        ? 'Terbuka'
                        : 'Terkunci'
                    }}

                </span>

            </div>

        </div>


    </div>

</div>