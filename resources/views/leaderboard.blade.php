@extends('layouts.app')

@section('title', 'Peringkat Ulangan IPA - QuizGo')

@push('styles')
<style>
body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(15, 23, 42, 0.76);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .soft-card {
            transition: transform 0.25s ease, border-color 0.25s ease, background 0.25s ease;
        }

        .soft-card:hover {
            transform: translateY(-3px);
            border-color: rgba(34, 211, 238, 0.35);
        }

        .table-row {
            transition: background 0.2s ease;
        }

        .table-row:hover {
            background: rgba(255, 255, 255, 0.05);
        }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
            <header class="glass rounded-2xl p-5 lg:p-7 flex flex-col xl:flex-row xl:items-center xl:justify-between gap-5">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="w-14 h-14 rounded-2xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center text-amber-300 text-2xl shrink-0">
                        <i class="fa-solid fa-ranking-star"></i>
                    </div>

                    <div class="min-w-0">
                        <p class="text-cyan-300 text-xs uppercase tracking-widest font-bold mb-1">
                            Leaderboard Realtime
                        </p>

                        <h2 class="text-2xl lg:text-3xl font-extrabold text-white">
                            Peringkat Ulangan IPA
                        </h2>

                        <p class="text-white/55 text-sm mt-1">
                            Ranking otomatis berdasarkan XP, skor tertinggi, dan konsistensi jawaban.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <span id="syncStatus" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-emerald-500/10 text-emerald-300 border border-emerald-500/20 text-xs font-bold">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Live
                    </span>

                    <span class="px-3 py-2 rounded-xl bg-white/5 border border-white/10 text-xs text-white/50 font-semibold">
                        Update <span id="lastUpdated">{{ $leaderboardUpdatedAt }}</span>
                    </span>
                </div>
            </header>

            <section class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="glass rounded-2xl p-5">
                    <p class="text-[11px] text-white/45 uppercase tracking-widest font-bold">Total Peserta</p>
                    <h3 id="totalParticipants" class="text-3xl font-black mt-2">0</h3>
                </div>

                <div class="glass rounded-2xl p-5">
                    <p class="text-[11px] text-white/45 uppercase tracking-widest font-bold">Total XP</p>
                    <h3 id="totalXp" class="text-3xl font-black mt-2 text-cyan-300">0</h3>
                </div>

                <div class="glass rounded-2xl p-5">
                    <p class="text-[11px] text-white/45 uppercase tracking-widest font-bold">Rata-rata Akurasi</p>
                    <h3 id="avgAccuracy" class="text-3xl font-black mt-2 text-emerald-300">0%</h3>
                </div>
            </section>

            <section id="podiumGrid" class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6 items-end"></section>

            <section class="glass rounded-2xl overflow-hidden shadow-2xl">
                <div class="p-5 lg:p-6 border-b border-white/10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h3 class="font-extrabold text-lg flex items-center gap-2">
                            <i class="fa-solid fa-users text-cyan-300"></i>
                            Daftar Peserta
                        </h3>

                        <p class="text-xs text-white/45 mt-1">
                            XP menjadi urutan utama, lalu skor tertinggi dan jumlah jawaban benar.
                        </p>
                    </div>

                    <button
                        type="button"
                        onclick="refreshLeaderboard()"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white/75 text-xs font-bold transition"
                    >
                        <i class="fa-solid fa-rotate"></i>
                        <span>Refresh</span>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/5 border-b border-white/10 text-white/40 text-[11px] font-black uppercase tracking-wider">
                                <th class="p-4 lg:p-5 text-center w-20">Rank</th>
                                <th class="p-4 lg:p-5 min-w-56">Peserta</th>
                                <th class="p-4 lg:p-5 text-center">XP</th>
                                <th class="p-4 lg:p-5 text-center">High Score</th>
                                <th class="p-4 lg:p-5 text-center">Main</th>
                                <th class="p-4 lg:p-5 text-center">Akurasi</th>
                                <th class="p-4 lg:p-5 text-center">Level</th>
                            </tr>
                        </thead>

                        <tbody id="leaderboardBody" class="divide-y divide-white/5 text-sm"></tbody>
                    </table>
                </div>
            </section>
        </div>

<script>
        const leaderboardUrl = @json(route('leaderboard.data'));
        const leaderboardStreamUrl = @json(route('leaderboard.stream'));
        let leaderboard = @json($leaderboard);
        let isRefreshing = false;
        let leaderboardStream = null;

        function escapeHtml(value) {
            return String(value ?? '').replace(/[&<>"']/g, function (character) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;',
                }[character];
            });
        }

        function numberFormat(value) {
            return new Intl.NumberFormat('id-ID').format(Number(value || 0));
        }

        function rankBadge(rank) {
            if (rank === 1) {
                return 'bg-yellow-400 text-yellow-950';
            }

            if (rank === 2) {
                return 'bg-slate-300 text-slate-900';
            }

            if (rank === 3) {
                return 'bg-amber-700 text-amber-100';
            }

            return 'bg-white/5 text-white/55 border border-white/10';
        }

        function podiumCard(row, visualRank) {
            if (!row) {
                return `
                    <div class="glass rounded-2xl p-6 text-center border border-white/5 opacity-45 ${visualRank === 1 ? 'md:order-2' : visualRank === 2 ? 'md:order-1' : 'md:order-3'}">
                        <p class="text-sm text-white/45 font-semibold">Belum ada peringkat ${visualRank}</p>
                    </div>
                `;
            }

            const isFirst = row.rank === 1;
            const orderClass = row.rank === 1 ? 'md:order-2' : row.rank === 2 ? 'md:order-1' : 'md:order-3';
            const borderClass = row.rank === 1
                ? 'border-amber-400/60 bg-gradient-to-b from-amber-500/15 to-slate-900/80'
                : row.rank === 2
                    ? 'border-slate-300/30'
                    : 'border-amber-700/35';
            const sizeClass = isFirst ? 'p-7 lg:p-8' : 'p-6';
            const avatarClass = isFirst
                ? 'w-20 h-20 text-4xl text-amber-300 border-amber-400/50 bg-amber-500/20'
                : 'w-16 h-16 text-2xl text-cyan-300 border-cyan-400/30 bg-cyan-500/15';

            return `
                <article class="soft-card glass rounded-2xl ${sizeClass} text-center relative ${orderClass} ${borderClass}">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-9 h-9 rounded-full ${rankBadge(row.rank)} flex items-center justify-center font-black text-sm shadow-lg">
                        ${isFirst ? '<i class="fa-solid fa-crown"></i>' : row.rank}
                    </div>

                    <div class="${avatarClass} mx-auto mt-3 mb-4 rounded-2xl border flex items-center justify-center font-black">
                        ${escapeHtml(row.initial)}
                    </div>

                    <h3 class="${isFirst ? 'text-2xl text-yellow-300' : 'text-lg text-white'} font-extrabold truncate" title="${escapeHtml(row.name)}">
                        ${escapeHtml(row.name)}
                    </h3>

                    <p class="text-xs text-white/45 mt-1 font-semibold">Level ${row.level} | ${row.high_score}% high score</p>

                    <div class="mt-5 grid grid-cols-2 gap-3 text-left">
                        <div class="rounded-xl bg-white/5 border border-white/10 p-3">
                            <p class="text-[10px] text-white/40 uppercase font-bold">XP</p>
                            <p class="text-lg font-black text-cyan-300">${numberFormat(row.total_xp)}</p>
                        </div>

                        <div class="rounded-xl bg-white/5 border border-white/10 p-3">
                            <p class="text-[10px] text-white/40 uppercase font-bold">Akurasi</p>
                            <p class="text-lg font-black text-emerald-300">${row.accuracy}%</p>
                        </div>
                    </div>
                </article>
            `;
        }

        function renderPodium(rows) {
            const podium = document.getElementById('podiumGrid');
            const first = rows.find((row) => row.rank === 1);
            const second = rows.find((row) => row.rank === 2);
            const third = rows.find((row) => row.rank === 3);

            podium.innerHTML = [
                podiumCard(second, 2),
                podiumCard(first, 1),
                podiumCard(third, 3),
            ].join('');
        }

        function renderTable(rows) {
            const body = document.getElementById('leaderboardBody');

            if (!rows.length) {
                body.innerHTML = `
                    <tr>
                        <td colspan="7" class="p-10 text-center text-white/45 font-medium">
                            Belum ada data peserta ulangan IPA.
                        </td>
                    </tr>
                `;
                return;
            }

            body.innerHTML = rows.map((row) => `
                <tr class="table-row ${row.is_current_user ? 'bg-cyan-500/10' : ''}">
                    <td class="p-4 lg:p-5 text-center">
                        <span class="w-8 h-8 rounded-xl ${rankBadge(row.rank)} flex items-center justify-center mx-auto text-xs font-black">
                            ${row.rank <= 3 ? row.rank : '#' + row.rank}
                        </span>
                    </td>

                    <td class="p-4 lg:p-5">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-cyan-500/15 text-cyan-300 border border-cyan-500/25 flex items-center justify-center text-sm font-black shrink-0">
                                ${escapeHtml(row.initial)}
                            </div>

                            <div class="min-w-0">
                                <p class="font-extrabold text-white truncate">${escapeHtml(row.name)}</p>
                                <p class="text-[11px] text-white/40">Benar ${numberFormat(row.correct_answer)} | Salah ${numberFormat(row.wrong_answer)}</p>
                            </div>
                        </div>
                    </td>

                    <td class="p-4 lg:p-5 text-center font-black text-cyan-300">${numberFormat(row.total_xp)}</td>
                    <td class="p-4 lg:p-5 text-center font-bold text-yellow-300">${row.high_score}%</td>
                    <td class="p-4 lg:p-5 text-center text-white/70">${numberFormat(row.total_play)}x</td>
                    <td class="p-4 lg:p-5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <span class="font-bold text-emerald-300">${row.accuracy}%</span>
                            <span class="w-20 h-2 bg-white/10 rounded-full overflow-hidden hidden sm:block">
                                <span class="block h-full bg-emerald-400" style="width: ${Math.min(row.accuracy, 100)}%"></span>
                            </span>
                        </div>
                    </td>
                    <td class="p-4 lg:p-5 text-center">
                        <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10 text-white/70 text-xs font-bold">
                            Lv ${row.level}
                        </span>
                    </td>
                </tr>
            `).join('');
        }

        function renderStats(rows) {
            const totalXp = rows.reduce((sum, row) => sum + Number(row.total_xp || 0), 0);
            const avgAccuracy = rows.length
                ? Math.round(rows.reduce((sum, row) => sum + Number(row.accuracy || 0), 0) / rows.length)
                : 0;

            document.getElementById('totalParticipants').textContent = numberFormat(rows.length);
            document.getElementById('totalXp').textContent = numberFormat(totalXp);
            document.getElementById('avgAccuracy').textContent = avgAccuracy + '%';
        }

        function renderLeaderboard(rows) {
            leaderboard = Array.isArray(rows) ? rows : [];
            renderStats(leaderboard);
            renderPodium(leaderboard);
            renderTable(leaderboard);
        }

        function setSyncStatus(status) {
            const element = document.getElementById('syncStatus');

            if (status === 'connecting') {
                element.className = 'inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-cyan-500/10 text-cyan-300 border border-cyan-500/20 text-xs font-bold';
                element.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Menghubungkan';
                return;
            }

            if (status === 'loading') {
                element.className = 'inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-cyan-500/10 text-cyan-300 border border-cyan-500/20 text-xs font-bold';
                element.innerHTML = '<i class="fa-solid fa-rotate fa-spin"></i> Sinkronisasi';
                return;
            }

            if (status === 'error') {
                element.className = 'inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-red-500/10 text-red-300 border border-red-500/20 text-xs font-bold';
                element.innerHTML = '<span class="w-2 h-2 rounded-full bg-red-400"></span> Terputus';
                return;
            }

            element.className = 'inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-emerald-500/10 text-emerald-300 border border-emerald-500/20 text-xs font-bold';
            element.innerHTML = '<span class="w-2 h-2 rounded-full bg-emerald-400"></span> Live';
        }

        async function refreshLeaderboard() {
            if (isRefreshing) {
                return;
            }

            isRefreshing = true;
            setSyncStatus('loading');

            try {
                const response = await fetch(leaderboardUrl, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });

                if (!response.ok) {
                    throw new Error('Gagal mengambil data leaderboard.');
                }

                const payload = await response.json();
                renderLeaderboard(payload.leaderboard || []);
                document.getElementById('lastUpdated').textContent = payload.updated_at || '-';
                setSyncStatus('live');
            } catch (error) {
                setSyncStatus('error');
            } finally {
            isRefreshing = false;
            }
        }

        function connectLeaderboardStream() {
            if (!window.EventSource) {
                setSyncStatus('error');
                return;
            }

            if (leaderboardStream) {
                leaderboardStream.close();
            }

            setSyncStatus('connecting');
            leaderboardStream = new EventSource(leaderboardStreamUrl);

            leaderboardStream.addEventListener('open', function () {
                setSyncStatus('live');
            });

            leaderboardStream.addEventListener('leaderboard', function (event) {
                const payload = JSON.parse(event.data);

                renderLeaderboard(payload.leaderboard || []);
                document.getElementById('lastUpdated').textContent = payload.updated_at || '-';
                setSyncStatus('live');
            });

            leaderboardStream.addEventListener('heartbeat', function (event) {
                const payload = JSON.parse(event.data);

                document.getElementById('lastUpdated').textContent = payload.updated_at || '-';
                setSyncStatus('live');
            });

            leaderboardStream.addEventListener('reconnect', function () {
                leaderboardStream.close();
                setTimeout(connectLeaderboardStream, 750);
            });

            leaderboardStream.addEventListener('error', function () {
                setSyncStatus('error');
            });
        }

        renderLeaderboard(leaderboard);
        window.refreshLeaderboard = refreshLeaderboard;
        connectLeaderboardStream();

        window.addEventListener('beforeunload', function () {
            if (leaderboardStream) {
                leaderboardStream.close();
            }
        });
    </script>
@endsection

