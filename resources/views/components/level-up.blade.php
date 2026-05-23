@if(session('level_up'))

<!-- OVERLAY -->
<div
    id="level-up-popup"
    class="fixed inset-0 z-[99999]
    bg-[#07111f]/85 backdrop-blur-md
    flex items-center justify-center"
>

    <!-- CARD -->
    <div
        class="relative overflow-hidden
        rounded-[45px]
        bg-gradient-to-br from-cyan-500 to-blue-700
        p-10 lg:p-16
        text-center
        shadow-[0_0_80px_rgba(59,130,246,0.5)]"
    >

        <!-- GLOW -->
        <div
            class="absolute -top-20 -right-20
            w-72 h-72 bg-white/20
            blur-3xl rounded-full"
        ></div>

        <!-- ICON -->
        <div
            class="w-36 h-36 rounded-full
            bg-white/20
            flex items-center justify-center
            mx-auto mb-8
            animate-bounce"
        >

            <i class="fa-solid fa-bolt text-white text-7xl"></i>

        </div>

        <!-- TEXT -->
        <p class="text-cyan-100 text-xl mb-4 font-semibold">
            Progress Baru Tercapai
        </p>

        <h1 class="text-5xl lg:text-7xl font-extrabold text-white mb-5">
            LEVEL UP
        </h1>

        <h2 class="text-3xl lg:text-5xl font-bold text-cyan-100 mb-6">
            LEVEL {{ $level }}
        </h2>

        <!-- TITLE -->
        <div
            class="inline-flex items-center gap-3
            px-6 py-4 rounded-2xl
            bg-white/15 text-white font-bold text-lg"
        >

            <i class="fa-solid fa-shield-halved"></i>

            {{ $title }}

        </div>

    </div>

</div>

<!-- SOUND -->
<audio autoplay>
    <source src="{{ asset('sounds/correct.mp3') }}" type="audio/mpeg">
</audio>

<!-- SCRIPT -->
<script>

    setTimeout(() => {

        document
            .getElementById('level-up-popup')
            .style.display = 'none';

    }, 3500);

</script>

@endif