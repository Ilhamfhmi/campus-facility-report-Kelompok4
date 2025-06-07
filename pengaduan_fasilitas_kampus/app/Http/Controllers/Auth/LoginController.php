<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\SSOApiHelper;
use App\Models\User;

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
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        $user = User::where('username', $request->username)->first();
        if ($user && $user->role != "mahasiswa") {
            Auth::login($user);
    
            // Redirect ke intended page atau ke dashboard jika tidak ada
            return redirect()->intended(route('dashboard'))->with('success', $remember
                ? 'Anda telah berhasil login dengan Remember Me aktif!'
                : 'Anda telah berhasil login!');
        }

        $token = SSOApiHelper::GetToken($request->username, $request->password);
        
        if ($token != null) {
            if (!$user) {
                $userSSO = SSOApiHelper::GetProfile($token);
                if ($userSSO != null) {
                    $user = User::create([
                        'name' => $userSSO['fullname'],
                        'username' => $userSSO['user'],
                        'password' => bcrypt($request->password),
                        'role' => 'mahasiswa'
                    ]);
                }
            }

            Auth::login($user);
    
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
