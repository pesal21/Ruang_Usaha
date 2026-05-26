
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    [x-cloak] { display: none !important; }
</style>

<nav x-data="{ mobileOpen: false }" class="fixed top-0 w-full bg-white/95 backdrop-blur-md border-b-2 border-blue-500 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <div class="flex-shrink-0 flex items-center gap-2">
                <a href="<?php echo e(route('beranda')); ?>" class="flex items-center gap-2 group">
                    <img src="<?php echo e(asset('Logo.png')); ?>" class="w-8 h-8" alt="logo">
                    <span class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500">
                        RuangUsaha
                    </span>
                </a>
            </div>

            
            <div class="hidden md:flex items-center space-x-8">
                <a href="<?php echo e(route('beranda')); ?>"
                   class="<?php echo e(request()->routeIs('beranda') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600'); ?> relative text-sm transition">
                    Beranda
                </a>
                <a href="<?php echo e(route('umkm.index')); ?>"
                   class="<?php echo e(request()->routeIs('umkm.index') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600'); ?> relative text-sm transition">
                    Daftar UMKM
                </a>
                <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('umkm.pilih')); ?>"
                   class="<?php echo e(request()->routeIs('umkm.pilih') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600'); ?> relative text-sm transition">
                    Pilih UMKM
                </a>
                <?php endif; ?>
                <a href="<?php echo e(route('blog.index')); ?>"
                   class="<?php echo e(request()->routeIs('blog.index') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600'); ?> relative text-sm transition">
                    Blog
                </a>
            </div>

            
            <div class="hidden md:flex items-center space-x-4">
                <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="text-gray-700 hover:text-blue-600 font-medium text-sm transition px-4 py-2 rounded-lg border-2 border-blue-300 hover:border-blue-500 hover:bg-blue-50">
                    Login
                </a>
                <a href="<?php echo e(route('register')); ?>" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white font-semibold text-sm px-5 py-2 rounded-lg shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300 hover:scale-105 active:scale-95 transition-all">
                    Sign Up
                </a>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                        <div class="text-right hidden lg:block">
                            <p class="text-sm font-semibold text-gray-900 leading-tight"><?php echo e(auth()->user()->name); ?></p>
                            <p class="text-xs text-blue-600">Pelaku UMKM</p>
                        </div>
                        <?php if(auth()->user()->profile_picture): ?>
                        <img src="<?php echo e(asset('storage/'.auth()->user()->profile_picture)); ?>" alt="Profile"
                             class="w-9 h-9 rounded-full object-cover border-2 border-blue-400 group-hover:border-blue-500 transition">
                        <?php else: ?>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-teal-500 text-white flex items-center justify-center font-bold shadow-sm group-hover:scale-105 transition">
                            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                        </div>
                        <?php endif; ?>
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-3 w-48 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden z-50">
                        <a href="<?php echo e(route('profile.index')); ?>" class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Profil Akun</a>
                        <?php if(auth()->user()->umkm): ?>
                        <a href="<?php echo e(route('umkm.dashboard', auth()->user()->umkm->id)); ?>" class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Dashboard UMKM</a>
                        <?php else: ?>
                        <a href="<?php echo e(route('umkm.create')); ?>" class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Daftarkan UMKM</a>
                        <?php endif; ?>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            
            <div class="md:hidden flex items-center">
                <button @click="mobileOpen = !mobileOpen" class="text-gray-700 hover:text-blue-600 focus:outline-none p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    
    <div x-show="mobileOpen" @click.away="mobileOpen = false" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-white border-t border-blue-200 shadow-lg">
        <a href="<?php echo e(route('beranda')); ?>" class="block px-4 py-3 <?php echo e(request()->routeIs('beranda') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600'); ?>">Beranda</a>
        <a href="<?php echo e(route('umkm.index')); ?>" class="block px-4 py-3 <?php echo e(request()->routeIs('umkm.index') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600'); ?>">Daftar UMKM</a>
        <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('umkm.pilih')); ?>" class="block px-4 py-3 <?php echo e(request()->routeIs('umkm.pilih') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600'); ?>">Pilih UMKM</a>
        <?php endif; ?>
        <a href="<?php echo e(route('blog.index')); ?>" class="block px-4 py-3 <?php echo e(request()->routeIs('blog.index') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600'); ?>">Blog</a>
        <?php if(auth()->guard()->guest()): ?>
        <div class="px-4 py-3 space-y-2 border-t border-blue-100">
            <a href="<?php echo e(route('login')); ?>" class="block w-full text-center px-4 py-2 border-2 border-blue-300 rounded-lg text-blue-700 font-medium hover:bg-blue-50">Login</a>
            <a href="<?php echo e(route('register')); ?>" class="block w-full text-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-semibold rounded-lg">Sign Up</a>
        </div>
        <?php endif; ?>
        <?php if(auth()->guard()->check()): ?>
        <div class="px-4 py-3 border-t border-blue-100">
            <p class="text-sm font-semibold text-gray-900"><?php echo e(auth()->user()->name); ?></p>
            <a href="<?php echo e(route('profile.index')); ?>" class="block text-sm text-gray-600 hover:text-blue-600 mt-1">Profil Akun</a>
            <?php if(auth()->user()->umkm): ?>
            <a href="<?php echo e(route('umkm.dashboard', auth()->user()->umkm->id)); ?>" class="block text-sm text-gray-600 hover:text-blue-600">Dashboard</a>
            <?php else: ?>
            <a href="<?php echo e(route('umkm.create')); ?>" class="block text-sm text-gray-600 hover:text-blue-600">Daftarkan UMKM</a>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-2">
                <?php echo csrf_field(); ?>
                <button class="w-full text-left text-sm text-red-600">Logout</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</nav><?php /**PATH D:\KULIAH\TUGAS KULIAH\Sem 6\Produk Perangkat Lunak\UMKM-Bontang\resources\views/partials/navbar.blade.php ENDPATH**/ ?>