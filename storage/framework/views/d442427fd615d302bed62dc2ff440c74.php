

<?php $__env->startSection('content'); ?>

<div class="max-w-5xl mx-auto px-4 py-8">

    
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Detail UMKM
            </h1>

            <p class="text-gray-500 mt-1">
                Informasi lengkap UMKM
            </p>
        </div>

        <a href="<?php echo e(route('admin.umkm.data')); ?>"
           class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-medium transition">
            ← Kembali
        </a>
    </div>

    
    <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">

        
        <div class="h-48 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

        <div class="p-8">

            
            <div class="flex flex-col md:flex-row md:items-center gap-6 -mt-20 mb-8">

                <div class="w-32 h-32 rounded-2xl overflow-hidden border-4 border-white shadow-lg bg-white">
                    <?php if($umkm->logo): ?>
                        <img src="<?php echo e(asset('storage/' . $umkm->logo)); ?>"
                             class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-4xl font-bold text-blue-600">
                            <?php echo e(strtoupper(substr($umkm->nama_usaha,0,1))); ?>

                        </div>
                    <?php endif; ?>
                </div>

                <div class="pt-10">
                    <h2 class="text-3xl font-bold text-gray-800">
                        <?php echo e($umkm->nama_usaha); ?>

                    </h2>

                    <p class="text-gray-500 mt-1">
                        <?php echo e($umkm->kategori->nama ?? '-'); ?>

                    </p>

                    <div class="mt-3">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            <?php if($umkm->status == 'approved'): ?>
                                bg-green-100 text-green-700
                            <?php elseif($umkm->status == 'pending'): ?>
                                bg-yellow-100 text-yellow-700
                            <?php elseif($umkm->status == 'suspended'): ?>
                                bg-gray-200 text-gray-700
                            <?php else: ?>
                                bg-red-100 text-red-700
                            <?php endif; ?>">

                            <?php echo e(ucfirst($umkm->status)); ?>


                        </span>
                    </div>
                </div>
            </div>

            
            <div class="grid md:grid-cols-2 gap-6 mb-8">

                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">
                        Pemilik
                    </h3>

                    <p class="text-gray-600">
                        <?php echo e($umkm->user->name); ?>

                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">
                        Kontak
                    </h3>

                    <p class="text-gray-600">
                        <?php echo e($umkm->kontak ?? '-'); ?>

                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">
                        Jenis UMKM
                    </h3>

                    <p class="text-gray-600">
                        <?php echo e($umkm->jenis_umkm); ?>

                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">
                        Jam Operasional
                    </h3>

                    <p class="text-gray-600">
                        <?php echo e($umkm->jam_operasional); ?>

                    </p>
                </div>

            </div>

            
            <div class="mb-8">
                <h3 class="font-semibold text-gray-700 mb-2">
                    Deskripsi
                </h3>

                <p class="text-gray-600 leading-relaxed">
                    <?php echo e($umkm->deskripsi); ?>

                </p>
            </div>

            
            <div class="flex flex-wrap gap-3">

                <?php if($umkm->status === 'pending'): ?>

                    <form action="<?php echo e(route('admin.umkm.approve', $umkm->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium">
                            ✅ Approve
                        </button>
                    </form>

                    <form action="<?php echo e(route('admin.umkm.reject', $umkm->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium">
                            ❌ Reject
                        </button>
                    </form>

                <?php elseif($umkm->status === 'approved'): ?>

                    <form action="<?php echo e(route('admin.umkm.suspend', $umkm->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            class="px-5 py-2.5 bg-gray-700 hover:bg-black text-white rounded-xl font-medium">
                            ⛔ Suspend UMKM
                        </button>
                    </form>

                <?php elseif($umkm->status === 'suspended'): ?>

                    <form action="<?php echo e(route('admin.umkm.activate', $umkm->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium">
                            ✅ Aktifkan Kembali
                        </button>
                    </form>

                <?php endif; ?>

            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\TUGAS KULIAH\Sem 6\Produk Perangkat Lunak\UMKM-Bontang\resources\views/admin/umkm/detail.blade.php ENDPATH**/ ?>