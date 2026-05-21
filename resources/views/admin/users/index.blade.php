@extends('admin.layout')

@section('content')

<div class="max-w-6xl mx-auto px-4">

    {{-- HEADER --}}
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">User Account Management</h1>
            <p class="text-gray-400 mt-1 text-sm">Manage all registered users.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300
                  rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50
                  hover:border-gray-400 active:scale-95 shadow-sm transition-all duration-200">
            ← Back to Admin Dashboard
        </a>
    </div>

    {{-- SEARCH + FILTER BAR --}}
    <form method="GET" class="flex items-center gap-3 mb-6">

        {{-- Search --}}
        <div class="relative flex-1">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <img src="{{ asset('assets/img/icon_umkm/search.png') }}" alt="Search icon" class="w-4 h-4">
            </span>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name, email..."
                class="pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm w-full
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-400
                       hover:border-gray-300 bg-white transition-colors duration-200">
        </div>

        {{-- User Role Filter --}}
        <select name="role"
            onchange="this.form.submit()"
            class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm bg-white
           focus:outline-none focus:ring-2 focus:ring-blue-500
           hover:border-gray-300 text-gray-600 cursor-pointer transition-colors duration-200">
            <option value="">User Role: All</option>
            <option value="admin" @selected(request('role')=='admin' )>Admin</option>
            <option value="business_owner" @selected(request('role')=='umkm' )>Business Owner</option>
        </select>

        {{-- Status Filter --}}
        <select name="status"
            onchange="this.form.submit()"
            class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm bg-white
           focus:outline-none focus:ring-2 focus:ring-blue-500
           hover:border-gray-300 text-gray-600 cursor-pointer transition-colors duration-200">
            <option value="">Status: All</option>
            <option value="active" @selected(request('status')=='active' )>Active</option>
            <option value="suspended" @selected(request('status')=='suspended' )>Suspended</option>
        </select>

        <button type="submit" class="sr-only">Search</button>
    </form>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-visible hover:shadow-md transition-shadow duration-300">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-gray-400 uppercase text-xs tracking-wide border-b border-gray-100 bg-gray-50">
                    <th class="px-6 py-3 text-left">User</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Role</th>
                    <th class="px-6 py-3 text-left">Date Joined</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                <tr class="border-t border-gray-50 hover:bg-gray-50/80 transition-colors duration-150">

                    {{-- USER --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden flex-shrink-0
                                        flex items-center justify-center text-gray-500 font-semibold text-sm
                                        ring-2 ring-white shadow-sm">
                                @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                    alt="{{ $user->name }}"
                                    class="w-full h-full object-cover rounded-full">
                                @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif
                            </div>
                            <span class="font-medium text-gray-800">{{ $user->name }}</span>
                        </div>
                    </td>

                    {{-- EMAIL --}}
                    <td class="px-6 py-4 text-gray-500">{{ $user->email }}</td>

                    {{-- ROLE --}}
                    <td class="px-6 py-4 text-gray-600">
                        {{ $user->role === 'admin' ? 'Admin' : 'Business Owner' }}
                    </td>

                    {{-- DATE JOINED --}}
                    <td class="px-6 py-4 text-gray-500">
                        {{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}
                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-4">
                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium shadow-sm transition-colors duration-200
                            @if($user->status === 'active') bg-green-100 text-green-700
                            @else bg-orange-100 text-orange-600
                            @endif">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>

                    {{-- ACTIONS --}}
                    <td class="px-6 py-4 text-right relative" x-data="{ open: false }">
                        <button
                            @click="open = !open"
                            class="w-8 h-8 inline-flex items-center justify-center rounded-full
                                   hover:bg-gray-200 active:scale-95 transition-all duration-200
                                   text-gray-500 font-bold tracking-tighter focus:outline-none"
                            title="Actions">
                            •••
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                            x-cloak
                            @click.away="open = false"
                            class="absolute right-4 top-full mt-1 w-44
                                   bg-white border border-gray-100 rounded-xl shadow-xl z-50 overflow-hidden">

                            <a href="{{ route('admin.user.show', $user->id) }}"
                                class="block w-full text-left px-4 py-3 text-sm text-gray-700
                                      hover:bg-gray-50 transition-colors duration-150 rounded-t-xl">
                                <img src="{{ asset('assets/img/icon_umkm/eye.svg') }}" alt="Eye icon representing the view details option in the user actions menu." class="w-4 h-4 inline mr-2">
                                View Details
                            </a>

                            @if($user->status === 'active')
                            <form action="{{ route('admin.user.suspend', $user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin mensuspend user ini?') && handleSubmit(this)">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm text-red-600
                                               hover:bg-red-50 transition-colors duration-150 rounded-b-xl
                                               disabled:opacity-60 disabled:cursor-not-allowed">
                                    <img src="{{ asset('assets/img/icon_umkm/suspend.svg') }}" alt="Suspend User" class="w-4 h-4 inline mr-2">
                                    Suspend User
                                </button>
                            </form>
                            @else
                            <form action="{{ route('admin.user.activate', $user->id) }}" method="POST"
                                onsubmit="return confirm('Aktifkan kembali user ini?') && handleSubmit(this)">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm text-green-600
                                               hover:bg-green-50 transition-colors duration-150 rounded-b-xl
                                               disabled:opacity-60 disabled:cursor-not-allowed">
                                    ✅ Activate User
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-14 text-center text-gray-400 text-sm">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-gray-500 font-medium">Tidak ada user ditemukan.</span>
                            <p class="text-gray-400 text-xs mt-2">Coba ubah filter atau kata kunci pencarian.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION INFO + LINKS --}}
    <div class="flex items-center justify-between mt-6">
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