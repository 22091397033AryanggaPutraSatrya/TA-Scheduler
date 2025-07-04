<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drafts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_akhir_id')->constrained('tugas_akhir')->cascadeOnDelete();
            $table->string('nama_file');
            $table->string('file_path');
            $table->unsignedInteger('versi');
            $table->text('catatan_mahasiswa')->nullable();
            $table->text('feedback_dosen')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drafts');
    }
};