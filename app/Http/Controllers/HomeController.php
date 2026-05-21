<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index()
    {
        $umkms = Umkm::where('status', 'approved')
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();
        $kategoris = Kategori::all();

        return view('beranda', compact('umkms', 'kategoris'));
    }
}
