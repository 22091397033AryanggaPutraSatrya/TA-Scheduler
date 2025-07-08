<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJadwalRequest; // Gunakan Form Request untuk validasi
use App\Models\JadwalTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    // Menampilkan halaman manajemen jadwal
    public function index()
    {
        $jadwalDosen = JadwalTemplate::where('dosen_user_id', Auth::id())->get();
        return view('dosen.jadwal.index', compact('jadwalDosen'));
    }

    // Menyimpan template jadwal baru
    public function store(StoreJadwalRequest $request)
    {
        JadwalTemplate::create([
            'dosen_user_id' => Auth::id(),
            'hari_dalam_minggu' => $request->hari_dalam_minggu,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'durasi_sesi_menit' => $request->durasi_sesi_menit,
        ]);

        return redirect()->route('dosen.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // Menghapus template jadwal
    public function destroy(JadwalTemplate $jadwal)
    {
        // Pastikan dosen hanya bisa menghapus jadwalnya sendiri (Authorization)
        if ($jadwal->dosen_user_id !== Auth::id()) {
            abort(403);
        }

        $jadwal->delete();

        return redirect()->route('dosen.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}