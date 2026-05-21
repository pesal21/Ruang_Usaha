@extends('admin.layout')

@section('content')

<div class="max-w-3xl mx-auto px-4">

    {{-- HEADER --}}
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Tambah Blog</h1>
            <p class="text-gray-400 text-sm mt-1">Buat artikel blog baru untuk RuangUsaha.</p>
        </div>
        <a href="{{ route('admin.blog.index') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300
                  rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400
                  active:scale-95 shadow-sm transition-all">
            ← Kembali
        </a>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 p-8">

        <form action="{{ route('admin.blog.store') }}" method="POST"
            enctype="multipart/form-data"
            class="space-y-6"
            id="blogForm"
            onsubmit="return handleSubmit(this)">
            @csrf

            {{-- ERROR --}}
            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- JUDUL --}}
            <div>
                <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                    Judul <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul"
                    value="{{ old('judul') }}"
                    placeholder="Masukkan judul artikel..."
                    required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50
                              focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white hover:border-gray-300 transition">
            </div>

            {{-- ISI --}}
            <div>
                <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                    Isi Artikel <span class="text-red-500">*</span>
                </label>
                <textarea name="isi" rows="12" required
                    placeholder="Tulis isi artikel di sini..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50
                                 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white
                                 hover:border-gray-300 transition resize-none">{{ old('isi') }}</textarea>
            </div>

            {{-- GAMBAR --}}
            <div>
                <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                    Gambar
                </label>

                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center
                            cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-200"
                    id="dropArea"
                    onclick="document.getElementById('gambarInput').click()">
                    <div id="uploadPlaceholder">
                        <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="text-sm text-gray-500">
                            <span class="text-blue-600 font-medium">Klik untuk upload</span> atau seret dan lepas
                        </p>
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG (maks. 5MB)</p>
                    </div>

                    <div id="uploadPreview" class="hidden">
                        <img id="previewImg" src="" alt="Preview"
                            class="max-h-40 mx-auto rounded-lg object-cover mb-2">
                        <p id="fileName" class="text-xs text-gray-400"></p>
                    </div>

                    <input type="file" id="gambarInput" name="gambar"
                        accept="image/*" class="hidden">
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit" id="submitBtn"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white text-sm
                           font-semibold rounded-xl transition-all shadow-sm hover:shadow-md
                           focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-70 disabled:cursor-not-allowed">
                    Simpan Blog
                </button>
                <a href="{{ route('admin.blog.index') }}"
                    class="px-6 py-2.5 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 active:scale-95
                          text-gray-600 text-sm font-medium rounded-xl transition-all">
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