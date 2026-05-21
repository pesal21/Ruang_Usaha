<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class AdminUmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Umkm::with('user', 'kategori');

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_usaha', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($user) use ($request) {
                        $user->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        // FILTER STATUS
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // SORT
        if ($request->sort == 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($request->sort == 'name') {
            $query->orderBy('nama_usaha', 'asc');
        } else {
            $query->latest();
        }

        $umkms = $query->paginate(10);

        return view('admin.umkm.data', compact('umkms'));
    }
}
