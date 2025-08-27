<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $fillable = [
        'nis',
        'jenis_sertifikat', 
        'judul_sertifikat',
        'tanggal_diraih',
        'foto_sertifikat'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}