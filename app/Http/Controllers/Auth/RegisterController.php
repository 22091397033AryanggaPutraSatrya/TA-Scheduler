<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('register');
    }

    // Memproses data registrasi
    public function register(Request $request)
    {
        // 1. Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash!
            'role' => 'mahasiswa', // Default role
        ]);

        // 3. Login-kan user secara otomatis
        Auth::login($user);

        // 4. Arahkan ke dashboard
        return redirect('/dashboard'); // Ganti dengan route dashboard Anda
    }
}