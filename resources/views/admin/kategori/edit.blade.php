@extends('admin.layout')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative page-enter">
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
                Edit Kategori
            </h1>
            <p class="text-gray-500 mt-2 text-base">Perbarui data kategori UMKM.</p>
            <div class="mt-5 flex items-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        <a href="{{ route('admin.kategori.index') }}"
           class="back-link inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors duration-200 card-animate"
           style="animation-delay: 0.15s;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="relative">
                Kembali ke Kelola Kategori
                <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-current transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
    </div>

    {{-- ── FORM EDIT KATEGORI ── --}}
    <div class="card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                hover:shadow-xl hover:shadow-blue-100 transition-all duration-300 p-6 sm:p-8"
         style="animation-delay: 0.2s;">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                        flex items-center justify-center shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h2 class="text-lg font-bold text-gray-800">Edit Kategori: <span class="text-blue-600">{{ $kategori->nama }}</span></h2>
        </div>

        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data"
            onsubmit="return handleSubmit(this)">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                {{-- NAMA KATEGORI --}}
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Nama Kategori <span class="text-red-400">*</span>
                    </label>
                    <input
                        type="text"
                        name="nama_kategori"
                        value="{{ $kategori->nama }}"
                        placeholder="Contoh: Kuliner & Makanan"
                        class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                               bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                               transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium"
                        required>
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Deskripsi
                    </label>
                    <input
                        type="text"
                        name="deskripsi"
                        value="{{ $kategori->deskripsi ?? '' }}"
                        placeholder="Contoh: Berbagai usaha kuliner lokal."
                        class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                               bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                               transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium">
                </div>

                {{-- ICON / GAMBAR --}}
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Icon / Gambar (Opsional)
                    </label>
                    <input
                        type="file"
                        name="icon"
                        accept=".png,.jpg,.jpeg,.svg"
                        class="w-full text-sm text-gray-600 border-2 border-blue-100 rounded-2xl
                               px-4 py-2.5 file:mr-4 file:py-2 file:px-4 file:rounded-xl
                               file:border-0 file:text-xs file:font-semibold
                               file:bg-gradient-to-r file:from-blue-500 file:to-teal-500 file:text-white
                               hover:file:from-blue-600 hover:file:to-teal-600
                               file:transition-all file:duration-200 file:cursor-pointer
                               file:shadow-md file:shadow-blue-200
                               bg-white/80 backdrop-blur-sm focus:outline-none
                               input-field transition-all duration-300">
                    @if($kategori->icon)
                    <p class="text-xs text-gray-500 mt-2">
                        ✓ Icon saat ini: 
                        <img src="{{ asset('storage/' . $kategori->icon) }}" 
                             alt="Icon saat ini" 
                             class="inline-block w-6 h-6 ml-1 rounded-lg">
                    </p>
                    @endif
                </div>
            </div>

            <div class="mt-8 flex flex-wrap gap-3 justify-end">
                <a href="{{ route('admin.kategori.index') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 border-2 border-blue-200 text-blue-700
                          font-semibold text-sm rounded-2xl hover:bg-blue-50 hover:border-blue-300
                          hover:-translate-y-0.5 active:scale-95 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit"
                    class="btn-shimmer inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-teal-500
                           hover:from-blue-700 hover:to-teal-600 text-white text-sm font-semibold rounded-2xl
                           shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300 hover:-translate-y-0.5
                           active:scale-95 transition-all duration-200 disabled:opacity-60 disabled:cursor-not-allowed
                           focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection