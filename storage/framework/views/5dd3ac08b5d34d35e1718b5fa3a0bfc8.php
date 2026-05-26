<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Profil UMKM – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <!-- ================= NAVBAR ================= -->
    <nav class="fixed top-0 w-full bg-white border-b z-50">
        <div class="relative h-16 px-6 flex items-center">

            <!-- LEFT : LOGO -->
            <div class="absolute left-6 flex items-center gap-2">
                <a href="<?php echo e(route('beranda')); ?>" class="inline-flex items-center gap-2">
                    <img src="<?php echo e(asset('Logo.png')); ?>" class="w-8 h-8" alt="logo">
                    <span class="text-lg font-semibold">RuangUsaha</span>
                </a>
            </div>

            <!-- CENTER : MENU -->
            <div class="mx-auto hidden md:flex items-center gap-8 text-sm font-regular">
                <a href="<?php echo e(route('beranda')); ?>" class="hover:text-blue-600 transition">Beranda</a>
                <a href="<?php echo e(route('umkm.index')); ?>" class="hover:text-blue-600 transition">Daftar UMKM</a>
                <a href="<?php echo e(route('umkm.pilih')); ?>" class="text-blue-600 transition">Pilih UMKM</a>
                <a href="<?php echo e(route('blog.index')); ?>" class="hover:text-blue-600 transition">
                    Blog
                </a>
            </div>

            <!-- RIGHT : AUTH / PROFILE -->
            <div class="absolute right-6 flex items-center gap-3">
                <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="px-4 py-2 text-sm border rounded-md hover:border-blue-600 hover:text-blue-600 transition">LOGIN</a>
                <a href="<?php echo e(route('register')); ?>" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700 active:scale-95 transition-all">SIGN UP</a>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center gap-3 focus:outline-none">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-medium leading-tight"><?php echo e(auth()->user()->name); ?></p>
                            <p class="text-xs text-gray-500">Pelaku UMKM</p>
                        </div>
                        <?php if(auth()->user()->profile_picture): ?>
                        <img src="<?php echo e(asset('storage/'.auth()->user()->profile_picture)); ?>"
                            alt="Profile"
                            class="w-9 h-9 rounded-full object-cover border-2 border-blue-600 hover:shadow-md transition">
                        <?php else: ?>
                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold hover:shadow-md transition">
                            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                        </div>
                        <?php endif; ?>
                    </button>

                    <div id="profileDropdown" class="hidden absolute right-0 mt-3 w-48 bg-white border rounded-xl shadow-xl overflow-hidden z-50">
                        <a href="<?php echo e(route('profile.index')); ?>" class="block px-4 py-3 text-sm hover:bg-gray-100 transition">Profil Akun</a>

                        <?php if(auth()->user()->umkm): ?>
                        <a href="<?php echo e(route('umkm.dashboard', auth()->user()->umkm->id)); ?>" class="block px-4 py-3 text-sm hover:bg-gray-100 transition">Dashboard UMKM</a>
                        <?php else: ?>
                        <a href="<?php echo e(route('umkm.create')); ?>"
                            class="block px-4 py-3 text-sm hover:bg-gray-100">
                            Buat UMKM
                        </a>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="w-full text-left px-4 py-3 text-sm hover:bg-gray-100 transition">Logout</button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="flex-1 max-w-3xl mx-auto w-full px-4 py-10">

        <!-- BACK LINK -->
        <div class="max-w-6xl mx-auto mt-8 mb-4">
            <a href="<?php echo e(route('umkm.dashboard', $umkm->id)); ?>" class="inline-flex items-center gap-1 text-blue-600 text-sm hover:underline">
                < Kembali
                    </a>
        </div>

        <!-- HEADER -->
        <div class="mt-4 mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Profil UMKM</h1>
            <p class="text-gray-400 text-sm mt-1">Perbarui informasi usaha Anda.</p>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">

            <form action="<?php echo e(route('umkm.update', $umkm->id)); ?>"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <?php if($errors->any()): ?>
                <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                    <ul class="text-sm text-red-600 space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>• <?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-2 block">
                        Logo Usaha
                    </label>

                    <?php if($umkm->logo): ?>
                    <div class="mb-3">
                        <img src="<?php echo e(asset('storage/'.$umkm->logo)); ?>"
                            alt="Logo"
                            class="w-24 h-24 rounded-xl object-cover border border-gray-100 shadow-sm">
                        <p class="text-xs text-gray-400 mt-1">Logo saat ini</p>
                    </div>
                    <?php endif; ?>

                    <input type="file" name="logo" accept="image/*"
                        class="w-full text-sm text-gray-500 border border-gray-200 rounded-xl
                                  px-3 py-2.5 file:mr-3 file:py-1 file:px-3 file:rounded-lg
                                  file:border-0 file:text-xs file:font-medium
                                  file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 bg-white">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti logo.</p>
                </div>

                
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                            Nama Usaha <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_usaha"
                            value="<?php echo e(old('nama_usaha', $umkm->nama_usaha)); ?>"
                            required
                            class="w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50
                                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                            Kategori Usaha <span class="text-red-500">*</span>
                        </label>
                        <select name="kategori_id" required
                            class="w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition text-gray-700">
                            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kategori->id); ?>"
                                <?php echo e(old('kategori_id', $umkm->kategori_id) == $kategori->id ? 'selected' : ''); ?>>
                                <?php echo e($kategori->nama); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" rows="4" required
                        class="w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50
                                     focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition resize-none"><?php echo e(old('deskripsi', $umkm->deskripsi)); ?></textarea>
                </div>

                
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                        Alamat Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea name="alamat_lengkap" rows="2" required
                        class="w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50
                                     focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition resize-none"><?php echo e(old('alamat_lengkap', $umkm->alamat_lengkap)); ?></textarea>
                </div>

                
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                            Jenis UMKM <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_umkm" required
                            class="w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition text-gray-700">
                            <option value="Toko Fisik" <?php echo e(old('jenis_umkm', $umkm->jenis_umkm) == 'Toko Fisik'  ? 'selected' : ''); ?>>Toko Fisik</option>
                            <option value="Toko Online" <?php echo e(old('jenis_umkm', $umkm->jenis_umkm) == 'Toko Online' ? 'selected' : ''); ?>>Toko Online</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                            Jam Operasional <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="jam_operasional"
                            value="<?php echo e(old('jam_operasional', $umkm->jam_operasional)); ?>"
                            placeholder="Contoh: 08.00 - 21.00 WITA"
                            required
                            class="w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50
                                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                    </div>
                </div>

                
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                            Kontak / WhatsApp
                        </label>
                        <input type="text" name="kontak"
                            value="<?php echo e(old('kontak', $umkm->kontak)); ?>"
                            placeholder="081234567890"
                            class="w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50
                                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                            Sosial Media <span class="text-gray-400 font-normal normal-case">(opsional)</span>
                        </label>
                        <input type="text" name="sosial_media"
                            value="<?php echo e(old('sosial_media', $umkm->sosial_media)); ?>"
                            placeholder="https://instagram.com/namausaha"
                            class="w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50
                                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                    </div>
                </div>

                
                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white
                               font-semibold text-sm rounded-xl transition shadow-sm">
                        Simpan Perubahan
                    </button>
                    <a href="<?php echo e(route('umkm.dashboard', $umkm->id)); ?>"
                        class="px-6 py-2.5 border border-gray-200 hover:bg-gray-50
                              text-gray-600 text-sm font-medium rounded-xl transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>

    </main>

    <!-- ================= FOOTER ================= -->
    <footer style="background-color: #1e2a3a;" class="text-gray-300">
        <div class="max-w-7xl mx-auto px-10 py-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">

            <!-- Brand -->
            <div>
                <h2 class="text-white font-bold text-xl mb-4">RuangUsaha</h2>
                <p class="text-sm leading-relaxed" style="color: #8fa3b8;">
                    Menghubungkan dan memberdayakan<br>usaha lokal di Bontang.
                </p>
                <div class="flex items-center gap-5 mt-6">
                    <!-- Facebook -->
                    <a href="#" style="color: #8fa3b8;" class="hover:text-white transition transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="#" style="color: #8fa3b8;" class="hover:text-white transition transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                        </svg>
                    </a>
                    <!-- Twitter / X -->
                    <a href="#" style="color: #8fa3b8;" class="hover:text-white transition transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Perusahaan -->
            <div>
                <h3 class="text-white font-bold text-base mb-5">Perusahaan</h3>
                <ul class="space-y-3 text-sm" style="color: #8fa3b8;">
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Kontak</a></li>
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Dukungan</a></li>
                </ul>
            </div>

            <!-- Tautan Cepat -->
            <div>
                <h3 class="text-white font-bold text-base mb-5">Tautan Cepat</h3>
                <ul class="space-y-3 text-sm" style="color: #8fa3b8;">
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Bagikan Lokasi</a></li>
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Lacak Pesanan</a></li>
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">FAQs</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h3 class="text-white font-bold text-base mb-5">Legal</h3>
                <ul class="space-y-3 text-sm" style="color: #8fa3b8;">
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Kebijakan Privasi</a></li>
                </ul>
            </div>

        </div>

        <!-- Divider + Copyright -->
        <div style="border-top: 1px solid #2d3f52;">
            <div class="max-w-7xl mx-auto px-10 py-6 text-center text-sm" style="color: #8fa3b8;">
                © 2025 RuangUsaha. All Rights Reserved.
            </div>
        </div>
    </footer>


</body>

</html><?php /**PATH D:\KULIAH\TUGAS KULIAH\Sem 6\Produk Perangkat Lunak\UMKM-Bontang\resources\views/umkm/edit.blade.php ENDPATH**/ ?>