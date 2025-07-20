<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDraftRequest;
use App\Models\Draft;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DraftController extends Controller
{
    // Menampilkan halaman manajemen draft
    public function index()
    {
        // PERBAIKAN: Gunakan first() untuk menghindari error 404
        $tugasAkhir = TugasAkhir::where('mahasiswa_user_id', Auth::id())->first();

        // Jika tidak ada data TA, kembali ke dashboard dengan pesan error
        if (!$tugasAkhir) {
            return redirect()->route('dashboard')->withErrors('Anda belum memiliki data tugas akhir yang terdaftar.');
        }

        $drafts = Draft::where('tugas_akhir_id', $tugasAkhir->id)->orderBy('versi', 'desc')->get();
        
        // Pastikan nama view ini cocok dengan file Anda, misalnya 'mahasiswa.draft'
        return view('mahasiswa.draft', compact('drafts', 'tugasAkhir'));
    }

    // Mengunggah draft baru
    public function store(StoreDraftRequest $request)
    {
        // PERBAIKAN: Gunakan first() juga di sini
        $tugasAkhir = TugasAkhir::where('mahasiswa_user_id', Auth::id())->first();

        if (!$tugasAkhir) {
            return back()->withErrors('Tidak dapat mengunggah draft karena data tugas akhir tidak ditemukan.');
        }
        
        // 1. Simpan file
        $file = $request->file('file_draft');
        $path = $file->store('drafts/' . $tugasAkhir->id, 'public');

        // 2. Tentukan versi
        $versiTerakhir = Draft::where('tugas_akhir_id', $tugasAkhir->id)->max('versi') ?? 0;
        
        // 3. Simpan data ke database
        Draft::create([
            'tugas_akhir_id' => $tugasAkhir->id,
            'nama_file' => $file->getClientOriginalName(),
            'file_path' => $path,
            'versi' => $versiTerakhir + 1,
            'catatan_mahasiswa' => $request->catatan_mahasiswa,
        ]);

        return redirect()->route('mahasiswa.draft')->with('success', 'Draft berhasil diunggah.');
    }
}