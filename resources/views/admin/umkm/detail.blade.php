@extends('admin.layout')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Detail UMKM
            </h1>

            <p class="text-gray-500 mt-1">
                Informasi lengkap UMKM
            </p>
        </div>

        <a href="{{ route('admin.umkm.data') }}"
           class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-medium transition">
            ← Kembali
        </a>
    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">

        {{-- COVER --}}
        <div class="h-48 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

        <div class="p-8">

            {{-- LOGO + INFO --}}
            <div class="flex flex-col md:flex-row md:items-center gap-6 -mt-20 mb-8">

                <div class="w-32 h-32 rounded-2xl overflow-hidden border-4 border-white shadow-lg bg-white">
                    @if($umkm->logo)
                        <img src="{{ asset('storage/' . $umkm->logo) }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-4xl font-bold text-blue-600">
                            {{ strtoupper(substr($umkm->nama_usaha,0,1)) }}
                        </div>
                    @endif
                </div>

                <div class="pt-10">
                    <h2 class="text-3xl font-bold text-gray-800">
                        {{ $umkm->nama_usaha }}
                    </h2>

                    <p class="text-gray-500 mt-1">
                        {{ $umkm->kategori->nama ?? '-' }}
                    </p>

                    <div class="mt-3">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            @if($umkm->status == 'approved')
                                bg-green-100 text-green-700
                            @elseif($umkm->status == 'pending')
                                bg-yellow-100 text-yellow-700
                            @elseif($umkm->status == 'suspended')
                                bg-gray-200 text-gray-700
                            @else
                                bg-red-100 text-red-700
                            @endif">

                            {{ ucfirst($umkm->status) }}

                        </span>
                    </div>
                </div>
            </div>

            {{-- DETAIL --}}
            <div class="grid md:grid-cols-2 gap-6 mb-8">

                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">
                        Pemilik
                    </h3>

                    <p class="text-gray-600">
                        {{ $umkm->user->name }}
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">
                        Kontak
                    </h3>

                    <p class="text-gray-600">
                        {{ $umkm->kontak ?? '-' }}
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">
                        Jenis UMKM
                    </h3>

                    <p class="text-gray-600">
                        {{ $umkm->jenis_umkm }}
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">
                        Jam Operasional
                    </h3>

                    <p class="text-gray-600">
                        {{ $umkm->jam_operasional }}
                    </p>
                </div>

            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-8">
                <h3 class="font-semibold text-gray-700 mb-2">
                    Deskripsi
                </h3>

                <p class="text-gray-600 leading-relaxed">
                    {{ $umkm->deskripsi }}
                </p>
            </div>

            {{-- ACTION BUTTON --}}
            <div class="flex flex-wrap gap-3">

                @if($umkm->status === 'pending')

                    <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium">
                            ✅ Approve
                        </button>
                    </form>

                    <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium">
                            ❌ Reject
                        </button>
                    </form>

                @elseif($umkm->status === 'approved')

                    <form action="{{ route('admin.umkm.suspend', $umkm->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-5 py-2.5 bg-gray-700 hover:bg-black text-white rounded-xl font-medium">
                            ⛔ Suspend UMKM
                        </button>
                    </form>

                @elseif($umkm->status === 'suspended')

                    <form action="{{ route('admin.umkm.activate', $umkm->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium">
                            ✅ Aktifkan Kembali
                        </button>
                    </form>

                @endif

            </div>

        </div>
    </div>
</div>

@endsection