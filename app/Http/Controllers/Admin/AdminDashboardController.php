<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Umkm;
use Carbon\Carbon;
use App\Models\ProdukUmkm;

class AdminDashboardController extends Controller
{
    

    public function index()
    {
        // TOTAL
        $totalUmkm = Umkm::count();
        $activeUsers = User::count();
        $products = ProdukUmkm::count();
        $pendingUmkm = Umkm::where('status', 'pending')->count();
        $newUmkmCount = Umkm::whereDate('created_at', '>=', now()->subDays(30))->count();
        

        // 🔥 UMKM per hari (30 hari terakhir)
        $chartData = Umkm::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
            ->whereDate('created_at', '>=', now()->subDays(365))
            ->groupByRaw('DATE(created_at)')
            ->orderBy('tanggal')
            ->get();
        
        // format ke array
        $labels = $chartData->pluck('tanggal');
        $data = $chartData->pluck('total');

        // 🔥 MOST VIEWED
        $mostViewedUmkm = Umkm::orderByDesc('views')
            ->take(5)
            ->get();

        $days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $days->push(Carbon::now()->subDays($i)->format('Y-m-d'));
        }

        $chartRaw = Umkm::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('tanggal')
            ->pluck('total', 'tanggal');

        $labels = $days->map(function ($day) {
            return Carbon::parse($day)->format('D'); // Sen, Sel, Rab
        });

        $data = $days->map(function ($day) use ($chartRaw) {
            return $chartRaw[$day] ?? 0;
        });

        // total 7 hari
        $newUmkmCount = $data->sum();

        // 7 hari terakhir
        $last7 = Umkm::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        // 7 hari sebelumnya (hari ke-8 s/d ke-14)
        $prev7 = Umkm::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(7)
        ])->count();

        // hitung persen
        if ($prev7 > 0) {
            $percentage = (($last7 - $prev7) / $prev7) * 100;
        } else {
            $percentage = $last7 > 0 ? 100 : 0;
        }

        // bulatkan
        $percentage = round($percentage, 1);


// RANGE WAKTU
$startOfWeek = Carbon::now()->startOfWeek();
$endOfWeek = Carbon::now()->endOfWeek();

$startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
$endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();


// ======================
// UMKM
// ======================
$umkm_now = Umkm::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
$umkm_prev = Umkm::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
$umkm_diff = $umkm_now - $umkm_prev;


// ======================
// USER
// ======================
$user_now = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
$user_prev = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
$user_diff = $user_now - $user_prev;


// ======================
// PRODUK
// ======================
$product_now = ProdukUmkm::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
$product_prev = ProdukUmkm::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
$product_diff = $product_now - $product_prev;


// ======================
// PENDING
// ======================
$pending_now = Umkm::where('status', 'pending')
    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->count();

$pending_prev = Umkm::where('status', 'pending')
    ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
    ->count();

$pending_diff = $pending_now - $pending_prev;

        return view('admin.dashboard', compact(
            'totalUmkm',
            'activeUsers',
            'products',
            'pendingUmkm',
            'labels',
            'data',
            'mostViewedUmkm',
            'newUmkmCount',
            'percentage',
            'umkm_diff',
            'user_diff',
            'product_diff',
            'pending_diff'
        ));
        
    }
    

}
