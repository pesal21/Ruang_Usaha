@extends('admin.layout')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative page-enter">
    {{-- Decorative orbs --}}
    <div class="absolute -top-16 -left-16 w-48 h-48 bg-blue-200/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-teal-200/20 rounded-full blur-3xl pointer-events-none"></div>

    {{-- ── HEADER ── --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8 relative">
        <div class="card-animate" style="animation-delay: 0.1s;">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-4 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Admin Panel
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
                Tambah Blog
            </h1>
            <p class="text-gray-500 mt-2 text-base">Buat artikel blog baru untuk RuangUsaha.</p>
            <div class="mt-5 flex items-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        <a href="{{ route('admin.blog.index') }}"
           class="back-link inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors duration-200 card-animate"
           style="animation-delay: 0.15s;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="relative">
                Kembali
                <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-current transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
    </div>

    {{-- ── FORM CARD ── --}}
    <div class="card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                hover:shadow-xl hover:shadow-blue-100 transition-all duration-300 p-6 sm:p-8"
         style="animation-delay: 0.2s;">

        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-100">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-teal-500
                        flex items-center justify-center shadow-lg shadow-blue-200 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Formulir Artikel Blog</h2>
                <p class="text-sm text-gray-500 mt-0.5">Isi data artikel dengan lengkap</p>
            </div>
        </div>

        <form action="{{ route('admin.blog.store') }}" method="POST"
            enctype="multipart/form-data"
            class="space-y-5"
            id="blogForm"
            onsubmit="return handleSubmit(this)">
            @csrf

            {{-- ERROR MESSAGES --}}
            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
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
                        @foreach($errors->all() as $error)
                        <li class="flex items-center gap-1.5">
                            <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- JUDUL --}}
            <div>
                <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                    Judul Artikel <span class="text-red-400">*</span>
                </label>
                <input type="text" name="judul"
                    value="{{ old('judul') }}"
                    placeholder="Masukkan judul artikel..."
                    required
                    class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                           bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                           transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium">
            </div>

            {{-- ISI --}}
            <div>
                <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                    Isi Artikel <span class="text-red-400">*</span>
                </label>
                <textarea name="isi" rows="12" required
                    placeholder="Tulis isi artikel di sini..."
                    class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                           bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                           transition-all duration-300 resize-none placeholder:text-gray-300 text-gray-700 font-medium">{{ old('isi') }}</textarea>
            </div>

            {{-- GAMBAR --}}
            <div>
                <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                    Gambar Artikel
                </label>

                <div class="drag-area rounded-2xl p-8 text-center cursor-pointer"
                    id="dropArea"
                    onclick="document.getElementById('gambarInput').click()">
                    <div id="uploadPlaceholder">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-50 to-teal-50
                                    flex items-center justify-center mx-auto mb-4 shadow-sm">
                            <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 font-medium mb-1">
                            <span class="text-blue-600">Klik untuk upload</span> atau seret dan lepas
                        </p>
                        <p class="text-xs text-gray-400 mt-2">PNG, JPG (maks. 5MB)</p>
                    </div>

                    <div id="uploadPreview" class="hidden">
                        <img id="previewImg" src="" alt="Preview"
                            class="max-h-40 mx-auto rounded-xl object-cover shadow-sm">
                        <p id="fileName" class="text-xs text-gray-500 mt-3 font-medium"></p>
                        <button type="button" onclick="event.stopPropagation(); resetUpload()"
                            class="mt-2 text-xs text-red-500 hover:text-red-600 font-semibold hover:underline transition-colors">
                            Hapus & Ganti File
                        </button>
                    </div>

                    <input type="file" id="gambarInput" name="gambar"
                        accept="image/*" class="hidden">
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t-2 border-blue-50">
                <button type="submit" id="submitBtn"
                    class="btn-shimmer inline-flex items-center justify-center gap-2 px-6 py-3
                           bg-gradient-to-r from-blue-600 to-teal-500 text-white text-sm font-semibold rounded-2xl
                           shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300 hover:-translate-y-0.5
                           active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400
                           disabled:opacity-70 disabled:cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Blog
                </button>
                <a href="{{ route('admin.blog.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3
                          border-2 border-blue-200 text-blue-700 font-semibold text-sm rounded-2xl
                          hover:bg-blue-50 hover:border-blue-300 hover:-translate-y-0.5
                          active:scale-95 transition-all duration-200 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>

<style>
    .back-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: .35rem;
    }
    .back-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 1.5rem;
        right: 0;
        height: 1.5px;
        background: currentColor;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .25s ease;
    }
    .back-link:hover::after { transform: scaleX(1); }
</style>

<script>
    function handleSubmit(form) {
        const btn = document.getElementById('submitBtn');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = 'Menyimpan...';
        }
        return true;
    }

    const gambarInput = document.getElementById('gambarInput');
    const dropArea = document.getElementById('dropArea');

    gambarInput.addEventListener('change', () => handleFile(gambarInput.files[0]));

    dropArea.addEventListener('dragover', e => {
        e.preventDefault();
        dropArea.classList.add('active');
    });
    dropArea.addEventListener('dragleave', () => dropArea.classList.remove('active'));
    dropArea.addEventListener('drop', e => {
        e.preventDefault();
        dropArea.classList.remove('active');
        const file = e.dataTransfer.files[0];
        if (file) {
            gambarInput.files = e.dataTransfer.files;
            handleFile(file);
        }
    });

    function handleFile(file) {
        if (!file) return;
        document.getElementById('fileName').textContent = file.name;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('uploadPreview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    function resetUpload() {
        document.getElementById('gambarInput').value = '';
        document.getElementById('previewImg').src = '';
        document.getElementById('fileName').textContent = '';
        document.getElementById('uploadPlaceholder').classList.remove('hidden');
        document.getElementById('uploadPreview').classList.add('hidden');
    }
</script>

@endsection