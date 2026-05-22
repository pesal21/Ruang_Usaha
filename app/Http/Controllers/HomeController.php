<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Kategori;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $umkms = Umkm::where('status', 'approved')
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();
        
        $kategoris = Kategori::all();
        
        // ✅ Tambahkan query blogs
        $blogs = Blog::orderBy('created_at', 'desc')
            ->limit(3)  // Tampilkan 3 blog terbaru
            ->get();

        return view('beranda', compact('umkms', 'kategoris', 'blogs'));
    }
}
