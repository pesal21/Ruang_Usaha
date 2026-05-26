<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?php echo e($blog->judul); ?> – RuangUsaha</title>
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
        .article-card {
            position: relative;
        }

        .article-card::before {
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

        .article-card:hover::before {
            opacity: 1;
        }

        /* ── Image zoom on hover ── */
        .article-img-wrap {
            overflow: hidden;
        }

        .article-img-wrap img {
            transition: transform .6s cubic-bezier(.25, .46, .45, .94);
        }

        .article-card:hover .article-img-wrap img {
            transform: scale(1.03);
        }

        /* ── Content styling ── */
        .article-content {
            line-height: 1.85;
            color: #4b5563;
        }

        .article-content p {
            margin-bottom: 1.25rem;
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
    </style>
</head>

<body class="hero-bg noise text-gray-800 antialiased min-h-screen">

    
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-24">

        
        <div class="mb-8">
            <a href="<?php echo e(route('blog.index')); ?>"
                class="back-link text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Blog
            </a>
        </div>

        
        <article class="article-card card-animate bg-white rounded-3xl border border-gray-100
                       shadow-md shadow-blue-50 overflow-hidden
                       hover:shadow-2xl hover:shadow-blue-100 transition-all duration-300">

            
            <?php if($blog->gambar): ?>
            <div class="article-img-wrap relative w-full h-56 sm:h-72 md:h-80 bg-gradient-to-br from-blue-50 via-sky-50 to-teal-50
                        flex items-center justify-center flex-shrink-0">
                <img src="<?php echo e(asset('storage/'.$blog->gambar)); ?>"
                    alt="<?php echo e($blog->judul); ?>"
                    class="w-full h-full object-cover">
            </div>
            <?php endif; ?>

            
            <div class="p-6 sm:p-8 md:p-10">

                
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    
                    <?php if($blog->kategori): ?>
                    <span class="inline-flex items-center gap-1.5 bg-blue-50 border border-blue-100 text-blue-600
                                 px-3 py-1.5 rounded-full text-xs font-semibold shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <?php echo e($blog->kategori); ?>

                    </span>
                    <?php endif; ?>

                    
                    <span class="inline-flex items-center gap-1.5 bg-gray-50 border border-gray-100 text-gray-500
                                 px-3 py-1.5 rounded-full text-xs font-medium shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <?php echo e(\Carbon\Carbon::parse($blog->created_at)->translatedFormat('d F Y')); ?>

                    </span>
                </div>

                
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gradient leading-tight tracking-tight mb-2">
                    <?php echo e($blog->judul); ?>

                </h1>

                
                <div class="flex items-center gap-2 mb-8 mt-4">
                    <span class="w-8 h-px bg-blue-200"></span>
                    <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                    <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                    <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                    <span class="w-8 h-px bg-teal-200"></span>
                </div>

                
                <div class="article-content text-gray-700 text-sm sm:text-base leading-relaxed text-justify space-y-5 whitespace-pre-line">
                    <?php echo e($blog->isi); ?>

                </div>

                
                <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs text-gray-400 flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Dipublikasikan <?php echo e(\Carbon\Carbon::parse($blog->created_at)->diffForHumans()); ?>

                    </span>

                    <a href="<?php echo e(route('blog.index')); ?>"
                        class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600
                               hover:text-blue-700 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Blog
                    </a>
                </div>

            </div>
        </article>

    </main>

    
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>

</html><?php /**PATH D:\KULIAH\TUGAS KULIAH\Sem 6\Produk Perangkat Lunak\UMKM-Bontang\resources\views/blog/show.blade.php ENDPATH**/ ?>