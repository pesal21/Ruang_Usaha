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

    public function suspend($id)
{
    $umkm = Umkm::findOrFail($id);

    $umkm->status = 'suspended';
    $umkm->save();

    return back()->with('success', 'UMKM berhasil disuspend.');
}

public function activate($id)
{
    $umkm = Umkm::findOrFail($id);

    $umkm->status = 'approved';
    $umkm->save();

    return back()->with('success', 'UMKM berhasil diaktifkan kembali.');
}

public function detailUmkm($id)
{
    $umkm = Umkm::with(['user', 'kategori', 'produk', 'galeri'])
        ->findOrFail($id);

    return view('admin.umkm.detail', compact('umkm'));
}

}
