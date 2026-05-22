<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Blog – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }

        /* ── Animated gradient mesh background ── */
        .hero-bg {
            background-color: #eff6ff;
            background-image:
                radial-gradient(ellipse 80% 60% at 20% -10%, rgba(96,165,250,.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 85% 10%,  rgba(45,212,191,.14) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 100%, rgba(59,130,246,.10) 0%, transparent 60%);
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

        /* ── Search glow on focus ── */
        .search-input:focus {
            box-shadow: 0 0 0 4px rgba(59,130,246,.15), 0 4px 20px rgba(59,130,246,.12);
        }

        /* ── Card shine effect ── */
        .umkm-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,.6) 0%, transparent 50%);
            opacity: 0;
            transition: opacity .3s ease;
            pointer-events: none;
            border-radius: inherit;
        }
        .umkm-card:hover::before { opacity: 1; }

        /* ── Image zoom ── */
        .card-img-wrap { overflow: hidden; }
        .card-img-wrap img { transition: transform .6s cubic-bezier(.25,.46,.45,.94); }
        .umkm-card:hover .card-img-wrap img { transform: scale(1.08); }

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
        .back-link:hover::after { transform: scaleX(1); }

        /* ── CTA button shimmer ── */
        .btn-primary {
            position: relative;
            overflow: hidden;
        }
        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.25), transparent);
            transition: left .5s ease;
        }
        .btn-primary:hover::after { left: 160%; }

        /* ── Card detail button fill ── */
        .card-btn {
            position: relative;
            overflow: hidden;
            z-index: 0;
        }
        .card-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #2563eb, #0891b2);
            transform: translateY(101%);
            transition: transform .25s cubic-bezier(.4,0,.2,1);
            z-index: -1;
            border-radius: inherit;
        }
        .umkm-card:hover .card-btn::before { transform: translateY(0); }
        .umkm-card:hover .card-btn { color: #fff; border-color: transparent; }

        /* ── Staggered card entrance ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
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

<body class="hero-bg noise text-gray-800 antialiased min-h-screen">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    <main class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-24">

        {{-- Back link --}}
        <div class="mb-8">
            <a href="{{ route('beranda') }}"
               class="back-link text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        {{-- Page Header --}}
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Berita & Informasi Terkini
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gradient leading-tight tracking-tight">
                Blog & Artikel
            </h1>
            <p class="text-gray-500 mt-4 max-w-lg mx-auto text-base leading-relaxed">
                Informasi dan wawasan terbaru seputar dunia usaha, ekonomi, dan pemberdayaan UMKM di Bontang.
            </p>

            <div class="mt-6 flex items-center justify-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

            {{-- Search input --}}
            <div class="relative w-full lg:w-80 group">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400
                             transition-colors duration-200 group-focus-within:text-blue-500
                             pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari artikel..."
                       class="search-input w-full pl-12 pr-4 py-3 border-2 border-blue-100
                              rounded-2xl bg-white/80 backdrop-blur-sm focus:outline-none
                              focus:border-blue-400 text-sm transition-all duration-300
                              placeholder:text-gray-400 shadow-sm text-gray-700 font-medium">
            </div>

        {{-- Grid Blog --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($blogs as $index => $blog)
            <a href="{{ route('blog.show', $blog->id) }}"
               class="umkm-card card-animate group relative bg-white rounded-2xl
                      border border-gray-100 shadow-md shadow-blue-50 overflow-hidden
                      hover:shadow-2xl hover:shadow-blue-200 hover:-translate-y-2
                      transition-all duration-300 flex flex-col">
            </a>

                {{-- Image Area --}}
                <div class="card-img-wrap relative h-44 bg-gradient-to-br from-blue-50 via-sky-50
                            to-teal-50 flex items-center justify-center flex-shrink-0">
                    @if($blog->gambar)
                        <img src="{{ asset('storage/'.$blog->gambar) }}"
                             class="w-full h-full object-cover"
                             alt="{{ $blog->judul }}">
                    @else
                        <div class="flex flex-col items-center gap-2 select-none">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100
                                        to-teal-100 flex items-center justify-center shadow-sm">
                                <svg class="w-7 h-7 text-blue-400" fill="none"
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1.5"
                                          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-400 font-medium">Tanpa gambar</span>
                        </div>
                    @endif

                    {{-- Kategori badge --}}
                    <span class="absolute top-3 left-3 text-xs bg-white/90 backdrop-blur-sm
                                 text-blue-700 border border-blue-100 px-2.5 py-1 rounded-full
                                 font-semibold shadow-sm">
                        {{ $blog->kategori ?? 'Umum' }}
                    </span>
                </div>

                {{-- Card Body --}}
                <div class="p-5 flex flex-col flex-1 gap-3">
                               transition-colors duration-200 line-clamp-2 text-base leading-snug">
                        {{ $blog->judul }}
                    </h3>

                    <p class="text-xs text-gray-500 line-clamp-3 leading-relaxed">
                        {{ \Illuminate\Support\Str::limit($blog->konten ?? $blog->isi ?? '', 120) }}
                    </p>

                    <div class="mt-auto pt-2 flex items-center justify-between">
                        <span class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('d F Y') }}
                        </span>
                        <span class="card-btn inline-block text-center text-sm border-2
                                     border-blue-200 text-blue-700 rounded-xl py-2 px-4
                                     font-semibold transition-all duration-250 active:scale-95
                                     select-none">
                            Baca →
                        </span>
                    </div>
                </div>
            </a>

            @empty
            <div class="col-span-full flex flex-col items-center justify-center py-24 text-center">
                <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-blue-50 to-teal-50
                            border border-blue-100 flex items-center justify-center mb-6 shadow-sm">
                    <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <h3 class="text-gray-700 font-bold text-xl mb-2">Belum ada artikel</h3>
                <p class="text-gray-400 text-sm max-w-xs leading-relaxed">
                    Coba kata kunci lain atau ubah filter pencarian Anda.
                </p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if(method_exists($blogs, 'hasPages') && $blogs->hasPages())
            <div class="mt-14 flex justify-center">
                <div class="bg-white/70 backdrop-blur-sm border border-gray-100 rounded-2xl
                            px-4 py-3 shadow-sm">
                    {{ $blogs->withQueryString()->links() }}
                </div>
            </div>
        @endif

    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

</body>
</html>