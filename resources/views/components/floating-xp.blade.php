<!-- FLOATING XP -->
<div
    id="floating-xp"
    class="hidden fixed inset-0 z-[9999]
    flex items-center justify-center
    pointer-events-none"
>

    <div
        id="xp-text"
        class="text-center"
    >

        <h1
            class="text-5xl lg:text-7xl
            font-extrabold text-cyan-300
            drop-shadow-[0_0_25px_rgba(34,211,238,0.8)]
            animate-bounce"
        >

            +10 XP

        </h1>

        <p
            class="text-2xl font-bold
            text-pink-300 mt-3"
        >

            COMBO x3

        </p>

    </div>

</div>

<!-- STYLE -->
<style>

    @keyframes floatUp {

        0%{
            transform:translateY(40px);
            opacity:0;
        }

        20%{
            opacity:1;
        }

        100%{
            transform:translateY(-120px);
            opacity:0;
        }

    }

    #xp-text{

        animation:floatUp 2s ease forwards;

    }

</style>

<!-- SCRIPT -->
<script>

    @if(session('success'))

        const floatingXp = document.getElementById('floating-xp');

        floatingXp.classList.remove('hidden');

        setTimeout(() => {

            floatingXp.style.display = 'none';

        }, 2000);

    @endif

</script>