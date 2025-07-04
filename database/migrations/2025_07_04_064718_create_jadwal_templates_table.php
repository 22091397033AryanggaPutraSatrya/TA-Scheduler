<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_user_id')->constrained('users')->cascadeOnDelete();
            // 1: Senin, 2: Selasa, ..., 7: Minggu (sesuai standar ISO-8601)
            $table->unsignedTinyInteger('hari_dalam_minggu');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->unsignedInteger('durasi_sesi_menit')->default(30);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_templates');
    }
};