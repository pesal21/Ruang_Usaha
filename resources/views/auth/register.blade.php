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
            <a href="{{ route('beranda') }}" class="flex items-center gap-2.5 group">
                <img src="{{ asset('Logo.png') }}" class="w-8 h-8 transition-transform group-hover:scale-110" alt="logo">
                <span class="text-xl font-bold bg-gradient-to-r from-blue-700 to-cyan-600 bg-clip-text text-transparent">
                    RuangUsaha
                </span>
            </a>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-24 pb-12">
        <div class="w-full max-w-2xl">

            <!-- HEADER -->
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-blue-700 to-cyan-600 bg-clip-text text-transparent">
                    Bergabung Bersama RuangUsaha!
                </h1>
                <p class="text-gray-500 mt-3 max-w-xl mx-auto text-sm md:text-base leading-relaxed">
                    Buat akun untuk memperluas jangkauan bisnismu dan dikenal oleh masyarakat Bontang.
                </p>
            </div>

            <!-- FORM CARD -->
            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-blue-100 border border-blue-50 p-8 sm:p-10 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-200">

                <form action="{{ route('register.process') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="role" value="{{ request('role') }}">

                    <!-- NAMA LENGKAP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="input-glow w-full px-4 py-3 border-2 border-gray-200 rounded-xl 
                                      focus:outline-none focus:border-blue-400 focus:ring-0 
                                      hover:border-blue-300 transition-all duration-200 text-gray-700 placeholder:text-gray-400"
                               placeholder="Masukkan nama lengkap">
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="input-glow w-full px-4 py-3 border-2 border-gray-200 rounded-xl 
                                      focus:outline-none focus:border-blue-400 focus:ring-0 
                                      hover:border-blue-300 transition-all duration-200 text-gray-700 placeholder:text-gray-400"
                               placeholder="Masukkan email">
                    </div>

                    <!-- NOMOR TELEPON -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="input-glow w-full px-4 py-3 border-2 border-gray-200 rounded-xl 
                                      focus:outline-none focus:border-blue-400 focus:ring-0 
                                      hover:border-blue-300 transition-all duration-200 text-gray-700 placeholder:text-gray-400"
                               placeholder="Masukkan nomor telepon">
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <input type="password" name="password"
                               class="input-glow w-full px-4 py-3 border-2 border-gray-200 rounded-xl 
                                      focus:outline-none focus:border-blue-400 focus:ring-0 
                                      hover:border-blue-300 transition-all duration-200 text-gray-700 placeholder:text-gray-400"
                               placeholder="Masukkan password">
                    </div>

                    <!-- KONFIRMASI PASSWORD -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                               class="input-glow w-full px-4 py-3 border-2 border-gray-200 rounded-xl 
                                      focus:outline-none focus:border-blue-400 focus:ring-0 
                                      hover:border-blue-300 transition-all duration-200 text-gray-700 placeholder:text-gray-400"
                               placeholder="Ulangi password">
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                            class="btn-shimmer w-full py-3.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-semibold rounded-xl 
                                   shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300 hover:scale-[1.02] active:scale-95 
                                   transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Selanjutnya
                    </button>

                    <!-- LINK LOGIN -->
                    <p class="text-center text-sm text-gray-500 pt-2">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold text-blue-600 animated-underline hover:text-blue-800 transition-colors ml-1">
                            Masuk di sini
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    @include('partials.footer')

</body>
</html>