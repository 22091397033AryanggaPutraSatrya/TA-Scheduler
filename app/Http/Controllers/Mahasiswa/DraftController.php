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
        $tugasAkhir = TugasAkhir::where('mahasiswa_user_id', Auth::id())->firstOrFail();
        $drafts = Draft::where('tugas_akhir_id', $tugasAkhir->id)->orderBy('versi', 'desc')->get();
        
        return view('mahasiswa.draft.index', compact('drafts', 'tugasAkhir'));
    }

    // Mengunggah draft baru
    public function store(StoreDraftRequest $request)
    {
        $tugasAkhir = TugasAkhir::where('mahasiswa_user_id', Auth::id())->firstOrFail();
        
        // 1. Simpan file
        $file = $request->file('file_draft');
        $path = $file->store('drafts/' . $tugasAkhir->id, 'public'); // Simpan ke storage/app/public/drafts/{id_ta}

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

        // Jalankan `php artisan storage:link` di terminal Anda sekali saja
        // agar file bisa diakses publik.

        return redirect()->route('mahasiswa.draft.index')->with('success', 'Draft berhasil diunggah.');
    }
}