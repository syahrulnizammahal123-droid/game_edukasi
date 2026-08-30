@extends('layouts.app')

@section('title', 'Dashboard Admin - QuizGo')

@push('styles')
<style>
body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(15, 23, 42, 0.78);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
                <header class="glass rounded-2xl p-6 lg:p-7 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-cyan-300 text-xs uppercase tracking-widest font-bold mb-2">
                            {{ ucfirst(Auth::user()->role ?? 'guru') }}
                        </p>

                        <h2 class="text-2xl lg:text-3xl font-extrabold">
                            Dashboard Admin/Guru
                        </h2>

                        <p class="text-white/55 text-sm mt-1">
                            Ringkasan kelas, bank soal, dan aktivitas ulangan siswa.
                        </p>
                    </div>

                    <a href="{{ route('soal.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-3 rounded-2xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-extrabold transition">
                        <i class="fa-solid fa-plus"></i>
                        <span>Tambah Soal</span>
                    </a>
                </header>

                <section class="grid grid-cols-2 xl:grid-cols-4 gap-4">
                    <div class="glass rounded-2xl p-5">
                        <p class="text-white/45 text-[11px] uppercase tracking-widest font-bold">Total Siswa</p>
                        <h3 class="text-3xl font-black mt-2">{{ $totalSiswa }}</h3>
                    </div>

                    <div class="glass rounded-2xl p-5">
                        <p class="text-white/45 text-[11px] uppercase tracking-widest font-bold">Admin/Guru</p>
                        <h3 class="text-3xl font-black mt-2">{{ $totalGuru }}</h3>
                    </div>

                    <div class="glass rounded-2xl p-5">
                        <p class="text-white/45 text-[11px] uppercase tracking-widest font-bold">Bank Soal</p>
                        <h3 class="text-3xl font-black mt-2">{{ $totalSoal }}</h3>
                    </div>

                    <div class="glass rounded-2xl p-5">
                        <p class="text-white/45 text-[11px] uppercase tracking-widest font-bold">Rata-rata Skor</p>
                        <h3 class="text-3xl font-black mt-2">{{ $averageScore }}%</h3>
                    </div>
                </section>

                <section class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                    <div class="glass rounded-2xl p-6 xl:col-span-2">
                        <div class="flex items-center justify-between gap-4 mb-5">
                            <h3 class="font-extrabold text-lg">Aktivitas Terbaru</h3>
                            <span class="text-xs text-white/45">{{ $totalMain }} total ulangan</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="text-left text-white/40 text-[11px] uppercase tracking-widest">
                                    <tr class="border-b border-white/10">
                                        <th class="py-3 pr-4">Siswa</th>
                                        <th class="py-3 pr-4">Level</th>
                                        <th class="py-3 pr-4">Skor</th>
                                        <th class="py-3 pr-4">Benar</th>
                                        <th class="py-3">Tanggal</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-white/5">
                                    @forelse($latestHistories as $history)
                                        <tr>
                                            <td class="py-3 pr-4 font-semibold">{{ $history->user->name ?? 'Peserta' }}</td>
                                            <td class="py-3 pr-4">Level {{ $history->level }}</td>
                                            <td class="py-3 pr-4 font-black text-cyan-300">{{ $history->score }}%</td>
                                            <td class="py-3 pr-4">{{ $history->correct_answer }}/{{ $history->total_question }}</td>
                                            <td class="py-3 text-white/50">{{ optional($history->played_at)->format('d M Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-8 text-center text-white/45">
                                                Belum ada aktivitas ulangan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="glass rounded-2xl p-6">
                            <h3 class="font-extrabold text-lg mb-5">Soal Per Level</h3>

                            <div class="space-y-4">
                                @for($level = 1; $level <= 3; $level++)
                                    <div>
                                        <div class="flex justify-between text-sm mb-2">
                                            <span class="font-semibold">Level {{ $level }}</span>
                                            <span class="text-cyan-300 font-bold">{{ $levelStats[$level] ?? 0 }} soal</span>
                                        </div>

                                        <div class="h-2 bg-white/10 rounded-full overflow-hidden">
                                            <div
                                                class="h-full bg-gradient-to-r from-cyan-400 to-blue-500"
                                                style="width: {{ min((($levelStats[$level] ?? 0) / 10) * 100, 100) }}%"
                                            ></div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <div class="glass rounded-2xl p-6">
                            <h3 class="font-extrabold text-lg mb-5">Top Siswa</h3>

                            <div class="space-y-3">
                                @forelse($topStudents as $index => $student)
                                    <div class="flex items-center justify-between gap-3 p-3 rounded-xl bg-white/5">
                                        <div class="min-w-0">
                                            <p class="font-bold text-sm truncate">{{ $student->user->name ?? 'Peserta' }}</p>
                                            <p class="text-[11px] text-white/40">Skor tertinggi {{ $student->high_score }}%</p>
                                        </div>

                                        <span class="text-cyan-300 font-black text-sm shrink-0">
                                            {{ $student->total_xp }} XP
                                        </span>
                                    </div>
                                @empty
                                    <p class="text-sm text-white/45 text-center py-4">
                                        Belum ada data siswa.
                                    </p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>
            </div>
@endsection

