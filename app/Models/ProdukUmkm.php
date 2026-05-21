<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukUmkm extends Model
{
    // ⬇️ PENTING
    protected $table = 'produk_umkm';

    protected $fillable = [
        'umkm_id',
        'nama_produk',
        'harga',
        'deskripsi',
        'foto_produk'
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
