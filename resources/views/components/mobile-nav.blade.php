<div
    class="lg:hidden fixed bottom-5 left-1/2
    -translate-x-1/2 z-50
    w-[92%] max-w-md"
>

    <div
        class="glass rounded-[30px]
        border border-white/10
        px-3 py-3
        flex items-center justify-between
        shadow-[0_0_35px_rgba(0,0,0,0.35)]"
    >

        <!-- DASHBOARD -->
        <a href="/dashboard"
            class="flex flex-col items-center justify-center
            gap-2 w-full py-2 rounded-2xl
            {{ request()->is('dashboard')
                ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg'
                : 'text-white/60'
            }}"
        >

            <i class="fa-solid fa-house text-lg"></i>

            <span class="text-xs font-semibold">
                Dashboard
            </span>

        </a>

        <!-- GAME -->
        <a href="/game/level"
            class="flex flex-col items-center justify-center
            gap-2 w-full py-2 rounded-2xl
            {{ request()->is('game/*')
                ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg'
                : 'text-white/60'
            }}"
        >

            <i class="fa-solid fa-play text-lg"></i>

            <span class="text-xs font-semibold">
                Main
            </span>

        </a>

        <!-- RANK -->
        <a href="/leaderboard"
            class="flex flex-col items-center justify-center
            gap-2 w-full py-2 rounded-2xl
            {{ request()->is('leaderboard')
                ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg'
                : 'text-white/60'
            }}"
        >

            <i class="fa-solid fa-ranking-star text-lg"></i>

            <span class="text-xs font-semibold">
                Rank
            </span>

        </a>

        <!-- SOAL -->
        <a href="/soal"
            class="flex flex-col items-center justify-center
            gap-2 w-full py-2 rounded-2xl
            {{ request()->is('soal*')
                ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg'
                : 'text-white/60'
            }}"
        >

            <i class="fa-solid fa-book-open text-lg"></i>

            <span class="text-xs font-semibold">
                Soal
            </span>

        </a>

    </div>

</div>