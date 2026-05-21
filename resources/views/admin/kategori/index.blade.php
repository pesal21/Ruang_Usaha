@extends('admin.layout')

@section('content')

<div class="max-w-6xl mx-auto px-4">

    {{-- HEADER --}}
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Kelola Kategori</h1>
            <p class="text-gray-400 text-sm mt-1">Tambah dan kelola kategori UMKM.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300
                  rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50
                  hover:border-gray-400 active:scale-95 shadow-sm transition-all duration-200">
            ← Back to Admin Dashboard
        </a>
    </div>

    {{-- FORM TAMBAH KATEGORI --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 p-6 mb-8">
        <h2 class="text-base font-semibold text-gray-700 mb-5">Tambah Kategori Baru</h2>

        <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data"
            onsubmit="return handleSubmit(this)">
            @csrf

            <div class="grid md:grid-cols-3 gap-4">

                {{-- NAMA KATEGORI --}}
                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block">
                        Nama Kategori
                    </label>
                    <input
                        type="text"
                        name="nama_kategori"
                        placeholder="Contoh: Kuliner & Makanan"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-500
                               hover:border-gray-300 transition-colors duration-200">
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block">
                        Deskripsi
                    </label>
                    <input
                        type="text"
                        name="deskripsi"
                        placeholder="Contoh: Berbagai usaha kuliner lokal."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-500
                               hover:border-gray-300 transition-colors duration-200">
                </div>

                {{-- ICON / GAMBAR --}}
                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block">
                        Icon / Gambar
                    </label>
                    <input
                        type="file"
                        name="icon"
                        accept=".png,.jpg,.jpeg,.svg"
                        class="w-full text-sm text-gray-500 border border-gray-200 rounded-xl
                               px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded-lg
                               file:border-0 file:text-xs file:font-medium
                               file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100
                               focus:outline-none focus:ring-2 focus:ring-blue-500
                               hover:border-gray-300 transition-colors duration-200">
                </div>

            </div>

            <div class="mt-4 flex justify-end">
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white
                           rounded-xl text-sm font-medium transition-all duration-200 shadow-sm
                           disabled:opacity-60 disabled:cursor-not-allowed
                           focus:outline-none focus:ring-2 focus:ring-blue-400">
                    + Tambah Kategori
                </button>
            </div>
        </form>
    </div>

    {{-- TABEL KATEGORI --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-visible">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-gray-400 uppercase text-xs tracking-wide border-b border-gray-100 bg-gray-50">
                    <th class="px-6 py-3 text-left">Icon</th>
                    <th class="px-6 py-3 text-left">Nama Kategori</th>
                    <th class="px-6 py-3 text-left">Deskripsi</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kategoris as $kategori)
                <tr class="border-t border-gray-50 hover:bg-gray-50/80 transition-colors duration-150"
                    x-data="{ edit: false }">

                    {{-- ICON --}}
                    <td class="px-6 py-4">
                        @if($kategori->icon)
                        <img src="{{ asset('storage/' . $kategori->icon) }}"
                            alt="{{ $kategori->nama }}"
                            class="w-10 h-10 object-contain rounded-lg bg-gray-50 p-1">
                        @else
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center
                                        justify-center text-gray-400 text-xs">
                            N/A
                        </div>
                        @endif
                    </td>

                    {{-- NAMA --}}
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $kategori->nama }}
                    </td>

                    {{-- DESKRIPSI --}}
                    <td class="px-6 py-4 text-gray-500">
                        {{ $kategori->deskripsi ?? '-' }}
                    </td>

                    {{-- AKSI --}}
                    <td class="px-6 py-4 text-right" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-8 h-8 inline-flex items-center justify-center rounded-full
                                   hover:bg-gray-200 active:scale-95 transition-all duration-200
                                   text-gray-500 font-bold tracking-tighter focus:outline-none"
                            title="Aksi">
                            •••
                        </button>

                        {{-- DROPDOWN --}}
                        <div x-show="open" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                            @click.away="open = false"
                            class="absolute right-10 mt-1 w-44 bg-white border border-gray-100
                                    rounded-xl shadow-xl z-50 overflow-hidden">

                            {{-- Delete --}}
                            <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?') && handleSubmit(this)">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm text-red-600
                                           hover:bg-red-50 transition-colors duration-150 rounded-b-xl
                                           disabled:opacity-60 disabled:cursor-not-allowed">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>

                {{-- EDIT ROW (muncul di bawah baris saat edit = true) --}}
                <tr x-show="edit" x-cloak
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4"
                    class="bg-blue-50/40 border-t border-blue-100">
                    <td colspan="4" class="px-6 py-4">
                        <form action="{{ route('admin.kategori.update', $kategori->id) }}"
                            method="POST" enctype="multipart/form-data"
                            onsubmit="return handleSubmit(this)">
                            @csrf
                            @method('PUT')

                            <div class="grid md:grid-cols-3 gap-4">

                                <div>
                                    <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block">
                                        Nama Kategori
                                    </label>
                                    <input type="text" name="nama_kategori"
                                        value="{{ $kategori->nama }}"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl
                                                  text-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                                                  bg-white hover:border-gray-300 transition-colors duration-200">
                                </div>

                                <div>
                                    <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block">
                                        Deskripsi
                                    </label>
                                    <input type="text" name="deskripsi"
                                        value="{{ $kategori->deskripsi ?? '' }}"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl
                                                  text-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                                                  bg-white hover:border-gray-300 transition-colors duration-200">
                                </div>

                                <div>
                                    <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 block">
                                        Icon / Gambar Baru
                                    </label>
                                    <input type="file" name="icon" accept=".png,.jpg,.jpeg,.svg"
                                        class="w-full text-sm text-gray-500 border border-gray-200 rounded-xl
                                                  px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded-lg
                                                  file:border-0 file:text-xs file:font-medium
                                                  file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100
                                                  bg-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                                  hover:border-gray-300 transition-colors duration-200">
                                </div>

                            </div>

                            <div class="mt-4 flex gap-3 justify-end">
                                <button type="button" @click="edit = false"
                                    class="px-5 py-2 border border-gray-200 rounded-xl text-sm
                                           text-gray-600 hover:bg-gray-50 active:scale-95 transition-all duration-200">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white
                                           rounded-xl text-sm font-medium transition-all duration-200
                                           disabled:opacity-60 disabled:cursor-not-allowed
                                           focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="4" class="px-6 py-14 text-center text-gray-400 text-sm">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="text-gray-500 font-medium">Belum ada kategori.</span>
                            <p class="text-gray-400 text-xs mt-2">Tambahkan kategori baru melalui form di atas.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script>
    // Mencegah double submit pada form
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