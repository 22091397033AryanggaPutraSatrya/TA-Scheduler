<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTemplate extends Model
{
    use HasFactory;

    protected $table = 'jadwal_templates';

    protected $fillable = [
        'dosen_user_id',
        'hari_dalam_minggu',
        'jam_mulai',
        'jam_selesai',
        'durasi_sesi_menit',
    ];

    /**
     * Relasi ke model User (dosen).
     */
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_user_id');
    }
}