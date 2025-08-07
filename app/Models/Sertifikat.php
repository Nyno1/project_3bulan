<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $fillable = [
    'nis',
    'nama_siswa',
    'jenis_sertifikat',
    'tanggal_diraih',
    'foto_sertifikat',
];

}
