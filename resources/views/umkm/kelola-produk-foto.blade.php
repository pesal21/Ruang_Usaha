<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Produk & Foto – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        .product-card {
            position: relative;
        }

        .product-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .6) 0%, transparent 50%);
            opacity: 0;
            transition: opacity .3s ease;
            pointer-events: none;
            border-radius: inherit;
            z-index: 1;
        }

        .product-card:hover::before {
            opacity: 1;
        }

        /* ── Image zoom ── */
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

        /* ── Button shimmer ── */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }

        .btn-shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: -80%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .25), transparent);
            transition: left .5s ease;
        }

        .btn-shimmer:hover::after {
            left: 150%;
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

        /* ── Select custom arrow ── */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236b7280' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px !important;
        }
    </style>
</head>

<body class="hero-bg noise text-gray-800 antialiased min-h-screen flex flex-col">

    {{-- ── NAVBAR ── --}}
    @include('partials.navbar')

    {{-- ── MAIN CONTENT ── --}}
    <main class="relative z-10 flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-24">

        {{-- ── Back Link ── --}}
        <div class="mb-8">
            <a href="{{ route('umkm.dashboard', $umkm->id) }}"
                class="back-link text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

        {{-- ── Page Header ── --}}
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Manajemen Usaha
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gradient leading-tight tracking-tight">
                Kelola Produk & Foto
            </h1>
            <p class="text-gray-500 mt-4 max-w-lg mx-auto text-base leading-relaxed">
                Atur produk dan galeri foto untuk usaha <span class="font-semibold text-blue-600">{{ $umkm->nama_usaha }}</span>.
            </p>

            {{-- Decorative divider --}}
            <div class="mt-6 flex items-center justify-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        {{-- ===== GRID KONTEN UTAMA ===== --}}
        <div class="grid lg:grid-cols-2 gap-10">

            {{-- ================= PRODUK ================= --}}
            <section>
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                                    flex items-center justify-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Daftar Produk</h2>
                    </div>

                    <a href="{{ route('umkm.produk.create', $umkm->id) }}"
                        class="btn-shimmer inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-teal-500
                               text-white text-sm font-semibold rounded-xl shadow-md shadow-blue-100
                               hover:shadow-lg hover:-translate-y-0.5 active:scale-95 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Produk
                    </a>
                </div>

                @if($produk->count())
                <div class="space-y-3">
                    @foreach($produk as $index => $item)
                    <div class="product-card card-animate bg-white rounded-2xl border border-gray-100
                                shadow-md shadow-blue-50 overflow-hidden hover:shadow-lg hover:shadow-blue-100
                                transition-all duration-300 flex items-center gap-4 p-4"
                        style="animation-delay: {{ $index * 0.05 }}s;">

                        {{-- Gambar Produk --}}
                        <div class="product-img-wrap w-16 h-16 rounded-xl flex-shrink-0 overflow-hidden
                                    bg-gradient-to-br from-blue-50 via-sky-50 to-teal-50 flex items-center justify-center">
                            @if($item->foto_produk)
                            <img src="{{ asset('storage/'.$item->foto_produk) }}"
                                class="w-full h-full object-cover" alt="{{ $item->nama_produk }}">
                            @else
                            <div class="flex items-center justify-center w-full h-full text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            @endif
                        </div>

                        {{-- Info Produk --}}
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-800 text-sm truncate">{{ $item->nama_produk }}</h3>
                            @if($item->kategori ?? false)
                            <p class="text-xs text-gray-400 mt-0.5">{{ $item->kategori }}</p>
                            @endif
                            @if($item->harga)
                            <p class="text-sm font-bold text-blue-600 mt-1">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>
                            @endif
                        </div>

                        {{-- Aksi --}}
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('produk.edit', $item->id) }}"
                                class="w-9 h-9 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600
                                       hover:bg-blue-100 hover:shadow-sm transition-all duration-200"
                                title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>

                            <form action="{{ route('produk.destroy', $item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus produk ini?')"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 text-red-500
                                           hover:bg-red-100 hover:shadow-sm transition-all duration-200"
                                    title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
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
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium text-sm">Belum ada produk ditambahkan.</p>
                    <p class="text-gray-400 text-xs mt-1">Klik tombol "Tambah Produk" untuk memulai.</p>
                </div>
                @endif
            </section>

            {{-- ================= GALERI ================= --}}
            <section>
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                                    flex items-center justify-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Galeri Foto Usaha</h2>
                    </div>

                    <button onclick="document.getElementById('fotoInput').click()"
                        class="btn-shimmer inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-teal-500
                               text-white text-sm font-semibold rounded-xl shadow-md shadow-blue-100
                               hover:shadow-lg hover:-translate-y-0.5 active:scale-95 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Foto
                    </button>
                </div>

                {{-- Form upload tersembunyi --}}
                <form action="{{ route('umkm.galeri.store', $umkm->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    id="galeriFoto">
                    @csrf
                    <input type="file" name="foto" id="fotoInput" required
                        class="hidden"
                        onchange="document.getElementById('galeriFoto').submit()">
                </form>

                @if(isset($umkm->galeri) && $umkm->galeri->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($umkm->galeri as $index => $foto)
                    <div class="gallery-card card-animate rounded-2xl border border-gray-100
                                shadow-md shadow-blue-50 overflow-hidden hover:shadow-xl hover:shadow-blue-100
                                hover:-translate-y-1 transition-all duration-300 relative group"
                        style="animation-delay: {{ $index * 0.06 }}s;">
                        <div class="h-40 w-full overflow-hidden">
                            <img src="{{ asset('storage/'.$foto->foto) }}"
                                class="w-full h-full object-cover"
                                alt="Foto Usaha {{ $umkm->nama_usaha }}">
                        </div>
                        {{-- Tombol hapus --}}
                        <form action="{{ route('umkm.galeri.destroy', $foto->id) }}" method="POST"
                            onsubmit="return confirm('Hapus foto ini?')"
                            class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-red-500/90 backdrop-blur-sm
                                       text-white shadow-lg hover:bg-red-600 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
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
                    <p class="text-gray-400 text-xs mt-1">Klik tombol "Tambah Foto" untuk mengunggah.</p>
                </div>
                @endif
            </section>

        </div>
    </main>

    {{-- ── FOOTER ── --}}
    @include('partials.footer')

</body>

</html>