<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – RuangUsaha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Animasi ilustrasi */
        .float-animation {
            animation: float 5s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        /* Link underline animasi */
        .animated-underline {
            position: relative;
            display: inline-block;
        }
        .animated-underline::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 1.5px;
            background: currentColor;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        .animated-underline:hover::after {
            transform: scaleX(1);
        }

        /* Shimmer effect untuk tombol */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }
        .btn-shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        .btn-shimmer:hover::after {
            left: 160%;
        }

        /* Input focus glow */
        .input-glow:focus {
            box-shadow: 0 0 0 4px rgba(59,130,246,0.15), 0 4px 12px rgba(59,130,246,0.1);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-sky-50 min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50 border-b border-blue-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center">
            <a href="<?php echo e(route('beranda')); ?>" class="flex items-center gap-2.5 group">
                <img src="<?php echo e(asset('Logo.png')); ?>" class="w-8 h-8 transition-transform group-hover:scale-110" alt="logo">
                <span class="text-xl font-bold bg-gradient-to-r from-blue-700 to-cyan-600 bg-clip-text text-transparent">
                    RuangUsaha
                </span>
            </a>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 pt-20 pb-12">
        <div class="grid md:grid-cols-2 gap-10 items-center w-full max-w-6xl">

            <!-- ILUSTRASI -->
            <div class="hidden md:flex justify-center">
                <img src="<?php echo e(asset('gambar-1.png')); ?>" class="w-[400px] lg:w-[480px] float-animation drop-shadow-2xl"
                     alt="Login Illustration">
            </div>

            <!-- FORM CARD -->
            <div class="w-full max-w-md mx-auto bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-blue-100 
                        border border-blue-50 p-8 sm:p-10 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-200">

                <!-- Switch role -->
                <div class="flex bg-gray-100 rounded-full p-1 mb-8">
                    <a href="<?php echo e(route('login.role', ['role' => 'admin'])); ?>"
                       class="w-1/2 text-center py-2.5 font-semibold text-sm rounded-full transition-all duration-300
                              <?php echo e($role == 'admin' ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-200' : 'text-gray-500 hover:bg-gray-200 hover:text-gray-700'); ?>">
                        Admin
                    </a>
                    <a href="<?php echo e(route('login.role', ['role' => 'umkm'])); ?>"
                       class="w-1/2 text-center py-2.5 font-semibold text-sm rounded-full transition-all duration-300
                              <?php echo e($role == 'umkm' ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-200' : 'text-gray-500 hover:bg-gray-200 hover:text-gray-700'); ?>">
                        Pelaku UMKM
                    </a>
                </div>

                <!-- Heading -->
                <h2 class="text-2xl sm:text-3xl font-extrabold bg-gradient-to-r from-blue-700 to-cyan-600 bg-clip-text text-transparent mb-1">
                    Selamat Datang
                </h2>
                <p class="text-gray-500 text-sm mb-8">
                    Masuk untuk melanjutkan ke dashboard Anda
                </p>

                <!-- Error message -->
                <?php if($errors->any()): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- Form -->
                <form method="POST" action="<?php echo e(route('login.process')); ?>" class="space-y-5">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="role" value="<?php echo e($role); ?>">

                    <!-- Email / Username -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email atau Username</label>
                        <div class="relative group">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 transition-colors group-focus-within:text-blue-500">
                                <img src="<?php echo e(asset('assets/img/icon_umkm/people.png')); ?>" alt="icon" class="w-5 h-5 object-contain">
                            </span>
                            <input type="text" name="email" value="<?php echo e(old('email')); ?>"
                                   class="input-glow w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-xl 
                                          focus:outline-none focus:border-blue-400 focus:ring-0 
                                          hover:border-blue-300 transition-all duration-200 text-gray-700 placeholder:text-gray-400"
                                   placeholder="Masukkan email atau username">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <div class="relative group">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 transition-colors group-focus-within:text-blue-500">
                                <img src="<?php echo e(asset('assets/img/icon_umkm/lock.png')); ?>" alt="icon" class="w-5 h-5 object-contain">
                            </span>
                            <input type="password" name="password" id="password"
                                   class="input-glow w-full pl-11 pr-12 py-3 border-2 border-gray-200 rounded-xl 
                                          focus:outline-none focus:border-blue-400 focus:ring-0 
                                          hover:border-blue-300 transition-all duration-200 text-gray-700 placeholder:text-gray-400"
                                   placeholder="Masukkan password">
                            <button type="button" onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-500 transition-colors p-1 rounded-lg hover:bg-blue-50">
                                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Lupa password -->
                    <div class="text-right">
                        <a href="#" class="text-sm font-medium text-blue-600 animated-underline hover:text-blue-800 transition-colors">
                            Lupa Password?
                        </a>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            class="btn-shimmer w-full py-3.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-semibold rounded-xl 
                                   shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300 hover:scale-[1.02] active:scale-95 
                                   transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Masuk
                    </button>

                    <!-- Register link -->
                    <p class="text-center text-sm text-gray-500 mt-4">
                        Belum punya akun?
                        <a href="<?php echo e(route('register', ['role' => $role])); ?>"
                           class="font-semibold text-blue-600 animated-underline hover:text-blue-800 transition-colors ml-1">
                            Daftar di sini
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    <!-- TOGGLE PASSWORD SCRIPT -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M15 12a3 3 0 01-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />`;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
        }
    </script>
</body>
</html><?php /**PATH D:\KULIAH\TUGAS KULIAH\Sem 6\Produk Perangkat Lunak\UMKM-Bontang\resources\views/auth/login.blade.php ENDPATH**/ ?>