<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }

    public function showRegister() { return view('auth.Register'); }
    // Register Logic
    public function register(Request $request) {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:8|confirmed', // 'confirmed' mencari input name="password_confirmation"
            'phone_number' => 'required|string', // Sesuaikan dengan name di HTML
        ]);

        User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'phone_number'      => '+62' . $data['phone_number'], // Mapping phone_number (HTML) ke phone (Database)
            'password'   => Hash::make($data['password']),
            'role'       => 'admin', // Karena ini form admin
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    // Login Logic
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Update Profile (Phone & Avatar)
public function updateProfile(Request $request) {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Pastikan $user ditemukan sebelum memanggil method save()
        if (!$user) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user->first_name = $request->first_name;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada di storage
            if ($user->avatar) { 
                Storage::disk('public')->delete($user->avatar); 
            }
            
            // Simpan foto baru
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Method save() sekarang akan dikenali oleh IDE karena PHPDoc di atas
        $user->save(); 
        
        return back()->with('success', 'Profile updated!');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}