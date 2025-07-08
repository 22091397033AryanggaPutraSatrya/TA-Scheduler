<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'dosen') {
            // Arahkan ke view dashboard dosen
            // Anda bisa pass data yang relevan ke view dari sini
            return view('dosen.dashboard');
        }

        if ($user->role === 'mahasiswa') {
            // Arahkan ke view dashboard mahasiswa
            return view('mahasiswa.dashboard');
        }
        
        if ($user->role === 'admin') {
            // Arahkan ke view dashboard admin
            return view('admin.dashboard');
        }

        // Fallback jika role tidak ditemukan
        return redirect('/');
    }
}