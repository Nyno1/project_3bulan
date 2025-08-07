<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;

class SertifikatController extends Controller
{
    public function create()
    {
        return view('sertifikat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama_siswa' => 'required',
            'jenis_sertifikat' => 'required',
            'tanggal_diraih' => 'required|date',
            'foto_sertifikat' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan foto ke folder public/sertifikats
        $fotoPath = $request->file('foto_sertifikat')->store('sertifikats', 'public');

        Sertifikat::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'jenis_sertifikat' => $request->jenis_sertifikat,
            'tanggal_diraih' => $request->tanggal_diraih,
            'foto_sertifikat' => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Data sertifikat berhasil ditambahkan!');
    }
}
