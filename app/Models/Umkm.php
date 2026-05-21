<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_usaha',
        'kategori_id',
        'deskripsi',
        'alamat_lengkap',
        'jenis_umkm',
        'jam_operasional',
        'kontak',
        'logo',
        'sosial_media',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function produk()
    {
        return $this->hasMany(ProdukUmkm::class, 'umkm_id');
    }

    public function galeri()
    {
        return $this->hasMany(GaleriUmkm::class, 'umkm_id');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
