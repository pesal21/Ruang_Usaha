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

public function showProduk($id)
{
    // Ambil detail produk
    $produk = ProdukUmkm::findOrFail($id);
    
    // Ambil UMKM yang memiliki produk ini
    $umkm = $produk->umkm;
    
    $isAdmin = auth()->check() && auth()->user()->role === 'admin';
    
    // User biasa hanya bisa lihat produk dari UMKM yang approved
    if (!$isAdmin) {
        abort_unless($umkm->status === 'approved', 403);
    }
    
    // Ambil rekomendasi produk dari UMKM yang sama (kecuali produk yang sedang dilihat)
    // Minimal 2-4 produk
    $rekomendasi = ProdukUmkm::where('umkm_id', $umkm->id)
        ->where('id', '!=', $produk->id)
        ->limit(4)
        ->get();
    
    return view('produk.show', compact('produk', 'umkm', 'rekomendasi'));
}
}
