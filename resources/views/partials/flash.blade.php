@if(session('success'))
    <div class="mb-5 rounded-2xl border border-emerald-400/30 bg-emerald-500/15 px-4 py-3 text-sm font-bold text-emerald-200">
        <i class="fa-solid fa-circle-check mr-2"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-5 rounded-2xl border border-red-400/30 bg-red-500/15 px-4 py-3 text-sm font-bold text-red-200">
        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
        {{ session('error') }}
    </div>
@endif
