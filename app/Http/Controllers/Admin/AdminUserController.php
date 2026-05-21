<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
class AdminUserController extends Controller
{
    // Tambahkan method index
    public function index(Request $request)
    {
        $query = User::query();

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER ROLE
        if ($request->role) {
            $query->where('role', $request->role);
        }

        // FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function suspend($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'suspended';
        $user->save();

        return back()->with('success', 'User berhasil disuspend');
    }

    // Tambahkan method activate
    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return back()->with('success', 'User berhasil diaktifkan');
    }
}
