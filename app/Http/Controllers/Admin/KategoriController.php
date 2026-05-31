<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::orderBy('nama')->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi'     => 'nullable|string|max:500',  // tambah ini
            'icon'          => 'nullable|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')
                ->store('icon_kategori', 'public');
        }

        Kategori::create([
            'nama'      => $data['nama_kategori'],
            'deskripsi' => $data['deskripsi'] ?? null,  // tambah ini
            'icon'      => $data['icon'] ?? null,
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $data = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi'     => 'nullable|string|max:500',  // tambah ini
            'icon'          => 'nullable|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            if ($kategori->icon) {
                Storage::disk('public')->delete($kategori->icon);
            }
            $kategori->icon = $request->file('icon')
                ->store('icon_kategori', 'public');
        }

        $kategori->nama      = $data['nama_kategori'];
        $kategori->deskripsi = $data['deskripsi'] ?? null;  // tambah ini
        $kategori->save();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        if ($kategori->icon) {
            Storage::disk('public')->delete($kategori->icon);
        }

        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
