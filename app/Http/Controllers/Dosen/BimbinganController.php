<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BimbinganController extends Controller
{
    // Menampilkan daftar booking yang masuk untuk dosen
    public function index()
    {
        $bookings = Booking::where('dosen_user_id', Auth::id())
            ->with('mahasiswa') // Eager load data mahasiswa
            ->orderBy('waktu_mulai', 'desc')
            ->get();
            
        return view('dosen.bimbingan.index', compact('bookings'));
    }

    // Mengubah status booking (konfirmasi atau tolak)
    public function update(Request $request, Booking $bimbingan)
    {
        // Pastikan dosen hanya bisa update bimbingan untuk dirinya
        if ($bimbingan->dosen_user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:confirmed,rejected,completed',
        ]);

        $bimbingan->update(['status' => $request->status]);

        // Kirim notifikasi (bisa ditambahkan nanti)

        return redirect()->route('dosen.bimbingan.index')->with('success', 'Status bimbingan berhasil diperbarui.');
    }
}