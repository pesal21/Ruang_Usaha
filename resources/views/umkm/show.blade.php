<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $umkm->nama_usaha }} – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
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
                <a href="{{ route('beranda') }}" class="hover:text-blue-600 transition">Beranda</a>
                <a href="{{ route('umkm.index') }}" class="text-blue-600 transition">Daftar UMKM</a>
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
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm border rounded-md">LOGIN</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md">SIGN UP</a>
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

                    <div id="profileDropdown" class="hidden absolute right-0 mt-3 w-48 bg-white border rounded-xl shadow-lg overflow-hidden">
                        <a href="{{ route('profile.index') }}" class="block px-4 py-3 text-sm hover:bg-gray-100">Profil Akun</a>

                        @if(auth()->user()->umkm)
                        <a href="{{ route('umkm.dashboard', auth()->user()->umkm->id) }}" class="block px-4 py-3 text-sm hover:bg-gray-100">Dashboard UMKM</a>
                        @else
                        <a href="{{ route('umkm.create') }}" class="block px-4 py-3 text-sm hover:bg-gray-100">Daftarkan UMKM</a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-sm hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- ================= CONTENT ================= -->
    <main class="max-w-5xl mx-auto px-6 pt-28 pb-24">

        <!-- BACK -->
        <a href="{{ route('umkm.index') }}"
            class="inline-flex items-center gap-1.5 text-sm text-blue-600 hover:text-blue-700 hover:underline transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        <!-- ===== HERO CARD ===== -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 p-6 mb-10">
            <div class="flex gap-6 items-start">

                <!-- LOGO -->
                <div class="shrink-0 w-28 h-28 rounded-xl border border-gray-100 bg-gray-50 flex items-center justify-center overflow-hidden">
                    @if($umkm->logo)
                    <img src="{{ asset('storage/' . $umkm->logo) }}" class="w-full h-full object-contain p-2">
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <rect x="2" y="3" width="20" height="14" rx="2" />
                        <path d="M8 21h8M12 17v4" />
                    </svg>
                    @endif
                </div>

                <!-- INFO -->
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $umkm->nama_usaha }}</h1>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed text-justify">{{ $umkm->deskripsi }}</p>

                    <!-- META GRID -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-3 mt-5 text-sm text-gray-600">

                        <!-- Kategori -->
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('assets/img/icon_umkm/kategori.svg') }}"
                                class="w-4 h-4 object-contain" alt="kategori">
                            <span>{{ $umkm->kategori->nama ?? '-' }}</span>
                        </div>

                        <!-- Alamat -->
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('assets/img/icon_umkm/alamat.svg') }}"
                                class="w-4 h-4 object-contain" alt="alamat">
                            <span>{{ $umkm->alamat_lengkap }}</span>
                        </div>

                        <!-- Jam Operasional -->
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('assets/img/icon_umkm/jam_operasional.svg') }}"
                                class="w-4 h-4 object-contain" alt="jam operasional">
                            <span>{{ $umkm->jam_operasional }}</span>
                        </div>

                        <!-- No HP -->
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('assets/img/icon_umkm/telepon.svg') }}"
                                class="w-4 h-4 object-contain" alt="kontak">
                            <span>{{ $umkm->kontak ?? '-' }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- ===== PRODUK ===== -->
        <section class="mb-12">
            <h2 class="text-xl font-bold text-gray-900 mb-5">Produk</h2>

            @if($umkm->produk->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">

                @foreach($umkm->produk as $p)
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                    <div class="h-32 bg-gray-100">
                        @if($p->foto_produk)
                        <img src="{{ asset('storage/'.$p->foto_produk) }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="flex items-center justify-center h-full text-gray-400 text-xs">
                            No Image
                        </div>
                        @endif
                    </div>

                    <div class="p-3">
                        <p class="text-sm font-semibold truncate">{{ $p->nama_produk }}</p>
                        <p class="text-sm font-bold text-blue-600">
                            Rp {{ number_format($p->harga, 0, ',', '.') }}
                        </p>
                    </div>

                </div>
                @endforeach

            </div>
            @else
            <p class="text-sm text-gray-400">Belum ada produk.</p>
            @endif
        </section>

        <!-- ===== FOTO USAHA ===== -->
        <section>
            <h2 class="text-xl font-bold text-gray-900 mb-5">Foto Usaha</h2>

            @if($umkm->galeri->count())
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                @foreach($umkm->galeri as $foto)
                <div class="rounded-xl overflow-hidden border hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ asset('storage/'.$foto->foto) }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                @endforeach

            </div>
            @else
            <p class="text-sm text-gray-400">Belum ada foto usaha.</p>
            @endif
        </section>

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

    <script>
        function toggleDropdown() {
            document.getElementById('profileDropdown').classList.toggle('hidden');
        }
        // Menutup dropdown jika klik di luar
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            if (dropdown && !e.target.closest('.relative')) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>

</html>