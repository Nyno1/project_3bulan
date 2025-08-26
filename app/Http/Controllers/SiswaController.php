<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::with('sertifikats')->findOrFail($id);
        return view('siswa.detail', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

      public function importForm()
    {
        return view('sertifikat.import');
    }


    public function importExcel(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);

        try {
            $import = new \App\Imports\SertifikatImport;
            Excel::import($import, $request->file('file'));
            $importedData = $import->data;

            $request->session()->put('imported_sertifikats', $importedData);

            return redirect()->route('sertifikat.preview')->with('success', 'File Excel berhasil diunggah. Silakan tinjau data sebelum diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor: ' . $e->getMessage());
        }
    }

    public function previewImport(Request $request)
    {
        return view('sertifikat.preview');
    }

    public function confirmImport(Request $request)
    {
        $sertifikats = $request->input('sertifikats');

        if (empty($sertifikats)) {
            return redirect()->route('sertifikat.import.form')->with('error', 'Tidak ada data untuk diimpor.');
        }

        foreach ($sertifikats as $index => $data) {
            $fotoPath = null;
            if ($request->hasFile("foto_sertifikat.$index")) {
                $fotoPath = $request->file("foto_sertifikat.$index")->store('sertifikat', 'public');
            }

            Siswa::create([
                'nis' => $data['nis'],
                'nama' => $data['nama'],
            ]);
        }

        $request->session()->forget('imported_sertifikats');

        return redirect()->route('dashboard')->with('success', 'Semua data berhasil diimpor!');
    }
}
