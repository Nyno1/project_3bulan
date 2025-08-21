<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;
     protected $fillable = [
        'nis',
        'nama_siswa',
        'jenis_sertifikat',
        'judul_sertifikat',
        'tanggal_diraih',
        'foto_sertifikat',
    ];

    protected $casts = [
        'foto_sertifikat' => 'array',
        'tanggal_diraih' => 'date', // Tambahkan baris ini
    ];

}
