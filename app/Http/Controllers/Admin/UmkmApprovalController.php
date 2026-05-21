<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmApprovalController extends Controller
{
    
    public function approve(Umkm $umkm)
    {
        $umkm->update([
            'status' => 'approved'
        ]);

        return redirect()->back()->with('success', 'UMKM berhasil disetujui');
    }

    public function reject(Umkm $umkm)
    {
        $umkm->update([
            'status' => 'rejected'
        ]);

        return redirect()->back()->with('success', 'UMKM berhasil ditolak');
    }
}
