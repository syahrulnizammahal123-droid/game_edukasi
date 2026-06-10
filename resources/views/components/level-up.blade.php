@if(session('level_up'))
<div id="levelUpModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md transition-all duration-300">
    
    <div class="relative max-w-sm w-full rounded-[35px] p-8 text-center border border-yellow-400/30 shadow-[0_0_50px_rgba(234,179,8,0.25)] transform scale-100 transition-all duration-300 animate-[bounce_1s_ease-in-out_1]" 
         style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);">
        
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-yellow-400/10 blur-2xl rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-cyan-500/10 blur-2xl rounded-full pointer-events-none"></div>

        <div class="w-24 h-24 rounded-[28px] bg-gradient-to-br from-yellow-400 via-orange-500 to-red-600 flex items-center justify-center mx-auto mb-6 shadow-xl shadow-orange-500/20 ring-4 ring-yellow-400/20">
            <i class="fa-solid fa-angles-up text-white text-4xl animate-pulse"></i>
        </div>

        <span class="text-xs font-black uppercase tracking-widest text-yellow-400">Selamat, Ksatria!</span>
        <h2 class="text-3xl font-black text-white mt-1 mb-2 tracking-tight">LEVEL UP!</h2>
        
        <p class="text-white/70 text-xs leading-relaxed mb-6 px-2">
            Kemampuan berpikir kritismu semakin tajam. Batas tingkatan level baru dan tantangan stage yang lebih tinggi telah terbuka!
        </p>

        <button onclick="closeLevelUpModal()" class="w-full py-4 rounded-[20px] bg-gradient-to-r from-cyan-400 via-blue-500 to-blue-600 text-white font-extrabold text-sm shadow-lg shadow-blue-500/20 hover:from-cyan-300 hover:to-blue-500 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
            Lanjutkan Petualangan
        </button>
    </div>
</div>

<script>
    function closeLevelUpModal() {
        const modal = document.getElementById('levelUpModal');
        if (modal) {
            modal.classList.add('opacity-0', 'pointer-events-none');
            const card = modal.querySelector('div');
            if (card) {
                card.classList.add('scale-95');
            }
            setTimeout(() => {
                modal.remove();
            }, 300);
        }
    }
</script>
@endif