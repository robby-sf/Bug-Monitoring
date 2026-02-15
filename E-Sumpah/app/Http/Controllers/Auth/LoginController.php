<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'nik' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt(['nik' => $request->nik, 'password' => $request->password])) {
        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'nik' => 'NIK atau password salah.',
    ])->onlyInput('nik');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}