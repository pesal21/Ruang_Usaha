
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    [x-cloak] { display: none !important; }

    /* ── Animated underline for nav links ── */
    .nav-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(to right, #3b82f6, #0d9488);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 1px;
    }
    .nav-link:hover::after {
        transform: scaleX(1);
    }

    /* ── Active nav link style ── */
    .nav-link-active {
        color: #2563eb;
        font-weight: 600;
    }
    .nav-link-active::after {
        transform: scaleX(1);
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .2), transparent);
        transition: left 0.5s ease;
    }
    .btn-shimmer:hover::after {
        left: 150%;
    }

    /* ── Dropdown item hover ── */
    .dropdown-item {
        transition: all 0.2s ease;
    }
    .dropdown-item:hover {
        padding-left: 1.25rem;
    }
</style>

<nav x-data="{ mobileOpen: false }" class="fixed top-0 w-full bg-white/90 backdrop-blur-lg z-50 shadow-sm border-b border-blue-100/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            
            <div class="flex-shrink-0 flex items-center gap-2">
                <a href="<?php echo e(route('beranda')); ?>" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center shadow-sm group-hover:shadow-md group-hover:scale-105 transition-all duration-200">
                        <img src="<?php echo e(asset('Logo.png')); ?>" class="w-5 h-5" alt="logo">
                    </div>
                    <span class="text-xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500">
                        RuangUsaha
                    </span>
                </a>
            </div>

            
            <div class="hidden md:flex items-center space-x-1">
                <a href="<?php echo e(route('beranda')); ?>"
                   class="nav-link px-3 py-2 text-sm <?php echo e(request()->routeIs('beranda') ? 'nav-link-active' : 'text-gray-600 hover:text-blue-600'); ?> transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Beranda
                </a>
                <a href="<?php echo e(route('umkm.index')); ?>"
                   class="nav-link px-3 py-2 text-sm <?php echo e(request()->routeIs('umkm.index') ? 'nav-link-active' : 'text-gray-600 hover:text-blue-600'); ?> transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Daftar UMKM
                </a>
                <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('umkm.pilih')); ?>"
                   class="nav-link px-3 py-2 text-sm <?php echo e(request()->routeIs('umkm.pilih') ? 'nav-link-active' : 'text-gray-600 hover:text-blue-600'); ?> transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Pilih UMKM
                </a>
                <?php endif; ?>
                <a href="<?php echo e(route('blog.index')); ?>"
                   class="nav-link px-3 py-2 text-sm <?php echo e(request()->routeIs('blog.index') ? 'nav-link-active' : 'text-gray-600 hover:text-blue-600'); ?> transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Blog
                </a>
            </div>

            
            <div class="hidden md:flex items-center space-x-3">
                <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" 
                   class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors duration-200 px-4 py-2 rounded-xl border-2 border-gray-200 hover:border-blue-300 hover:bg-blue-50/50">
                    Login
                </a>
                <a href="<?php echo e(route('register')); ?>" 
                   class="btn-shimmer bg-gradient-to-r from-blue-600 to-teal-500 text-white font-semibold text-sm px-5 py-2.5 rounded-xl shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300 hover:-translate-y-0.5 active:scale-95 transition-all duration-200">
                    Daftar Gratis
                </a>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="flex items-center gap-3 focus:outline-none group px-2 py-1.5 rounded-xl hover:bg-blue-50/50 transition-colors duration-200">
                        <div class="text-right hidden lg:block">
                            <p class="text-sm font-semibold text-gray-900 leading-tight"><?php echo e(auth()->user()->name); ?></p>
                            <p class="text-xs text-blue-500 font-medium">Pelaku UMKM</p>
                        </div>
                        <?php if(auth()->user()->profile_picture): ?>
                        <img src="<?php echo e(asset('storage/'.auth()->user()->profile_picture)); ?>" 
                             alt="Profile"
                             class="w-9 h-9 rounded-full object-cover border-2 border-blue-200 group-hover:border-blue-400 transition-all duration-200 shadow-sm">
                        <?php else: ?>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-teal-500 text-white flex items-center justify-center font-bold shadow-sm group-hover:shadow-md group-hover:scale-105 transition-all duration-200">
                            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                        </div>
                        <?php endif; ?>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-500 transition-colors duration-200" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="open" 
                         @click.away="open = false" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                         class="absolute right-0 mt-3 w-56 bg-white border border-gray-100 rounded-2xl shadow-xl shadow-blue-100 overflow-hidden z-50">
                        
                        
                        <div class="px-4 py-3 border-b border-gray-50 bg-gradient-to-r from-blue-50 to-teal-50">
                            <p class="text-sm font-semibold text-gray-900"><?php echo e(auth()->user()->name); ?></p>
                            <p class="text-xs text-gray-500 mt-0.5"><?php echo e(auth()->user()->email); ?></p>
                        </div>
                        
                        <div class="py-1.5">
                            <a href="<?php echo e(route('profile.index')); ?>" 
                               class="dropdown-item flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50/60 transition-all duration-200">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profil Akun
                            </a>
                            
                            <?php if(auth()->user()->umkm): ?>
                            <a href="<?php echo e(route('umkm.dashboard', auth()->user()->umkm->id)); ?>" 
                               class="dropdown-item flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50/60 transition-all duration-200">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                </svg>
                                Dashboard UMKM
                            </a>
                            <?php else: ?>
                            <a href="<?php echo e(route('umkm.create')); ?>" 
                               class="dropdown-item flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50/60 transition-all duration-200">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                                Daftarkan UMKM
                            </a>
                            <?php endif; ?>
                        </div>
                        
                        <div class="border-t border-gray-50 py-1.5">
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" 
                                        class="dropdown-item w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:text-red-600 hover:bg-red-50/60 transition-all duration-200">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            
            <div class="md:hidden flex items-center">
                <button @click="mobileOpen = !mobileOpen" 
                        class="text-gray-600 hover:text-blue-600 focus:outline-none p-2 rounded-xl hover:bg-blue-50 transition-colors duration-200">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    
    <div x-show="mobileOpen" 
         @click.away="mobileOpen = false" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-3"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-3"
         class="md:hidden bg-white/95 backdrop-blur-lg border-t border-blue-100 shadow-xl">
        
        <div class="px-4 py-3 space-y-1">
            <a href="<?php echo e(route('beranda')); ?>" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm <?php echo e(request()->routeIs('beranda') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-600 hover:bg-blue-50/60 hover:text-blue-600'); ?> transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Beranda
            </a>
            <a href="<?php echo e(route('umkm.index')); ?>" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm <?php echo e(request()->routeIs('umkm.index') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-600 hover:bg-blue-50/60 hover:text-blue-600'); ?> transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Daftar UMKM
            </a>
            <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('umkm.pilih')); ?>" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm <?php echo e(request()->routeIs('umkm.pilih') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-600 hover:bg-blue-50/60 hover:text-blue-600'); ?> transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Pilih UMKM
            </a>
            <?php endif; ?>
            <a href="<?php echo e(route('blog.index')); ?>" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm <?php echo e(request()->routeIs('blog.index') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-600 hover:bg-blue-50/60 hover:text-blue-600'); ?> transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Blog
            </a>
        </div>
        
        <?php if(auth()->guard()->guest()): ?>
        <div class="px-4 py-3 space-y-2 border-t border-blue-100">
            <a href="<?php echo e(route('login')); ?>" 
               class="flex items-center justify-center gap-2 w-full px-4 py-2.5 border-2 border-blue-200 rounded-xl text-blue-600 font-medium text-sm hover:bg-blue-50 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Login
            </a>
            <a href="<?php echo e(route('register')); ?>" 
               class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-gradient-to-r from-blue-600 to-teal-500 text-white font-semibold text-sm rounded-xl shadow-md shadow-blue-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Daftar Gratis
            </a>
        </div>
        <?php endif; ?>
        
        <?php if(auth()->guard()->check()): ?>
        <div class="px-4 py-3 border-t border-blue-100 space-y-1">
            <div class="flex items-center gap-3 px-4 py-2">
                <?php if(auth()->user()->profile_picture): ?>
                <img src="<?php echo e(asset('storage/'.auth()->user()->profile_picture)); ?>" 
                     alt="Profile"
                     class="w-10 h-10 rounded-full object-cover border-2 border-blue-200 shadow-sm">
                <?php else: ?>
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-teal-500 text-white flex items-center justify-center font-bold shadow-sm">
                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                </div>
                <?php endif; ?>
                <div>
                    <p class="text-sm font-semibold text-gray-900"><?php echo e(auth()->user()->name); ?></p>
                    <p class="text-xs text-gray-500"><?php echo e(auth()->user()->email); ?></p>
                </div>
            </div>
            <a href="<?php echo e(route('profile.index')); ?>" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-blue-50/60 hover:text-blue-600 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profil Akun
            </a>
            <?php if(auth()->user()->umkm): ?>
            <a href="<?php echo e(route('umkm.dashboard', auth()->user()->umkm->id)); ?>" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-blue-50/60 hover:text-blue-600 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Dashboard UMKM
            </a>
            <?php else: ?>
            <a href="<?php echo e(route('umkm.create')); ?>" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-blue-50/60 hover:text-blue-600 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Daftarkan UMKM
            </a>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-1">
                <?php echo csrf_field(); ?>
                <button class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl text-sm text-red-500 hover:bg-red-50/60 hover:text-red-600 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</nav><?php /**PATH D:\KULIAH\TUGAS KULIAH\Sem 6\Produk Perangkat Lunak\UMKM-Bontang\resources\views/partials/navbar.blade.php ENDPATH**/ ?>