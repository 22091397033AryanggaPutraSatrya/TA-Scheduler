<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_user_id',
        'dosen_user_id',
        'waktu_mulai',
        'waktu_selesai',
        'topik_bahasan',
        'metode',
        'lokasi_atau_link',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'waktu_mulai' => 'datetime',
            'waktu_selesai' => 'datetime',
        ];
    }

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
        return $this->belongsTo(User::class, 'dosen_user_id');
    }
}