<?php

namespace App\Imports;

use App\Models\Sertifikat;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Collection;

class SertifikatImport implements ToCollection, WithHeadingRow, WithValidation
{
    public $data;

    public function collection(Collection $rows)
    {
        $this->data = $rows->map(function ($row) {
            return [
                'nis'               => $row['nis'],
                'nama_siswa'        => $row['nama_siswa'],
              
            ];
        });
    }

    public function rules(): array
    {
        return [
            'nis'               => 'required',
            'nama_siswa'        => 'required',
          
        ];
    }
}
