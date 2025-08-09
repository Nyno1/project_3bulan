<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;

class SertifikatController extends Controller
{
 public function index()
{
    // Ambil sertifikat terbaru untuk dashboard
    $sertifikats = Sertifikat::latest()->take(5)->get();

    // Hitung total sertifikasi
    $totalSertifikasi = Sertifikat::count();

    // Hitung total siswa unik (berdasarkan NIS)
    $totalSiswa = Sertifikat::distinct('nis')->count('nis');

    return view('dashboard', compact('sertifikats', 'totalSertifikasi', 'totalSiswa'));
}


    public function create()
    {
        // Tampilkan form tambah sertifikat
        return view('sertifikat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama_siswa' => 'required',
            'jenis_sertifikat' => 'required',
            'tanggal_diraih' => 'required|date',
            'foto_sertifikat' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        // Upload foto
        $fotoPath = $request->file('foto_sertifikat')->store('sertifikat', 'public');

        Sertifikat::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'jenis_sertifikat' => $request->jenis_sertifikat,
            'tanggal_diraih' => $request->tanggal_diraih,
            'foto_sertifikat' => $fotoPath
        ]);

        return redirect()->route('dashboard')->with('success', 'Sertifikat berhasil ditambahkan!');
    }
}
