<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'      => 'required|numeric|unique:users,nik',
            'name'     => 'required|string|max:255',
            'phone'    => 'required',
            'password' => 'required|min:8|confirmed', 
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->nik . '@epelayanan.com', // fallback jika tidak ada input email
            'nik'      => $request->nik,
            'no_hp'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'user', 
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}