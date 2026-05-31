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
                Kelola Kategori
            </h1>
            <p class="text-gray-500 mt-2 text-base">Tambah dan kelola kategori UMKM.</p>
            <div class="mt-5 flex items-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="back-link inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors duration-200 card-animate"
           style="animation-delay: 0.15s;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="relative">
                Kembali ke Dashboard
                <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-current transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
    </div>

    {{-- ── FORM TAMBAH KATEGORI ── --}}
    <div class="card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                hover:shadow-xl hover:shadow-blue-100 transition-all duration-300 p-6 sm:p-8 mb-8"
         style="animation-delay: 0.2s;">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                        flex items-center justify-center shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <h2 class="text-lg font-bold text-gray-800">Tambah Kategori Baru</h2>
        </div>

        <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data"
            onsubmit="return handleSubmit(this)">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                {{-- NAMA KATEGORI --}}
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Nama Kategori <span class="text-red-400">*</span>
                    </label>
                    <input
                        type="text"
                        name="nama_kategori"
                        placeholder="Contoh: Kuliner & Makanan"
                        class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                               bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                               transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium">
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Deskripsi
                    </label>
                    <input
                        type="text"
                        name="deskripsi"
                        placeholder="Contoh: Berbagai usaha kuliner lokal."
                        class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                               bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                               transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium">
                </div>

                {{-- ICON / GAMBAR --}}
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Icon / Gambar
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
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="btn-shimmer inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-teal-500
                           hover:from-blue-700 hover:to-teal-600 text-white text-sm font-semibold rounded-2xl
                           shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300 hover:-translate-y-0.5
                           active:scale-95 transition-all duration-200 disabled:opacity-60 disabled:cursor-not-allowed
                           focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Kategori
                </button>
            </div>
        </form>
    </div>

    {{-- ── TABEL KATEGORI ── --}}
    <div class="card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                overflow-hidden hover:shadow-xl hover:shadow-blue-100 transition-all duration-300"
         style="animation-delay: 0.25s;">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-500 uppercase text-xs tracking-wider border-b border-blue-50 bg-gradient-to-r from-blue-50/60 to-teal-50/40">
                        <th class="px-6 py-4 text-left font-semibold">Icon</th>
                        <th class="px-6 py-4 text-left font-semibold">Nama Kategori</th>
                        <th class="px-6 py-4 text-left font-semibold">Deskripsi</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kategoris as $kategori)
                    <tr class="border-t border-gray-50 hover:bg-blue-50/40 transition-colors duration-200">

                        {{-- ICON --}}
                        <td class="px-6 py-4">
                            @if($kategori->icon)
                            <img src="{{ asset('storage/' . $kategori->icon) }}"
                                alt="{{ $kategori->nama }}"
                                class="w-10 h-10 object-contain rounded-xl bg-gradient-to-br from-blue-50 to-teal-50 p-1.5 shadow-sm">
                            @else
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50 to-teal-50 flex items-center
                                        justify-center text-blue-400 text-xs font-bold shadow-sm">
                                {{ strtoupper(substr($kategori->nama, 0, 1)) }}
                            </div>
                            @endif
                        </td>

                        {{-- NAMA --}}
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $kategori->nama }}
                        </td>

                        {{-- DESKRIPSI --}}
                        <td class="px-6 py-4 text-gray-500">
                            {{ $kategori->deskripsi ?? '—' }}
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4 text-right relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="w-9 h-9 inline-flex items-center justify-center rounded-xl
                                       hover:bg-blue-100 active:scale-95 transition-all duration-200
                                       text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                title="Aksi">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                </svg>
                            </button>

                            {{-- DROPDOWN --}}
                            <div x-show="open" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                @click.away="open = false"
                                class="absolute right-0 top-full mt-1 w-48 bg-white border border-gray-100
                                        rounded-2xl shadow-xl shadow-blue-100 z-[999] overflow-hidden py-1.5">

                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                                    class="dropdown-item w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600
                                           hover:text-blue-600 hover:bg-blue-50/60 transition-all duration-200">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?') && handleSubmit(this)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="dropdown-item w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500
                                               hover:bg-red-50/60 transition-all duration-200
                                               disabled:opacity-60 disabled:cursor-not-allowed">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-20 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-50 to-teal-50 border border-blue-100 flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <span class="text-gray-500 font-semibold text-base">Belum ada kategori.</span>
                                <p class="text-gray-400 text-sm mt-1">Tambahkan kategori baru melalui form di atas.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
    .dropdown-item { transition: all 0.2s ease; }
    .dropdown-item:hover { padding-left: 1.5rem; }
</style>

<script>
    function handleSubmit(form) {
        const btn = form.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = 'Processing...';
        }
        return true;
    }
</script>

@endsection