<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function login(Request $request)
    {
        $request->validate(['email' => 'required|string', 'password' => 'required|string']);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role == "siswa") {
                return redirect('/dashboardpeserta')->with('success', 'Berhasil Login');
            }
            if ($user->role == "admin") {
                return redirect('/halamanregis')->with('success', 'Berhasil Login');
            }
        }
        Auth::logout();
        return redirect()->back()->withErrors(['email' => 'Gagal login, Email atau password Anda salah.']);
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect the user to the login page (or any other page)
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}
