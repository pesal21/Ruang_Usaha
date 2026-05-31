<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $produk->nama_produk }} – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* ── Animated gradient mesh background ── */
        .hero-bg {
            background-color: #f0f9ff;
            background-image:
                radial-gradient(ellipse 80% 60% at 20% -10%, rgba(59, 130, 246, .12) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 85% 10%, rgba(20, 184, 166, .10) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 100%, rgba(99, 102, 241, .08) 0%, transparent 60%);
        }

        /* ── Noise texture overlay ── */
        .noise::after {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .02;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-size: 128px 128px;
            z-index: 0;
        }

        /* ── Gradient text ── */
        .text-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #0891b2 50%, #0d9488 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Staggered entrance ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-up {
            animation: fadeUp .5s ease both;
        }

        /* ── Page load fade-in ── */
        @keyframes fadeInMain {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .page-enter {
            animation: fadeInMain 0.6s ease forwards;
        }

        /* ── Back link animation ── */
        .back-link {
            position: relative;
        }
        .back-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 1.75rem;
            right: 0;
            height: 1.5px;
            background: currentColor;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s ease;
        }
        .back-link:hover::after {
            transform: scaleX(1);
        }
    </style>
</head>

<body class="hero-bg noise text-gray-800 antialiased min-h-screen flex flex-col">

    {{-- ── NAVBAR ── --}}
    @include('partials.navbar')

    {{-- ── Script untuk menyimpan scroll position dan restore saat kembali ── --}}
    <script>
        // Simpan scroll position saat halaman ditinggalkan
        document.addEventListener('beforeunload', function() {
            sessionStorage.setItem('scrollPosition', window.scrollY);
        });

        // Restore scroll position saat halaman dimuat
        window.addEventListener('load', function() {
            const scrollPosition = sessionStorage.getItem('scrollPosition');
            if (scrollPosition !== null) {
                window.scrollTo(0, parseInt(scrollPosition));
            }
        });

        // Handle back button dengan referrer yang disimpan
        function goBack() {
            const referrer = sessionStorage.getItem('referrerUrl');
            const referrerScroll = sessionStorage.getItem('referrerScroll');
            
            if (referrer) {
                sessionStorage.removeItem('referrerUrl');
                sessionStorage.removeItem('referrerScroll');
                window.location.href = referrer;
                window.addEventListener('pageshow', function() {
                    if (referrerScroll) {
                        window.scrollTo(0, parseInt(referrerScroll));
                    }
                });
            } else {
                if (window.history.length > 1) {
                    window.history.back();
                } else {
                    window.location.href = '{{ route("umkm.index") }}';
                }
            }
        }
    </script>

    {{-- ── MAIN CONTENT ── --}}
    <main class="relative z-10 flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-24 page-enter">

        {{-- ── Back Link ── --}}
        <div class="mb-8 animate-fade-up" style="animation-delay: 0.1s;">
            <a href="{{ route('umkm.index') }}"
               class="back-link inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-indigo-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        {{-- ===== DETAIL PRODUK ===== --}}
        <div class="grid lg:grid-cols-3 gap-10 mb-16">

            {{-- ── GALERI PRODUK ── --}}
            <div class="lg:col-span-1 animate-fade-up" style="animation-delay: 0.15s;">
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl border border-blue-50 shadow-lg shadow-blue-50/50 overflow-hidden">
                    <div class="w-full aspect-square bg-gradient-to-br from-blue-50 via-sky-50 to-indigo-50 flex items-center justify-center overflow-hidden">
                        @if($produk->foto_produk)
                            <img id="mainImage" src="{{ asset('storage/'.$produk->foto_produk) }}"
                                class="w-full h-full object-contain hover:scale-110 transition-transform duration-700" 
                                alt="{{ $produk->nama_produk }}">
                        @else
                            <div class="flex flex-col items-center justify-center w-full h-full text-gray-400 gap-3">
                                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-100 
                                            flex items-center justify-center shadow-sm">
                                    <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-400">No Image</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ── INFO PRODUK ── --}}
            <div class="lg:col-span-2 animate-fade-up" style="animation-delay: 0.2s;">
                
                {{-- Breadcrumb --}}
                <div class="mb-6 flex items-center gap-2 text-sm text-gray-500 flex-wrap">
                    <a href="{{ route('umkm.index') }}" class="hover:text-blue-600 transition-colors font-medium">Produk</a>
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-700 font-semibold truncate">{{ $produk->nama_produk }}</span>
                </div>

                {{-- Nama Produk --}}
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient mb-6 leading-tight">
                    {{ $produk->nama_produk }}
                </h1>

                {{-- UMKM Info --}}
                <a href="{{ route('umkm.show', $umkm->id) }}" 
                   class="group inline-flex items-center gap-3 mb-8 p-4 bg-gradient-to-br from-blue-50 to-indigo-50 
                          border border-blue-100 rounded-xl hover:shadow-lg hover:border-blue-200 transition-all duration-200">
                    @if($umkm->logo)
                        <img src="{{ asset('storage/'.$umkm->logo) }}" 
                            class="w-12 h-12 rounded-full object-cover ring-2 ring-white shadow-sm" 
                            alt="{{ $umkm->nama_usaha }}">
                    @else
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 
                                    flex items-center justify-center text-white font-bold shadow-sm ring-2 ring-white">
                            {{ strtoupper(substr($umkm->nama_usaha, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Dari UMKM</p>
                        <p class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">
                            {{ $umkm->nama_usaha }}
                        </p>
                    </div>
                    <svg class="w-4 h-4 text-blue-400 opacity-0 group-hover:opacity-100 transform translate-x-0 
                               group-hover:translate-x-1 transition-all duration-300 ml-auto" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                {{-- Harga --}}
                <div class="mb-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                    <p class="text-gray-500 text-sm font-medium mb-2">Harga</p>
                    <p class="text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text 
                             bg-gradient-to-r from-blue-600 to-indigo-600">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Divider --}}
                <div class="border-t border-gray-200 my-8"></div>
                {{-- Deskripsi Produk --}}
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-3">
                        <span class="w-1.5 h-5 bg-gradient-to-b from-blue-500 to-indigo-600 rounded-full"></span>
                        Deskripsi Produk
                    </h3>
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                        <p class="text-gray-600 leading-relaxed text-justify">
                            {{ $produk->deskripsi ? trim($produk->deskripsi) : 'Tidak ada deskripsi untuk produk ini.' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- ===== PRODUK REKOMENDASI ===== --}}
        <section class="animate-fade-up" style="animation-delay: 0.25s;">
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 
                                flex items-center justify-center shadow-md shadow-blue-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Anda Mungkin Juga Suka</h2>
                </div>
                <p class="text-gray-500 ml-13">Produk lainnya dari {{ $umkm->nama_usaha }}</p>
            </div>

            @if($rekomendasi->count())
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach($rekomendasi as $index => $item)
                        <a href="{{ route('produk.show', $item->id) }}"
                            class="group animate-fade-up bg-white rounded-2xl border border-gray-100
                                   shadow-md hover:shadow-2xl hover:shadow-blue-100/60
                                   hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col">

                            {{-- Gambar Produk --}}
                            <div class="relative w-full aspect-square bg-gradient-to-br from-blue-50 via-sky-50 to-indigo-50
                                        flex items-center justify-center overflow-hidden flex-shrink-0">
                                @if($item->foto_produk)
                                    <img src="{{ asset('storage/'.$item->foto_produk) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                                        alt="{{ $item->nama_produk }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/20 to-transparent 
                                                opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                @else
                                    <div class="flex flex-col items-center justify-center w-full h-full text-gray-400 gap-2">
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 
                                                    flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-400">No Image</span>
                                    </div>
                                @endif
                                
                                {{-- Quick view badge --}}
                                <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm rounded-lg px-2.5 py-1.5 
                                            text-xs font-semibold text-blue-600 shadow-sm opacity-0 group-hover:opacity-100 
                                            transform translate-y-1 group-hover:translate-y-0 transition-all duration-300">
                                    Lihat →
                                </div>
                            </div>

                            {{-- Info Produk --}}
                            <div class="p-4 flex flex-col flex-1 gap-2">
                                <h3 class="font-semibold text-gray-800 text-sm line-clamp-2 leading-snug 
                                         group-hover:text-blue-700 transition-colors duration-300">
                                    {{ $item->nama_produk }}
                                </h3>
                                <div class="flex-1"></div>
                                <p class="text-sm font-extrabold text-transparent bg-clip-text 
                                         bg-gradient-to-r from-blue-600 to-indigo-600 mt-auto">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="relative overflow-hidden bg-white/80 backdrop-blur-sm border-2 border-dashed border-blue-200 
                            rounded-2xl flex flex-col items-center justify-center py-16 text-center">
                    <div class="absolute inset-0 opacity-5">
                        <div class="absolute top-0 left-0 w-40 h-40 bg-blue-300 rounded-full blur-3xl"></div>
                        <div class="absolute bottom-0 right-0 w-40 h-40 bg-indigo-300 rounded-full blur-3xl"></div>
                    </div>
                    
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-100 border-2 
                                    border-blue-200 flex items-center justify-center mb-5 shadow-lg shadow-blue-100">
                            <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <p class="text-gray-600 font-semibold text-base mb-1">Belum ada produk lain</p>
                        <p class="text-gray-400 text-sm">Ini adalah satu-satunya produk dari toko ini.</p>
                    </div>
                </div>
            @endif
        </section>

    </main>

    {{-- ── FOOTER ── --}}
    @include('partials.footer')

</body>

</html>