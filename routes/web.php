<?php
// Dibuat oleh Faizal darmawan - 202312013
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UmkmPublicController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UmkmApprovalController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AdminUmkmController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\BlogController;
use App\Models\Umkm;

/*
|--------------------------------------------------------------------------
| LANDING / PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/beranda', [HomeController::class, 'index']);

Route::get('/umkm', [UmkmPublicController::class, 'index'])
    ->name('umkm.index');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// LOGIN
Route::get('/login', fn() => view('auth.login', ['role' => null]))
    ->name('login');

Route::get('/login/{role}', function ($role) {
    abort_unless(in_array($role, ['admin', 'umkm']), 404);
    return view('auth.login', compact('role'));
})->name('login.role');

Route::post('/login-process', [AuthController::class, 'login'])
    ->name('login.process');

// REGISTER UMKM
Route::get('/register', fn() => view('auth.register'))
    ->name('register');

Route::post('/register-process', [AuthController::class, 'register'])
    ->name('register.process');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profil', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::post('/profil/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::post('/profil/password', [ProfileController::class, 'password'])
        ->name('profile.password');

    Route::post('/profile/picture', [ProfileController::class, 'picture'])->name('profile.picture');
});


/*
|--------------------------------------------------------------------------
| UMKM (AUTH)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // CREATE UMKM (WAJIB DI ATAS)
    Route::get('/umkm/create', [UmkmController::class, 'create'])
        ->name('umkm.create');

    Route::post('/umkm/store', [UmkmController::class, 'store'])
        ->name('umkm.store');

    Route::get('/umkm/{id}/edit', [UmkmController::class, 'edit'])
        ->name('umkm.edit');

    Route::put('/umkm/{id}/update', [UmkmController::class, 'update'])
        ->name('umkm.update');

    Route::get('/umkm/{id}/kelola', [UmkmController::class, 'kelola'])
        ->name('umkm.kelola');

    // PRODUK
    Route::get('/umkm/{id}/produk/create', [UmkmController::class, 'createProduk'])
        ->name('umkm.produk.create');

    Route::post('/umkm/{id}/produk/store', [UmkmController::class, 'storeProduk'])
        ->name('umkm.produk.store');

    Route::get('/produk/{id}/edit', [UmkmController::class, 'editProduk'])
        ->name('produk.edit');

    Route::put('/produk/{id}', [UmkmController::class, 'updateProduk'])
        ->name('produk.update');

    Route::delete('/produk/{id}', [UmkmController::class, 'destroyProduk'])
        ->name('produk.destroy');

    // GALERI
    Route::post('/umkm/{id}/galeri', [UmkmController::class, 'storeGaleri'])
        ->name('umkm.galeri.store');

    Route::delete('/umkm/galeri/{id}', [UmkmController::class, 'destroyGaleri'])
        ->name('umkm.galeri.destroy');
});


/*
|--------------------------------------------------------------------------
| DASHBOARD UMKM
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {

        $user = auth()->user();

        abort_unless($user->role === 'umkm', 403);

        if (!$user->umkm) {
            return redirect()->route('umkm.create')
                ->with('info', 'Silakan lengkapi data UMKM terlebih dahulu');
        }

        if ($user->umkm->status !== 'approved') {
            return redirect()->route('umkm.create')
                ->with('info', 'UMKM Anda sedang menunggu persetujuan admin');
        }

        return redirect()->route('umkm.dashboard', $user->umkm->id);
    })->name('dashboard.umkm');


    Route::get('/umkm/{umkm}/dashboard', function (Umkm $umkm) {

    abort_unless(auth()->user()->id === $umkm->user_id, 403);

    // jika pending
    if ($umkm->status === 'pending') {
        abort(403, 'UMKM belum disetujui admin');
    }

    // jika suspended
    if ($umkm->status === 'suspended') {
        abort(403, 'UMKM sedang disuspend admin');
    }

    $produk = $umkm->produk;
     $isAdmin = auth()->check() && auth()->user()->role === 'admin';

    return view('umkm.dashboard', compact('umkm', 'produk'));
})->name('umkm.dashboard');

    Route::get('/pilih-umkm', [UmkmController::class, 'pilih'])->name('umkm.pilih');
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::post('/admin/umkm/{umkm}/approve', [UmkmApprovalController::class, 'approve'])
        ->name('admin.umkm.approve');

    Route::post('/admin/umkm/{umkm}/reject', [UmkmApprovalController::class, 'reject'])
        ->name('admin.umkm.reject');

    Route::get('/admin/umkm/data', [AdminUmkmController::class, 'index'])
        ->name('admin.umkm.data');

    // Yang sudah ada (jangan diubah)
    Route::get('/admin/users/{user}', [AdminUserController::class, 'show'])
        ->name('admin.user.show')
        ->middleware(['auth', 'admin']);

    Route::post('/admin/user/{id}/suspend', [AdminUserController::class, 'suspend'])
        ->name('admin.user.suspend')
        ->middleware(['auth', 'admin']);

    // Tambahkan 2 route ini
    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.user.index')
        ->middleware(['auth', 'admin']);

    Route::post('/admin/user/{id}/activate', [AdminUserController::class, 'activate'])
        ->name('admin.user.activate')
        ->middleware(['auth', 'admin']);
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/kategori', [KategoriController::class, 'index'])
        ->name('admin.kategori.index');

    Route::post('/admin/kategori', [KategoriController::class, 'store'])
        ->name('admin.kategori.store');

    Route::put('/admin/kategori/{kategori}', [KategoriController::class, 'update'])
        ->name('admin.kategori.update');

    Route::delete('/admin/kategori/{kategori}', [KategoriController::class, 'destroy'])
        ->name('admin.kategori.destroy');
});

Route::get('/umkm/success', function () {
    return view('umkm.success');
})->name('umkm.success');

/*
|--------------------------------------------------------------------------
| UMKM PUBLIC DETAIL (PALING BAWAH)
|--------------------------------------------------------------------------
*/

Route::get('/umkm/{id}', [UmkmPublicController::class, 'show'])
    ->name('umkm.show');

Route::get('/blog', [BlogController::class, 'index'])
    ->name('blog.index');

Route::get('/blog/{id}', [BlogController::class, 'show'])
    ->name('blog.show');


Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/blog', [BlogController::class, 'adminIndex'])->name('admin.blog.index');

    Route::get('/blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('admin.blog.store');

    Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/blog/{id}', [BlogController::class, 'update'])->name('admin.blog.update');

    Route::post('/blog/{id}/delete', [BlogController::class, 'destroy'])->name('admin.blog.delete');
});

Route::post('/admin/umkm/{id}/suspend', [AdminUmkmController::class, 'suspend'])
    ->name('admin.umkm.suspend');

Route::post('/admin/umkm/{id}/activate', [AdminUmkmController::class, 'activate'])
    ->name('admin.umkm.activate');


Route::get('/admin/umkm/{id}', [AdminUmkmController::class, 'detailUmkm'])
    ->name('admin.umkm.detail');