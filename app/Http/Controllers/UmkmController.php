<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\ProdukUmkm;
use App\Models\GaleriUmkm;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    // =============================
    // FORM DAFTAR UMKM
    // =============================
    public function create()
    {
        $kategoris = Kategori::orderBy('nama')->get();
        return view('umkm.create', compact('kategoris'));
    }

   

    public function edit($id)
    {
        $umkm = Umkm::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $kategoris = Kategori::all();

        return view('umkm.edit', compact('umkm', 'kategoris'));
    }

    // =============================
    // SIMPAN UMKM
    // =============================
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_usaha'      => 'required|string|max:255',
            'kategori_id'     => 'required|exists:kategoris,id', // ✅
            'deskripsi'       => 'required|string',
            'alamat_lengkap'  => 'required|string',
            'jenis_umkm'      => 'required|string',
            'jam_operasional' => 'required|string',
            'kontak'          => 'nullable|string',
            'sosial_media'    => 'nullable|string',
            'logo'            => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')
                ->store('logo_umkm', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['status']  = 'pending';

        Umkm::create($data);

        return redirect()->route('umkm.success');

    }

    // =============================
    // DASHBOARD UMKM
    // =============================
    public function dashboard($id)
{
    $umkm = Umkm::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    // cek suspend
    if ($umkm->status === 'suspended') {
        return redirect()->route('umkm.pilih')
            ->with('error', 'UMKM Anda sedang disuspend oleh admin.');
    }

    // cek pending
    if ($umkm->status === 'pending') {
        return redirect()->route('umkm.pilih')
            ->with('error', 'UMKM Anda belum disetujui admin.');
    }

    $produk = $umkm->produk;

    return view('umkm.dashboard', compact('umkm', 'produk'));
}
    // =============================
    // KELOLA PRODUK & GALERI
    // =============================
    public function kelola($id)
{
    $umkm = Umkm::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    // cek suspend
    if ($umkm->status === 'suspended') {
        return redirect()->route('umkm.pilih')
            ->with('error', 'UMKM Anda sedang disuspend oleh admin.');
    }

    // cek pending
    if ($umkm->status === 'pending') {
        return redirect()->route('umkm.pilih')
            ->with('error', 'UMKM Anda belum disetujui admin.');
    }

    return view('umkm.kelola-produk-foto', [
        'umkm'   => $umkm,
        'produk' => $umkm->produk,
        'galeri' => $umkm->galeri,
    ]);
}

    // =============================
    // EDIT UMKM
    // =============================
    public function editProduk($id)
{
    $produk = Produkumkm::with('umkm')
        ->where('id', $id)
        ->firstOrFail();

    // keamanan: pastikan pemilik
    if ($produk->umkm->user_id !== Auth::id()) {
        abort(403);
    }

    return view('umkm.edit-produk', compact('produk'));
}

    // =============================
    // UPDATE UMKM
    // =============================
    public function update(Request $request, $id)
    {
        $umkm = Umkm::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $data = $request->validate([
            'nama_usaha'      => 'required|string|max:255',
            'kategori_id'     => 'required|exists:kategoris,id', // ✅ FIX
            'deskripsi'       => 'required|string',
            'alamat_lengkap'  => 'required|string',
            'jenis_umkm'      => 'required|string',
            'jam_operasional' => 'required|string',
            'kontak'          => 'nullable|string',
            'sosial_media'    => 'nullable|string',
            'logo'            => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            if ($umkm->logo) {
                Storage::disk('public')->delete($umkm->logo);
            }

            $data['logo'] = $request->file('logo')
                ->store('logo_umkm', 'public');
        }

        $umkm->update($data);

        return redirect()
            ->route('umkm.dashboard', $umkm->id)
            ->with('success', 'UMKM berhasil diperbarui');
    }

    public function updateProduk(Request $request, $id)
{
    $produk = Produkumkm::with('umkm')->findOrFail($id);

    // keamanan: pastikan produk milik user login
    if ($produk->umkm->user_id !== Auth::id()) {
        abort(403);
    }

    // validasi
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'harga'       => 'required|numeric|min:0',
        'deskripsi'   => 'nullable|string',
    ]);

    // update data
    $produk->update([
        'nama_produk' => $request->nama_produk,
        'harga'       => $request->harga,
        'deskripsi'   => $request->deskripsi,
    ]);

    // redirect kembali ke kelola UMKM
    return redirect()
        ->route('umkm.kelola', $produk->umkm_id)
        ->with('success', 'Produk berhasil diperbarui');
}


    // =============================
    // FORM TAMBAH PRODUK
    // =============================
    public function createProduk($id)
    {
        $umkm = Umkm::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('umkm.tambah-produk', compact('umkm'));
    }

    // =============================
    // SIMPAN PRODUK
    // =============================
    public function storeProduk(Request $request, $id)
    {
        $umkm = Umkm::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'nullable|numeric',
            'deskripsi'   => 'nullable|string',
            'foto_produk' => 'nullable|image|max:5120',
        ]);

        $foto = null;
        if ($request->hasFile('foto_produk')) {
            $foto = $request->file('foto_produk')
                ->store('produk_umkm', 'public');
        }

        ProdukUmkm::create([
            'umkm_id'     => $umkm->id,
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
            'foto_produk' => $foto,
        ]);

        return redirect()
            ->route('umkm.kelola', $umkm->id)
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // =============================
    // HAPUS PRODUK
    // =============================
    public function destroyProduk($id)
    {
        $produk = ProdukUmkm::where('id', $id)
            ->whereHas('umkm', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->firstOrFail();

        if ($produk->foto_produk) {
            Storage::disk('public')->delete($produk->foto_produk);
        }

        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }

    // =============================
    // SIMPAN GALERI
    // =============================
    public function storeGaleri(Request $request, $id)
    {
        $umkm = Umkm::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'foto' => 'required|image|max:5120',
        ]);

        $path = $request->file('foto')
            ->store('galeri_umkm', 'public');

        GaleriUmkm::create([
            'umkm_id' => $umkm->id,
            'foto'    => $path,
        ]);

        return back()->with('success', 'Foto galeri berhasil ditambahkan');
    }

    // =============================
    // HAPUS GALERI FOTO
    // =============================
    public function destroyGaleri($id)
    {
        $galeri = GaleriUmkm::findOrFail($id);

        // Keamanan: pastikan pemilik UMKM
        if ($galeri->umkm->user_id !== Auth::id()) {
            abort(403);
        }

        // Hapus file dari storage
        if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus');
    }

    // =============================
    // DETAIL UMKM (PUBLIC)
    // =============================
    public function show($id)
{
    $umkm = Umkm::findOrFail($id);

    // jika suspend jangan tampil ke publik
    if ($umkm->status === 'suspended') {
        return redirect()->route('beranda')
            ->with('error', 'UMKM ini sedang disuspend admin.');
    }

    $umkm->increment('views');

    return view('umkm.show', compact('umkm'));
}


    public function pilih()
{
    $umkms = auth()->user()->umkms;

    return view('umkm.pilih', compact('umkms'));
}
}
