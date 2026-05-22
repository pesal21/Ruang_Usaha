@extends('admin.layout')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative">
    {{-- Orbs dekoratif --}}
    <div class="absolute -top-16 -left-16 w-48 h-48 bg-blue-200/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-200/20 rounded-full blur-3xl pointer-events-none"></div>

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8 relative">
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                Tambah Blog
            </h1>
            <p class="text-gray-500 mt-1.5 text-base">Buat artikel blog baru untuk RuangUsaha.</p>
        </div>
        <a href="{{ route('admin.blog.index') }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-indigo-600 transition-colors duration-200 group">
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

    {{-- FORM CARD --}}
    <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-md border border-blue-50 hover:shadow-lg transition-shadow duration-300 p-6 sm:p-8">

        <form action="{{ route('admin.blog.store') }}" method="POST"
            enctype="multipart/form-data"
            class="space-y-6"
            id="blogForm"
            onsubmit="return handleSubmit(this)">
            @csrf

            {{-- ERROR --}}
            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3 shadow-sm">
                <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <ul class="text-sm text-red-600 space-y-1 list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- JUDUL --}}
            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5 block">
                    Judul <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul"
                    value="{{ old('judul') }}"
                    placeholder="Masukkan judul artikel..."
                    required
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-white
                           focus:outline-none focus:border-blue-400 focus:shadow-[0_0_0_4px_rgba(59,130,246,0.15)]
                           hover:border-blue-300 transition-all duration-200 placeholder:text-gray-400">
            </div>

            {{-- ISI --}}
            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5 block">
                    Isi Artikel <span class="text-red-500">*</span>
                </label>
                <textarea name="isi" rows="12" required
                    placeholder="Tulis isi artikel di sini..."
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-white
                           focus:outline-none focus:border-blue-400 focus:shadow-[0_0_0_4px_rgba(59,130,246,0.15)]
                           hover:border-blue-300 transition-all duration-200 resize-none placeholder:text-gray-400">{{ old('isi') }}</textarea>
            </div>

            {{-- GAMBAR --}}
            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5 block">
                    Gambar
                </label>

                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 sm:p-8 text-center
                            cursor-pointer hover:border-blue-400 hover:bg-blue-50/50 transition-all duration-200 group"
                    id="dropArea"
                    onclick="document.getElementById('gambarInput').click()">
                    <div id="uploadPlaceholder">
                        <svg class="w-10 h-10 text-gray-300 mx-auto mb-3 group-hover:text-blue-400 transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="text-sm text-gray-600">
                            <span class="text-blue-600 font-semibold">Klik untuk upload</span> atau seret dan lepas
                        </p>
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG (maks. 5MB)</p>
                    </div>

                    <div id="uploadPreview" class="hidden">
                        <img id="previewImg" src="" alt="Preview"
                            class="max-h-40 mx-auto rounded-lg object-cover mb-2 shadow-sm ring-2 ring-white">
                        <p id="fileName" class="text-xs text-gray-500"></p>
                    </div>

                    <input type="file" id="gambarInput" name="gambar"
                        accept="image/*" class="hidden">
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-100">
                <button type="submit" id="submitBtn"
                    class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700
                           active:scale-95 text-white text-sm font-semibold rounded-xl transition-all duration-200
                           shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400
                           disabled:opacity-70 disabled:cursor-not-allowed">
                    Simpan Blog
                </button>
                <a href="{{ route('admin.blog.index') }}"
                    class="px-6 py-2.5 border-2 border-gray-200 hover:bg-gray-50 hover:border-gray-300 active:scale-95
                          text-gray-600 text-sm font-medium rounded-xl transition-all duration-200 text-center">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>

<script>
    // Mencegah double submit
    function handleSubmit(form) {
        const btn = document.getElementById('submitBtn');
        if (btn) {
            btn.disabled = true;
            btn.textContent = 'Menyimpan...';
        }
        return true;
    }

    // Drag & Drop + Preview
    const gambarInput = document.getElementById('gambarInput');
    const dropArea = document.getElementById('dropArea');

    gambarInput.addEventListener('change', () => handleFile(gambarInput.files[0]));

    dropArea.addEventListener('dragover', e => {
        e.preventDefault();
        dropArea.classList.add('border-blue-400', 'bg-blue-50');
    });
    dropArea.addEventListener('dragleave', () => dropArea.classList.remove('border-blue-400', 'bg-blue-50'));
    dropArea.addEventListener('drop', e => {
        e.preventDefault();
        dropArea.classList.remove('border-blue-400', 'bg-blue-50');
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
</script>

@endsection