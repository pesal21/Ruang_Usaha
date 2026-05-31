@extends('admin.layout')
<!-- Dibuat oleh Fauzan Azhima Ardani - 202312029 -->
@section('content')

<div class="page-enter">
    {{-- ── Header ── --}}
    <div class="mb-10">
        <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                    px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
            Admin Panel
        </div>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
            Dashboard Overview
        </h1>
        <p class="text-gray-500 mt-3 max-w-lg text-base leading-relaxed">
            Welcome back, <span class="font-semibold text-blue-600">{{ auth()->user()->name }}</span>! Here's your overview for today.
        </p>
        {{-- Decorative divider --}}
        <div class="mt-5 flex items-center gap-2">
            <span class="w-8 h-px bg-blue-200"></span>
            <span class="w-2 h-2 rounded-full bg-teal-400"></span>
            <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
            <span class="w-2 h-2 rounded-full bg-blue-400"></span>
            <span class="w-8 h-px bg-teal-200"></span>
        </div>
    </div>

    {{-- ── STAT CARDS ── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
        {{-- Card 1: Total UMKM --}}
        <div class="stat-card card-animate relative overflow-hidden bg-white rounded-2xl p-6 shadow-md shadow-blue-50
                    border border-gray-100 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-1.5
                    transition-all duration-300 cursor-default group"
             style="animation-delay: 0.1s;">
            <div class="absolute -top-6 -right-6 w-28 h-28 rounded-full bg-gradient-to-br from-blue-400/20 to-blue-500/10
                        group-hover:scale-125 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-medium text-gray-500">Total UMKM</p>
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center shadow-sm">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-extrabold text-gray-900">{{ str_pad($totalUmkm, 2, '0', STR_PAD_LEFT) }}</h2>
                <p class="text-sm mt-2 font-medium {{ $umkm_diff >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                    <span class="inline-flex items-center gap-1">
                        @if($umkm_diff >= 0)
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        @else
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        @endif
                        {{ abs($umkm_diff) }} minggu ini
                    </span>
                </p>
            </div>
        </div>

        {{-- Card 2: Active Users --}}
        <div class="stat-card card-animate relative overflow-hidden bg-white rounded-2xl p-6 shadow-md shadow-blue-50
                    border border-gray-100 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-1.5
                    transition-all duration-300 cursor-default group"
             style="animation-delay: 0.15s;">
            <div class="absolute -top-6 -right-6 w-28 h-28 rounded-full bg-gradient-to-br from-emerald-400/20 to-teal-500/10
                        group-hover:scale-125 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-medium text-gray-500">Active Users</p>
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-100 to-teal-200 flex items-center justify-center shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-extrabold text-gray-900">{{ str_pad($activeUsers, 2, '0', STR_PAD_LEFT) }}</h2>
                <p class="text-sm mt-2 font-medium {{ $user_diff >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                    <span class="inline-flex items-center gap-1">
                        @if($user_diff >= 0)
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        @else
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        @endif
                        {{ abs($user_diff) }} minggu ini
                    </span>
                </p>
            </div>
        </div>

        {{-- Card 3: Products Listed --}}
        <div class="stat-card card-animate relative overflow-hidden bg-white rounded-2xl p-6 shadow-md shadow-blue-50
                    border border-gray-100 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-1.5
                    transition-all duration-300 cursor-default group"
             style="animation-delay: 0.2s;">
            <div class="absolute -top-6 -right-6 w-28 h-28 rounded-full bg-gradient-to-br from-amber-400/20 to-orange-500/10
                        group-hover:scale-125 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-medium text-gray-500">Products Listed</p>
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-100 to-orange-200 flex items-center justify-center shadow-sm">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-extrabold text-gray-900">{{ $products }}</h2>
                <p class="text-sm mt-2 font-medium {{ $product_diff >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                    <span class="inline-flex items-center gap-1">
                        @if($product_diff >= 0)
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        @else
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        @endif
                        {{ abs($product_diff) }} minggu ini
                    </span>
                </p>
            </div>
        </div>

        {{-- Card 4: Pending Approvals --}}
        <div class="stat-card card-animate relative overflow-hidden bg-white rounded-2xl p-6 shadow-md shadow-blue-50
                    border border-gray-100 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-1.5
                    transition-all duration-300 cursor-default group"
             style="animation-delay: 0.25s;">
            <div class="absolute -top-6 -right-6 w-28 h-28 rounded-full bg-gradient-to-br from-rose-400/20 to-pink-500/10
                        group-hover:scale-125 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-medium text-gray-500">Pending Approvals</p>
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-rose-100 to-pink-200 flex items-center justify-center shadow-sm">
                        <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-extrabold text-gray-900">{{ $pendingUmkm }}</h2>
                <p class="text-sm mt-2 font-medium {{ $pending_diff >= 0 ? 'text-rose-600' : 'text-gray-500' }}">
                    <span class="inline-flex items-center gap-1">
                        @if($pending_diff >= 0)
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        @else
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        @endif
                        {{ abs($pending_diff) }} minggu ini
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- ── CHART + MOST VIEWED ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
        {{-- Chart --}}
        <div class="lg:col-span-2 card-animate bg-white rounded-2xl p-6 shadow-md shadow-blue-50 border border-gray-100
                    hover:shadow-xl hover:shadow-blue-100 transition-all duration-300 bg-gradient-to-br from-white to-blue-50/30"
             style="animation-delay: 0.3s;">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100 flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <p class="font-bold text-gray-800 text-lg">New UMKM Registrations</p>
            </div>
            <div class="flex items-baseline gap-2 mb-6">
                <h2 class="text-4xl font-extrabold text-gray-900">{{ $newUmkmCount ?? 0 }}</h2>
                <span class="text-sm font-semibold {{ $percentage >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                    {{ $percentage >= 0 ? '+' : '' }}{{ $percentage }}%
                </span>
                <span class="text-xs text-gray-400 ml-1">vs minggu lalu</span>
            </div>
            <div class="relative h-52">
                <canvas id="registrationChart"></canvas>
            </div>
        </div>

        {{-- Most Viewed --}}
        <div class="card-animate bg-white rounded-2xl p-6 shadow-md shadow-blue-50 border border-gray-100
                    hover:shadow-xl hover:shadow-blue-100 transition-all duration-300"
             style="animation-delay: 0.35s;">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100 flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <p class="font-bold text-gray-800 text-lg">Most Viewed UMKM</p>
            </div>
            <div class="space-y-5">
                @php $maxViews = $mostViewedUmkm->max('views'); @endphp
                @forelse($mostViewedUmkm as $item)
                    @php $percent = $maxViews > 0 ? round(($item->views / $maxViews) * 100) : 0; @endphp
                    <div>
                        <div class="flex justify-between text-sm mb-1.5">
                            <span class="text-gray-700 font-semibold truncate mr-2">{{ $item->nama_usaha }}</span>
                            <span class="text-gray-400 text-xs flex-shrink-0">{{ number_format($item->views) }} views</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-blue-500 to-teal-500 transition-all duration-500"
                                 style="width: {{ max($percent, 8) }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm text-center py-6">Belum ada data views.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ── TABLE UMKM ── --}}
    @if(isset($umkms) && $umkms->count() > 0)
    <div class="card-animate bg-white rounded-2xl shadow-md shadow-blue-50 border border-gray-100 overflow-hidden mb-10
                hover:shadow-xl hover:shadow-blue-100 transition-all duration-300"
         style="animation-delay: 0.4s;">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50/60 to-white flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100 flex items-center justify-center shadow-sm">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <h2 class="font-bold text-gray-800 text-lg">Daftar UMKM Terbaru</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-50/40 to-teal-50/40">
                        <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama UMKM</th>
                        <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($umkms as $umkm)
                    <tr class="border-t border-gray-50 hover:bg-blue-50/40 transition-colors duration-200">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                @if($umkm->logo)
                                    <img src="{{ asset('storage/'.$umkm->logo) }}" class="w-8 h-8 rounded-lg object-cover shadow-sm">
                                @else
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-teal-500 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                                        {{ strtoupper(substr($umkm->nama_usaha, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="text-gray-800 font-semibold">{{ $umkm->nama_usaha }}</span>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                @if($umkm->status == 'pending') bg-amber-50 text-amber-700 ring-1 ring-amber-600/20
                                @elseif($umkm->status == 'approved') bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20
                                @elseif($umkm->status == 'suspended') bg-rose-50 text-rose-700 ring-1 ring-rose-600/20
                                @else bg-gray-50 text-gray-700 ring-1 ring-gray-600/20 @endif
                            ">
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                    @if($umkm->status == 'pending') bg-amber-500
                                    @elseif($umkm->status == 'approved') bg-emerald-500
                                    @elseif($umkm->status == 'suspended') bg-rose-500
                                    @else bg-gray-500 @endif
                                "></span>
                                {{ ucfirst($umkm->status) }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-wrap gap-2">
                                @if($umkm->status === 'pending')
                                    <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button class="btn-shimmer inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500
                                                       hover:from-emerald-600 hover:to-teal-600 text-white rounded-xl text-xs font-semibold
                                                       shadow-md shadow-emerald-200 hover:shadow-lg hover:-translate-y-0.5 active:scale-95
                                                       transition-all duration-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button class="btn-shimmer inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-rose-500 to-pink-500
                                                       hover:from-rose-600 hover:to-pink-600 text-white rounded-xl text-xs font-semibold
                                                       shadow-md shadow-rose-200 hover:shadow-lg hover:-translate-y-0.5 active:scale-95
                                                       transition-all duration-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                            Reject
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-xs italic px-2">— No actions —</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

{{-- Chart.js Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('registrationChart').getContext('2d');
        const labels = @json($labels);
        const data = @json($data);

        const gradient = ctx.createLinearGradient(0, 0, 0, 200);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.25)');
        gradient.addColorStop(1, 'rgba(13, 148, 136, 0.02)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'UMKM Baru',
                    data: data,
                    borderColor: '#3b82f6',
                    backgroundColor: gradient,
                    borderWidth: 2.5,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2.5,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#3b82f6',
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 3,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    x: {
                        display: true,
                        grid: { display: false, drawBorder: false },
                        ticks: { font: { size: 11 }, color: '#9ca3af' }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, font: { size: 11 }, color: '#9ca3af' },
                        grid: { color: '#f1f5f9', drawBorder: false }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: { weight: '600' },
                        bodyFont: { weight: '500' },
                        padding: 12,
                        cornerRadius: 8,
                    }
                }
            }
        });
    });
</script>
@endsection