<nav class="lg:hidden fixed bottom-5 left-1/2 -translate-x-1/2 z-50 w-[92%] max-w-md">
    <div class="glass rounded-[28px] border border-white/10 px-3 py-3 flex items-center justify-between shadow-[0_0_35px_rgba(0,0,0,0.35)]">
        <a
            href="{{ route('dashboard') }}"
            class="flex flex-col items-center justify-center gap-1.5 w-full py-2 rounded-2xl {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg' : 'text-white/60 hover:text-white' }}"
        >
            <i class="fa-solid fa-house text-lg"></i>
            <span class="text-[11px] font-semibold">Dashboard</span>
        </a>

        <a
            href="{{ route('game.level') }}"
            class="flex flex-col items-center justify-center gap-1.5 w-full py-2 rounded-2xl {{ request()->routeIs('game.level') || request()->routeIs('game.start') ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg' : 'text-white/60 hover:text-white' }}"
        >
            <i class="fa-solid fa-file-pen text-lg"></i>
            <span class="text-[11px] font-semibold">Ulangan</span>
        </a>

        <a
            href="{{ route('leaderboard') }}"
            class="flex flex-col items-center justify-center gap-1.5 w-full py-2 rounded-2xl {{ request()->routeIs('leaderboard') || request()->routeIs('leaderboard.*') ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg' : 'text-white/60 hover:text-white' }}"
        >
            <i class="fa-solid fa-ranking-star text-lg"></i>
            <span class="text-[11px] font-semibold">Peringkat</span>
        </a>

        @if(Auth::user()?->isAdminOrGuru())
            <a
                href="{{ route('soal.index') }}"
                class="flex flex-col items-center justify-center gap-1.5 w-full py-2 rounded-2xl {{ request()->routeIs('soal.*') ? 'bg-gradient-to-r from-purple-500 to-indigo-600 text-white shadow-lg' : 'text-white/60 hover:text-white' }}"
            >
                <i class="fa-solid fa-folder-open text-lg"></i>
                <span class="text-[11px] font-semibold">Soal</span>
            </a>
        @else
            <a
                href="{{ route('riwayat') }}"
                class="flex flex-col items-center justify-center gap-1.5 w-full py-2 rounded-2xl {{ request()->routeIs('riwayat') ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg' : 'text-white/60 hover:text-white' }}"
            >
                <i class="fa-solid fa-clock-rotate-left text-lg"></i>
                <span class="text-[11px] font-semibold">Riwayat</span>
            </a>
        @endif
    </div>
</nav>
