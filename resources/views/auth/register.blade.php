<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register – RuangUsaha</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        /* ── Animated underline ── */
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

        /* ── Card shine effect ── */
        .register-card {
            position: relative;
        }
        .register-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .6) 0%, transparent 25%);
            opacity: 0;
            transition: opacity .3s ease;
            pointer-events: none;
            border-radius: inherit;
            z-index: 1;
        }
        .register-card:hover::before {
            opacity: 1;
        }

        /* ── Page load fade-in ── */
        @keyframes fadeInMain {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .page-enter {
            animation: fadeInMain 0.6s ease forwards;
        }

        /* ── Staggered entrance ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-animate {
            animation: fadeUp .5s ease both;
        }
    </style>
</head>

<body class="hero-bg noise text-gray-800 antialiased min-h-screen flex flex-col">

    {{-- ── NAVBAR ── --}}
    @include('partials.navbar')

    {{-- ── MAIN CONTENT ── --}}
    <main class="relative z-10 flex-1 flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-28 pb-20 page-enter">
        <div class="w-full max-w-2xl">

            {{-- ── Page Header ── --}}
            <div class="text-center mb-10 card-animate" style="animation-delay: 0.15s;">
                <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                            px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                    Pendaftaran Akun
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
                    Bergabung Bersama RuangUsaha!
                </h1>
                <p class="text-gray-500 mt-4 max-w-xl mx-auto text-base leading-relaxed">
                    Buat akun untuk memperluas jangkauan bisnismu dan dikenal oleh masyarakat Bontang.
                </p>
                {{-- Decorative divider --}}
                <div class="mt-5 flex items-center justify-center gap-2">
                    <span class="w-8 h-px bg-blue-200"></span>
                    <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                    <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                    <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                    <span class="w-8 h-px bg-teal-200"></span>
                </div>
            </div>

            {{-- ── FORM CARD ── --}}
            <div class="register-card card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                        hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500 p-8 sm:p-10"
                 style="animation-delay: 0.2s;">

                {{-- Header dengan ikon --}}
                <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-100">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-teal-500
                                flex items-center justify-center shadow-lg shadow-blue-200 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Formulir Pendaftaran</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Isi data diri Anda dengan lengkap</p>
                    </div>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl flex items-start gap-3">
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
                            @foreach ($errors->all() as $error)
                            <li class="flex items-center gap-1.5">
                                <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>
                                {{ $error }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <form action="{{ route('register.process') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="role" value="{{ request('role') }}">

                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Nama Lengkap <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </span>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-11 pr-4 text-sm
                                          bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                          transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium"
                                   placeholder="Masukkan nama lengkap">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Email <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-11 pr-4 text-sm
                                          bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                          transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium"
                                   placeholder="Masukkan email">
                        </div>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Nomor Telepon
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </span>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-11 pr-4 text-sm
                                          bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                          transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium"
                                   placeholder="Masukkan nomor telepon">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Password <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input type="password" name="password"
                                   class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-11 pr-4 text-sm
                                          bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                          transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium"
                                   placeholder="Minimal 8 karakter">
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Konfirmasi Password <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <input type="password" name="password_confirmation"
                                   class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-11 pr-4 text-sm
                                          bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                          transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium"
                                   placeholder="Ulangi password">
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                            class="btn-shimmer w-full py-3.5 bg-gradient-to-r from-blue-600 to-teal-500 text-white font-semibold rounded-2xl 
                                   shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300 hover:-translate-y-0.5 active:scale-[0.98] 
                                   transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-400 mt-4">
                        <span class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Buat Akun
                        </span>
                    </button>

                    {{-- Login Link --}}
                    <p class="text-center text-sm text-gray-500 pt-2">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" 
                           class="font-semibold text-blue-600 animated-underline hover:text-blue-700 transition-colors ml-1">
                            Masuk di sini
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    {{-- ── FOOTER ── --}}
    @include('partials.footer')

</body>
</html>