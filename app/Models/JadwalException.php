<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalException extends Model
{
    use HasFactory;

    protected $table = 'jadwal_exceptions';

    protected $fillable = [
        'dosen_user_id',
        'tanggal',
        'alasan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    /**
     * Relasi ke model User (dosen).
     */
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_user_id');
    }
}