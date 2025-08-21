<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikats = Sertifikat::latest()->take(10)->get();
        $totalSertifikasi = Sertifikat::count();
        $totalSiswa = Sertifikat::distinct('nis')->count('nis');
        $totalAdminAktif = User::where('role', 'admin')->count();
        $totalSertifikatBulanIni = Sertifikat::whereMonth('tanggal_diraih', Carbon::now()->month)
            ->whereYear('tanggal_diraih', Carbon::now()->year)
            ->count();

        return view('dashboard', compact(
            'sertifikats',
            'totalSertifikasi',
            'totalSiswa',
            'totalSertifikatBulanIni',
            'totalAdminAktif'
        ));
    }

    public function create()
    {
        return view('sertifikat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|unique:sertifikats,nis',
            'nama_siswa' => 'required|string',
        ]);

        Sertifikat::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'jenis_sertifikat' => $request->jenis_sertifikat ?? null,
            'judul_sertifikat' => $request->judul_sertifikat ?? null,
            'tanggal_diraih' => $request->tanggal_diraih ?? null,
            'foto_sertifikat' => [], // Inisialisasi sebagai array kosong
        ]);

        return redirect()->route('dashboard')->with('success', 'Siswa baru berhasil ditambahkan!');
    }

    /**
     * Menambahkan satu foto sertifikat ke NIS yang sudah ada.
     * Foto akan ditambahkan ke daftar foto yang sudah ada.
     */
    public function storePhoto(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|exists:sertifikats,nis',
            'foto_sertifikat' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $sertifikat = Sertifikat::where('nis', $request->nis)->first();

        if (!$sertifikat) {
            return redirect()->back()->with('error', 'NIS tidak ditemukan di database.');
        }

        // Simpan foto baru
        $fotoPath = $request->file('foto_sertifikat')->store('sertifikat_photos', 'public');

        try {
            // Ambil array foto yang sudah ada (akan otomatis didekode oleh $casts)
            $existingPhotos = $sertifikat->foto_sertifikat ?? [];

            // Tambahkan path foto baru ke array
            $existingPhotos[] = $fotoPath;

            // Perbarui record dengan array foto yang baru
            $sertifikat->update(['foto_sertifikat' => $existingPhotos]);

            return redirect()->route('dashboard')->with('success', 'Foto sertifikat berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Hapus file yang diunggah jika ada kesalahan saat pembaruan database
            if (isset($fotoPath) && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    /**
     * Mengunggah sertifikat secara massal.
     * Jika NIS (dari nama file) sudah ada, foto akan ditambahkan ke daftar foto yang ada.
     * Jika NIS belum ada, record baru akan dibuat.
     */
    public function uploadMassal(Request $request)
    {
        $request->validate([
            'foto_sertifikat.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jenis_sertifikat'  => 'required|string',
            'judul_sertifikat'  => 'required|string',
            'tanggal_diraih'    => 'required|date',
        ]);

        $uploadedCount = 0;
        $errors = [];

        foreach ($request->file('foto_sertifikat') as $file) {
            try {
                // Asumsikan NIS adalah nama file tanpa ekstensi
                $nis = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                $sertifikat = Sertifikat::where('nis', $nis)->first();

                // Simpan file baru
                $path = $file->store('sertifikats', 'public');

                if (!$sertifikat) {
                    // Buat record baru jika NIS tidak ditemukan
                    Sertifikat::create([
                        'nis'               => $nis,
                        'nama_siswa'        => 'Nama Siswa (Silakan Edit)', // Nama default, perlu diedit nanti
                        'jenis_sertifikat'  => $request->jenis_sertifikat,
                        'judul_sertifikat'  => $request->judul_sertifikat,
                        'tanggal_diraih'    => $request->tanggal_diraih,
                        'foto_sertifikat'   => [$path], // Simpan sebagai array dengan satu path baru
                    ]);
                } else {
                    // Jika NIS sudah ada, ambil array foto yang sudah ada (otomatis didekode oleh $casts)
                    $existingPhotos = $sertifikat->foto_sertifikat ?? [];
                    // Tambahkan path foto baru
                    $existingPhotos[] = $path;

                    // Perbarui record yang sudah ada
                    $sertifikat->update([
                        'foto_sertifikat'   => $existingPhotos, // Laravel akan otomatis mengkodekan kembali ke JSON
                        'jenis_sertifikat'  => $request->jenis_sertifikat,
                        'judul_sertifikat'  => $request->judul_sertifikat,
                        'tanggal_diraih'    => $request->tanggal_diraih,
                    ]);
                }

                $uploadedCount++;
            } catch (\Exception $e) {
                $errors[] = "Error pada file {$file->getClientOriginalName()}: " . $e->getMessage();
                // Hapus file yang diunggah jika terjadi kesalahan selama operasi database
                if (isset($path) && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        if ($uploadedCount > 0) {
            $message = "Upload massal berhasil! {$uploadedCount} sertifikat berhasil diproses.";
            if (!empty($errors)) {
                $message .= " Namun ada " . count($errors) . " file yang gagal diproses.";
            }
            return redirect()->route('dashboard')->with('success', $message);
        } else {
            $errorMessage = "Upload massal gagal! " . implode(' ', $errors);
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    /**
     * Menampilkan formulir edit untuk sertifikat tertentu.
     */
    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        return view('sertifikat.edit', compact('sertifikat'));
    }

    /**
     * Memperbarui data sertifikat di database.
     * Jika foto baru diunggah, semua foto lama akan dihapus dan diganti dengan yang baru.
     */
    public function update(Request $request, Sertifikat $sertifikat)
    {
        try {
            // Validasi data yang masuk
            $validatedData = $request->validate([
                'nis' => ['required', 'string', 'max:255', Rule::unique('sertifikats')->ignore($sertifikat->id)],
                'nama_siswa' => 'required|string|max:255',
                'judul_sertifikat' => 'required|string|max:255',
                'tanggal_diraih' => 'required|date',
                'jenis_sertifikat' => 'required|string|max:255',
                'foto_sertifikat' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Dapatkan data yang divalidasi
            $data = $request->except(['_token', '_method', 'foto_sertifikat']);
            
            // Proses unggah foto baru jika ada
            if ($request->hasFile('foto_sertifikat')) {
                // Hapus foto lama jika ada
                if (!empty($sertifikat->foto_sertifikat)) {
                    foreach ($sertifikat->foto_sertifikat as $photoPath) {
                        if (Storage::disk('public')->exists($photoPath)) {
                            Storage::disk('public')->delete($photoPath);
                        }
                    }
                }
                
                // Simpan foto baru dengan nama file yang lebih relevan (misal: nis_jenis_judul.jpg)
                $file = $request->file('foto_sertifikat');
                $extension = $file->getClientOriginalExtension();
                $filename = str_replace([' '], '_', $validatedData['nis'] . '_' . $validatedData['jenis_sertifikat'] . '_' . now()->timestamp . '.' . $extension);
                
                $path = $file->storeAs('sertifikat_photos', $filename, 'public');
                $data['foto_sertifikat'] = [$path]; // Simpan sebagai array
            }
            
            // Perbarui data sertifikat
            $sertifikat->update($data);

            return redirect()->route('dashboard')->with('success', 'Data sertifikat berhasil diperbarui.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error during update: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            Log::error('Error updating sertifikat: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data sertifikat.');
        }
    }

    /**
     * Menghapus sertifikat dari database dan semua file fotonya.
     */
    public function destroy($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        // Hapus semua file foto terkait
        if ($sertifikat->foto_sertifikat) { // Ini sekarang adalah array
            foreach ($sertifikat->foto_sertifikat as $photoPath) {
                if (Storage::disk('public')->exists($photoPath)) {
                    Storage::disk('public')->delete($photoPath);
                }
            }
        }

        $sertifikat->delete();

        return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus!');
    }

    // ====== Search & API ======
    public function search()
    {
        return view('sertifikat.search');
    }

    public function doSearch(Request $request)
    {
        $request->validate([
            'search_type' => 'required|in:nama,nis',
            'search_term' => 'required|string|max:255',
        ]);

        $query = Sertifikat::query();
        if ($request->search_type === 'nama') {
            $query->where('nama_siswa', 'LIKE', "%{$request->search_term}%");
        } else {
            $query->where('nis', 'LIKE', "%{$request->search_term}%");
        }

        $results = $query->orderBy('tanggal_diraih', 'desc')->get();

        return view('sertifikat.results', compact('results'))
            ->with('searchTerm', $request->search_term)
            ->with('searchType', $request->search_type);
    }

    public function searchApi(Request $request)
    {
        $request->validate([
            'type' => 'required|in:nama,nis',
            'term' => 'required|string|max:255',
        ]);

        $query = Sertifikat::query();
        if ($request->type === 'nama') {
            $query->where('nama_siswa', 'LIKE', "%{$request->term}%");
        } else {
            $query->where('nis', $request->term);
        }

        $results = $query->orderBy('tanggal_diraih', 'desc')->limit(50)->get();

        return response()->json([
            'success' => true,
            'count' => $results->count(),
            'data' => $results
        ]);
    }

    public function show($id)
    {
        try {
            $sertifikat = Sertifikat::findOrFail($id);

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $sertifikat
                ]);
            }

            return view('sertifikat.detail', compact('sertifikat'));

        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sertifikat tidak ditemukan'
                ], 404);
            }

            return redirect()->back()->with('error', 'Sertifikat tidak ditemukan');
        }
    }

    public function verify(Request $request)
    {
        $request->validate(['identifier' => 'required|string']);

        $sertifikat = Sertifikat::where('id', $request->identifier)
            ->orWhere('nis', $request->identifier)
            ->first();

        if (!$sertifikat) {
            return response()->json(['success' => false, 'message' => 'Sertifikat tidak ditemukan']);
        }

        return response()->json(['success' => true, 'message' => 'Sertifikat valid', 'data' => $sertifikat]);
    }

    // ====== Import Excel ======
    public function importForm()
    {
        return view('sertifikat.import');
    }

    public function downloadTemplate()
    {
        $filePath = public_path('templates/test project 3 bulan.xlsx');
        if (file_exists($filePath)) {
            return response()->download($filePath, 'test project 3 bulan.xlsx');
        }
        return redirect()->back()->with('error', 'File template tidak ditemukan.');
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
            // Jika ada file foto yang diunggah per baris import, simpan sebagai array
            $fotoPaths = [];
            if ($request->hasFile("foto_sertifikat.$index")) {
                $fotoPath = $request->file("foto_sertifikat.$index")->store('sertifikat', 'public');
                $fotoPaths[] = $fotoPath;
            }

            // Periksa apakah NIS sudah ada
            $existingSertifikat = Sertifikat::where('nis', $data['nis'])->first();

            if ($existingSertifikat) {
                // Jika NIS sudah ada, tambahkan foto ke array yang ada
                $currentPhotos = $existingSertifikat->foto_sertifikat ?? [];
                $updatedPhotos = array_merge($currentPhotos, $fotoPaths);
                $existingSertifikat->update([
                    'nama_siswa' => $data['nama_siswa'], // Perbarui juga nama siswa
                    'foto_sertifikat' => $updatedPhotos,
                ]);
            } else {
                // Jika NIS belum ada, buat record baru
                Sertifikat::create([
                    'nis' => $data['nis'],
                    'nama_siswa' => $data['nama_siswa'],
                    'jenis_sertifikat' => null, // Asumsikan jenis, judul, tanggal tidak dari Excel untuk import ini
                    'judul_sertifikat' => null,
                    'tanggal_diraih' => null,
                    'foto_sertifikat' => $fotoPaths,
                ]);
            }
        }

        $request->session()->forget('imported_sertifikats');

        return redirect()->route('dashboard')->with('success', 'Semua data berhasil diimpor!');
    }
}