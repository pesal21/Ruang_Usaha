<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Usaha – RuangUsaha</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
        /* Drag & Drop */
        .drag-area {
            border: 2px dashed #cbd5e1;
            transition: border-color 0.2s, background 0.2s;
        }
        .drag-area.active {
            border-color: #3b82f6;
            background: #eff6ff;
        }
        /* Shimmer */
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
        /* Animasi underline */
        .animated-underline {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .animated-underline::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 1.5rem;
            right: 0;
            height: 1.5px;
            background: currentColor;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.25s ease;
        }
        .animated-underline:hover::after {
            transform: scaleX(1);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-sky-50 text-gray-800 min-h-screen flex flex-col">

    {{-- Navbar (dari partial) --}}
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="flex-1 pt-24 pb-20 px-4">
        <div class="max-w-2xl mx-auto">

            {{-- Back link --}}
            <div class="mb-6">
                <a href="{{ route('beranda') }}"
                   class="animated-underline text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            {{-- Hero Text --}}
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-blue-700 to-cyan-600 bg-clip-text text-transparent mb-3">
                    Bergabung Bersama RuangUsaha!
                </h1>
                <p class="text-gray-500 text-sm max-w-md mx-auto leading-relaxed">
                    Daftarkan usahamu untuk memperluas jangkauan dan dikenal oleh masyarakat Bontang.
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

            {{-- Form Card --}}
            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-blue-100 border border-blue-50 p-8 sm:p-10 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-200">

                <h2 class="text-lg font-bold text-gray-800 mb-8 text-center">
                    Formulir Pendaftaran Usaha
                </h2>

                <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5" onsubmit="return handleSubmit(this)">
                    @csrf

                    {{-- Error messages --}}
                    @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">
                        <ul class="text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Nama Usaha + Kategori --}}
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Usaha <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_usaha" required
                                   placeholder="Contoh: Kedai Kopi Senja"
                                   class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm
                                          focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 transition-all duration-200 bg-white placeholder:text-gray-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori Usaha <span class="text-red-500">*</span></label>
                            <select name="kategori_id" required
                                    class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm
                                           focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 transition-all duration-200 bg-white text-gray-600 cursor-pointer appearance-none"
                                    style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%228%22 fill=%22none%22%3E%3Cpath d=%22M1 1l5 5 5-5%22 stroke=%22%236b7280%22 stroke-width=%221.5%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;">
                                <option value="">Pilih kategori</option>
                                @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Singkat Usaha <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi" required rows="4"
                                  placeholder="Jelaskan secara singkat tentang usaha Anda"
                                  class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm
                                         focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 transition-all duration-200 bg-white placeholder:text-gray-400 resize-none"></textarea>
                    </div>

                    {{-- Alamat Lengkap --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="alamat_lengkap" required
                               placeholder="Jalan, Kelurahan, Kecamatan, Kota"
                               class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm
                                      focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 transition-all duration-200 bg-white placeholder:text-gray-400">
                    </div>

                    {{-- Jenis UMKM + Jam Operasional --}}
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jenis UMKM <span class="text-red-500">*</span></label>
                            <select name="jenis_umkm" required
                                    class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm
                                           focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 transition-all duration-200 bg-white text-gray-600 cursor-pointer appearance-none"
                                    style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%228%22 fill=%22none%22%3E%3Cpath d=%22M1 1l5 5 5-5%22 stroke=%22%236b7280%22 stroke-width=%221.5%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;">
                                <option value="">Pilih jenis</option>
                                <option value="Toko Fisik">Toko Fisik</option>
                                <option value="Toko Online">Toko Online</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jam Operasional <span class="text-red-500">*</span></label>
                            <input type="text" name="jam_operasional" required
                                   placeholder="Contoh: 09:00 - 21:00 WITA"
                                   class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm
                                          focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 transition-all duration-200 bg-white placeholder:text-gray-400">
                        </div>
                    </div>

                    {{-- Kontak --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor Kontak / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="kontak" required
                               placeholder="081234567890"
                               class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm
                                      focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 transition-all duration-200 bg-white placeholder:text-gray-400">
                    </div>

                    {{-- Upload Logo --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Upload Logo / Foto Usaha <span class="text-red-500">*</span></label>
                        <div class="drag-area rounded-xl p-8 text-center cursor-pointer hover:border-blue-400 transition-all duration-200 bg-gray-50/80"
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
                                <img id="previewImg" src="" alt="Preview" class="max-h-32 mx-auto rounded-lg object-contain shadow-sm">
                                <p id="fileName" class="text-xs text-gray-500 mt-2"></p>
                            </div>

                            <input type="file" id="logoInput" name="logo" accept=".png,.jpg,.jpeg,.pdf" class="hidden">
                        </div>
                    </div>

                    {{-- Sosial Media --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tautan Sosial Media <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </span>
                            <input type="text" name="sosial_media"
                                   placeholder="https://instagram.com/namausaha"
                                   class="input-glow w-full border-2 border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm
                                          focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 transition-all duration-200 bg-white placeholder:text-gray-400">
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                            class="btn-shimmer w-full py-3.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-semibold rounded-xl 
                                   shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300 hover:scale-[1.02] active:scale-95 
                                   transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-70 disabled:cursor-not-allowed"
                            id="submitBtn">
                        Selesai
                    </button>
                </form>
            </div>
        </div>
    </main>

    @include('partials.footer')

    {{-- Scripts --}}
    <script>
        function handleSubmit(form) {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.textContent = 'Mengirim...';
            return true;
        }

        function toggleDropdown() {
            document.getElementById('profileDropdown').classList.toggle('hidden');
        }
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            if (dropdown && !e.target.closest('.relative')) {
                dropdown.classList.add('hidden');
            }
        });

        // Drag & Drop
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