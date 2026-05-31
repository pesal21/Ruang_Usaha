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
                User Account Management
            </h1>
            <p class="text-gray-500 mt-2 text-base">Manage all registered users.</p>
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

    {{-- ── SEARCH + FILTER BAR ── --}}
    <form method="GET" class="card-animate flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-6
                              bg-white/90 backdrop-blur-sm rounded-2xl p-4 shadow-md border border-blue-50"
          style="animation-delay: 0.2s;">
        {{-- Search --}}
        <div class="relative flex-1 w-full sm:w-auto group">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 transition-colors group-focus-within:text-blue-500 pointer-events-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
            </span>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name, email..."
                class="input-field w-full pl-11 pr-4 py-2.5 border-2 border-blue-100 rounded-xl text-sm
                       bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                       hover:border-blue-300 transition-all duration-200 placeholder:text-gray-400">
        </div>

        {{-- User Role Filter --}}
        <select name="role"
            onchange="this.form.submit()"
            class="input-field px-4 py-2.5 border-2 border-blue-100 rounded-xl text-sm bg-white/80 backdrop-blur-sm
                   focus:outline-none focus:border-blue-400 hover:border-blue-300 text-gray-600 cursor-pointer transition-all duration-200 appearance-none"
            style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%228%22 fill=%22none%22%3E%3Cpath d=%22M1 1l5 5 5-5%22 stroke=%22%236b7280%22 stroke-width=%221.5%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;">
            <option value="">All Roles</option>
            <option value="admin" @selected(request('role')=='admin')>Admin</option>
            <option value="umkm" @selected(request('role')=='umkm')>Business Owner</option>
        </select>

        {{-- Status Filter --}}
        <select name="status"
            onchange="this.form.submit()"
            class="input-field px-4 py-2.5 border-2 border-blue-100 rounded-xl text-sm bg-white/80 backdrop-blur-sm
                   focus:outline-none focus:border-blue-400 hover:border-blue-300 text-gray-600 cursor-pointer transition-all duration-200 appearance-none"
            style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%228%22 fill=%22none%22%3E%3Cpath d=%22M1 1l5 5 5-5%22 stroke=%22%236b7280%22 stroke-width=%221.5%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;">
            <option value="">All Status</option>
            <option value="active" @selected(request('status')=='active')>Active</option>
            <option value="suspended" @selected(request('status')=='suspended')>Suspended</option>
        </select>

        <button type="submit" class="sr-only">Search</button>
    </form>

    {{-- ── TABLE CARD ── --}}
    <div class="card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                overflow-hidden hover:shadow-xl hover:shadow-blue-100 transition-all duration-300"
         style="animation-delay: 0.25s;">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-500 uppercase text-xs tracking-wider border-b border-blue-50 bg-gradient-to-r from-blue-50/60 to-teal-50/40">
                        <th class="px-6 py-4 text-left font-semibold">User</th>
                        <th class="px-6 py-4 text-left font-semibold">Email</th>
                        <th class="px-6 py-4 text-left font-semibold">Role</th>
                        <th class="px-6 py-4 text-left font-semibold">Date Joined</th>
                        <th class="px-6 py-4 text-left font-semibold">Status</th>
                        <th class="px-6 py-4 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-t border-gray-50 hover:bg-blue-50/40 transition-colors duration-200">
                        {{-- USER --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100 overflow-hidden flex-shrink-0
                                            flex items-center justify-center text-blue-600 font-bold text-xs shadow-sm">
                                    @if($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                        alt="{{ $user->name }}"
                                        class="w-full h-full object-cover">
                                    @else
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                    @endif
                                </div>
                                <span class="font-semibold text-gray-800">{{ $user->name }}</span>
                            </div>
                        </td>

                        {{-- EMAIL --}}
                        <td class="px-6 py-4 text-gray-500 font-medium">{{ $user->email }}</td>

                        {{-- ROLE --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                @if($user->role === 'admin') bg-purple-50 text-purple-700 ring-1 ring-purple-600/20
                                @else bg-blue-50 text-blue-700 ring-1 ring-blue-600/20 @endif">
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                    @if($user->role === 'admin') bg-purple-500
                                    @else bg-blue-500 @endif
                                "></span>
                                {{ $user->role === 'admin' ? 'Admin' : 'Business Owner' }}
                            </span>
                        </td>

                        {{-- DATE JOINED --}}
                        <td class="px-6 py-4 text-gray-500">
                            {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                @if($user->status === 'active') bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20
                                @else bg-amber-50 text-amber-700 ring-1 ring-amber-600/20 @endif">
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                    @if($user->status === 'active') bg-emerald-500
                                    @else bg-amber-500 @endif
                                "></span>
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-6 py-4 text-right relative" x-data="{ open: false }">
                            <button
                                @click="open = !open"
                                class="w-9 h-9 inline-flex items-center justify-center rounded-xl
                                       hover:bg-blue-100 active:scale-95 transition-all duration-200
                                       text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-300"
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
                                class="absolute right-0 top-full mb-2 w-48
                                    bg-white border border-gray-100 rounded-2xl shadow-xl shadow-blue-100 z-[999] overflow-hidden py-1.5">

                                <a href="{{ route('admin.user.show', $user->id) }}"
                                   class="dropdown-item flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600
                                          hover:text-blue-600 hover:bg-blue-50/60 transition-all duration-200">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    View Details
                                </a>

                                @if($user->status === 'active')
                                <form action="{{ route('admin.user.suspend', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin mensuspend user ini?') && handleSubmit(this)">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500
                                               hover:bg-red-50/60 transition-all duration-200
                                               disabled:opacity-60 disabled:cursor-not-allowed">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Suspend User
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('admin.user.activate', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Aktifkan kembali user ini?') && handleSubmit(this)">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item w-full flex items-center gap-3 px-4 py-2.5 text-sm text-emerald-600
                                               hover:bg-emerald-50/60 transition-all duration-200
                                               disabled:opacity-60 disabled:cursor-not-allowed">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Activate User
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
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <span class="text-gray-500 font-semibold text-base">Tidak ada user ditemukan.</span>
                                <p class="text-gray-400 text-sm mt-1">Coba ubah filter atau kata kunci pencarian.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── PAGINATION ── --}}
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6 card-animate" style="animation-delay: 0.3s;">
        <p class="text-sm text-gray-500">
            Showing
            <span class="font-semibold text-gray-700">{{ $users->firstItem() ?? 0 }}</span>
            to
            <span class="font-semibold text-gray-700">{{ $users->lastItem() ?? 0 }}</span>
            of
            <span class="font-semibold text-gray-700">{{ $users->total() }}</span>
            results
        </p>
        <div>
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<script>
    function handleSubmit(form) {
        const buttons = form.querySelectorAll('button[type="submit"]');
        buttons.forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = 'Processing...';
        });
        return true;
    }
</script>

@endsection