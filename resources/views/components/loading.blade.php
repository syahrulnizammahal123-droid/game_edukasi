<!-- LOADING -->
<div
    id="loading-screen"
    class="hidden fixed inset-0 z-[9999]
    bg-[#07111f]/90 backdrop-blur-md
    flex items-center justify-center"
>

    <div class="text-center">

        <!-- SPINNER -->
        <div class="relative w-28 h-28 mx-auto mb-8">

            <!-- OUTER -->
            <div
                class="absolute inset-0
                rounded-full
                border-4 border-cyan-400/20"
            ></div>

            <!-- ANIMATE -->
            <div
                class="absolute inset-0
                rounded-full
                border-4 border-transparent
                border-t-cyan-400
                border-r-blue-500
                animate-spin"
            ></div>

            <!-- CENTER -->
            <div
                class="absolute inset-4
                rounded-full
                bg-gradient-to-br
                from-cyan-400 to-blue-600
                flex items-center justify-center
                shadow-[0_0_35px_rgba(59,130,246,0.45)]"
            >

                <i class="fa-solid fa-gamepad text-white text-3xl"></i>

            </div>

        </div>

        <!-- TEXT -->
        <h2 class="text-white text-3xl font-extrabold mb-3">
            Memuat Petualangan
        </h2>

        <p class="text-cyan-300">
            Menyiapkan dunia quiz...
        </p>

    </div>

</div>

<!-- SCRIPT -->
<script>

    // SEMUA LINK
    document.querySelectorAll('a').forEach(link => {

        link.addEventListener('click', function(){

            // CEGAH #
            if(this.getAttribute('href') !== '#'){

                document
                    .getElementById('loading-screen')
                    .classList.remove('hidden');

            }

        });

    });

    // SEMUA FORM
    document.querySelectorAll('form').forEach(form => {

        form.addEventListener('submit', function(){

            document
                .getElementById('loading-screen')
                .classList.remove('hidden');

        });

    });

</script>