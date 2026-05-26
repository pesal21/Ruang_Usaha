<?php $__env->startSection('content'); ?>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative">
    
    <div class="absolute -top-16 -left-16 w-48 h-48 bg-blue-200/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-200/20 rounded-full blur-3xl pointer-events-none"></div>

    
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8 relative">
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                User Account Management
            </h1>
            <p class="text-gray-500 mt-1.5 text-base">Manage all registered users.</p>
        </div>
        <a href="<?php echo e(route('admin.dashboard')); ?>"
           class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-indigo-600 transition-colors duration-200 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="relative">
                Back to Admin Dashboard
                <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-current transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
    </div>

    
    <form method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-6 bg-white/90 backdrop-blur-sm rounded-2xl p-4 shadow-md border border-blue-50">
        
        <div class="relative flex-1 w-full sm:w-auto group">
            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 transition-colors group-focus-within:text-blue-500">
                <img src="<?php echo e(asset('assets/img/icon_umkm/search.png')); ?>" alt="Search" class="w-4 h-4">
            </span>
            <input
                type="text"
                name="search"
                value="<?php echo e(request('search')); ?>"
                placeholder="Search by name, email..."
                class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm
                       focus:outline-none focus:border-blue-400 focus:shadow-[0_0_0_4px_rgba(59,130,246,0.15)]
                       hover:border-blue-300 transition-all duration-200 bg-white placeholder:text-gray-400">
        </div>

        
        <select name="role"
            onchange="this.form.submit()"
            class="px-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm bg-white
                   focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100
                   hover:border-blue-300 text-gray-600 cursor-pointer transition-all duration-200">
            <option value="">User Role: All</option>
            <option value="admin" <?php if(request('role')=='admin'): echo 'selected'; endif; ?>>Admin</option>
            <option value="business_owner" <?php if(request('role')=='umkm'): echo 'selected'; endif; ?>>Business Owner</option>
        </select>

        
        <select name="status"
            onchange="this.form.submit()"
            class="px-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm bg-white
                   focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100
                   hover:border-blue-300 text-gray-600 cursor-pointer transition-all duration-200">
            <option value="">Status: All</option>
            <option value="active" <?php if(request('status')=='active'): echo 'selected'; endif; ?>>Active</option>
            <option value="suspended" <?php if(request('status')=='suspended'): echo 'selected'; endif; ?>>Suspended</option>
        </select>

        <button type="submit" class="sr-only">Search</button>
    </form>

    
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 uppercase text-xs tracking-wider border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                        <th class="px-6 py-3.5 text-left font-semibold">User</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Email</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Role</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Date Joined</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Status</th>
                        <th class="px-6 py-3.5 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-t border-gray-50 hover:bg-blue-50/30 transition-colors duration-200">
                        
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 overflow-hidden flex-shrink-0
                                            flex items-center justify-center text-blue-600 font-bold text-sm shadow-sm ring-2 ring-white">
                                    <?php if($user->profile_picture): ?>
                                    <img src="<?php echo e(asset('storage/' . $user->profile_picture)); ?>"
                                        alt="<?php echo e($user->name); ?>"
                                        class="w-full h-full object-cover rounded-full">
                                    <?php else: ?>
                                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                    <?php endif; ?>
                                </div>
                                <span class="font-medium text-gray-800"><?php echo e($user->name); ?></span>
                            </div>
                        </td>

                        
                        <td class="px-6 py-4 text-gray-500"><?php echo e($user->email); ?></td>

                        
                        <td class="px-6 py-4 text-gray-600">
                            <?php echo e($user->role === 'admin' ? 'Admin' : 'Business Owner'); ?>

                        </td>

                        
                        <td class="px-6 py-4 text-gray-500">
                            <?php echo e(\Carbon\Carbon::parse($user->created_at)->format('d M Y')); ?>

                        </td>

                        
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold ring-1 ring-inset
                                <?php if($user->status === 'active'): ?> bg-green-50 text-green-700 ring-green-600/20
                                <?php else: ?> bg-orange-50 text-orange-700 ring-orange-600/20 <?php endif; ?>">
                                <?php echo e(ucfirst($user->status)); ?>

                            </span>
                        </td>

                        
                        <td class="px-6 py-4 text-right relative" x-data="{ open: false }">
                            <button
                                @click="open = !open"
                                class="w-9 h-9 inline-flex items-center justify-center rounded-full
                                       hover:bg-blue-100 active:scale-95 transition-all duration-200
                                       text-gray-500 font-bold text-lg leading-none focus:outline-none focus:ring-2 focus:ring-blue-300"
                                title="Actions">
                                •••
                            </button>

                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                x-cloak
                                @click.away="open = false"
                                class="absolute right-0 right-12 mb-1 w-48
                                       bg-white border border-gray-100 rounded-xl shadow-xl z-50 overflow-hidden py-1">

                                <a href="<?php echo e(route('admin.user.show', $user->id)); ?>"
                                   class="block w-full text-left px-4 py-2.5 text-sm text-gray-700
                                          hover:bg-blue-50 transition-colors duration-150">
                                    <img src="<?php echo e(asset('assets/img/icon_umkm/eye.svg')); ?>" alt="" class="w-4 h-4 inline mr-2">
                                    View Details
                                </a>

                                <?php if($user->status === 'active'): ?>
                                <form action="<?php echo e(route('admin.user.suspend', $user->id)); ?>" method="POST"
                                    onsubmit="return confirm('Yakin ingin mensuspend user ini?') && handleSubmit(this)">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2.5 text-sm text-red-600
                                               hover:bg-red-50 transition-colors duration-150
                                               disabled:opacity-60 disabled:cursor-not-allowed">
                                        <img src="<?php echo e(asset('assets/img/icon_umkm/suspend.svg')); ?>" alt="" class="w-4 h-4 inline mr-2">
                                        Suspend User
                                    </button>
                                </form>
                                <?php else: ?>
                                <form action="<?php echo e(route('admin.user.activate', $user->id)); ?>" method="POST"
                                    onsubmit="return confirm('Aktifkan kembali user ini?') && handleSubmit(this)">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2.5 text-sm text-green-600
                                               hover:bg-green-50 transition-colors duration-150
                                               disabled:opacity-60 disabled:cursor-not-allowed">
                                        ✅ Activate User
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <span class="text-gray-500 font-medium text-base">Tidak ada user ditemukan.</span>
                                <p class="text-gray-400 text-sm mt-1">Coba ubah filter atau kata kunci pencarian.</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
        <p class="text-sm text-gray-500">
            Showing
            <span class="font-semibold text-gray-700"><?php echo e($users->firstItem() ?? 0); ?></span>
            to
            <span class="font-semibold text-gray-700"><?php echo e($users->lastItem() ?? 0); ?></span>
            of
            <span class="font-semibold text-gray-700"><?php echo e($users->total()); ?></span>
            results
        </p>
        <div>
            <?php echo e($users->appends(request()->query())->links()); ?>

        </div>
    </div>
</div>

<script>
    function handleSubmit(form) {
        const buttons = form.querySelectorAll('button[type="submit"]');
        buttons.forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = 'Processing...';
        });
        return true;
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\TUGAS KULIAH\Sem 6\Produk Perangkat Lunak\UMKM-Bontang\resources\views/admin/users/index.blade.php ENDPATH**/ ?>