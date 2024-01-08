<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jawaban_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained();
            $table->foreignId('soal_ujian_id')->constrained();
            $table->timestamp('waktu_mulai_ujian')->nullable();
            $table->enum('status', ['selesai', 'belum selesai']);
            $table->text('jawaban_mahasiswa')->nullable();
            $table->float('poin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_mahasiswas');
    }
};
