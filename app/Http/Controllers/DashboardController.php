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
        // Mengambil data user yang sedang login
        $user = Auth::user();

        if ($user->role === 'dosen') {
            // Arahkan ke view dashboard dosen dan kirim data dosen
            return view('dosen.dashboard', ['dosen' => $user]);
        }

        if ($user->role === 'mahasiswa') {
            // SOLUSI:
            // Kirim variabel $user ke view dengan nama 'mahasiswa'
            return view('mahasiswa.dashboard', ['mahasiswa' => $user]);
        }
        
        if ($user->role === 'admin') {
            // Arahkan ke view dashboard admin dan kirim data admin
            return view('admin.dashboard', ['admin' => $user]);
        }

        // Fallback jika role tidak ditemukan
        return redirect('/');
    }
}