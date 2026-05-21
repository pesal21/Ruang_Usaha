@extends('admin.layout')

@section('content')

<div class="max-w-3xl mx-auto px-4">

    {{-- HEADER --}}
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Blog</h1>
            <p class="text-gray-400 text-sm mt-1">Perbarui artikel blog yang sudah ada.</p>
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

        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST"
            enctype="multipart/form-data"
            class="space-y-6"
            id="blogForm"
            onsubmit="return handleSubmit(this)">
            @csrf
            @method('PUT')

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
                    value="{{ old('judul', $blog->judul) }}"
                    required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50
                              focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white hover:border-gray-300 transition">
            </div>

            {{-- ISI --}}
            <div>
                <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                    Isi Artikel <span class="text-red-500">*</span>
                </label>
                <textarea name="isi" rows="10" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50
                                 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white
                                 hover:border-gray-300 transition resize-none">{{ old('isi', $blog->isi) }}</textarea>
            </div>

            {{-- GAMBAR --}}
            <div>
                <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">
                    Gambar
                </label>

                @if($blog->gambar)
                <div class="mb-3">
                    <img src="{{ asset('storage/'.$blog->gambar) }}"
                        alt="Gambar saat ini"
                        class="w-40 h-28 object-cover rounded-xl border border-gray-100 shadow-sm">
                    <p class="text-xs text-gray-400 mt-1">Gambar saat ini</p>
                </div>
                @endif

                <input type="file" name="gambar" accept="image/*"
                    class="w-full text-sm text-gray-500 border border-gray-200 rounded-xl
                              px-3 py-2.5 file:mr-3 file:py-1 file:px-3 file:rounded-lg
                              file:border-0 file:text-xs file:font-medium
                              file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 bg-white
                              focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-gray-300 transition">
                <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
            </div>

            {{-- BUTTONS --}}
            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit" id="submitBtn"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white text-sm
                           font-semibold rounded-xl transition-all shadow-sm hover:shadow-md
                           focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-70 disabled:cursor-not-allowed">
                    Simpan Perubahan
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
</script>

@endsection