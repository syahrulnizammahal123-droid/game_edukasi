<!-- =========================================================
     QUIZGO LOADING SCREEN
========================================================= -->

<div
    id="loading-screen"
    class="hidden fixed inset-0 z-[9999]
    bg-[#07111f]/90 backdrop-blur-md
    flex items-center justify-center"
>

    <div class="text-center px-6">


        <!-- =================================================
             SPINNER
        ================================================== -->

        <div class="relative w-28 h-28 mx-auto mb-8">

            <!-- OUTER CIRCLE -->

            <div
                class="absolute inset-0
                rounded-full
                border-4
                border-cyan-400/20"
            ></div>


            <!-- ANIMATED CIRCLE -->

            <div
                class="absolute inset-0
                rounded-full
                border-4
                border-transparent
                border-t-cyan-400
                border-r-blue-500
                animate-spin"
            ></div>


            <!-- CENTER ICON -->

            <div
                class="absolute inset-4
                rounded-full
                bg-gradient-to-br
                from-cyan-400
                to-blue-600
                flex items-center
                justify-center
                shadow-[0_0_35px_rgba(59,130,246,0.45)]"
            >

                <i
                    class="fa-solid
                    fa-flask
                    text-white
                    text-3xl"
                ></i>

            </div>

        </div>



        <!-- =================================================
             TEXT
        ================================================== -->

        <h2
            class="text-white
            text-3xl
            font-extrabold
            mb-3"
        >
            Memuat QuizGo
        </h2>


        <p
            class="text-cyan-300
            text-sm
            font-medium"
        >
            Menyiapkan ulangan IPA...
        </p>


        <p
            class="text-white/30
            text-[11px]
            mt-2"
        >
            Mohon tunggu sebentar
        </p>


    </div>

</div>



<!-- =========================================================
     SCRIPT LOADING
========================================================= -->

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const loadingScreen =
            document.getElementById('loading-screen');


        if (!loadingScreen) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | FLAG
        |--------------------------------------------------------------------------
        */

        let loadingActive = false;


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN LOADING
        |--------------------------------------------------------------------------
        */

        function showLoading() {

            if (loadingActive) {
                return;
            }

            loadingActive = true;

            loadingScreen.classList.remove('hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | SEMUA LINK
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll('a').forEach(function (link) {

            link.addEventListener('click', function (event) {

                const href =
                    this.getAttribute('href');


                /*
                | Abaikan:
                | - #
                | - kosong
                | - javascript:
                | - anchor halaman
                */

                if (
                    !href ||
                    href === '#' ||
                    href.startsWith('javascript:') ||
                    href.startsWith('#')
                ) {
                    return;
                }


                /*
                | Abaikan link yang membuka tab baru
                */

                if (
                    this.target === '_blank' ||
                    event.ctrlKey ||
                    event.metaKey ||
                    event.shiftKey
                ) {
                    return;
                }


                /*
                | Tampilkan loading sebentar sebelum
                | browser berpindah halaman.
                */

                showLoading();

            });

        });


        /*
        |--------------------------------------------------------------------------
        | SEMUA FORM
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll('form').forEach(function (form) {

            form.addEventListener('submit', function () {

                showLoading();

            });

        });


        /*
        |--------------------------------------------------------------------------
        | TOMBOL BROWSER BACK / FORWARD
        |--------------------------------------------------------------------------
        */

        window.addEventListener('pageshow', function () {

            loadingActive = false;

            loadingScreen.classList.add('hidden');

        });


        /*
        |--------------------------------------------------------------------------
        | SEBELUM HALAMAN DITINGGALKAN
        |--------------------------------------------------------------------------
        */

        window.addEventListener('beforeunload', function () {

            /*
             * Loading hanya terlihat ketika halaman benar-benar
             * berpindah. Browser akan menangani perpindahannya.
             */

            loadingActive = true;

        });

    });

</script>