<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk – RuangUsaha</title>

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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .25), transparent);
            transition: left .5s ease;
        }

        .btn-shimmer:hover::after {
            left: 150%;
        }

        /* ── Form input focus glow ── */
        .input-field:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .12), 0 4px 20px rgba(59, 130, 246, .08);
        }

        /* ── Select custom arrow ── */
        select.input-field {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236b7280' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px !important;
        }

        /* ── Card shine effect ── */
        .form-card {
            position: relative;
        }

        /* ── Drag & drop area ── */
        .drag-area {
            border: 2px dashed #bfdbfe;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(4px);
        }

        .drag-area.active {
            border-color: #3b82f6;
            background: #eff6ff;
            box-shadow: 0 0 0 6px rgba(59, 130, 246, 0.08);
        }

        .drag-area:hover {
            border-color: #93c5fd;
            background: #f8faff;
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
            <a href="<?php echo e(route('umkm.kelola', $umkm->id)); ?>"
                class="back-link text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Kelola Produk
            </a>
        </div>

        
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Manajemen Produk
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
                Tambah Produk Baru
            </h1>
            <p class="text-gray-500 mt-3 max-w-md mx-auto text-sm md:text-base">
                Lengkapi detail produk untuk ditampilkan di halaman usaha Anda.
            </p>
            <div class="mt-5 flex items-center justify-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        
        <div class="form-card card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                    hover:shadow-xl hover:shadow-blue-100 transition-all duration-300 p-6 sm:p-8">

            
            <?php if($errors->any()): ?>
            <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-8 flex items-start gap-3">
                <div class="w-9 h-9 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-red-700 mb-1">Perbaiki kesalahan berikut:</p>
                    <ul class="text-sm text-red-600 space-y-0.5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-center gap-1.5">
                            <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>
                            <?php echo e($error); ?>

                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('umkm.produk.store', $umkm->id)); ?>" method="POST" enctype="multipart/form-data"
                id="produk-form" class="grid md:grid-cols-2 gap-8">
                <?php echo csrf_field(); ?>

                
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                                    flex items-center justify-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">
                            Detail Produk
                        </h2>
                    </div>

                    
                    <div class="mb-5">
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Nama Produk <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="nama_produk" value="<?php echo e(old('nama_produk')); ?>" required
                            placeholder="Masukkan nama produk"
                            class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                      bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                      transition-all duration-300 placeholder:text-gray-400 text-gray-700 font-medium">
                    </div>

                    
                    <div class="mb-5">
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Harga <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold text-sm">Rp</span>
                            <input type="number" name="harga" value="<?php echo e(old('harga')); ?>" min="0"
                                placeholder="0"
                                class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-10 pr-4 text-sm
                                          bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                          transition-all duration-300 placeholder:text-gray-400 text-gray-700 font-medium">
                        </div>
                    </div>

                    
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" rows="5"
                            placeholder="Jelaskan detail produk (opsional)..."
                            class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                     bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                     transition-all duration-300 placeholder:text-gray-400 text-gray-700
                                     font-medium resize-none"><?php echo e(old('deskripsi')); ?></textarea>
                    </div>
                </div>

                
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                                    flex items-center justify-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">
                            Foto Produk
                        </h2>
                    </div>

                    <div class="drag-area rounded-2xl p-8 text-center cursor-pointer"
                        id="dragArea"
                        onclick="document.getElementById('fotoInput').click()">

                        <div id="uploadPlaceholder">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-50 to-teal-50
                                        flex items-center justify-center mx-auto mb-4 shadow-sm">
                                <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                            <p class="text-sm text-gray-600 font-medium mb-1">
                                <span class="text-blue-600">Klik untuk upload</span> atau seret dan lepas
                            </p>
                            <p class="text-xs text-gray-400 mt-2">PNG, JPG, GIF (Maks 800x400px)</p>
                        </div>

                        <div id="uploadPreview" class="hidden">
                            <img id="previewImg" src="" alt="Preview"
                                class="max-h-48 mx-auto rounded-xl object-contain shadow-sm">
                            <p id="fileName" class="text-xs text-gray-500 mt-3 font-medium"></p>
                            <button type="button" onclick="event.stopPropagation(); resetUpload()"
                                class="mt-3 text-xs text-red-500 hover:text-red-600 font-semibold hover:underline transition-colors">
                                Hapus & Ganti Foto
                            </button>
                        </div>

                        <input type="file" id="fotoInput" name="foto_produk" accept="image/*" class="hidden">
                    </div>

                    <p class="text-xs text-gray-400 mt-3 text-center">
                        Foto produk akan ditampilkan di katalog usaha Anda.
                    </p>
                </div>
            </form>

            
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t-2 border-blue-50">
                <a href="<?php echo e(route('umkm.kelola', $umkm->id)); ?>"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3
                          border-2 border-blue-200 text-blue-700 font-semibold text-sm
                          rounded-2xl hover:bg-blue-50 hover:border-blue-300
                          hover:-translate-y-0.5 active:scale-95 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batalkan
                </a>
                <button type="submit" form="produk-form"
                    class="btn-shimmer inline-flex items-center justify-center gap-2 px-6 py-3
                           bg-gradient-to-r from-blue-600 to-teal-500 text-white
                           font-semibold text-sm rounded-2xl shadow-lg shadow-blue-200
                           hover:shadow-xl hover:shadow-blue-300 hover:-translate-y-0.5
                           active:scale-95 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Produk
                </button>
            </div>
        </div>

    </main>

    
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script>
        const dragArea = document.getElementById('dragArea');
        const fotoInput = document.getElementById('fotoInput');
        const placeholder = document.getElementById('uploadPlaceholder');
        const preview = document.getElementById('uploadPreview');
        const previewImg = document.getElementById('previewImg');
        const fileName = document.getElementById('fileName');

        fotoInput.addEventListener('change', () => {
            if (fotoInput.files.length > 0) {
                handleFile(fotoInput.files[0]);
            }
        });

        dragArea.addEventListener('dragover', e => {
            e.preventDefault();
            dragArea.classList.add('active');
        });

        dragArea.addEventListener('dragleave', () => {
            dragArea.classList.remove('active');
        });

        dragArea.addEventListener('drop', e => {
            e.preventDefault();
            dragArea.classList.remove('active');
            const file = e.dataTransfer.files[0];
            if (file) {
                fotoInput.files = e.dataTransfer.files;
                handleFile(file);
            }
        });

        function handleFile(file) {
            if (!file) return;
            fileName.textContent = file.name;
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
                previewImg.classList.remove('hidden');
            } else {
                previewImg.classList.add('hidden');
            }
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
        }

        function resetUpload() {
            fotoInput.value = '';
            previewImg.src = '';
            fileName.textContent = '';
            placeholder.classList.remove('hidden');
            preview.classList.add('hidden');
        }
    </script>

</body>

</html><?php /**PATH D:\TUGAS KULIAH\PPL\Ruang_Usaha\resources\views/umkm/tambah-produk.blade.php ENDPATH**/ ?>