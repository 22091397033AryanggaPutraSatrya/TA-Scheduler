<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas_akhir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('dosen_pembimbing_id')->constrained('users')->cascadeOnDelete();
            $table->string('judul');
            $table->enum('status', ['pengajuan', 'dikerjakan', 'revisi', 'selesai'])->default('pengajuan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas_akhir');
    }
};