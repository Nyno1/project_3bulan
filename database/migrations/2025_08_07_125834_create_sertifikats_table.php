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
       Schema::create('sertifikats', function (Blueprint $table) {
    $table->id();
    $table->string('nis'); // HAPUS ->unique()
    $table->string('nama_siswa');
    $table->string('jenis_sertifikat')->nullable();
    $table->string('judul_sertifikat')->nullable();
    $table->date('tanggal_diraih')->nullable();
    $table->string('foto_sertifikat')->nullable();
    $table->timestamps();
});

    }

    /**
     * 
     * 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
