@extends('admin.layout')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative page-enter">
    {{-- Decorative orbs --}}
    <div class="absolute -top-16 -left-16 w-48 h-48 bg-blue-200/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-200/20 rounded-full blur-3xl pointer-events-none"></div>

    {{-- ── HEADER ── --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8 relative">
        <div class="card-animate" style="animation-delay: 0.1s;">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-4 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Admin Panel
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
                UMKM Data Management
            </h1>
            <p class="text-gray-500 mt-2 text-base">View and approve registered businesses.</p>
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

    {{-- ── TABLE CARD ── --}}
    <div class="card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                overflow-hidden hover:shadow-xl hover:shadow-blue-100 transition-all duration-300"
         style="animation-delay: 0.2s;">

        {{-- SEARCH + FILTER BAR --}}
        <div class="flex flex-col lg:flex-row lg:items-center gap-3 px-6 py-5 border-b border-blue-50 bg-gradient-to-r from-blue-50/30 to-white">
            <form method="GET" class="flex flex-col sm:flex-row sm:items-center gap-3 w-full">
                {{-- Search --}}
                <div class="relative w-full sm:w-72 group">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 transition-colors group-focus-within:text-blue-500 pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                    </span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by name, owner..."
                        class="input-field w-full pl-11 pr-4 py-2.5 border-2 border-blue-100 rounded-xl text-sm
                               bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                               hover:border-blue-300 transition-all duration-200 placeholder:text-gray-400">
                </div>

                {{-- Filter & Sort --}}
                <div class="flex flex-wrap items-center gap-2 sm:ml-auto">
                    <select name="status"
                        class="input-field px-4 py-2.5 border-2 border-blue-100 rounded-xl text-sm bg-white/80 backdrop-blur-sm
                               focus:outline-none focus:border-blue-400 hover:border-blue-300 text-gray-600 cursor-pointer transition-all duration-200 appearance-none"
                        style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%228%22 fill=%22none%22%3E%3Cpath d=%22M1 1l5 5 5-5%22 stroke=%22%236b7280%22 stroke-width=%221.5%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;">
                        <option value="all">All Status</option>
                        <option value="approved" @selected(request('status')=='approved')>Approved</option>
                        <option value="pending" @selected(request('status')=='pending')>Pending</option>
                        <option value="rejected" @selected(request('status')=='rejected')>Rejected</option>
                    </select>

                    <select name="sort"
                        class="input-field px-4 py-2.5 border-2 border-blue-100 rounded-xl text-sm bg-white/80 backdrop-blur-sm
                               focus:outline-none focus:border-blue-400 hover:border-blue-300 text-gray-600 cursor-pointer transition-all duration-200 appearance-none"
                        style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%228%22 fill=%22none%22%3E%3Cpath d=%22M1 1l5 5 5-5%22 stroke=%22%236b7280%22 stroke-width=%221.5%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;">
                        <option value="">Sort By</option>
                        <option value="newest" @selected(request('sort')=='newest')>Newest</option>
                        <option value="oldest" @selected(request('sort')=='oldest')>Oldest</option>
                        <option value="name" @selected(request('sort')=='name')>Name A–Z</option>
                    </select>

                    <button type="submit"
                        class="btn-shimmer px-5 py-2.5 bg-gradient-to-r from-blue-600 to-teal-500 hover:from-blue-700 hover:to-teal-600
                               active:scale-95 transition-all duration-200 text-white rounded-xl text-sm
                               font-semibold shadow-md shadow-blue-200 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Apply Filter
                    </button>
                </div>
            </form>
        </div>

        {{-- ── TABLE ── --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-500 uppercase text-xs tracking-wider border-b border-blue-50 bg-gradient-to-r from-blue-50/60 to-teal-50/40">
                        <th class="px-6 py-4 text-left font-semibold">Business Name</th>
                        <th class="px-6 py-4 text-left font-semibold">Category</th>
                        <th class="px-6 py-4 text-left font-semibold">Owner</th>
                        <th class="px-6 py-4 text-left font-semibold">Registration Date</th>
                        <th class="px-6 py-4 text-left font-semibold">Status</th>
                        <th class="px-6 py-4 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($umkms as $umkm)
                    <tr class="border-t border-gray-50 hover:bg-blue-50/40 transition-colors duration-200">
                        {{-- BUSINESS NAME + LOGO --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100 overflow-hidden flex-shrink-0
                                            flex items-center justify-center text-blue-600 font-bold text-xs shadow-sm">
                                    @if($umkm->logo)
                                    <img src="{{ asset('storage/' . $umkm->logo) }}"
                                        alt="{{ $umkm->nama_usaha }}"
                                        class="w-full h-full object-cover">
                                    @else
                                    {{ strtoupper(substr($umkm->nama_usaha, 0, 1)) }}
                                    @endif
                                </div>
                                <span class="font-semibold text-gray-800">{{ $umkm->nama_usaha }}</span>
                            </div>
                        </td>

                        {{-- CATEGORY --}}
                        <td class="px-6 py-4 text-gray-600 font-medium">
                            {{ $umkm->kategori->nama ?? '—' }}
                        </td>

                        {{-- OWNER --}}
                        <td class="px-6 py-4 text-gray-700 font-medium">
                            {{ $umkm->user->name }}
                        </td>

                        {{-- REGISTRATION DATE --}}
                        <td class="px-6 py-4 text-gray-500">
                            {{ \Carbon\Carbon::parse($umkm->created_at)->format('d M Y') }}
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                @if($umkm->status == 'approved') bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20
                                @elseif($umkm->status == 'pending') bg-amber-50 text-amber-700 ring-1 ring-amber-600/20
                                @elseif($umkm->status == 'suspended') bg-gray-100 text-gray-600 ring-1 ring-gray-400/20
                                @else bg-red-50 text-red-600 ring-1 ring-red-600/20 @endif
                            ">
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                    @if($umkm->status == 'approved') bg-emerald-500
                                    @elseif($umkm->status == 'pending') bg-amber-500
                                    @elseif($umkm->status == 'suspended') bg-gray-400
                                    @else bg-red-500 @endif
                                "></span>
                                {{ ucfirst($umkm->status) }}
                            </span>
                        </td>

                        {{-- ACTIONS (dropdown) --}}
                        <td class="px-6 py-4 text-right relative" x-data="{ open: false }">
                            <button
                                @click="open = !open"
                                class="w-9 h-9 inline-flex items-center justify-center rounded-xl
                                       hover:bg-blue-100 active:scale-95 transition-all duration-200
                                       text-gray-400 hover:text-gray-600 font-bold text-lg leading-none focus:outline-none focus:ring-2 focus:ring-blue-300"
                                title="Actions">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                </svg>
                            </button>

                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                x-cloak
                                @click.away="open = false"
                                class="absolute right-0 top-full mb-2 w-52
                                    bg-white border border-gray-100 rounded-2xl shadow-xl shadow-blue-100 z-[999] overflow-hidden py-1.5">

                                <a href="{{ route('admin.umkm.detail', $umkm->id) }}"
                                   class="dropdown-item flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600
                                          hover:text-blue-600 hover:bg-blue-50/60 transition-all duration-200">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    View Detail
                                </a>

                                @if($umkm->status === 'pending')
                                <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item w-full flex items-center gap-3 px-4 py-2.5 text-sm text-emerald-600
                                               hover:bg-emerald-50/60 transition-all duration-200">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Approve
                                    </button>
                                </form>

                                <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menolak UMKM ini?')">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500
                                               hover:bg-red-50/60 transition-all duration-200">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Reject
                                    </button>
                                </form>
                                @elseif($umkm->status === 'approved')
                                <form action="{{ route('admin.umkm.suspend', $umkm->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin suspend UMKM ini?')">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500
                                               hover:bg-red-50/60 transition-all duration-200">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Suspend
                                    </button>
                                </form>
                                @elseif($umkm->status === 'suspended')
                                <form action="{{ route('admin.umkm.activate', $umkm->id) }}" method="POST"
                                    onsubmit="return confirm('Aktifkan kembali UMKM ini?')">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item w-full flex items-center gap-3 px-4 py-2.5 text-sm text-emerald-600
                                               hover:bg-emerald-50/60 transition-all duration-200">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Activate
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-50 to-teal-50 border border-blue-100 flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                </div>
                                <span class="text-gray-500 font-semibold text-base">Tidak ada data UMKM ditemukan.</span>
                                <p class="text-gray-400 text-sm mt-1">Coba ubah filter atau kata kunci pencarian.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($umkms->hasPages())
        <div class="px-6 py-5 border-t border-blue-50 flex justify-center">
            {{ $umkms->links() }}
        </div>
        @endif

    </div>
</div>

@endsection

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