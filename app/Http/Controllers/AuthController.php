<?php
// Dibuat oleh Faizal darmawan - 202312013
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Umkm;

class AuthController extends Controller
{
    // =====================================================
    // TAMPIL HALAMAN LOGIN
    // =====================================================
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // =====================================================
    // PROSES LOGIN
    // =====================================================
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required',
            'role'     => 'required|in:admin,umkm'
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Akun tidak ditemukan'
            ]);
        }

        // 🔐 CEK ROLE
        if ($user->role !== $request->role) {
            return back()->withErrors([
                'email' => 'Akun ini terdaftar sebagai ' . strtoupper($user->role)
            ]);
        }

        // 🔑 CEK PASSWORD
        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'Email atau password salah'
            ]);
        }

        // 🚀 REDIRECT SESUAI ROLE
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'umkm') {

            if ($user->umkms()->count() > 0) {

                if ($user->umkms()->count() == 1) {
                    return redirect()->route(
                        'umkm.dashboard',
                        $user->umkms->first()->id
                    );
                }

                return redirect()->route('umkm.pilih');
            }

            return redirect()->route('umkm.create');
        }
    }
    



    // =====================================================
    // TAMPIL HALAMAN REGISTER
    // =====================================================
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // =====================================================
    // PROSES REGISTER USER BARU
    // =====================================================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,umkm',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        auth()->login($user);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('umkm.create');
    }


    // =====================================================
    // LOGOUT
    // =====================================================
    public function logout(Request $request)
    {
        Auth::logout();

        // 🔐 Bersihkan session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 🔥 ARAHKAN KE BERANDA
        return redirect()->route('beranda');
    }
}
