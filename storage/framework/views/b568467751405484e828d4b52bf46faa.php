<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar UMKM Bontang</title>
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

        /* ── Badge pulse dot ── */
        .badge-count {
            animation: none;
        }

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

        /* ── Skeleton pulse (optional fallback) ── */
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.5} }

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

    
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-24">

        
        <div class="mb-8">
            <a href="<?php echo e(route('beranda')); ?>"
               class="back-link text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        
        <div class="text-center mb-12">
            
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Direktori UMKM Kota Bontang
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gradient leading-tight tracking-tight">
                Daftar UMKM Bontang
            </h1>
            <p class="text-gray-500 mt-4 max-w-lg mx-auto text-base leading-relaxed">
                Jelajahi dan temukan berbagai usaha lokal unggulan yang ada di Kota Bontang.
            </p>

            
            <div class="mt-6 flex items-center justify-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        
        <form method="GET" class="max-w-2xl mx-auto relative mb-10 group">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 transition-colors duration-200 group-focus-within:text-blue-500 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
            </span>
            <input
                type="text"
                name="search"
                value="<?php echo e(request('search')); ?>"
                placeholder="Cari nama, kategori, atau lokasi UMKM…"
                class="search-input w-full pl-12 pr-14 py-4 border-2 border-blue-100 rounded-2xl
                       bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                       text-sm transition-all duration-300 placeholder:text-gray-400
                       shadow-sm text-gray-700 font-medium">
            <button type="submit"
                    class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-gradient-to-br from-blue-500
                           to-teal-500 text-white rounded-xl p-2.5 hover:from-blue-600 hover:to-teal-600
                           hover:shadow-lg hover:shadow-blue-200 active:scale-95 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
            </button>
        </form>

        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8
                    bg-white/60 backdrop-blur-sm border border-white/80 rounded-2xl px-5 py-4 shadow-sm">

            
            <div class="flex items-center gap-3 flex-wrap">
                <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('umkm.create')); ?>"
                   class="btn-primary inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r
                          from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-xl
                          shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300
                          hover:-translate-y-0.5 active:scale-95 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah UMKM
                </a>
                <?php endif; ?>

                <div class="flex items-center gap-2 text-sm text-gray-600 font-medium bg-blue-50
                            border border-blue-100 px-3.5 py-2.5 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-500" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2
                                 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0
                                 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <span class="text-blue-700 font-bold"><?php echo e($umkms->total()); ?></span>
                    <span class="text-gray-500">UMKM Terdaftar</span>
                </div>
            </div>

            
            <form method="GET" class="flex items-center gap-2.5 flex-wrap">
                <input type="hidden" name="search" value="<?php echo e(request('search')); ?>">

                <select name="kategori"
                        class="border-2 border-blue-100 bg-white text-gray-700 px-4 py-2.5
                               rounded-xl text-sm shadow-sm focus:outline-none focus:border-blue-400
                               focus:ring-4 focus:ring-blue-100 cursor-pointer transition-all duration-200
                               hover:border-blue-300 font-medium">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k->id); ?>" <?php echo e(request('kategori') == $k->id ? 'selected' : ''); ?>>
                        <?php echo e($k->nama); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <select name="sort"
                        class="border-2 border-blue-100 bg-white text-gray-700 px-4 py-2.5
                               rounded-xl text-sm shadow-sm focus:outline-none focus:border-blue-400
                               focus:ring-4 focus:ring-blue-100 cursor-pointer transition-all duration-200
                               hover:border-blue-300 font-medium">
                    <option value="terbaru" <?php echo e(request('sort','terbaru')=='terbaru' ? 'selected' : ''); ?>>Terbaru</option>
                    <option value="terlama" <?php echo e(request('sort')=='terlama'  ? 'selected' : ''); ?>>Terlama</option>
                    <option value="nama_asc" <?php echo e(request('sort')=='nama_asc' ? 'selected' : ''); ?>>Nama: A–Z</option>
                    <option value="nama_desc"<?php echo e(request('sort')=='nama_desc'? 'selected' : ''); ?>>Nama: Z–A</option>
                </select>

                <button type="submit"
                        class="btn-primary inline-flex items-center gap-1.5 px-5 py-2.5
                               bg-gradient-to-r from-blue-600 to-teal-500 text-white text-sm
                               font-semibold rounded-xl shadow-md shadow-blue-100
                               hover:shadow-lg hover:-translate-y-0.5 active:scale-95
                               transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1
                                 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0
                                 013 6V4z"/>
                    </svg>
                    Filter
                </button>
            </form>
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            <?php $__empty_1 = true; $__currentLoopData = $umkms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('umkm.show', $u->id)); ?>"
               class="umkm-card card-animate group relative bg-white rounded-2xl border border-gray-100
                      shadow-md shadow-blue-50 overflow-hidden hover:shadow-2xl hover:shadow-blue-200
                      hover:-translate-y-2 transition-all duration-300 flex flex-col">

                
                <div class="card-img-wrap relative h-44 bg-gradient-to-br from-blue-50 via-sky-50 to-teal-50
                            flex items-center justify-center flex-shrink-0">
                    <?php if($u->logo): ?>
                        <img src="<?php echo e(asset('storage/'.$u->logo)); ?>"
                             class="w-full h-full object-cover"
                             alt="<?php echo e($u->nama_usaha); ?>">
                    <?php else: ?>
                        
                        <div class="flex flex-col items-center gap-2 select-none">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-teal-100
                                        flex items-center justify-center shadow-sm">
                                <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5
                                             21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1
                                             1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-400 font-medium">Belum ada foto</span>
                        </div>
                    <?php endif; ?>

                    
                    <span class="absolute top-3 left-3 text-xs bg-white/90 backdrop-blur-sm
                                 text-blue-700 border border-blue-100 px-2.5 py-1 rounded-full
                                 font-semibold shadow-sm">
                        <?php echo e($u->kategori_usaha ?? 'Umum'); ?>

                    </span>

                    <?php if($u->jenis_umkm): ?>
                    <span class="absolute top-3 right-3 text-xs px-2.5 py-1 rounded-full font-semibold shadow-sm
                        <?php echo e($u->jenis_umkm === 'Toko Fisik'
                            ? 'bg-emerald-500/90 text-white'
                            : 'bg-violet-500/90 text-white'); ?>">
                        <?php echo e($u->jenis_umkm); ?>

                    </span>
                    <?php endif; ?>
                </div>

                
                <div class="p-5 flex flex-col flex-1 gap-3">

                    <h3 class="font-bold text-gray-900 group-hover:text-blue-700 transition-colors
                               duration-200 line-clamp-2 text-base leading-snug">
                        <?php echo e($u->nama_usaha); ?>

                    </h3>

                    <p class="text-xs text-gray-500 flex items-start gap-1.5 leading-relaxed">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-blue-400
                             flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8
                                     8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="line-clamp-2"><?php echo e($u->alamat_lengkap ?? 'Lokasi tidak tersedia'); ?></span>
                    </p>

                    
                    <div class="mt-auto pt-2">
                        <span class="card-btn block w-full text-center text-sm border-2 border-blue-200
                                     text-blue-700 rounded-xl py-2.5 font-semibold transition-all
                                     duration-250 active:scale-95 select-none">
                            Lihat Detail →
                        </span>
                    </div>
                </div>
            </a>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            
            <div class="col-span-full flex flex-col items-center justify-center py-24 text-center">
                <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-blue-50 to-teal-50 border
                            border-blue-100 flex items-center justify-center mb-6 shadow-sm">
                    <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2
                                 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0
                                 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0
                                 006.586 13H4"/>
                    </svg>
                </div>
                <h3 class="text-gray-700 font-bold text-xl mb-2">Belum ada UMKM ditemukan</h3>
                <p class="text-gray-400 text-sm max-w-xs leading-relaxed">
                    Coba kata kunci lain atau
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('umkm.create')); ?>"
                           class="text-blue-600 font-semibold hover:underline">
                            daftarkan usahamu
                        </a>
                        sekarang.
                    <?php else: ?>
                        ubah filter pencarian Anda.
                    <?php endif; ?>
                </p>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="mt-10 flex justify-center">
            <?php echo e($umkms->withQueryString()->links('pagination::tailwind')); ?>

        </div>

    </main>

    
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>
</html><?php /**PATH D:\KULIAH\TUGAS KULIAH\Sem 6\Produk Perangkat Lunak\UMKM-Bontang\resources\views/umkm/index.blade.php ENDPATH**/ ?>