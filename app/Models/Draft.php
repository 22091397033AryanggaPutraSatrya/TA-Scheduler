<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    use HasFactory;

    protected $fillable = [
        'tugas_akhir_id',
        'nama_file',
        'file_path',
        'versi',
        'catatan_mahasiswa',
        'feedback_dosen',
    ];

    /**
     * Relasi ke model TugasAkhir.
     */
    public function tugasAkhir()
    {
        return $this->belongsTo(TugasAkhir::class);
    }
}