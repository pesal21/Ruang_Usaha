<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }

        /* Latar belakang gradien halus */
        .admin-bg {
            background-color: #f8fafc;
            background-image:
                radial-gradient(ellipse 60% 50% at 50% -10%, rgba(59,130,246,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 90% 80%, rgba(45,212,191,0.06) 0%, transparent 55%);
        }
    </style>
</head>

<body class="admin-bg text-gray-800 min-h-screen flex flex-col">

    
    <nav class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b-2 border-blue-500 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

            
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-2.5 group">
                <img src="<?php echo e(asset('Logo.png')); ?>" class="w-8 h-8 transition-transform group-hover:scale-110" alt="logo">
                <span class="text-xl font-bold bg-gradient-to-r from-blue-700 to-cyan-600 bg-clip-text text-transparent">
                    RuangUsaha
                </span>
            </a>

            
            <div class="hidden md:flex items-center space-x-1">
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    Beranda
                </a>
                <a href="<?php echo e(route('admin.umkm.data')); ?>"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          <?php echo e(request()->routeIs('admin.umkm.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    Data UMKM
                </a>
                <a href="<?php echo e(route('admin.user.index')); ?>"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          <?php echo e(request()->routeIs('admin.user.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    User Accounts
                </a>
                <a href="<?php echo e(route('admin.kategori.index')); ?>"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          <?php echo e(request()->routeIs('admin.kategori.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    Kelola Kategori
                </a>
                <a href="<?php echo e(route('admin.blog.index')); ?>"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          <?php echo e(request()->routeIs('admin.blog.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    Kelola Blog
                </a>
            </div>

            
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex items-center gap-3 focus:outline-none group">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-900 leading-tight"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-xs text-blue-600">Administrator</p>
                    </div>
                    <?php if(auth()->user()->profile_picture): ?>
                        <img src="<?php echo e(asset('storage/'.auth()->user()->profile_picture)); ?>"
                             class="w-9 h-9 rounded-full object-cover border-2 border-blue-400 group-hover:border-blue-500 transition">
                    <?php else: ?>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 text-white flex items-center justify-center font-bold shadow-sm group-hover:scale-105 transition">
                            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                        </div>
                    <?php endif; ?>
                </button>

                <div x-show="open"
                     x-cloak
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-3 w-44 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden z-50">
                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                        Pengaturan
                    </a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                                class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            
        </div>
    </nav>

    
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <footer class="bg-white/60 backdrop-blur-sm border-t border-blue-100 py-4 text-center text-xs text-gray-400">
        © <?php echo e(date('Y')); ?> RuangUsaha Admin Panel
    </footer>

</body>
</html><?php /**PATH D:\KULIAH\TUGAS KULIAH\Sem 6\Produk Perangkat Lunak\UMKM-Bontang\resources\views/admin/layout.blade.php ENDPATH**/ ?>