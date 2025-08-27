<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nis','nama'];

    public function sertifikats()
    {
        return $this->hasMany(Sertifikat::class, 'nis', 'nis');
    }
}
