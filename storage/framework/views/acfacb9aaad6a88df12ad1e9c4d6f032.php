<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih UMKM – RuangUsaha</title>
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
        .umkm-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .6) 0%, transparent 50%);
            opacity: 0;
            transition: opacity .3s ease;
            pointer-events: none;
            border-radius: inherit;
        }
        .umkm-card:hover::before {
            opacity: 1;
        }

        /* ── Image zoom ── */
        .card-img-wrap {
            overflow: hidden;
        }
        .card-img-wrap img {
            transition: transform .6s cubic-bezier(.25, .46, .45, .94);
        }
        .umkm-card:hover .card-img-wrap img {
            transform: scale(1.08);
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
            transition: transform .25s cubic-bezier(.4, 0, .2, 1);
            z-index: -1;
            border-radius: inherit;
        }
        .umkm-card:hover .card-btn::before {
            transform: translateY(0);
        }
        .umkm-card:hover .card-btn {
            color: #fff;
            border-color: transparent;
        }

        /* ── Staggered card entrance ── */
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

<body class="hero-bg noise text-gray-800 antialiased min-h-screen flex flex-col">

    
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main class="relative z-10 flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-24">

        
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
    Dashboard UMKM
</div>

<h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gradient leading-tight tracking-tight">
    Pilih UMKM
</h1>
<p class="text-gray-500 mt-4 max-w-lg mx-auto text-base leading-relaxed">
    Pilih usaha yang ingin kamu kelola dan pantau perkembangannya.
</p>


<div class="mt-6 flex items-center justify-center gap-2">
    <span class="w-8 h-px bg-blue-200"></span>
    <span class="w-2 h-2 rounded-full bg-teal-400"></span>
    <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
    <span class="w-2 h-2 rounded-full bg-blue-400"></span>
    <span class="w-8 h-px bg-teal-200"></span>
</div>
</div>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
    <?php $__empty_1 = true; $__currentLoopData = $umkms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $umkm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
    $gradients = [
    'from-blue-500 to-cyan-500',
    'from-orange-500 to-amber-400',
    'from-teal-500 to-emerald-500',
    'from-violet-500 to-purple-500',
    'from-rose-500 to-pink-500',
    'from-indigo-500 to-blue-600',
    ];
    $g = $gradients[$loop->index % count($gradients)];
    ?>

    <a href="<?php echo e(route('umkm.dashboard', $umkm->id)); ?>"
    class="umkm-card card-animate group relative bg-white rounded-2xl border border-gray-100
    shadow-md shadow-blue-50 overflow-hidden hover:shadow-2xl hover:shadow-blue-200
    hover:-translate-y-2 transition-all duration-300 flex flex-col items-center p-6"
    style="animation-delay: <?php echo e($index * 0.08); ?>s">

    
    <div class="card-img-wrap w-20 h-20 mb-5 rounded-2xl flex items-center justify-center
    shadow-md group-hover:shadow-lg transition-shadow duration-300 flex-shrink-0
    <?php echo e($umkm->logo ? 'bg-gray-50' : 'bg-gradient-to-br '.$g); ?>">
    <?php if($umkm->logo): ?>
    <img src="<?php echo e(asset('storage/'.$umkm->logo)); ?>"
    class="w-full h-full object-cover"
    alt="<?php echo e($umkm->nama_usaha); ?>">
    <?php else: ?>
    <span class="text-2xl font-extrabold text-white select-none">
        <?php echo e(strtoupper(substr($umkm->nama_usaha, 0, 1))); ?>

    </span>
    <?php endif; ?>
</div>


<h3 class="font-bold text-gray-900 group-hover:text-blue-700 transition-colors duration-200
text-center text-sm md:text-base leading-snug line-clamp-2">
<?php echo e($umkm->nama_usaha); ?>

</h3>


<span class="card-btn mt-4 inline-block text-xs font-semibold text-blue-600 border-2 border-blue-200
rounded-xl px-4 py-2.5 transition-all duration-250 active:scale-95 select-none">
Kelola →
</span>
</a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<div class="col-span-full flex flex-col items-center justify-center py-24 text-center">
    <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-blue-50 to-teal-50 border
    border-blue-100 flex items-center justify-center mb-6 shadow-sm">
    <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
    </svg>
</div>
<h3 class="text-gray-700 font-bold text-xl mb-2">Belum ada UMKM</h3>
<p class="text-gray-400 text-sm max-w-xs leading-relaxed">
    Kamu belum mendaftarkan usaha.
    <a href="<?php echo e(route('umkm.create')); ?>" class="text-blue-600 font-semibold hover:underline">
        Daftarkan sekarang
    </a>
</p>
</div>
<?php endif; ?>
</div>

</main>


<?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>
</html><?php /**PATH D:\KULIAH\TUGAS KULIAH\Sem 6\Produk Perangkat Lunak\UMKM-Bontang\resources\views/umkm/pilih.blade.php ENDPATH**/ ?>