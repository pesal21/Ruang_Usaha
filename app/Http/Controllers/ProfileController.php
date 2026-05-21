<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        Auth::user()->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function password(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->password_lama, Auth::user()->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password_baru),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }

    public function picture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if (Auth::user()->profile_picture) {
                Storage::disk('public')->delete(Auth::user()->profile_picture);
            }

            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile', 'public');

            Auth::user()->update([
                'profile_picture' => $path,
            ]);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
