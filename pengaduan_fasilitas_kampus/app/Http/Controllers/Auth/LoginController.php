<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Redirect ke route 'dashboard' kalau sudah login
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        // Pastikan view login ada di resources/views/login.blade.php
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect ke intended page atau ke dashboard jika tidak ada
            return redirect()->intended(route('dashboard'))->with('success', $remember
                ? 'Anda telah berhasil login dengan Remember Me aktif!'
                : 'Anda telah berhasil login!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect(route('login'))->with('success', 'Anda telah berhasil logout!');
    }
}
