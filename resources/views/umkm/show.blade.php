<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $umkm->nama_usaha }} – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* ── Animated gradient mesh background ── */
        .hero-bg {
            background-color: #eff6ff;
            background-image:
                radial-gradient(ellipse 80% 60% at 20% -10%, rgba(96, 165, 250, .18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 85% 10%, rgba(45, 212, 191, .14) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 100%, rgba(59, 130, 246, .10) 0%, transparent 60%);
        }

        /* ── Noise texture overlay ── */
        .noise::after {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .025;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-size: 128px 128px;
            z-index: 0;
        }

        /* ── Gradient text ── */
        .text-gradient {
            background: linear-gradient(135deg, #1d4ed8 0%, #0891b2 50%, #0d9488 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Animated underline for back link ── */
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

        .back-link:hover::after {
            transform: scaleX(1);
        }

        /* ── Card shine effect ── */
        .detail-card {
            position: relative;
        }

        .detail-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .6) 0%, transparent 25%);
            opacity: 0;
            transition: opacity .3s ease;
            pointer-events: none;
            border-radius: inherit;
            z-index: 1;
        }

        .detail-card:hover::before {
            opacity: 1;
        }

        /* ── Product card ── */
        .product-card {
            position: relative;
        }

        .product-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .5) 0%, transparent 50%);
            opacity: 0;
            transition: opacity .3s ease;
            pointer-events: none;
            border-radius: inherit;
            z-index: 1;
        }

        .product-card:hover::before {
            opacity: 1;
        }

        .product-img-wrap {
            overflow: hidden;
        }

        .product-img-wrap img {
            transition: transform .6s cubic-bezier(.25, .46, .45, .94);
        }

        .product-card:hover .product-img-wrap img {
            transform: scale(1.08);
        }

        /* ── Gallery card ── */
        .gallery-card {
            position: relative;
            overflow: hidden;
        }

        .gallery-card img {
            transition: transform .6s cubic-bezier(.25, .46, .45, .94);
        }

        .gallery-card:hover img {
            transform: scale(1.08);
        }

        /* ── Staggered entrance ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .card-animate {
            animation: fadeUp .5s ease both;
        }

        /* ── Select custom arrow (jika diperlukan) ── */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236b7280' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px !important;
        }
    </style>
</head>

<body class="hero-bg noise text-gray-800 antialiased min-h-screen">

    {{-- ── NAVBAR ── --}}
    @include('partials.navbar')

    {{-- ── MAIN CONTENT ── --}}
    <main class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-24">

        {{-- ── Back Link ── --}}
        <div class="mb-8">
            <a href="{{ route('umkm.index') }}"
                class="back-link text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar UMKM
            </a>
        </div>

        {{-- ── Page Header ── --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Detail Usaha
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
                {{ $umkm->nama_usaha }}
            </h1>
            <div class="mt-5 flex items-center justify-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        {{-- ===== HERO DETAIL CARD ===== --}}
        <div class="detail-card card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                    hover:shadow-2xl hover:shadow-blue-100 transition-all duration-300 p-6 sm:p-8 mb-10">

            <div class="flex flex-col sm:flex-row gap-6 sm:gap-8 items-start">

                {{-- ── Logo UMKM ── --}}
                <div class="shrink-0 w-28 h-28 sm:w-32 sm:h-32 rounded-2xl bg-gradient-to-br from-blue-50 via-sky-50 to-teal-50
                            border border-blue-100 flex items-center justify-center overflow-hidden shadow-sm">
                    @if($umkm->logo)
                    <img src="{{ asset('storage/' . $umkm->logo) }}" class="w-full h-full object-cover"
                        alt="{{ $umkm->nama_usaha }}">
                    @else
                    <div class="flex flex-col items-center gap-1.5 select-none">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                                    flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5
                                     21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1
                                     1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="text-xs text-gray-400 font-medium">No Logo</span>
                    </div>
                    @endif
                </div>

                {{-- ── Info Utama ── --}}
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight">
                        {{ $umkm->nama_usaha }}
                    </h2>
                    <p class="text-sm text-gray-500 mt-3 leading-relaxed text-justify">
                        {{ $umkm->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>

                    {{-- ── Meta Grid ── --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-6">
                        {{-- Kategori --}}
                        <div class="flex items-center gap-3 bg-blue-50/60 border border-blue-100 rounded-xl px-4 py-3
                                    transition-all duration-200 hover:bg-blue-50 hover:shadow-sm">
                            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-100 to-blue-200
                                        flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-400 font-medium">Kategori</p>
                                <p class="text-sm font-semibold text-gray-700 truncate">{{ $umkm->kategori->nama ?? '-' }}</p>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="flex items-center gap-3 bg-blue-50/60 border border-blue-100 rounded-xl px-4 py-3
                            transition-all duration-200 hover:bg-blue-50 hover:shadow-sm">

                            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-teal-100 to-teal-200
                                flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-teal-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs text-gray-400 font-medium">Alamat</p>

                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($umkm->nama_usaha . ' ' . $umkm->alamat_lengkap . ' Bontang Kalimantan Timur') }}"
                            target="_blank"
                            class="block text-sm font-semibold text-gray-700 hover:text-blue-600 hover:underline">

                                {{ $umkm->alamat_lengkap ?? 'Lokasi tidak tersedia' }}
                            </a>
                            </div>
                        </div>

                        {{-- Jam Operasional --}}
                        <div class="flex items-center gap-3 bg-blue-50/60 border border-blue-100 rounded-xl px-4 py-3
                                    transition-all duration-200 hover:bg-blue-50 hover:shadow-sm">
                            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-amber-100 to-amber-200
                                        flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-400 font-medium">Jam Operasional</p>
                                <p class="text-sm font-semibold text-gray-700 truncate">{{ $umkm->jam_operasional ?? '-' }}</p>
                            </div>
                        </div>

                        {{-- Kontak --}}
                        <div class="flex items-center gap-3 bg-blue-50/60 border border-blue-100 rounded-xl px-4 py-3
                                    transition-all duration-200 hover:bg-blue-50 hover:shadow-sm">
                            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-emerald-100 to-emerald-200
                                        flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-400 font-medium">Kontak</p>
                                <p class="text-sm font-semibold text-gray-700 truncate">{{ $umkm->kontak ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== SECTION PRODUK ===== --}}
        <section class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                            flex items-center justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Produk</h2>
                @if($umkm->produk->count())
                <span class="text-xs bg-blue-100 text-blue-600 px-2.5 py-1 rounded-full font-semibold">
                    {{ $umkm->produk->count() }}
                </span>
                @endif
            </div>

            @if($umkm->produk->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($umkm->produk as $index => $p)
                <a href="{{ route('produk.show', $p->id) }}"
                    class="product-card card-animate bg-white rounded-2xl border border-gray-100
                            shadow-md shadow-blue-50 overflow-hidden hover:shadow-xl hover:shadow-blue-100
                            hover:-translate-y-1.5 transition-all duration-300 flex flex-col">

                    {{-- Image --}}
                    <div class="product-img-wrap relative h-36 bg-gradient-to-br from-blue-50 via-sky-50 to-teal-50
                                flex items-center justify-center flex-shrink-0">
                        @if($p->foto_produk)
                        <img src="{{ asset('storage/'.$p->foto_produk) }}"
                            class="w-full h-full object-cover"
                            alt="{{ $p->nama_produk }}">
                        @else
                        <div class="flex flex-col items-center gap-2 select-none">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                                        flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <span class="text-xs text-gray-400 font-medium">No Image</span>
                        </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="p-3.5 flex flex-col flex-1 gap-2">
                        <p class="text-sm font-semibold text-gray-800 line-clamp-2 leading-snug">
                            {{ $p->nama_produk }}
                        </p>
                        <p class="text-sm font-bold text-blue-600 mt-auto">
                            Rp {{ number_format($p->harga, 0, ',', '.') }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="bg-white/60 backdrop-blur-sm border border-dashed border-blue-200 rounded-2xl
                        flex flex-col items-center justify-center py-14 text-center">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-50 to-teal-50 border
                            border-blue-100 flex items-center justify-center mb-4 shadow-sm">
                    <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <p class="text-gray-500 font-medium text-sm">Belum ada produk ditambahkan.</p>
            </div>
            @endif
        </section>

        {{-- ===== SECTION GALERI / FOTO USAHA ===== --}}
        <section>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                            flex items-center justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Foto Usaha</h2>
                @if($umkm->galeri->count())
                <span class="text-xs bg-blue-100 text-blue-600 px-2.5 py-1 rounded-full font-semibold">
                    {{ $umkm->galeri->count() }}
                </span>
                @endif
            </div>

            @if($umkm->galeri->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($umkm->galeri as $index => $foto)
                <div class="gallery-card card-animate rounded-2xl border border-gray-100
                            shadow-md shadow-blue-50 overflow-hidden hover:shadow-xl hover:shadow-blue-100
                            hover:-translate-y-1 transition-all duration-300 bg-white">
                    <div class="h-48 sm:h-56 w-full overflow-hidden">
                        <img src="{{ asset('storage/'.$foto->foto) }}"
                            class="w-full h-full object-cover"
                            alt="Foto Usaha {{ $umkm->nama_usaha }}">
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white/60 backdrop-blur-sm border border-dashed border-blue-200 rounded-2xl
                        flex flex-col items-center justify-center py-14 text-center">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-50 to-teal-50 border
                            border-blue-100 flex items-center justify-center mb-4 shadow-sm">
                    <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-gray-500 font-medium text-sm">Belum ada foto usaha.</p>
            </div>
            @endif
        </section>

    </main>

    {{-- ── FOOTER ── --}}
    @include('partials.footer')

    {{-- ── Script untuk menyimpan referrer dan scroll position ── --}}
    <script>
        function saveReferrer(url) {
            sessionStorage.setItem('referrerUrl', window.location.href);
            sessionStorage.setItem('referrerScroll', window.scrollY);
            window.location.href = url;
        }
    </script>

</body>

</html>