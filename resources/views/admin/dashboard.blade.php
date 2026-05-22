@extends('admin.layout')
<!-- Dibuat oleh Fauzan Azhima Ardani - 202312029 -->
@section('content')

<!-- HEADER dengan gradien -->
<div class="mb-8">
    <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
        Dashboard Overview
    </h1>
    <p class="text-gray-500 mt-1.5 text-base">
        Welcome back, Admin! Here's your overview for today.
    </p>
</div>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 mb-8">
    <!-- Card 1 -->
    <div class="relative overflow-hidden bg-white rounded-2xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-blue-50 cursor-default group">
        <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-100 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
        <p class="text-sm font-medium text-gray-500 relative z-10">Total UMKM</p>
        <h2 class="text-4xl font-bold mt-2 text-gray-800 relative z-10">{{ str_pad($totalUmkm, 2, '0', STR_PAD_LEFT) }}</h2>
        <p class="text-sm mt-1.5 relative z-10 {{ $umkm_diff >= 0 ? 'text-green-600' : 'text-red-500' }}">
            {{ $umkm_diff >= 0 ? '+' : '' }}{{ $umkm_diff }} minggu ini
        </p>
    </div>

    <!-- Card 2 -->
    <div class="relative overflow-hidden bg-white rounded-2xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-blue-50 cursor-default group">
        <div class="absolute -top-4 -right-4 w-24 h-24 bg-emerald-100 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
        <p class="text-sm font-medium text-gray-500 relative z-10">Active Users</p>
        <h2 class="text-4xl font-bold mt-2 text-gray-800 relative z-10">{{ str_pad($activeUsers, 2, '0', STR_PAD_LEFT) }}</h2>
        <p class="text-sm mt-1.5 relative z-10 {{ $user_diff >= 0 ? 'text-green-600' : 'text-red-500' }}">
            {{ $user_diff >= 0 ? '+' : '' }}{{ $user_diff }} minggu ini
        </p>
    </div>

    <!-- Card 3 -->
    <div class="relative overflow-hidden bg-white rounded-2xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-blue-50 cursor-default group">
        <div class="absolute -top-4 -right-4 w-24 h-24 bg-amber-100 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
        <p class="text-sm font-medium text-gray-500 relative z-10">Products Listed</p>
        <h2 class="text-4xl font-bold mt-2 text-gray-800 relative z-10">{{ $products }}</h2>
        <p class="text-sm mt-1.5 relative z-10 {{ $product_diff >= 0 ? 'text-green-600' : 'text-red-500' }}">
            {{ $product_diff >= 0 ? '+' : '' }}{{ $product_diff }} minggu ini
        </p>
    </div>

    <!-- Card 4 -->
    <div class="relative overflow-hidden bg-white rounded-2xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-blue-50 cursor-default group">
        <div class="absolute -top-4 -right-4 w-24 h-24 bg-orange-100 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
        <p class="text-sm font-medium text-gray-500 relative z-10">Pending Approvals</p>
        <h2 class="text-4xl font-bold mt-2 text-gray-800 relative z-10">{{ $pendingUmkm }}</h2>
        <p class="text-sm mt-1.5 relative z-10 {{ $pending_diff >= 0 ? 'text-orange-600' : 'text-gray-500' }}">
            {{ $pending_diff >= 0 ? '+' : '' }}{{ $pending_diff }} minggu ini
        </p>
    </div>
</div>

<!-- CHART + MOST VIEWED -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
    <!-- Chart -->
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-md border border-blue-50 hover:shadow-lg transition-shadow duration-300 bg-gradient-to-br from-white to-blue-50/30">
        <p class="font-semibold text-gray-800 text-lg">New UMKM Registrations</p>
        <div class="flex items-baseline gap-2 mb-4">
            <h2 class="text-4xl font-bold text-gray-800">{{ $newUmkmCount ?? 0 }}</h2>
            <span class="text-sm font-semibold {{ $percentage >= 0 ? 'text-green-600' : 'text-red-500' }}">
                {{ $percentage >= 0 ? '+' : '' }}{{ $percentage }}%
            </span>
        </div>
        <div class="relative h-48">
            <canvas id="registrationChart"></canvas>
        </div>
    </div>

    <!-- Most Viewed -->
    <div class="bg-white rounded-2xl p-6 shadow-md border border-blue-50 hover:shadow-lg transition-shadow duration-300">
        <p class="font-semibold text-gray-800 text-lg mb-4">Most Viewed UMKM</p>
        <div class="space-y-5">
            @php
                $maxViews = $mostViewedUmkm->max('views');
            @endphp
            @foreach($mostViewedUmkm as $item)
                @php
                    $percent = $maxViews > 0 ? round(($item->views / $maxViews) * 100) : 0;
                @endphp
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-700 font-medium">{{ $item->nama_usaha }}</span>
                        <span class="text-gray-400 text-xs">{{ number_format($item->views) }} views</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500" style="width: {{ $percent }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- TABLE UMKM -->
@if(isset($umkms) && $umkms->count() > 0)
<div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden mb-10 hover:shadow-lg transition-shadow duration-300">
    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
        <h2 class="font-semibold text-gray-800 text-lg">Daftar UMKM</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-blue-50/70">
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama UMKM</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($umkms as $umkm)
                <tr class="border-t border-gray-50 hover:bg-blue-50/30 transition-colors duration-200">
                    <td class="p-4 text-gray-800 font-medium">{{ $umkm->nama_usaha }}</td>
                    <td class="p-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold ring-1 ring-inset
                            @if($umkm->status=='pending') bg-yellow-50 text-yellow-700 ring-yellow-600/20
                            @elseif($umkm->status=='approved') bg-green-50 text-green-700 ring-green-600/20
                            @else bg-red-50 text-red-700 ring-red-600/20 @endif
                        ">
                            {{ ucfirst($umkm->status) }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex flex-wrap gap-2">
                            @if($umkm->status === 'pending')
                                <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST">
                                    @csrf
                                    <button class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-xl text-xs font-semibold shadow-md hover:shadow-lg hover:-translate-y-0.5 active:scale-95 transform transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST">
                                    @csrf
                                    <button class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white rounded-xl text-xs font-semibold shadow-md hover:shadow-lg hover:-translate-y-0.5 active:scale-95 transform transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2">
                                        Reject
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 text-xs italic px-2">Tidak ada aksi</span>
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

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('registrationChart').getContext('2d');
        const labels = @json($labels);
        const data = @json($data);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'UMKM Baru',
                    data: data,
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79,70,229,0.15)',
                    borderWidth: 2.5,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#4f46e5',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { display: true, grid: { display: false } },
                    y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f1f5f9' } }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
@endsection