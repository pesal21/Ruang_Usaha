@extends('admin.layout')

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative page-enter">
    {{-- Decorative orbs --}}
    <div class="absolute -top-16 -left-16 w-48 h-48 bg-blue-200/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-teal-200/20 rounded-full blur-3xl pointer-events-none"></div>

    {{-- ── HEADER ── --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8 relative">
        <div class="card-animate" style="animation-delay: 0.1s;">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-4 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Admin Panel
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
                Detail UMKM
            </h1>
            <p class="text-gray-500 mt-2 text-base">Informasi lengkap UMKM.</p>
            <div class="mt-5 flex items-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        <a href="{{ route('admin.umkm.data') }}"
           class="back-link inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors duration-200 card-animate"
           style="animation-delay: 0.15s;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="relative">
                Kembali
                <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-current transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
    </div>

    {{-- ── DETAIL CARD ── --}}
    <div class="card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                overflow-hidden hover:shadow-xl hover:shadow-blue-100 transition-all duration-300"
         style="animation-delay: 0.2s;">

        {{-- COVER --}}
        <div class="h-40 sm:h-48 bg-gradient-to-r from-blue-500 via-blue-600 to-teal-500 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10"
                 style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 24px 24px;"></div>
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
        </div>

        <div class="p-6 sm:p-8">

            {{-- LOGO + INFO --}}
            <div class="flex flex-col md:flex-row md:items-center gap-6 -mt-20 mb-8">
                <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl overflow-hidden border-4 border-white shadow-xl bg-gradient-to-br from-blue-50 to-teal-50 flex-shrink-0 relative z-10">
                    @if($umkm->logo)
                        <img src="{{ asset('storage/' . $umkm->logo) }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-4xl font-bold text-blue-500 bg-gradient-to-br from-blue-100 to-teal-100">
                            {{ strtoupper(substr($umkm->nama_usaha, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div class="pt-2 md:pt-14">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                        {{ $umkm->nama_usaha }}
                    </h2>

                    <div class="flex flex-wrap items-center gap-3 mt-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 border border-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            {{ $umkm->kategori->nama ?? '-' }}
                        </span>

                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold
                            @if($umkm->status == 'approved') bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20
                            @elseif($umkm->status == 'pending') bg-amber-50 text-amber-700 ring-1 ring-amber-600/20
                            @elseif($umkm->status == 'suspended') bg-gray-100 text-gray-600 ring-1 ring-gray-400/20
                            @else bg-red-50 text-red-600 ring-1 ring-red-600/20 @endif
                        ">
                            <span class="w-1.5 h-1.5 rounded-full
                                @if($umkm->status == 'approved') bg-emerald-500
                                @elseif($umkm->status == 'pending') bg-amber-500
                                @elseif($umkm->status == 'suspended') bg-gray-400
                                @else bg-red-500 @endif
                            "></span>
                            {{ ucfirst($umkm->status) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- DETAIL GRID --}}
            <div class="grid sm:grid-cols-2 gap-4 mb-8">
                {{-- Pemilik --}}
                <div class="flex items-center gap-3 bg-blue-50/60 border border-blue-100 rounded-xl px-4 py-3
                            transition-all duration-200 hover:bg-blue-50 hover:shadow-sm">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-gray-400 font-medium">Pemilik</p>
                        <p class="text-sm font-semibold text-gray-700 truncate">{{ $umkm->user->name }}</p>
                    </div>
                </div>

                {{-- Kontak --}}
                <div class="flex items-center gap-3 bg-blue-50/60 border border-blue-100 rounded-xl px-4 py-3
                            transition-all duration-200 hover:bg-blue-50 hover:shadow-sm">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-emerald-100 to-teal-200 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-gray-400 font-medium">Kontak</p>
                        <p class="text-sm font-semibold text-gray-700 truncate">{{ $umkm->kontak ?? '-' }}</p>
                    </div>
                </div>

                {{-- Jenis UMKM --}}
                <div class="flex items-center gap-3 bg-blue-50/60 border border-blue-100 rounded-xl px-4 py-3
                            transition-all duration-200 hover:bg-blue-50 hover:shadow-sm">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-amber-100 to-orange-200 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-gray-400 font-medium">Jenis UMKM</p>
                        <p class="text-sm font-semibold text-gray-700 truncate">{{ $umkm->jenis_umkm }}</p>
                    </div>
                </div>

                {{-- Jam Operasional --}}
                <div class="flex items-center gap-3 bg-blue-50/60 border border-blue-100 rounded-xl px-4 py-3
                            transition-all duration-200 hover:bg-blue-50 hover:shadow-sm">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-violet-100 to-purple-200 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-gray-400 font-medium">Jam Operasional</p>
                        <p class="text-sm font-semibold text-gray-700 truncate">{{ $umkm->jam_operasional }}</p>
                    </div>
                </div>
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-8 p-5 bg-blue-50/40 border border-blue-100 rounded-2xl">
                <h3 class="text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Deskripsi
                </h3>
                <p class="text-gray-600 leading-relaxed text-sm">
                    {{ $umkm->deskripsi ?? 'Tidak ada deskripsi.' }}
                </p>
            </div>

            {{-- PRODUK SECTION --}}
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Produk ({{ $umkm->produk->count() }})
                </h3>
                
                @if($umkm->produk->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($umkm->produk as $produk)
                        <div class="bg-white border-2 border-blue-100 rounded-2xl overflow-hidden hover:shadow-lg hover:shadow-blue-100 transition-all duration-300">
                            {{-- Foto Produk --}}
                            <div class="h-40 bg-gradient-to-br from-blue-50 to-teal-50 overflow-hidden flex items-center justify-center">
                                @if($produk->foto_produk)
                                    <img src="{{ asset('storage/' . $produk->foto_produk) }}"
                                         alt="{{ $produk->nama_produk }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-xs">Tidak ada foto</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Produk Info --}}
                            <div class="p-4">
                                <h4 class="font-semibold text-gray-800 truncate mb-2">{{ $produk->nama_produk }}</h4>
                                <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                                    {{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-blue-600">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-blue-50/40 border-2 border-dashed border-blue-200 rounded-2xl">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <p class="text-gray-500 font-medium">Belum ada produk ditambahkan</p>
                    </div>
                @endif
            </div>

            {{-- GALERI SECTION --}}
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Galeri ({{ $umkm->galeri->count() }})
                </h3>

                @if($umkm->galeri->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach($umkm->galeri as $foto)
                        <div class="group relative overflow-hidden rounded-xl border-2 border-blue-100 hover:border-purple-300 transition-all duration-300 cursor-pointer"
                             x-data="{ enlarged: false }"
                             @click="enlarged = true">
                            <div class="aspect-square overflow-hidden bg-gradient-to-br from-purple-50 to-blue-50">
                                <img src="{{ asset('storage/' . $foto->foto) }}"
                                     alt="Galeri"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            
                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                                </svg>
                            </div>

                            {{-- Enlarged View --}}
                            <div x-show="enlarged" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 @click.away="enlarged = false"
                                 class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4">
                                <div class="relative max-w-2xl w-full">
                                    <img src="{{ asset('storage/' . $foto->foto) }}"
                                         alt="Galeri"
                                         class="w-full rounded-2xl shadow-2xl">
                                    <button @click="enlarged = false"
                                            class="absolute -top-10 right-0 text-white hover:text-gray-300 transition-colors">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-purple-50/40 border-2 border-dashed border-purple-200 rounded-2xl">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-500 font-medium">Belum ada foto galeri ditambahkan</p>
                    </div>
                @endif
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex flex-wrap gap-3 pt-6 border-t-2 border-blue-50">
                @if($umkm->status === 'pending')
                    <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="btn-shimmer inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-emerald-500 to-teal-500
                                   hover:from-emerald-600 hover:to-teal-600 text-white text-sm font-semibold rounded-2xl
                                   shadow-lg shadow-emerald-200 hover:shadow-xl hover:-translate-y-0.5
                                   active:scale-95 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Approve
                        </button>
                    </form>

                    <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="btn-shimmer inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-rose-500 to-pink-500
                                   hover:from-rose-600 hover:to-pink-600 text-white text-sm font-semibold rounded-2xl
                                   shadow-lg shadow-rose-200 hover:shadow-xl hover:-translate-y-0.5
                                   active:scale-95 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reject
                        </button>
                    </form>
                @elseif($umkm->status === 'approved')
                    <form action="{{ route('admin.umkm.suspend', $umkm->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="btn-shimmer inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-gray-600 to-gray-700
                                   hover:from-gray-700 hover:to-gray-800 text-white text-sm font-semibold rounded-2xl
                                   shadow-lg shadow-gray-200 hover:shadow-xl hover:-translate-y-0.5
                                   active:scale-95 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Suspend UMKM
                        </button>
                    </form>
                @elseif($umkm->status === 'suspended')
                    <form action="{{ route('admin.umkm.activate', $umkm->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="btn-shimmer inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-blue-600 to-teal-500
                                   hover:from-blue-700 hover:to-teal-600 text-white text-sm font-semibold rounded-2xl
                                   shadow-lg shadow-blue-200 hover:shadow-xl hover:-translate-y-0.5
                                   active:scale-95 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Aktifkan Kembali
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .back-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: .35rem;
    }
    .back-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 1.5rem;
        right: 0;
        height: 1.5px;
        background: currentColor;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .25s ease;
    }
    .back-link:hover::after { transform: scaleX(1); }
</style>

@endsection