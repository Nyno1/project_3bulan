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
        $table->string('nis');
        $table->string('nama_siswa');
        $table->string('jenis_sertifikat');
        $table->string('judul_sertifikat');
        $table->date('tanggal_diraih');
        $table->string('foto_sertifikat'); // Menyimpan nama file
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
