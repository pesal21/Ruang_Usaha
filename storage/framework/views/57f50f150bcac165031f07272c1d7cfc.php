<?php $__env->startSection('content'); ?>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative">
    
    <div class="absolute -top-16 -left-16 w-48 h-48 bg-purple-200/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-cyan-200/20 rounded-full blur-3xl pointer-events-none"></div>

    
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8 relative">
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-blue-700 via-purple-600 to-cyan-600 bg-clip-text text-transparent">
                Kelola Kategori
            </h1>
            <p class="text-gray-500 mt-1.5 text-base">Tambah dan kelola kategori UMKM.</p>
        </div>
        <a href="<?php echo e(route('admin.dashboard')); ?>"
           class="inline-flex items-center gap-2 text-sm font-medium text-purple-600 hover:text-purple-700 transition-colors duration-200 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="relative">
                Kembali ke Dashboard
                <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-current transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
    </div>

    
    <div class="flex items-center gap-2 mb-8">
        <span class="w-10 h-1 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full"></span>
        <span class="w-3 h-3 bg-pink-400 rounded-full"></span>
        <span class="w-16 h-1 bg-gradient-to-r from-purple-400 to-cyan-400 rounded-full"></span>
        <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
        <span class="w-10 h-1 bg-gradient-to-r from-cyan-400 to-blue-400 rounded-full"></span>
    </div>

    
    <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-md border border-purple-50 hover:shadow-lg transition-shadow duration-300 p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-5 flex items-center gap-2">
            <span class="w-1.5 h-6 bg-gradient-to-b from-purple-500 to-pink-500 rounded-full"></span>
            Tambah Kategori Baru
        </h2>

        <form action="<?php echo e(route('admin.kategori.store')); ?>" method="POST" enctype="multipart/form-data"
            onsubmit="return handleSubmit(this)">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5 block">
                        Nama Kategori
                    </label>
                    <input
                        type="text"
                        name="nama_kategori"
                        placeholder="Contoh: Kuliner & Makanan"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm
                               focus:outline-none focus:border-purple-400 focus:shadow-[0_0_0_4px_rgba(168,85,247,0.15)]
                               hover:border-purple-300 transition-all duration-200 bg-white placeholder:text-gray-400">
                </div>

                
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5 block">
                        Deskripsi
                    </label>
                    <input
                        type="text"
                        name="deskripsi"
                        placeholder="Contoh: Berbagai usaha kuliner lokal."
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm
                               focus:outline-none focus:border-purple-400 focus:shadow-[0_0_0_4px_rgba(168,85,247,0.15)]
                               hover:border-purple-300 transition-all duration-200 bg-white placeholder:text-gray-400">
                </div>

                
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5 block">
                        Icon / Gambar
                    </label>
                    <input
                        type="file"
                        name="icon"
                        accept=".png,.jpg,.jpeg,.svg"
                        class="w-full text-sm text-gray-500 border-2 border-gray-200 rounded-xl
                               px-3 py-2 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg
                               file:border-0 file:text-xs file:font-semibold
                               file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100
                               focus:outline-none focus:border-purple-400 focus:shadow-[0_0_0_4px_rgba(168,85,247,0.15)]
                               hover:border-purple-300 transition-all duration-200 bg-white">
                </div>
            </div>

            <div class="mt-5 flex justify-end">
                <button type="submit"
                    class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600
                           active:scale-95 text-white rounded-xl text-sm font-semibold transition-all duration-200
                           shadow-md hover:shadow-lg disabled:opacity-60 disabled:cursor-not-allowed
                           focus:outline-none focus:ring-2 focus:ring-purple-400">
                    + Tambah Kategori
                </button>
            </div>
        </form>
    </div>

    
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 uppercase text-xs tracking-wider border-b border-gray-100 bg-gradient-to-r from-purple-50 to-pink-50">
                        <th class="px-6 py-3.5 text-left font-semibold">Icon</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Nama Kategori</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Deskripsi</th>
                        <th class="px-6 py-3.5 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-t border-gray-50 hover:bg-purple-50/30 transition-colors duration-200"
                        x-data="{ edit: false }">

                        
                        <td class="px-6 py-4">
                            <?php if($kategori->icon): ?>
                            <img src="<?php echo e(asset('storage/' . $kategori->icon)); ?>"
                                alt="<?php echo e($kategori->nama); ?>"
                                class="w-10 h-10 object-contain rounded-lg bg-gray-50 p-1 shadow-sm ring-2 ring-white">
                            <?php else: ?>
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center
                                            justify-center text-gray-400 text-xs shadow-sm ring-2 ring-white">
                                N/A
                            </div>
                            <?php endif; ?>
                        </td>

                        
                        <td class="px-6 py-4 font-medium text-gray-800">
                            <?php echo e($kategori->nama); ?>

                        </td>

                        
                        <td class="px-6 py-4 text-gray-600">
                            <?php echo e($kategori->deskripsi ?? '—'); ?>

                        </td>

                        
                        <td class="px-6 py-4 text-right relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="w-9 h-9 inline-flex items-center justify-center rounded-full
                                       hover:bg-purple-100 active:scale-95 transition-all duration-200
                                       text-gray-500 font-bold text-lg leading-none focus:outline-none focus:ring-2 focus:ring-purple-300"
                                title="Aksi">
                                •••
                            </button>

                            
                            <div x-show="open" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                @click.away="open = false"
                                class="absolute right-0 top-full mt-1 w-48 bg-white border border-gray-100
                                        rounded-xl shadow-xl z-50 overflow-hidden py-1">

                                
                                <button @click="edit = !edit; open = false"
                                    class="w-full text-left px-4 py-2.5 text-sm text-gray-700
                                           hover:bg-purple-50 transition-colors duration-150">
                                    ✏️ Edit
                                </button>

                                
                                <form action="<?php echo e(route('admin.kategori.destroy', $kategori->id)); ?>" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?') && handleSubmit(this)">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2.5 text-sm text-red-600
                                               hover:bg-red-50 transition-colors duration-150
                                               disabled:opacity-60 disabled:cursor-not-allowed">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    
                    <tr x-show="edit" x-cloak
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-4"
                        class="bg-purple-50/40 border-t border-purple-100">
                        <td colspan="4" class="px-6 py-4">
                            <form action="<?php echo e(route('admin.kategori.update', $kategori->id)); ?>"
                                method="POST" enctype="multipart/form-data"
                                onsubmit="return handleSubmit(this)">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5 block">
                                            Nama Kategori
                                        </label>
                                        <input type="text" name="nama_kategori"
                                            value="<?php echo e($kategori->nama); ?>"
                                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl
                                                      text-sm focus:outline-none focus:border-purple-400 focus:shadow-[0_0_0_4px_rgba(168,85,247,0.15)]
                                                      bg-white hover:border-purple-300 transition-all duration-200">
                                    </div>

                                    <div>
                                        <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5 block">
                                            Deskripsi
                                        </label>
                                        <input type="text" name="deskripsi"
                                            value="<?php echo e($kategori->deskripsi ?? ''); ?>"
                                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl
                                                      text-sm focus:outline-none focus:border-purple-400 focus:shadow-[0_0_0_4px_rgba(168,85,247,0.15)]
                                                      bg-white hover:border-purple-300 transition-all duration-200">
                                    </div>

                                    <div>
                                        <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5 block">
                                            Icon / Gambar Baru
                                        </label>
                                        <input type="file" name="icon" accept=".png,.jpg,.jpeg,.svg"
                                            class="w-full text-sm text-gray-500 border-2 border-gray-200 rounded-xl
                                                      px-3 py-2 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg
                                                      file:border-0 file:text-xs file:font-semibold
                                                      file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100
                                                      bg-white focus:outline-none focus:border-purple-400 focus:shadow-[0_0_0_4px_rgba(168,85,247,0.15)]
                                                      hover:border-purple-300 transition-all duration-200">
                                    </div>
                                </div>

                                <div class="mt-5 flex flex-wrap gap-3 justify-end">
                                    <button type="button" @click="edit = false"
                                        class="px-5 py-2.5 border-2 border-gray-200 rounded-xl text-sm
                                               font-medium text-gray-600 hover:bg-gray-50 active:scale-95 transition-all duration-200">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600
                                               active:scale-95 text-white rounded-xl text-sm font-semibold transition-all duration-200
                                               shadow-md hover:shadow-lg disabled:opacity-60 disabled:cursor-not-allowed
                                               focus:outline-none focus:ring-2 focus:ring-purple-400">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-purple-50 to-pink-50 border border-purple-100 flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-10 h-10 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <span class="text-gray-500 font-medium text-base">Belum ada kategori.</span>
                                <p class="text-gray-400 text-sm mt-1">Tambahkan kategori baru melalui form di atas.</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Mencegah double submit pada form
    function handleSubmit(form) {
        const btn = form.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = 'Processing...';
        }
        return true;
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\TUGAS KULIAH\Sem 6\Produk Perangkat Lunak\UMKM-Bontang\resources\views/admin/kategori/index.blade.php ENDPATH**/ ?>