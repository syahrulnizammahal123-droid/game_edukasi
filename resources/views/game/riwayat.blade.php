@extends('layouts.app')

@section('title', 'Riwayat Ulangan - QuizKU')

@push('styles')
<style>
body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .menu-hover {
            transition: all 0.25s ease;
        }

        .menu-hover:hover {
            transform: translateX(3px);
        }

        .table-row {
            transition: all 0.25s ease;
        }

        .table-row:hover {
            background: rgba(255, 255, 255, 0.05);
        }
</style>
@endpush

@section('content')
<div
            class="max-w-6xl
            mx-auto
            space-y-8"
        >


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div
                class="glass
                rounded-[30px]
                p-8
                relative
                overflow-hidden
                border border-white/10"
            >

                <div
                    class="flex
                    items-center
                    gap-4"
                >

                    <div
                        class="w-14 h-14
                        rounded-2xl
                        bg-cyan-500/20
                        border border-cyan-500/30
                        flex items-center
                        justify-center
                        text-cyan-400
                        text-2xl
                        font-black
                        shadow-lg"
                    >

                        <i
                            class="fa-solid
                            fa-clock-rotate-left"
                        ></i>

                    </div>


                    <div>

                        <h2
                            class="text-3xl
                            font-extrabold
                            text-white"
                        >
                            Riwayat Ulangan
                        </h2>


                        <p
                            class="text-white/60
                            text-sm
                            mt-0.5"
                        >
                            Daftar hasil dan nilai ulangan IPA yang telah kamu selesaikan.
                        </p>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 TABEL RIWAYAT
            ================================================== -->

            <div
                class="glass
                rounded-[25px]
                overflow-hidden
                border border-white/10
                shadow-2xl"
            >


                <!-- TABLE HEADER -->

                <div
                    class="p-6
                    border-b
                    border-white/10
                    flex
                    items-center
                    justify-between"
                >

                    <h3
                        class="font-bold
                        text-base
                        text-white
                        flex items-center
                        gap-2"
                    >

                        <i
                            class="fa-solid
                            fa-file-pen
                            text-cyan-400"
                        ></i>

                        Catatan Ulangan IPA

                    </h3>

                </div>



                <!-- TABLE -->

                <div class="overflow-x-auto">

                    <table
                        class="w-full
                        text-left
                        border-collapse"
                    >


                        <!-- THEAD -->

                        <thead>

                            <tr
                                class="border-b
                                border-white/10
                                bg-white/5
                                text-white/40
                                text-[11px]
                                font-black
                                uppercase
                                tracking-wider"
                            >

                                <th
                                    class="p-5
                                    text-center
                                    w-16"
                                >
                                    No
                                </th>


                                <th class="p-5">
                                    Ulangan
                                </th>

                                @if(Auth::user()?->isAdminOrGuru())

                                    <th class="p-5">
                                        Siswa
                                    </th>

                                @endif


                                <th
                                    class="p-5
                                    text-center"
                                >
                                    Nilai
                                </th>


                                <th
                                    class="p-5
                                    text-center"
                                >
                                    Status
                                </th>


                                <th
                                    class="p-5
                                    text-center"
                                >
                                    Tanggal
                                </th>

                            </tr>

                        </thead>



                        <!-- TBODY -->

                        <tbody
                            class="divide-y
                            divide-white/5
                            text-sm"
                        >


                            @forelse($histories ?? [] as $history)

                                <tr class="table-row">

                                    <td
                                        class="p-5
                                        text-center
                                        font-bold
                                        text-white/40"
                                    >
                                        {{ method_exists($histories, 'firstItem') ? $histories->firstItem() + $loop->index : $loop->iteration }}
                                    </td>


                                    <td
                                        class="p-5
                                        font-bold
                                        text-white"
                                    >

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-8 h-8
                                                rounded-lg
                                                bg-cyan-500/20
                                                text-cyan-400
                                                flex items-center
                                                justify-center
                                                text-xs
                                                font-black"
                                            >

                                                <i class="fa-solid fa-flask"></i>

                                            </div>


                                            <div>

                                                <span>
                                                    Ulangan Level {{ $history->level }}
                                                </span>

                                                <p
                                                    class="text-[10px]
                                                    text-white/40
                                                    font-normal
                                                    mt-0.5"
                                                >
                                                    Benar {{ $history->correct_answer }} dari {{ $history->total_question }} soal
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    @if(Auth::user()?->isAdminOrGuru())

                                        <td class="p-5 text-white/70 font-semibold">
                                            {{ $history->user->name ?? 'Peserta' }}
                                        </td>

                                    @endif


                                    <td
                                        class="p-5
                                        text-center
                                        font-black
                                        text-amber-400"
                                    >
                                        {{ $history->score }}
                                    </td>


                                    <td
                                        class="p-5
                                        text-center"
                                    >

                                        <span
                                            class="px-3 py-1
                                            rounded-full
                                            {{ $history->score >= 60
                                                ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30'
                                                : 'bg-red-500/20 text-red-300 border-red-500/30' }}
                                            border
                                            text-xs
                                            font-bold"
                                        >
                                            {{ $history->score >= 60 ? 'Lulus' : 'Remedial' }}
                                        </span>

                                        <p class="mt-1 text-[10px] text-white/35">
                                            Grade {{ $history->grade }} | XP +{{ $history->xp_earned }}
                                        </p>

                                    </td>


                                    <td
                                        class="p-5
                                        text-center
                                        text-white/50
                                        text-xs"
                                    >
                                        {{ optional($history->played_at)->format('d M Y H:i') }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="{{ Auth::user()?->isAdminOrGuru() ? 6 : 5 }}"
                                        class="p-8 text-center text-white/45 text-sm"
                                    >
                                        Belum ada riwayat ulangan.
                                    </td>
                                </tr>

                            @endforelse


                        </tbody>


                    </table>

                </div>

                @if(isset($histories) && method_exists($histories, 'links') && $histories->hasPages())

                    <div class="p-5 border-t border-white/10">
                        {{ $histories->links() }}
                    </div>

                @endif

            </div>



            <!-- =================================================
                 INFORMASI
            ================================================== -->

            <div
                class="glass
                rounded-[25px]
                p-6
                border border-cyan-500/10"
            >

                <div
                    class="flex
                    items-start
                    gap-4"
                >

                    <div
                        class="w-10 h-10
                        rounded-xl
                        bg-cyan-500/10
                        border border-cyan-500/20
                        flex items-center
                        justify-center
                        text-cyan-400
                        shrink-0"
                    >

                        <i class="fa-solid fa-circle-info"></i>

                    </div>


                    <div>

                        <h3
                            class="text-sm
                            font-bold
                            text-white
                            mb-1"
                        >
                            Informasi Riwayat
                        </h3>


                        <p
                            class="text-xs
                            text-white/50
                            leading-relaxed"
                        >
                            Halaman ini digunakan untuk melihat kembali
                            hasil ulangan IPA yang telah dikerjakan.
                            Gunakan hasil sebelumnya sebagai bahan evaluasi
                            untuk meningkatkan pemahaman pada ulangan berikutnya.
                        </p>

                    </div>

                </div>

            </div>


        </div>
@endsection

