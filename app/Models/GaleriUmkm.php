<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriUmkm extends Model
{
    protected $table = 'galeri_umkm';

    protected $fillable = ['umkm_id', 'foto'];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
