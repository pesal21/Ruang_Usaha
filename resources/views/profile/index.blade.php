<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Akun – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }

        /* Drag & drop area */
        .drag-area {
            border: 2px dashed #cbd5e1;
            transition: border-color 0.2s, background 0.2s;
        }
        .drag-area.active {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        /* Input focus glow */
        .input-glow:focus {
            box-shadow: 0 0 0 4px rgba(59,130,246,0.15), 0 4px 12px rgba(59,130,246,0.1);
        }

        /* Shimmer effect untuk tombol utama */
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
        .btn-shimmer:hover::after { left: 160%; }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-sky-50 text-gray-800 min-h-screen flex flex-col">

    {{-- Navbar modern --}}
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="flex-1 max-w-3xl mx-auto w-full px-4 sm:px-6 pt-28 pb-16">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-blue-700 to-cyan-600 bg-clip-text text-transparent">
                Profil Akun
            </h1>
            <p class="text-gray-500 text-sm mt-1">Kelola informasi akun dan keamanan Anda.</p>
        </div>

        {{-- Success message --}}
        @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- Foto Profil Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-blue-100 border border-blue-50 p-6 mb-6 
                    hover:shadow-2xl hover:shadow-blue-200 transition-shadow duration-300">
            <h2 class="text-base font-semibold text-gray-800 mb-6">Foto Profil</h2>

            <div class="grid md:grid-cols-2 gap-8">
                {{-- Foto Saat Ini --}}
                <div class="flex flex-col items-center justify-center">
                    @if(auth()->user()->profile_picture)
                        <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}"
                             alt="Profile Picture"
                             class="w-28 h-28 rounded-full object-cover border-4 border-blue-100 shadow-md mb-3">
                    @else
                        <div class="w-28 h-28 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 text-white flex items-center 
                                    justify-center text-4xl font-bold border-4 border-blue-100 shadow-md mb-3">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <p class="text-xs text-gray-400">
                        {{ auth()->user()->profile_picture ? 'Foto profil saat ini' : 'Belum ada foto profil' }}
                    </p>
                </div>

                {{-- Upload Form --}}
                <div>
                    <form method="POST" action="{{ route('profile.picture') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="drag-area rounded-xl p-6 text-center cursor-pointer mb-3 bg-gray-50/80 hover:border-blue-400 transition-colors"
                             id="dragArea"
                             onclick="document.getElementById('photoInput').click()">

                            <div id="uploadPlaceholder">
                                <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="text-sm text-gray-500">
                                    <span class="text-blue-600 font-medium">Klik untuk upload</span> atau seret dan lepas
                                </p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG (maks. 2MB)</p>
                            </div>

                            <div id="uploadPreview" class="hidden">
                                <img id="previewImg" src="" alt="Preview"
                                     class="w-20 h-20 rounded-full object-cover mx-auto mb-2 shadow-sm">
                                <p id="fileName" class="text-xs text-gray-400"></p>
                            </div>

                            <input type="file" id="photoInput" name="profile_picture" accept="image/*" class="hidden">
                        </div>

                        @error('profile_picture')
                        <p class="text-xs text-red-500 mb-2">{{ $message }}</p>
                        @enderror

                        <button type="submit"
                                class="btn-shimmer w-full py-2.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white text-sm 
                                       font-semibold rounded-xl shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300 
                                       hover:scale-[1.02] active:scale-95 transition-all duration-300">
                            Simpan Foto Profil
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Informasi Akun Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-blue-100 border border-blue-50 p-6 mb-6 
                    hover:shadow-2xl hover:shadow-blue-200 transition-shadow duration-300">
            <h2 class="text-base font-semibold text-gray-800 mb-5">Informasi Akun</h2>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block">Nama</label>
                    <input type="text" name="name"
                           value="{{ old('name', auth()->user()->name) }}"
                           class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm 
                                  focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 
                                  transition-all duration-200 bg-white placeholder:text-gray-400">
                    @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block">Email</label>
                    <input type="email" name="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm 
                                  focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 
                                  transition-all duration-200 bg-white placeholder:text-gray-400">
                    @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="btn-shimmer px-6 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white text-sm 
                                   font-semibold rounded-xl shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300 
                                   hover:scale-[1.02] active:scale-95 transition-all duration-300">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Ubah Password Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-blue-100 border border-blue-50 p-6 
                    hover:shadow-2xl hover:shadow-blue-200 transition-shadow duration-300">
            <h2 class="text-base font-semibold text-gray-800 mb-5">Ubah Password</h2>

            <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block">Password Lama</label>
                    <input type="password" name="password_lama"
                           class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm 
                                  focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 
                                  transition-all duration-200 bg-white placeholder:text-gray-400">
                    @error('password_lama')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block">Password Baru</label>
                    <input type="password" name="password_baru"
                           class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm 
                                  focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 
                                  transition-all duration-200 bg-white placeholder:text-gray-400">
                </div>

                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block">Konfirmasi Password Baru</label>
                    <input type="password" name="password_baru_confirmation"
                           class="input-glow w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm 
                                  focus:outline-none focus:border-blue-400 focus:ring-0 hover:border-blue-300 
                                  transition-all duration-200 bg-white placeholder:text-gray-400">
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="px-6 py-2.5 bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded-xl 
                                   shadow-md hover:shadow-lg hover:scale-[1.02] active:scale-95 transition-all duration-300">
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>

    </main>

    {{-- Footer modern --}}
    @include('partials.footer')

    {{-- Script drag & drop --}}
    <script>
        const dragArea = document.getElementById('dragArea');
        const photoInput = document.getElementById('photoInput');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(e => {
            dragArea.addEventListener(e, ev => { ev.preventDefault(); ev.stopPropagation(); });
        });
        ['dragenter', 'dragover'].forEach(e => dragArea.addEventListener(e, () => dragArea.classList.add('active')));
        ['dragleave', 'drop'].forEach(e => dragArea.addEventListener(e, () => dragArea.classList.remove('active')));

        dragArea.addEventListener('drop', e => {
            photoInput.files = e.dataTransfer.files;
            handleFiles(e.dataTransfer.files);
        });
        photoInput.addEventListener('change', () => handleFiles(photoInput.files));

        function handleFiles(files) {
            if (!files.length) return;
            const file = files[0];
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                return;
            }
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('uploadPlaceholder').classList.add('hidden');
                document.getElementById('uploadPreview').classList.remove('hidden');
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('fileName').textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    </script>

</body>
</html>