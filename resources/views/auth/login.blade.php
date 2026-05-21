<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – RuangUsaha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* animasi halus untuk ilustrasi */
        .float-animation {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }

            100% {
                transform: translateY(0px);
            }
        }
    </style>
</head>

<body class="bg-white">

    <!-- NAVBAR SIMPLE (TIDAK DIUBAH) -->
    <nav class="fixed top-0 w-full bg-white z-50">
        <div class="relative h-16 px-6 flex items-center">

            <!-- ================= LEFT : LOGO ================= -->
            <div class="absolute left-6 flex items-center gap-2">
                <a href="{{ route('beranda') }}" class="inline-flex items-center gap-2">
                    <img src="{{ asset('Logo.png') }}" class="w-8 h-8" alt="logo">
                    <span class="text-lg font-semibold">RuangUsaha</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <section class="grid md:grid-cols-2 px-8 md:px-20 lg:px-28 py-10 items-center min-h-[80vh]">

        <!-- LEFT ILLUSTRATION -->
        <div class="hidden md:flex justify-center">
            <img src="{{ asset('gambar-1.png') }}" class="w-[480px] float-animation" alt="Login Illustration">
        </div>

        <!-- FORM LOGIN -->
        <div class="bg-white p-8 rounded-xl w-full max-w-md mx-auto shadow-lg hover:shadow-xl transition-shadow duration-300">

            <!-- SWITCH ADMIN / USER -->
            <div class="flex bg-gray-100 rounded-full overflow-hidden mb-8 p-1">
                <a href="{{ route('login.role', ['role' => 'admin']) }}"
                    class="w-1/2 text-center py-3 font-medium rounded-full transition-all duration-300 cursor-pointer
                    {{ $role == 'admin' ? 'bg-blue-600 text-white shadow-md' : 'text-gray-600 hover:bg-gray-200' }}">
                    Admin
                </a>
                <a href="{{ route('login.role', ['role' => 'umkm']) }}"
                    class="w-1/2 text-center py-3 font-medium rounded-full transition-all duration-300 cursor-pointer
                    {{ $role == 'umkm' ? 'bg-blue-600 text-white shadow-md' : 'text-gray-600 hover:bg-gray-200' }}">
                    Pelaku UMKM
                </a>
            </div>

            <h2 class="text-2xl font-bold mb-2">Selamat Datang Kembali</h2>
            <p class="text-sm text-gray-500 mb-6">
                Masuk untuk melanjutkan ke dashboard Anda
            </p>

            <!-- ERROR MESSAGE (jika ada) -->
            @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <input type="hidden" name="role" value="{{ $role }}">

                <!-- EMAIL / USERNAME -->
                <label class="block text-sm font-medium mb-1">Email atau Username</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-400">
                        <img src="{{ asset('assets/img/icon_umkm/people.png') }}" alt="User icon" class="w-5 h-5 object-contain">
                    </span>
                    <input type="text" name="email" value="{{ old('email') }}"
                        class="w-full border rounded-lg pl-10 pr-4 py-2 mb-4 transition-all duration-200
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-blue-300"
                        placeholder="Masukkan email atau username">
                </div>

                <!-- PASSWORD -->
                <label class="block text-sm font-medium mb-1">Password</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-400">
                        <img src="{{ asset('assets/img/icon_umkm/lock.png') }}" alt="Lock icon" class="w-5 h-5 object-contain">
                    </span>
                    <input type="password" name="password" id="password"
                        class="w-full border rounded-lg pl-10 pr-10 py-2 transition-all duration-200
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-blue-300"
                        placeholder="Masukkan password">
                    <!-- TOGGLE PASSWORD VISIBILITY -->
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <div class="text-right mt-1 mb-6">
                    <a href="#" class="text-blue-500 text-sm hover:text-blue-700 transition-colors">Lupa Password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold transition-all duration-300
                    hover:bg-blue-700 hover:shadow-lg hover:scale-[1.02] active:scale-95 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Masuk
                </button>

                <p class="text-center mt-4 text-sm">
                    Belum punya akun?
                    <a href="{{ route('register', ['role' => $role]) }}"
                        class="text-blue-600 font-semibold hover:text-blue-800 transition-colors">
                        Daftar di sini
                    </a>
                </p>
            </form>
        </div>
    </section>

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

    <!-- SCRIPT TOGGLE PASSWORD -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // ganti ikon ke "eye-off" (mata tertutup)
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M15 12a3 3 0 01-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                `;
            } else {
                passwordInput.type = 'password';
                // kembali ke ikon mata terbuka
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>

</body>

</html>