<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangUsaha – Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --blue:    #1d4ed8;
            --blue-lt: #3b82f6;
            --teal:    #0d9488;
            --orange:  #ea580c;
            --orange-lt:#fb923c;
        }

        body { font-family: 'Poppins', sans-serif; }

        /* ── Gradient mesh overlay ── */
        .hero-mesh {
            background-image:
                radial-gradient(ellipse 70% 60% at 5%  0%,  rgba(59,130,246,.22) 0%, transparent 55%),
                radial-gradient(ellipse 55% 50% at 95% 5%,  rgba(13,148,136,.18) 0%, transparent 55%),
                radial-gradient(ellipse 50% 45% at 50% 110%,rgba(234,88,12,.12)  0%, transparent 55%);
        }

        /* ── Floating animation ── */
        @keyframes float {
            0%,100% { transform: translateY(0px) rotate(0deg); }
            33%      { transform: translateY(-12px) rotate(1deg); }
            66%      { transform: translateY(-6px) rotate(-1deg); }
        }
        .animate-float { animation: float 5s ease-in-out infinite; }

        /* ── Stat badge bounce-in ── */
        @keyframes popIn {
            from { opacity: 0; transform: scale(.7) translateY(8px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }
        .pop-in { animation: popIn .5s cubic-bezier(.34,1.56,.64,1) both; }

        /* ── Gradient text ── */
        .text-blue-grad {
            background: linear-gradient(135deg, var(--blue), var(--teal));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .text-orange-grad {
            background: linear-gradient(135deg, var(--orange), #f59e0b);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        /* ── Shimmer button ── */
        .btn-shimmer { position: relative; overflow: hidden; }
        .btn-shimmer::after {
            content: '';
            position: absolute; top: 0; left: -80%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.3), transparent);
            transition: left .55s ease;
        }
        .btn-shimmer:hover::after { left: 150%; }

        /* ── Section wave divider ── */
        .wave-top    { margin-bottom: -2px; }
        .wave-bottom { margin-top: -2px; }

        /* ── UMKM logo card ── */
        .logo-card { transition: all .3s cubic-bezier(.4,0,.2,1); }
        .logo-card:hover { transform: translateY(-8px) scale(1.03); }
        .logo-card:hover .logo-ring { box-shadow: 0 0 0 4px rgba(59,130,246,.25); }

        /* ── Kategori card left accent ── */
        .kat-card {
            position: relative;
            transition: all .3s ease;
        }
        .kat-card::before {
            content: '';
            position: absolute;
            left: 0; top: 8px; bottom: 8px;
            width: 4px;
            border-radius: 0 4px 4px 0;
            background: linear-gradient(to bottom, var(--blue-lt), var(--teal));
            opacity: 0;
            transition: opacity .25s ease;
        }
        .kat-card:hover::before { opacity: 1; }
        .kat-card:hover { transform: translateY(-6px); }

        /* ── Blog card image overlay ── */
        .blog-img-overlay {
            position: relative; overflow: hidden;
        }
        .blog-img-overlay::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,.35) 0%, transparent 60%);
        }

        /* ── Underline link animation ── */
        .link-anim {
            position: relative; display: inline-block;
        }
        .link-anim::after {
            content: '';
            position: absolute; left: 0; bottom: -1px;
            width: 0; height: 1.5px;
            background: currentColor;
            transition: width .25s ease;
        }
        .link-anim:hover::after { width: 100%; }

        /* ── Stats section number counter feel ── */
        .stat-num {
            background: linear-gradient(135deg, var(--blue), var(--teal));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        /* ── Noise texture ── */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='4'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-size: 160px;
            opacity: .022;
            pointer-events: none;
            z-index: 9999;
        }
    </style>
</head>
<body class="antialiased text-gray-900 bg-white">

    @include('partials.navbar')

    {{-- ════════════════════════════════════════════════════
         HERO
    ════════════════════════════════════════════════════ --}}
    <section class="relative pt-28 pb-0 overflow-hidden dot-grid hero-mesh">

        {{-- Decorative shapes --}}
        <div class="absolute top-10 left-4 w-72 h-72 rounded-full bg-blue-400/10 blur-3xl pointer-events-none"></div>
        <div class="absolute top-0 right-0 w-96 h-80 rounded-full bg-orange-400/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-10 left-1/3 w-64 h-64 rounded-full bg-teal-400/10 blur-3xl pointer-events-none"></div>

        {{-- Decorative ring accents --}}
        <div class="absolute top-20 right-12 w-32 h-32 rounded-full border-2 border-blue-200/60 pointer-events-none"></div>
        <div class="absolute top-32 right-20 w-14 h-14 rounded-full border-2 border-orange-300/50 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-16 grid md:grid-cols-2 gap-12 items-center pb-16">

            {{-- ── Left: Copy ── --}}
            <div class="z-10" data-aos="fade-right" data-aos-duration="700">

                {{-- Eyebrow pill --}}
                <div class="inline-flex items-center gap-2 bg-blue-600/10 border border-blue-200 text-blue-700
                            px-4 py-1.5 rounded-full text-xs font-bold mb-6 tracking-wide uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                    Platform UMKM Digital Bontang
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.12] tracking-tight text-gray-900">
                    Satu <span class="text-blue-grad">Platform</span>,<br>
                    Seribu Peluang<br>
                    untuk <span class="text-orange-grad">UMKM</span> Bontang.
                </h1>

                <p class="mt-5 text-gray-500 text-base md:text-lg leading-relaxed max-w-md">
                    Temukan, daftarkan, dan kembangkan bisnis lokal Anda — semua dalam satu ekosistem yang terhubung.
                </p>

                {{-- CTAs --}}
                <div class="flex flex-wrap gap-3 mt-8">
                    @guest
                    <a href="{{ route('login.role', 'umkm') }}"
                    class="btn-shimmer inline-flex items-center gap-2 px-7 py-3.5
                            bg-gradient-to-r from-orange-500 to-amber-500 text-white font-bold
                            rounded-2xl shadow-xl shadow-orange-400/30 hover:shadow-orange-400/50
                            hover:-translate-y-0.5 active:scale-95 transition-all duration-200 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Daftarkan Bisnis Anda
                    </a>
                    @endguest
                    
                    @auth
                    <a href="{{ auth()->user()->umkm ? route('umkm.pilih') : route('umkm.create') }}"
                    class="btn-shimmer inline-flex items-center gap-2 px-7 py-3.5
                            bg-gradient-to-r from-orange-500 to-amber-500 text-white font-bold
                            rounded-2xl shadow-xl shadow-orange-400/30 hover:shadow-orange-400/50
                            hover:-translate-y-0.5 active:scale-95 transition-all duration-200 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Kelola Bisnis Anda
                    </a>
                    @endauth
                    
                    <a href="{{ route('umkm.index') }}"
                    class="inline-flex items-center gap-2 px-7 py-3.5 border-2 border-blue-200
                            text-blue-700 font-bold rounded-2xl hover:bg-blue-600 hover:text-white
                            hover:border-blue-600 hover:-translate-y-0.5 active:scale-95
                            transition-all duration-200 text-sm">
                        Jelajahi UMKM
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                {{-- Trust signals --}}
                <div class="mt-10 flex items-center gap-6 flex-wrap">
                    <div class="flex flex-col">
                        <span class="text-2xl font-extrabold stat-num">500+</span>
                        <span class="text-xs text-gray-500 font-medium">UMKM Terdaftar</span>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-extrabold stat-num">20+</span>
                        <span class="text-xs text-gray-500 font-medium">Kategori Usaha</span>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-extrabold stat-num">Bontang</span>
                        <span class="text-xs text-gray-500 font-medium">Kota Industri</span>
                    </div>
                </div>
            </div>

            {{-- ── Right: Hero Image + Floating Badges ── --}}
            <div class="relative flex justify-center items-center z-10"
                 data-aos="fade-left" data-aos-duration="700" data-aos-delay="150">

                {{-- Floating stat badges --}}
                <div class="pop-in absolute -top-4 -left-4 md:left-4 bg-white rounded-2xl shadow-xl
                            shadow-blue-200/60 border border-blue-100 px-4 py-3 flex items-center gap-3
                            text-sm font-semibold z-20" style="animation-delay:.3s">
                    <span class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </span>
                    <div>
                        <div class="text-blue-700 font-bold text-sm">Bisnis Berkembang</div>
                        <div class="text-gray-400 text-xs font-normal">Bergabung sekarang</div>
                    </div>
                </div>

                <div class="pop-in absolute -bottom-2 right-0 md:right-4 bg-white rounded-2xl shadow-xl
                            shadow-orange-200/60 border border-orange-100 px-4 py-3 flex items-center gap-3
                            text-sm font-semibold z-20" style="animation-delay:.55s">
                    <span class="w-8 h-8 rounded-xl bg-orange-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </span>
                    <div>
                        <div class="text-orange-700 font-bold text-sm">Kota Bontang</div>
                        <div class="text-gray-400 text-xs font-normal">Kalimantan Timur</div>
                    </div>
                </div>

                {{-- Main hero image --}}
                <img src="gambar-1.png" alt="RuangUsaha Hero"
                     class="w-[260px] sm:w-[340px] md:w-[440px] animate-float drop-shadow-2xl relative z-10">

                {{-- Glow behind image --}}
                <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-blue-300/20 to-orange-300/20
                            blur-3xl scale-75 pointer-events-none"></div>
            </div>
        </div>

        {{-- Wave divider --}}
        <div class="wave-top relative -bottom-1">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 60 C360 0 1080 0 1440 60 L1440 60 L0 60 Z" fill="white"/>
            </svg>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════
         DAFTAR UMKM
    ════════════════════════════════════════════════════ --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-16">

            {{-- Section header --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-12">
                <div data-aos="fade-right">
                    <span class="text-xs font-bold uppercase tracking-widest text-blue-500 mb-2 block">Direktori</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                        UMKM <span class="text-blue-grad">Bontang</span>
                    </h2>
                    <p class="text-gray-500 mt-2 text-sm max-w-sm">Usaha lokal yang telah terdaftar di platform kami.</p>
                </div>
                <a href="{{ route('umkm.index') }}
                   data-aos="fade-left"
                   class="link-anim text-sm font-semibold text-blue-600 hover:text-blue-700
                          flex items-center gap-1.5 flex-shrink-0">
                    Lihat semua UMKM
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            @if($umkms->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
                @foreach ($umkms as $umkm)
                @php
                    $gradients = [
                        'from-blue-500 to-cyan-500',
                        'from-orange-500 to-amber-400',
                        'from-teal-500 to-emerald-500',
                        'from-violet-500 to-purple-500',
                        'from-rose-500 to-pink-500',
                        'from-indigo-500 to-blue-600',
                    ];
                    $g = $gradients[$loop->index % count($gradients)];
                @endphp
                <a href="{{ route('umkm.show', $umkm->id) }}
                   class="logo-card group flex flex-col items-center bg-white rounded-2xl p-5
                          border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-blue-100
                          hover:border-blue-100 text-center"
                   data-aos="zoom-in" data-aos-delay="{{ min($loop->index * 50, 350) }}">

                    {{-- Avatar --}}
                    <div class="logo-ring w-16 h-16 rounded-2xl mb-3 flex items-center justify-center
                                transition-all duration-300 flex-shrink-0 overflow-hidden
                                {{ $umkm->logo ? 'bg-gray-50' : 'bg-gradient-to-br '.$g }}">
                        @if($umkm->logo)
                            <img src="{{ asset('storage/'.$umkm->logo) }}
                                 class="w-full h-full object-cover" alt="{{ $umkm->nama_usaha }}">
                        @else
                            <span class="text-2xl font-extrabold text-white select-none">
                                {{ strtoupper(substr($umkm->nama_usaha, 0, 1)) }}
                            </span>
                        @endif
                    </div>

                    <span class="font-semibold text-xs text-gray-700 group-hover:text-blue-700
                                 transition-colors duration-200 line-clamp-2 leading-snug">
                        {{ $umkm->nama_usaha }}
                    </span>

                    @if($umkm->kategori_usaha)
                    <span class="mt-1.5 text-xs text-gray-400 font-medium">{{ $umkm->kategori_usaha }}</span>
                    @endif
                </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-16 text-gray-400">
                <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5"/>
                    </svg>
                </div>
                <p class="text-sm font-medium">Belum ada UMKM terdaftar.</p>
            </div>
            @endif
        </div>
    </section>

    {{-- Wave into orange-tinted section --}}
    <div class="wave-bottom bg-white">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full block">
            <path d="M0 0 C360 60 1080 60 1440 0 L1440 60 L0 60 Z" fill="#fff7ed"/>
        </svg>
    </div>

    {{-- ════════════════════════════════════════════════════
         KATEGORI
    ════════════════════════════════════════════════════ --}}
    <section class="py-20 bg-orange-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-16">

            <div class="text-center mb-12" data-aos="fade-up">
                <span class="text-xs font-bold uppercase tracking-widest text-orange-500 mb-2 block">Eksplorasi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                    Kategori <span class="text-orange-grad">Usaha</span>
                </h2>
                <p class="text-gray-500 mt-2 text-sm">Temukan bisnis berdasarkan sektor yang Anda minati</p>
            </div>

            @php
                $katStyles = [
                    ['icon_bg'=> 'bg-blue-100',   'icon_txt'=> 'text-blue-600',   'card_bg'=> 'bg-white hover:bg-blue-50/60',  'badge'=> 'bg-blue-100 text-blue-700'],
                    ['icon_bg'=> 'bg-orange-100', 'icon_txt'=> 'text-orange-600', 'card_bg'=> 'bg-white hover:bg-orange-50/60','badge'=> 'bg-orange-100 text-orange-700'],
                    ['icon_bg'=> 'bg-teal-100',   'icon_txt'=> 'text-teal-600',   'card_bg'=> 'bg-white hover:bg-teal-50/60',  'badge'=> 'bg-teal-100 text-teal-700'],
                    ['icon_bg'=> 'bg-violet-100', 'icon_txt'=> 'text-violet-600', 'card_bg'=> 'bg-white hover:bg-violet-50/60','badge'=> 'bg-violet-100 text-violet-700'],
                    ['icon_bg'=> 'bg-rose-100',   'icon_txt'=> 'text-rose-600',   'card_bg'=> 'bg-white hover:bg-rose-50/60',  'badge'=> 'bg-rose-100 text-rose-700'],
                    ['icon_bg'=> 'bg-amber-100',  'icon_txt'=> 'text-amber-600',  'card_bg'=> 'bg-white hover:bg-amber-50/60', 'badge'=> 'bg-amber-100 text-amber-700'],
                ];
            @endphp

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse ($kategoris as $kategori)
                @php $s = $katStyles[$loop->index % count($katStyles)]; @endphp

                <div class="kat-card {{ $s['card_bg'] }} rounded-2xl border border-gray-100 shadow-sm
                            hover:shadow-lg hover:border-gray-200 p-6 flex items-start gap-4
                            cursor-default"
                     data-aos="fade-up" data-aos-delay="{{ min($loop->index * 80, 320) }}">

                    {{-- Icon --}}
                    <div class="w-14 h-14 flex-shrink-0 rounded-2xl flex items-center justify-center
                                {{ $s['icon_bg'] }} shadow-sm {{ $s['icon_txt'] }}">
                        @if($kategori->icon)
                            <img src="{{ asset('storage/'.$kategori->icon) }}" class="w-8 h-8 object-contain">
                        @else
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3
                                         M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011
                                         1v5m-4 0h4"/>
                            </svg>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap mb-1.5">
                            <h3 class="font-bold text-gray-900 text-base">{{ $kategori->nama }}</h3>
                            @if(isset($kategori->umkms_count))
                            <span class="text-xs px-2 py-0.5 rounded-full font-semibold {{ $s['badge'] }}">
                                {{ $kategori->umkms_count }} usaha
                            </span>
                            @endif
                        </div>
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">
                            {{ $kategori->deskripsi ?? 'Kategori usaha lokal di Bontang.' }}
                        </p>
                    </div>
                </div>

                @empty
                <p class="col-span-3 text-center text-gray-400 py-12 text-sm">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Wave back to white --}}
    <div class="bg-orange-50">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full block">
            <path d="M0 60 C360 0 1080 0 1440 60 L1440 60 L0 60 Z" fill="white"/>
        </svg>
    </div>

    {{-- ════════════════════════════════════════════════════
         BLOG & ARTIKEL
    ════════════════════════════════════════════════════ --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-16">

            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-12">
                <div data-aos="fade-right">
                    <span class="text-xs font-bold uppercase tracking-widest text-teal-500 mb-2 block">Wawasan</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                        Blog & <span class="text-blue-grad">Artikel</span>
                    </h2>
                    <p class="text-gray-500 mt-2 text-sm max-w-sm">Tips dan inspirasi untuk mengembangkan usaha Anda.</p>
                </div>
                <a href="#" data-aos="fade-left"
                   class="link-anim text-sm font-semibold text-teal-600 hover:text-teal-700
                          flex items-center gap-1.5 flex-shrink-0">
                    Semua artikel
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @forelse ($blogs ?? [] as $blog)
                @php $bh = $blogHeaders[$loop->index % count($blogHeaders)]; @endphp
                <article class="group bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden
                                hover:shadow-xl hover:shadow-blue-100 hover:-translate-y-2
                                transition-all duration-300"
                         data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="blog-img-overlay h-44 bg-gradient-to-br {{ $bh['bg'] }}
                                flex items-center justify-center relative">
                        <svg class="w-14 h-14 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="absolute bottom-3 left-4 text-xs font-bold px-2.5 py-1 rounded-full {{ $bh['tag_bg'] }}">
                            {{ $bh['tag'] }}
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-base mb-2 group-hover:text-blue-700
                                   transition-colors duration-200 leading-snug line-clamp-2">
                            {{ $blog->judul }}
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3">
                            {{ \Illuminate\Support\Str::limit($blog->isi, 90) }}
                        </p>
                        <a href="#" class="link-anim inline-flex items-center gap-1 mt-4 text-orange-600
                                          text-sm font-semibold hover:text-orange-700 transition-colors">
                            Baca selengkapnya
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </article>

                @empty
                {{-- Pesan kosong - tidak ada placeholder --}}
                <div class="col-span-3 text-center py-16">
                    <div class="w-20 h-20 rounded-2xl bg-orange-50 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <p class="text-gray-400 font-medium">Artikel sedang disiapkan...</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════
         CTA BANNER
    ════════════════════════════════════════════════════ --}}
    <section class="py-20 px-6 lg:px-16">
        <div class="max-w-7xl mx-auto">
            <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-teal-600 rounded-3xl
                        overflow-hidden px-8 md:px-16 py-14 text-center shadow-2xl shadow-blue-300/40"
                 data-aos="zoom-in-up">

                {{-- Decorative blobs inside banner --}}
                <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
                <div class="absolute bottom-0 right-0 w-80 h-80 bg-orange-400/15 rounded-full translate-x-1/3 translate-y-1/3 pointer-events-none"></div>

                {{-- Dot grid overlay --}}
                <div class="absolute inset-0 opacity-[.06]"
                     style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:24px 24px;"></div>

                <div class="relative z-10">
                    <span class="inline-block bg-white/15 text-white text-xs font-bold uppercase
                                 tracking-widest px-4 py-1.5 rounded-full mb-5">
                        Bergabung Sekarang
                    </span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white leading-tight mb-4">
                        Siap Kembangkan Bisnis Anda<br class="hidden sm:block"> Bersama RuangUsaha?
                    </h2>
                    <p class="text-blue-100 text-base max-w-xl mx-auto mb-8 leading-relaxed">
                        Daftarkan UMKM Anda secara gratis dan jangkau lebih banyak pelanggan di Bontang.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        @guest
                        <a href="{{ route('login.role', 'umkm') }}"
                        class="btn-shimmer inline-flex items-center gap-2 px-8 py-3.5
                                bg-gradient-to-r from-orange-500 to-amber-400 text-white font-bold
                                rounded-2xl shadow-xl shadow-orange-900/30 hover:-translate-y-0.5
                                active:scale-95 transition-all duration-200 text-sm">
                            Daftar Gratis Sekarang →
                        </a>
                        @endguest
                        
                        @auth
                        <a href="{{ auth()->user()->umkm ? route('umkm.pilih') : route('umkm.create') }}"
                        class="btn-shimmer inline-flex items-center gap-2 px-8 py-3.5
                                bg-gradient-to-r from-orange-500 to-amber-400 text-white font-bold
                                rounded-2xl shadow-xl shadow-orange-900/30 hover:-translate-y-0.5
                                active:scale-95 transition-all duration-200 text-sm">
                            Kelola Bisnis Saya →
                        </a>
                        @endauth
                        
                        <a href="{{ route('umkm.index') }}"
                        class="inline-flex items-center gap-2 px-7 py-3.5 bg-white/10 backdrop-blur
                                text-white font-semibold rounded-2xl border border-white/25
                                hover:bg-white/20 hover:-translate-y-0.5 active:scale-95
                                transition-all duration-200 text-sm">
                            Jelajahi UMKM
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, offset: 100, duration: 650 });

        // Mobile menu toggle
        const btn  = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        if (btn && menu) btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    </script>
</body>
</html>