<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil – RuangUsaha</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes fadeUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes gentlePulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.03);
            }
        }

        .animate-scale {
            animation: scaleIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        .animate-fadeup {
            animation: fadeUp 0.5s ease forwards;
        }

        .delay-1 {
            animation-delay: 0.15s;
            opacity: 0;
        }

        .delay-2 {
            animation-delay: 0.3s;
            opacity: 0;
        }

        .delay-3 {
            animation-delay: 0.45s;
            opacity: 0;
        }

        .pulse-active {
            animation: gentlePulse 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <!-- ================= NAVBAR ================= -->
    <nav class="fixed top-0 w-full bg-white border-b z-50">
        <div class="relative h-16 px-6 flex items-center">

            <!-- LEFT : LOGO -->
            <div class="absolute left-6 flex items-center gap-2">
                <a href="{{ route('beranda') }}" class="inline-flex items-center gap-2">
                    <img src="{{ asset('Logo.png') }}" class="w-8 h-8" alt="logo">
                    <span class="text-lg font-semibold">RuangUsaha</span>
                </a>
            </div>

            <!-- CENTER : MENU -->
            <div class="mx-auto hidden md:flex items-center gap-8 text-sm font-regular">
                <a href="{{ route('beranda') }}" class="text-blue-600 transition">Beranda</a>
                <a href="{{ route('umkm.index') }}" class="hover:text-blue-600 transition">Daftar UMKM</a>
                @auth
                <a href="{{ route('umkm.pilih') }}" class="hover:text-blue-600">Pilih UMKM</a>
                @endauth
                <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition">
                    Blog
                </a>
            </div>
            <!-- RIGHT : AUTH / PROFILE -->
            <div class="absolute right-6 flex items-center gap-3">
                @guest
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm border rounded-md hover:border-blue-600 hover:text-blue-600 transition">LOGIN</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700 active:scale-95 transition-all">SIGN UP</a>
                @endguest

                @auth
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center gap-3 focus:outline-none">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-medium leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">Pelaku UMKM</p>
                        </div>
                        @if(auth()->user()->profile_picture)
                        <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}"
                            alt="Profile"
                            class="w-9 h-9 rounded-full object-cover border-2 border-blue-600 hover:shadow-md transition">
                        @else
                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold hover:shadow-md transition">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        @endif
                    </button>

                    <div id="profileDropdown" class="hidden absolute right-0 mt-3 w-48 bg-white border rounded-xl shadow-xl overflow-hidden z-50">
                        <a href="{{ route('profile.index') }}" class="block px-4 py-3 text-sm hover:bg-gray-100 transition">Profil Akun</a>

                        @if(auth()->user()->umkm)
                        <a href="{{ route('umkm.dashboard', auth()->user()->umkm->id) }}" class="block px-4 py-3 text-sm hover:bg-gray-100 transition">Dashboard UMKM</a>
                        @else
                        <a href="{{ route('umkm.create') }}" class="block px-4 py-3 text-sm hover:bg-gray-100 transition">Daftarkan UMKM</a>
                        <a href="{{ route('umkm.create') }}"
                            class="block px-4 py-3 text-sm hover:bg-gray-100">
                            Buat UMKM
                        </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-3 text-sm text-red-600
                                   hover:bg-red-50 transition-colors duration-200
                                   flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="flex-1 flex items-center justify-center px-4 py-16">
        <div class="text-center max-w-md mx-auto">

            {{-- ICON SUKSES --}}
            <div class="animate-scale mx-auto mb-8 w-24 h-24 rounded-full bg-green-100
                        flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow duration-300">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            {{-- JUDUL --}}
            <h1 class="animate-fadeup delay-1 text-3xl font-bold text-gray-900 mb-3">
                Pendaftaran Berhasil!
            </h1>

            {{-- DESKRIPSI --}}
            <p class="animate-fadeup delay-2 text-gray-500 text-sm leading-relaxed mb-3">
                Terima kasih telah mendaftarkan usaha Anda di RuangUsaha.
            </p>

            {{-- STATUS BOX --}}
            <div class="animate-fadeup delay-2 bg-yellow-50 border border-yellow-200
                        rounded-xl px-6 py-4 mb-8 text-left hover:shadow-md transition-shadow duration-300">
                <div class="flex items-start gap-3">
                    <span class="text-yellow-500 mt-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <div>
                        <p class="text-sm font-semibold text-yellow-800 mb-1">Menunggu Persetujuan</p>
                        <p class="text-xs text-yellow-700 leading-relaxed">
                            UMKM Anda sedang ditinjau oleh tim admin RuangUsaha.
                            Proses verifikasi biasanya membutuhkan 1–2 hari kerja.
                            Anda akan dihubungi jika sudah disetujui.
                        </p>
                    </div>
                </div>
            </div>

            {{-- STEPS --}}
            <div class="animate-fadeup delay-2 grid grid-cols-3 gap-3 mb-10">
                <div class="bg-white border border-green-100 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-xs text-green-600 font-medium text-center">Formulir dikirim</p>
                </div>
                <div class="bg-white border border-yellow-200 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300 pulse-active">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <span class="text-yellow-600 font-bold text-sm">2</span>
                    </div>
                    <p class="text-xs text-yellow-600 font-medium text-center">Ditinjau admin</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm opacity-60 hover:opacity-80 transition-opacity duration-300">
                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <span class="text-gray-400 font-bold text-sm">3</span>
                    </div>
                    <p class="text-xs text-gray-400 text-center">UMKM aktif</p>
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="animate-fadeup delay-3 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('beranda') }}"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white text-sm
                          font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-md
                          focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('umkm.index') }}"
                    class="px-6 py-3 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 active:scale-95
                          text-gray-700 text-sm font-medium rounded-xl transition-all duration-200
                          focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Lihat Daftar UMKM
                </a>
            </div>

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

</html>