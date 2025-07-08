<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi jika user adalah mahasiswa
    public function tugasAkhir()
    {
        return $this->hasOne(TugasAkhir::class, 'mahasiswa_user_id');
    }

    // Relasi jika user adalah dosen
    public function bimbinganDosen()
    {
        return $this->hasMany(TugasAkhir::class, 'dosen_pembimbing_id');
    }
    
    // Relasi ke jadwal template (untuk dosen)
    public function jadwalTemplates()
    {
        return $this->hasMany(JadwalTemplate::class, 'dosen_user_id');
    }

    // Relasi ke booking (untuk dosen)
    public function bookingSebagaiDosen()
    {
        return $this->hasMany(Booking::class, 'dosen_user_id');
    }

    // Relasi ke booking (untuk mahasiswa)
    public function bookingSebagaiMahasiswa()
    {
        return $this->hasMany(Booking::class, 'mahasiswa_user_id');
    }
}