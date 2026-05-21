@extends('admin.layout')
<!-- Dibuat oleh Fauzan Azhima Ardani - 202312029 -->
@section('content')

<!-- HEADER -->
<h1 class="text-3xl font-bold">Dashboard Overview</h1>
<p class="text-gray-500 mt-1 mb-8">
    Welcome back, Admin! Here's your overview for today.
</p>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-default">
        <p class="text-sm text-gray-500">Total UMKM</p>
        <h2 class="text-4xl font-bold mt-2">{{ str_pad($totalUmkm, 2, '0', STR_PAD_LEFT) }}</h2>
        <p class="text-sm mt-1 
{{ $umkm_diff >= 0 ? 'text-green-500' : 'text-red-500' }}">
            {{ $umkm_diff >= 0 ? '+' : '' }}{{ $umkm_diff }} minggu ini
            </p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-default">
        <p class="text-sm text-gray-500">Active Users</p>
        <h2 class="text-4xl font-bold mt-2">{{ str_pad($activeUsers, 2, '0', STR_PAD_LEFT) }}</h2>
        <p class="text-sm mt-1 
{{ $user_diff >= 0 ? 'text-green-500' : 'text-red-500' }}">

            {{ $user_diff >= 0 ? '+' : '' }}{{ $user_diff }} minggu ini
        </p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-default">
        <p class="text-sm text-gray-500">Products Listed</p>
        <h2 class="text-4xl font-bold mt-2">{{ $products }}</h2>
        <p class="text-sm mt-1 
{{ $product_diff >= 0 ? 'text-green-500' : 'text-red-500' }}">

            {{ $product_diff >= 0 ? '+' : '' }}{{ $product_diff }} minggu ini
        </p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-default">
        <p class="text-sm text-gray-500">Pending Approvals</p>
        <h2 class="text-4xl font-bold mt-2">{{ $pendingUmkm }}</h2>
        <p class="text-sm mt-1 
{{ $pending_diff >= 0 ? 'text-orange-500' : 'text-gray-500' }}">

            {{ $pending_diff >= 0 ? '+' : '' }}{{ $pending_diff }} minggu ini
        </p>
    </div>

</div>

<!-- CHART + MOST VIEWED -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

    <!-- New UMKM Registrations Chart -->
    <div class="lg:col-span-2 bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
        <p class="font-semibold text-gray-800">New UMKM Registrations</p>
        <div class="flex items-baseline gap-2 mb-4">
            <h2 class="text-4xl font-bold">{{ $newUmkmCount ?? 0 }}</h2>
            <span class="text-sm font-medium 
    {{ $percentage >= 0 ? 'text-green-500' : 'text-red-500' }}">

                {{ $percentage >= 0 ? '+' : '' }}{{ $percentage }}%
            </span>
        </div>
        <!-- Chart Canvas -->
        <div class="relative h-48">
            <canvas id="registrationChart"></canvas>
        </div>
    </div>

    <!-- Most Viewed UMKM -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
        <p class="font-semibold text-gray-800 mb-4">Most Viewed UMKM</p>
        <div class="space-y-4">


            @php
            $maxViews = $mostViewedUmkm->max('views');
            @endphp

            @foreach($mostViewedUmkm as $item)
            @php
            $percent = $maxViews > 0 ? round(($item->views / $maxViews) * 100) : 0;
            @endphp

            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-gray-700">{{ $item->nama_usaha }}</span>
                    <span class="text-gray-400">{{ number_format($item->views) }} views</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="bg-blue-500 h-1.5 rounded-full"
                        style="width: {{ $percent }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

<!-- TABLE UMKM (Pending Approvals) -->
@if(isset($umkms) && $umkms->count() > 0)
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-10 hover:shadow-md transition-shadow duration-300">
    <div class="p-6 border-b border-gray-100">
        <h2 class="font-semibold text-gray-800">Daftar UMKM</h2>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-4 text-left text-gray-500 font-medium">Nama UMKM</th>
                <th class="p-4 text-left text-gray-500 font-medium">Status</th>
                <th class="p-4 text-left text-gray-500 font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($umkms as $umkm)
            <tr class="border-t border-gray-50 hover:bg-gray-50 transition-colors">
                <td class="p-4 text-gray-800">{{ $umkm->nama_usaha }}</td>

                <td class="p-4">
                    <span class="px-2.5 py-1 rounded-full text-xs font-medium shadow-sm transition-colors duration-200
                        @if($umkm->status=='pending') bg-yellow-100 text-yellow-700
                        @elseif($umkm->status=='approved') bg-green-100 text-green-700
                        @else bg-red-100 text-red-700 @endif
                    ">
                        {{ ucfirst($umkm->status) }}
                    </span>
                </td>

                <td class="p-4">
                    <div class="flex gap-2">
                        @if($umkm->status === 'pending')
                        <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST">
                            @csrf
                            <button class="px-3 py-1.5 bg-green-600 hover:bg-green-700 active:scale-95 transform transition-all duration-200 text-white rounded-lg text-xs font-medium focus:outline-none focus:ring-2 focus:ring-green-400">
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST">
                            @csrf
                            <button class="px-3 py-1.5 bg-red-600 hover:bg-red-700 active:scale-95 transform transition-all duration-200 text-white rounded-lg text-xs font-medium focus:outline-none focus:ring-2 focus:ring-red-400">
                                Reject
                            </button>
                        </form>
                        @else
                        <span class="text-gray-400 text-xs italic">Tidak ada aksi</span>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif



<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const ctx = document.getElementById('registrationChart').getContext('2d');

        const labels = @json($labels);
        const data = @json($data);

        console.log("LABELS:", labels);
        console.log("DATA:", data);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'UMKM Baru',
                    data: data,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,0.2)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: true
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

    });
</script>

@endsection

