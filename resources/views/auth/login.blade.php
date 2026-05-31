<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – RuangUsaha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }

        /* ── Latar lembut tanpa mesh berat ── */
        .hero-bg {
            background: linear-gradient(135deg, #eff6ff 0%, #e0f2fe 50%, #f0f9ff 100%);
        }

        /* ── Gradient Text ── */
        .text-gradient {
            background: linear-gradient(135deg, #1d4ed8 0%, #0891b2 50%, #0d9488 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Underline Animation (ringan) ── */
        .animated-underline {
            position: relative; display: inline-block;
        }
        .animated-underline::after {
            content: '';
            position: absolute; bottom: -2px; left: 0; width: 100%; height: 1.5px;
            background: currentColor; transform: scaleX(0); transform-origin: left;
            transition: transform 0.25s ease;
        }
        .animated-underline:hover::after { transform: scaleX(1); }

        /* ── Input focus ring ringan ── */
        .input-field:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
            outline: none;
        }

        /* ── Efek hover halus pada kartu ── */
        .login-card {
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }
        .login-card:hover {
            box-shadow: 0 20px 30px -10px rgba(59,130,246,0.15);
            transform: translateY(-2px);
        }

        /* ── Animasi masuk (fade-in-up) ── */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-in {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0; /* mulainya tersembunyi */
        }
    </style>
</head>

<body class="hero-bg text-gray-800 antialiased min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- MAIN CONTENT --}}
    <main class="relative z-10 flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 pt-28 pb-20">
        <div class="grid md:grid-cols-2 gap-10 items-center w-full max-w-6xl">

            {{-- ILUSTRASI (muncul dengan delay sedikit) --}}
            <div class="hidden md:flex justify-center animate-in" style="animation-delay: 0.15s;">
                <img src="{{ asset('gambar-1.png') }}" 
                     class="w-[400px] lg:w-[480px] drop-shadow-xl"
                     alt="Login Illustration">
            </div>

            {{-- FORM CARD (muncul pertama) --}}
            <div class="login-card animate-in w-full max-w-md mx-auto bg-white rounded-2xl border border-gray-100 
                        shadow-md p-8 sm:p-10"
                 style="animation-delay: 0.05s;">

                {{-- Switch Role --}}
                <div class="flex bg-gray-100 rounded-xl p-1 mb-8">
                    <a href="{{ route('login.role', ['role' => 'admin']) }}"
                       class="w-1/2 text-center py-2.5 font-semibold text-sm rounded-lg transition-all duration-200
                              {{ $role == 'admin' ? 'bg-blue-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200' }}">
                        Admin
                    </a>
                    <a href="{{ route('login.role', ['role' => 'umkm']) }}"
                       class="w-1/2 text-center py-2.5 font-semibold text-sm rounded-lg transition-all duration-200
                              {{ $role == 'umkm' ? 'bg-blue-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200' }}">
                        Pelaku UMKM
                    </a>
                </div>

                {{-- Heading --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gradient">Selamat Datang</h2>
                    <p class="text-gray-500 text-sm mt-1">Masuk untuk melanjutkan ke dashboard Anda</p>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-600 flex items-start gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <div>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('login.process') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="role" value="{{ $role }}">

                    {{-- Email / Username --}}
                    <div>
                        <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block font-semibold">
                            Email atau Username
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </span>
                            <input type="text" name="email" value="{{ old('email') }}"
                                   class="input-field w-full border-2 border-gray-200 rounded-xl py-3 pl-11 pr-4 text-sm
                                          bg-white focus:bg-white transition-colors duration-200
                                          placeholder:text-gray-400 text-gray-700 font-medium"
                                   placeholder="Masukkan email atau username">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block font-semibold">
                            Password
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input type="password" name="password" id="password"
                                   class="input-field w-full border-2 border-gray-200 rounded-xl py-3 pl-11 pr-12 text-sm
                                          bg-white focus:bg-white transition-colors duration-200
                                          placeholder:text-gray-400 text-gray-700 font-medium"
                                   placeholder="Masukkan password">
                            <button type="button" onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 p-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Lupa Password + Ingat Saya --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-xs text-gray-500 font-medium">Ingat saya</span>
                        </label>
                        <a href="#" class="text-xs font-semibold text-blue-600 animated-underline hover:text-blue-700 transition-colors">
                            Lupa Password?
                        </a>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                            class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-teal-500 text-white font-semibold rounded-xl 
                                   shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300 hover:-translate-y-0.5 
                                   active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Masuk
                    </button>

                    {{-- Register Link --}}
                    <p class="text-center text-sm text-gray-500 pt-2">
                        Belum punya akun?
                        <a href="{{ route('register', ['role' => $role]) }}"
                           class="font-semibold text-blue-600 animated-underline hover:text-blue-700 transition-colors ml-1">
                            Daftar di sini
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

    {{-- Toggle Password Script --}}
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M15 12a3 3 0 01-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"/>`;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            }
        }
    </script>
</body>
</html>