<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Usaha – RuangUsaha</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        .drag-area {
            border: 2px dashed #cbd5e1;
            transition: border-color 0.2s, background 0.2s;
        }

        .drag-area.active {
            border-color: #3b82f6;
            background: #eff6ff;
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
                <a href="{{ route('beranda') }}" class="text-blue-600 transition">Beranda</a>
                <a href="{{ route('umkm.index') }}" class="hover:text-blue-600 transition">Daftar UMKM</a>
                <a href="#" class="hover:text-blue-600 transition">Kategori</a>
                <a href="#" class="hover:text-blue-600 transition">Blog</a>
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

    <!-- MAIN CONTENT -->
    <main class="pt-24 pb-20 px-4">

        <!-- BACK LINK -->
        <div class="max-w-2xl mx-auto mb-4">
            <a href="{{ route('beranda') }}" class="inline-flex items-center gap-1 text-blue-600 text-sm hover:text-blue-700 hover:underline transition-colors duration-200">
                < Kembali
                    </a>
        </div>

        <!-- HERO TEXT -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Bergabung Bersama RuangUsaha!</h1>
            <p class="text-gray-500 text-sm max-w-md mx-auto leading-relaxed">
                Bergabunglah dengan RuangUsaha untuk memperluas jangkauan<br>
                bisnismu dan dikenal oleh masyarakat Bontang.
            </p>
        </div>

        <!-- FORM CARD -->
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-md transition-shadow duration-300">

            <h2 class="text-center text-base font-semibold text-gray-800 mb-8">
                Formulir Pendaftaran Usaha
            </h2>

            <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5" onsubmit="return handleSubmit(this)">
                @csrf
                {{-- Taruh di atas form, setelah <form ...> --}}
                @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-5">
                    <ul class="text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- NAMA + KATEGORI -->
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">Nama Usaha <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_usaha" required
                            placeholder="Contoh: Kedai Kopi Senja"
                            class="w-full border border-gray-200 rounded-lg py-2.5 px-4 text-sm bg-gray-50
                                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white hover:border-gray-300 transition">
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">Kategori Usaha <span class="text-red-500">*</span></label>
                        <select name="kategori_id" required
                            class="w-full border border-gray-200 rounded-lg py-2.5 px-4 text-sm bg-gray-50
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white hover:border-gray-300 transition text-gray-600 cursor-pointer">
                            <option value="">Pilih kategori</option>
                            @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- DESKRIPSI -->
                <div>
                    <label class="block mb-1.5 text-sm font-medium text-gray-700">Deskripsi Singkat Usaha <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" required rows="4"
                        placeholder="Jelaskan secara singkat tentang usaha Anda"
                        class="w-full border border-gray-200 rounded-lg py-2.5 px-4 text-sm bg-gray-50
                                     focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white hover:border-gray-300 transition resize-none"></textarea>
                </div>

                <!-- ALAMAT -->
                <div>
                    <label class="block mb-1.5 text-sm font-medium text-gray-700">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="alamat_lengkap" required
                        placeholder="Jalan, Kelurahan, Kecamatan, Kota"
                        class="w-full border border-gray-200 rounded-lg py-2.5 px-4 text-sm bg-gray-50
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white hover:border-gray-300 transition">
                </div>

                <!-- JENIS + JAM -->
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">Jenis UMKM <span class="text-red-500">*</span></label>
                        <select name="jenis_umkm" required
                            class="w-full border border-gray-200 rounded-lg py-2.5 px-4 text-sm bg-gray-50
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white hover:border-gray-300 transition text-gray-600 cursor-pointer">
                            <option value="">Pilih jenis</option>
                            <option value="Toko Fisik">Toko Fisik</option>
                            <option value="Toko Online">Toko Online</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">Jam Operasional <span class="text-red-500">*</span></label>
                        <input type="text" name="jam_operasional" required
                            placeholder="Contoh: 09:00 - 21:00 WITA"
                            class="w-full border border-gray-200 rounded-lg py-2.5 px-4 text-sm bg-gray-50
                                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white hover:border-gray-300 transition">
                    </div>
                </div>

                <!-- KONTAK -->
                <div>
                    <label class="block mb-1.5 text-sm font-medium text-gray-700">Nomor Kontak / WhatsApp <span class="text-red-500">*</span></label>
                    <input type="text" name="kontak" required
                        placeholder="081234567890"
                        class="w-full border border-gray-200 rounded-lg py-2.5 px-4 text-sm bg-gray-50
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white hover:border-gray-300 transition">
                </div>

                <!-- UPLOAD LOGO -->
                <div>
                    <label class="block mb-1.5 text-sm font-medium text-gray-700">Upload Logo / Foto Usaha <span class="text-red-500">*</span></label>

                    <div class="drag-area rounded-xl p-8 text-center cursor-pointer hover:border-blue-300 transition-colors"
                        id="dragArea"
                        onclick="document.getElementById('logoInput').click()">

                        <div id="uploadPlaceholder">
                            <svg class="w-10 h-10 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="text-sm text-gray-500">
                                <span class="text-blue-600 font-medium">Klik untuk upload</span> atau seret dan lepas
                            </p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, PDF (maks. 5MB)</p>
                        </div>

                        <div id="uploadPreview" class="hidden">
                            <img id="previewImg" src="" alt="Preview" class="max-h-32 mx-auto rounded-lg object-contain">
                            <p id="fileName" class="text-xs text-gray-500 mt-2"></p>
                        </div>

                        <input type="file" id="logoInput" name="logo" accept=".png,.jpg,.jpeg,.pdf" class="hidden">
                    </div>
                </div>

                <!-- SOSMED -->
                <div>
                    <label class="block mb-1.5 text-sm font-medium text-gray-700">Tautan Sosial Media <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </span>
                        <input type="text" name="sosial_media"
                            placeholder="https://instagram.com/namausaha"
                            class="w-full border border-gray-200 rounded-lg py-2.5 pl-10 pr-4 text-sm bg-gray-50
                                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white hover:border-gray-300 transition">
                    </div>
                </div>

                <!-- SUBMIT -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 active:scale-95 text-white py-3 rounded-xl
                           font-semibold text-sm transition-all duration-200 shadow-sm hover:shadow-md
                           focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-70 disabled:cursor-not-allowed"
                    id="submitBtn">
                    Selesai
                </button>

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

    <script>
        // Pencegahan double submit
        function handleSubmit(form) {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.textContent = 'Mengirim...';
            return true;
        }

        // Dropdown profile
        function toggleDropdown() {
            document.getElementById('profileDropdown').classList.toggle('hidden');
        }
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            if (dropdown && !e.target.closest('.relative')) {
                dropdown.classList.add('hidden');
            }
        });

        // Drag & Drop + Preview
        const dragArea = document.getElementById('dragArea');
        const logoInput = document.getElementById('logoInput');
        const placeholder = document.getElementById('uploadPlaceholder');
        const preview = document.getElementById('uploadPreview');
        const previewImg = document.getElementById('previewImg');
        const fileName = document.getElementById('fileName');

        logoInput.addEventListener('change', () => handleFile(logoInput.files[0]));

        dragArea.addEventListener('dragover', e => {
            e.preventDefault();
            dragArea.classList.add('active');
        });
        dragArea.addEventListener('dragleave', () => dragArea.classList.remove('active'));
        dragArea.addEventListener('drop', e => {
            e.preventDefault();
            dragArea.classList.remove('active');
            const file = e.dataTransfer.files[0];
            if (file) {
                logoInput.files = e.dataTransfer.files;
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
    </script>

</body>

</html>