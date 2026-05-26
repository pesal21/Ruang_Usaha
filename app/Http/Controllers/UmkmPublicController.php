<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\ProdukUmkm; // ✅ benar
use App\Models\GaleriUmkm; // ✅ benar

class UmkmPublicController extends Controller
{
    public function index(Request $request)
    {
        // WAJIB: mulai dari approved dulu
        $query = Umkm::where('status', 'approved');

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_usaha', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat_lengkap', 'like', '%' . $request->search . '%');
            });
        }

        // 🏷 FILTER KATEGORI
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // 🛒 FILTER JENIS UMKM
        if ($request->filled('jenis')) {
            $query->where('jenis_umkm', $request->jenis);
        }

        // ✅ AMBIL DATA SEKALI SAJA
        $umkms = $query->orderBy('created_at', 'desc')->paginate(9);

        // DROPDOWN KATEGORI
        $kategoris = Kategori::orderBy('nama')->get();

        return view('umkm.index', compact('umkms', 'kategoris'));
    }

   public function show($id)
{
    $umkm = Umkm::findOrFail($id);

    $isAdmin = auth()->check() && auth()->user()->role === 'admin';

    // user biasa hanya lihat yang approved
    if (!$isAdmin) {
        $umkm = Umkm::where('status', 'approved')->findOrFail($id);
    }

    $umkm->increment('views');

    $produk = ProdukUmkm::where('umkm_id', $id)->get();
    $galeri = GaleriUmkm::where('umkm_id', $id)->get();

    return view('umkm.show', compact('umkm', 'produk', 'galeri'));
}
}
