<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    use HasFactory;

    protected $table = 'tugas_akhir';

    protected $fillable = [
        'mahasiswa_user_id',
        'dosen_pembimbing_id',
        'judul',
        'status',
    ];

    /**
     * Relasi ke model User (mahasiswa).
     */
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_user_id');
    }

    /**
     * Relasi ke model User (dosen).
     */
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_pembimbing_id');
    }

    /**
     * Relasi ke model Draft.
     */
    public function drafts()
    {
        return $this->hasMany(Draft::class);
    }
}