<!DOCTYPE html>
<html lang="id">
<!-- Dibuat oleh Muhamad Rizky - 202312070 -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangUsaha – Beranda</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-white text-gray-800">

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

    <!-- ================= HERO ================= -->
    <section class="pt-32 pb-20 px-6 md:px-24 grid md:grid-cols-2 gap-10 items-center">

        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Satu <span class="text-blue-600">Platform</span>, Seribu Peluang untuk
                <span class="text-blue-600">UMKM</span> Bontang.
            </h1>

            <p class="mt-4 text-gray-600">
                Temukan data, profil, dan potensi usaha lokal di satu tempat.
            </p>

            <div class="flex space-x-4 mt-8">

                @guest
                <a href="{{ route('login.role', 'umkm') }}"
                    class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 hover:shadow-lg active:scale-95 transition-all duration-200">
                    Daftarkan Bisnis Anda
                </a>
                @endguest

                @auth
                <a href="{{ auth()->user()->umkm 
                    ? route('umkm.pilih') 
                    : route('umkm.create') }}"
                    class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 hover:shadow-lg active:scale-95 transition-all duration-200">
                    Kelola Bisnis Anda
                </a>
                @endauth

                <a href="{{ route('umkm.index') }}"
                    class="px-6 py-3 border border-gray-400 rounded-md hover:border-blue-600 hover:text-blue-600 active:scale-95 transition-all duration-200">
                    Lihat UMKM
                </a>

            </div>
        </div>

        <div class="flex justify-center">
            <img src="gambar-1.png" alt="hero" class="w-[380px] md:w-[450px] animate-float">
        </div>
    </section>

    <!-- ================= DAFTAR UMKM ================= -->
    <section class="px-6 md:px-24 py-10 text-center">
        <h2 class="text-3xl font-bold">Daftar UMKM</h2>
        <p class="text-gray-500 mt-2">UMKM yang telah terdaftar</p>

        @if($umkms->count())
        <div class="grid grid-cols-2 md:grid-cols-6 gap-6 mt-10">
            @foreach ($umkms as $umkm)
            <div class="bg-white border rounded-xl p-4 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer">

                <!-- ====== BAGIAN GAMBAR (DINAMIS) ====== -->
                <div class="w-20 h-20 rounded-full overflow-hidden mx-auto mb-3
                            flex items-center justify-center
                            @if(!$umkm->logo)
                                bg-blue-600 text-white
                            @else
                                bg-gray-200
                            @endif">

                    @if($umkm->logo)
                    <img src="{{ asset('storage/'.$umkm->logo) }}"
                        class="w-full h-full object-cover">
                    @else
                    <span class="text-2xl font-semibold">
                        {{ strtoupper(substr($umkm->nama_usaha, 0, 1)) }}
                    </span>
                    @endif

                </div>
                <!-- ====== END GAMBAR ====== -->

                <span class="font-semibold text-sm">{{ $umkm->nama_usaha }}</span>
            </div>
            @endforeach
        </div>
        @else
        <p class="mt-10 text-gray-500">Belum ada UMKM.</p>
        @endif
    </section>

    <!-- ================= KATEGORI ================= -->
    <section class="px-6 md:px-24 py-14 bg-gray-50">

        <h2 class="text-3xl font-bold text-center">Kategori UMKM</h2>
        <p class="text-gray-500 text-center mt-2">
            Jelajahi berbagai sektor usaha di Bontang
        </p>

        <div class="grid md:grid-cols-3 gap-6 mt-10">

            @forelse ($kategoris as $kategori)
            <div class="p-6 bg-white shadow-md rounded-xl flex items-start gap-4 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                <div class="w-12 h-12">
                    @if($kategori->icon)
                    <img
                        src="{{ asset('storage/'.$kategori->icon) }}"
                        class="w-full h-full object-contain">
                    @else
                    <div class="w-full h-full bg-gray-200 rounded"></div>
                    @endif
                </div>

                <div>
                    <h3 class="font-semibold text-lg">
                        {{ $kategori->nama }}
                    </h3>
                    <p class="text-gray-500 mt-2">
                        {{ $kategori->deskripsi }}
                    </p>
                </div>
            </div>
            @empty
            <p class="col-span-3 text-center text-gray-500">
                Belum ada kategori.
            </p>
            @endforelse
        </div>

    </section>

    <!-- ================= BLOG ================= -->
    <section class="px-6 md:px-24 py-16">
        <h2 class="text-3xl font-bold text-center mb-2">Blog & Artikel</h2>
        <p class="text-gray-500 text-center mb-10">Tips dan informasi seputar UMKM</p>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse ($blogs ?? [] as $blog)
            <!-- Jika tersedia data blog, bisa disesuaikan -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="h-40 bg-gray-200"></div>
                <div class="p-5">
                    <h3 class="font-semibold text-lg mb-2">{{ $blog->judul }}</h3>
                    <p class="text-gray-500 text-sm">{{ \Illuminate\Support\Str::limit($blog->isi, 80) }}</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 text-sm font-medium hover:underline">Baca selengkapnya →</a>
                </div>
            </div>
            @empty
            <!-- Placeholder blog cards -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="h-40 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center text-blue-600 text-4xl">📝</div>
                <div class="p-5">
                    <h3 class="font-semibold text-lg mb-2">Tips Memulai Usaha</h3>
                    <p class="text-gray-500 text-sm">Panduan praktis bagi pemula yang ingin memulai UMKM.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 text-sm font-medium hover:underline">Baca selengkapnya →</a>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="h-40 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center text-green-600 text-4xl">📊</div>
                <div class="p-5">
                    <h3 class="font-semibold text-lg mb-2">Strategi Digital Marketing</h3>
                    <p class="text-gray-500 text-sm">Cara meningkatkan penjualan lewat pemasaran online.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 text-sm font-medium hover:underline">Baca selengkapnya →</a>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="h-40 bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center text-yellow-600 text-4xl">💡</div>
                <div class="p-5">
                    <h3 class="font-semibold text-lg mb-2">Inovasi Produk Lokal</h3>
                    <p class="text-gray-500 text-sm">Contoh sukses UMKM Bontang yang berinovasi.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 text-sm font-medium hover:underline">Baca selengkapnya →</a>
                </div>
            </div>
            @endforelse
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

    <!-- Animasi float untuk hero image -->
    <style>
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

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
    </style>

    <script>
        function toggleDropdown() {
            document.getElementById('profileDropdown').classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            if (!e.target.closest('.relative')) {
                dropdown?.classList.add('hidden');
            }
        });
    </script>

</body>

</html>