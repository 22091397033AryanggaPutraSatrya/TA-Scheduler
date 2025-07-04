<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('dosen_user_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->text('topik_bahasan')->nullable();
            $table->enum('metode', ['online', 'offline']);
            $table->string('lokasi_atau_link')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'rejected', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};