<aside class="hidden lg:flex w-72 min-h-screen glass border-r border-white/10 p-6 flex-col justify-between shrink-0">
    <div>
        <div class="flex items-center gap-3 mb-8 px-2">
            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-cyan-500/20">
                Q
            </div>

            <div>
                <h1 class="font-extrabold text-lg tracking-wide text-white leading-tight">
                    QuizKU
                </h1>
                <p class="text-[10px] text-cyan-300 font-bold uppercase tracking-widest">
                    Media Pembelajaran IPA
                </p>
            </div>
        </div>

        <nav class="space-y-2">
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3.5 px-4 py-3 rounded-2xl font-bold text-sm transition {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg shadow-cyan-500/20' : 'text-white/60 hover:text-white hover:bg-white/5' }}"
            >
                <i class="fa-solid fa-house text-base w-5 text-center"></i>
                <span>Dashboard</span>
            </a>

            <a
                href="{{ route('game.level') }}"
                class="flex items-center gap-3.5 px-4 py-3 rounded-2xl font-bold text-sm transition {{ request()->routeIs('game.level') || request()->routeIs('game.start') ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg shadow-cyan-500/20' : 'text-white/60 hover:text-white hover:bg-white/5' }}"
            >
                <i class="fa-solid fa-file-pen text-base w-5 text-center"></i>
                <span>Ulangan</span>
            </a>

            <a
                href="{{ route('leaderboard') }}"
                class="flex items-center gap-3.5 px-4 py-3 rounded-2xl font-bold text-sm transition {{ request()->routeIs('leaderboard') || request()->routeIs('leaderboard.*') ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg shadow-cyan-500/20' : 'text-white/60 hover:text-white hover:bg-white/5' }}"
            >
                <i class="fa-solid fa-ranking-star text-base w-5 text-center"></i>
                <span>Peringkat</span>
            </a>

            <a
                href="{{ route('riwayat') }}"
                class="flex items-center gap-3.5 px-4 py-3 rounded-2xl font-bold text-sm transition {{ request()->routeIs('riwayat') ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg shadow-cyan-500/20' : 'text-white/60 hover:text-white hover:bg-white/5' }}"
            >
                <i class="fa-solid fa-clock-rotate-left text-base w-5 text-center"></i>
                <span>Riwayat</span>
            </a>

            @if(Route::has('soal.index') && Auth::user()?->isAdminOrGuru())
                <div class="pt-4 border-t border-white/10 my-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-white/40 px-4 mb-2 block">
                        Manajemen Guru
                    </span>

                    <a
                        href="{{ route('soal.index') }}"
                        class="flex items-center gap-3.5 px-4 py-3 rounded-2xl font-bold text-sm transition {{ request()->routeIs('soal.*') ? 'bg-gradient-to-r from-purple-500 to-indigo-600 text-white shadow-lg shadow-purple-500/20' : 'text-white/60 hover:text-white hover:bg-white/5' }}"
                    >
                        <i class="fa-solid fa-folder-open text-base w-5 text-center"></i>
                        <span>Kelola Soal IPA</span>
                    </a>
                </div>
            @endif
        </nav>
    </div>

    <div class="border-t border-white/10 pt-4 space-y-3">
        <div class="flex items-center gap-3 px-2">
            <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-cyan-300 font-bold border border-white/10 shrink-0">
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="overflow-hidden">
                <p class="text-xs font-bold text-white truncate">
                    {{ Auth::user()->name ?? 'Peserta' }}
                </p>
                <p class="text-[10px] text-white/40 truncate">
                    {{ Auth::user()->email ?? 'user@app.com' }}
                </p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf

            <button
                type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 text-red-300 hover:bg-red-500/10 rounded-2xl font-bold text-sm transition cursor-pointer text-left"
            >
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
