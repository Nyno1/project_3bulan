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
                'jenis_sertifikat'  => $row['jenis_sertifikat'],
                'judul_sertifikat'  => $row['judul_sertifikat'],
                'tanggal_diraih'    => Date::excelToDateTimeObject($row['tanggal_diraih'])->format('Y-m-d'),
                'foto_sertifikat'   => null, // Set to null as it's not in the Excel and is now nullable
            ];
        });
    }

    public function rules(): array
    {
        return [
            'nis'               => 'required',
            'nama_siswa'        => 'required',
            'jenis_sertifikat'  => 'required',
            'judul_sertifikat'  => 'required',
            'tanggal_diraih'    => 'required|integer', // Excel dates are integers
        ];
    }
}
