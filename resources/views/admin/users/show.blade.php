@extends('admin.layout')

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative">
    {{-- Orbs dekoratif --}}
    <div class="absolute -top-16 -left-16 w-48 h-48 bg-blue-200/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-200/20 rounded-full blur-3xl pointer-events-none"></div>

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8 relative">
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                Detail User
            </h1>
            <p class="text-gray-500 mt-1.5 text-base">Informasi akun pengguna</p>
        </div>
        <a href="{{ route('admin.user.index') }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-indigo-600 transition-colors duration-200 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="relative">
                Back to User Accounts
                <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-current transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
    </div>

    {{-- USER CARD --}}
    <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-md border border-blue-50 hover:shadow-lg transition-shadow duration-300 p-6 sm:p-8">

        {{-- AVATAR + NAMA --}}
        <div class="flex flex-col sm:flex-row items-center sm:items-center gap-5 mb-8 pb-8 border-b border-gray-100">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white
                        flex items-center justify-center text-2xl font-bold flex-shrink-0
                        ring-4 ring-blue-100 shadow-lg">
                @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                    alt="{{ $user->name }}"
                    class="w-full h-full object-cover rounded-full">
                @else
                {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div class="text-center sm:text-left">
                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-500 text-sm mt-1">{{ $user->email }}</p>
            </div>
        </div>

        {{-- DETAIL GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="bg-gray-50 rounded-xl p-4 hover:bg-blue-50/50 transition-colors duration-200">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Role</p>
                <p class="font-medium text-gray-800">
                    {{ $user->role === 'admin' ? 'Admin' : 'Business Owner' }}
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 hover:bg-blue-50/50 transition-colors duration-200">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Status Akun</p>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold ring-1 ring-inset
                    {{ $user->status === 'active'
                        ? 'bg-green-50 text-green-700 ring-green-600/20'
                        : 'bg-orange-50 text-orange-700 ring-orange-600/20' }}">
                    {{ ucfirst($user->status) }}
                </span>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 hover:bg-blue-50/50 transition-colors duration-200">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Tanggal Daftar</p>
                <p class="font-medium text-gray-800">{{ $user->created_at->format('d M Y') }}</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 hover:bg-blue-50/50 transition-colors duration-200">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">UMKM</p>
                <p class="font-medium text-gray-800">
                    {{ $user->umkm ? $user->umkm->nama_usaha : 'Belum memiliki UMKM' }}
                </p>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-8 border-t border-gray-100">
            @if($user->status === 'active')
            <form action="{{ route('admin.user.suspend', $user->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin mensuspend user ini?') && handleActionSubmit(this)">
                @csrf
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700
                           active:scale-95 text-white rounded-xl text-sm font-semibold transition-all duration-200
                           shadow-md hover:shadow-lg disabled:opacity-60 disabled:cursor-not-allowed
                           focus:outline-none focus:ring-2 focus:ring-red-400">
                    Deactivate Account
                </button>
            </form>
            @else
            <form action="{{ route('admin.user.activate', $user->id) }}" method="POST"
                onsubmit="return confirm('Aktifkan kembali user ini?') && handleActionSubmit(this)">
                @csrf
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700
                           active:scale-95 text-white rounded-xl text-sm font-semibold transition-all duration-200
                           shadow-md hover:shadow-lg disabled:opacity-60 disabled:cursor-not-allowed
                           focus:outline-none focus:ring-2 focus:ring-green-400">
                    ✅ Activate User
                </button>
            </form>
            @endif
        </div>

    </div>
</div>

<script>
    // Mencegah double submit dengan mengubah tombol menjadi "Processing..."
    function handleActionSubmit(form) {
        const btn = form.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = 'Processing...';
        }
        return true;
    }
</script>

@endsection