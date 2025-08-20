<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

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

        // Hitung total admin aktif (misal role = 'admin')
        $totalAdminAktif = User::where('role', 'admin')->count();

        // Total sertifikat yang diraih bulan ini
        $totalSertifikatBulanIni = Sertifikat::whereMonth('tanggal_diraih', Carbon::now()->month)
            ->whereYear('tanggal_diraih', Carbon::now()->year)
            ->count();

        return view('dashboard', compact('sertifikats', 'totalSertifikasi', 'totalSiswa', 'totalSertifikatBulanIni', 'totalAdminAktif'));
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
            'jenis_sertifikat' => 'required|string',
            'judul_sertifikat' => 'required|string',
            'tanggal_diraih' => 'required|date',
        ]);

        Sertifikat::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'jenis_sertifikat' => $request->jenis_sertifikat,
            'judul_sertifikat' => $request->judul_sertifikat,
            'tanggal_diraih' => $request->tanggal_diraih,
            'foto_sertifikat' => null
        ]);

        return redirect()->route('dashboard')->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    public function storePhoto(Request $request)
    {
        $request->validate([
            'nis' => [
                'required',
                'string',
                'exists:sertifikats,nis',
            ],
            'foto_sertifikat' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $existingSertifikat = Sertifikat::where('nis', $request->nis)->first();

        if (!$existingSertifikat) {
            return redirect()->back()->with('error', 'NIS tidak ditemukan di database.');
        }

        $fotoPath = $request->file('foto_sertifikat')->store('sertifikat_photos', 'public');

        try {
            if ($existingSertifikat->foto_sertifikat && Storage::disk('public')->exists($existingSertifikat->foto_sertifikat)) {
                Storage::disk('public')->delete($existingSertifikat->foto_sertifikat);
            }

            $existingSertifikat->update([
                'foto_sertifikat' => $fotoPath,
            ]);

            return redirect()->route('dashboard')->with('success', 'Foto sertifikat berhasil diunggah dan diperbarui untuk NIS ' . $request->nis . '!');

        } catch (\Exception $e) {
            Storage::disk('public')->delete($fotoPath);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

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

        $searchType = $request->input('search_type');
        $searchTerm = $request->input('search_term');

        $query = Sertifikat::query();

        if ($searchType === 'nama') {
            $query->where('nama_siswa', 'LIKE', '%' . $searchTerm . '%');
        } elseif ($searchType === 'nis') {
            $query->where('nis', 'LIKE', '%' . $searchTerm . '%');
        }

        $results = $query->orderBy('tanggal_diraih', 'desc')->get();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'count' => $results->count(),
                'data' => $results,
                'message' => $results->count() > 0
                    ? 'Ditemukan ' . $results->count() . ' sertifikat'
                    : 'Tidak ada sertifikat yang ditemukan'
            ]);
        }

        return view('sertifikat.results', compact('results', 'searchTerm', 'searchType'));
    }

    public function searchApi(Request $request)
    {
        $request->validate([
            'type' => 'required|in:nama,nis',
            'term' => 'required|string|max:255',
        ]);

        $searchType = $request->input('type');
        $searchTerm = $request->input('term');

        try {
            $query = Sertifikat::select('*');

            if ($searchType === 'nama') {
                $query->where('nama_siswa', 'LIKE', '%' . $searchTerm . '%');
            } else {
                $query->where('nis', $searchTerm);
            }

            $results = $query->orderBy('tanggal_diraih', 'desc')
                             ->limit(50)
                             ->get();

            return response()->json([
                'success' => true,
                'count' => $results->count(),
                'data' => $results
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mencari data',
                'error' => $e->getMessage()
            ], 500);
        }
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
        $request->validate([
            'identifier' => 'required|string'
        ]);

        $identifier = $request->input('identifier');

        try {
            $sertifikat = Sertifikat::where('id', $identifier)
                                     ->orWhere('nis', $identifier)
                                     ->first();

            if (!$sertifikat) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sertifikat tidak ditemukan'
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Sertifikat ditemukan dan valid',
                'data' => $sertifikat
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat verifikasi sertifikat',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function importForm()
    {
        return view('sertifikat.import');
    }

    /**
     * Mengunduh file template Excel.
     */
    public function downloadTemplate()
    {
        // Path disesuaikan dengan nama file yang Anda berikan
        $filePath = public_path('templates/test project 3 bulan.xlsx');
        
        // Pastikan file ada sebelum dikirim
        if (file_exists($filePath)) {
            return response()->download($filePath, 'test project 3 bulan.xlsx');
        } else {
            return redirect()->back()->with('error', 'File template tidak ditemukan.');
        }
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            $import = new \App\Imports\SertifikatImport;
            Excel::import($import, $request->file('file'));
            $importedData = $import->data;

            $request->session()->put('imported_sertifikats', $importedData);

            return redirect()->route('sertifikat.preview')->with('success', 'File Excel berhasil diunggah. Silakan tinjau data sebelum diimpor.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . implode('; ', $errors));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }

    public function previewImport(Request $request)
    {
        return view('sertifikat.preview');
    }

    public function confirmImport(Request $request)
    {
        $request->validate([
            'sertifikats.*.nis' => 'required|string',
            'sertifikats.*.nama_siswa' => 'required|string',
            'sertifikats.*.jenis_sertifikat' => 'required|string',
            'sertifikats.*.judul_sertifikat' => 'required|string',
            'sertifikats.*.tanggal_diraih' => 'required|date',
            'foto_sertifikat.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $sertifikatsToImport = $request->input('sertifikats');

        if (empty($sertifikatsToImport)) {
            return redirect()->route('sertifikat.import.form')->with('error', 'Tidak ada data untuk diimpor. Silakan unggah file Excel terlebih dahulu.');
        }

        $existingNis = Sertifikat::whereIn('nis', collect($sertifikatsToImport)->pluck('nis'))->pluck('nis')->toArray();
        if (!empty($existingNis)) {
            $request->session()->flash('error', 'NIS berikut sudah terdaftar di database: ' . implode(', ', $existingNis) . '. Mohon periksa kembali data Anda.');
            return redirect()->back()->withInput($request->all());
        }

        try {
            foreach ($sertifikatsToImport as $index => $data) {
                $fotoPath = null;
                if ($request->hasFile('foto_sertifikat.' . $index)) {
                    $fotoPath = $request->file('foto_sertifikat.' . $index)->store('sertifikat', 'public');
                }

                Sertifikat::create([
                    'nis' => $data['nis'],
                    'nama_siswa' => $data['nama_siswa'],
                    'jenis_sertifikat' => $data['jenis_sertifikat'],
                    'judul_sertifikat' => $data['judul_sertifikat'],
                    'tanggal_diraih' => $data['tanggal_diraih'],
                    'foto_sertifikat' => $fotoPath,
                ]);
            }

            $request->session()->forget('imported_sertifikats');

            return redirect()->route('dashboard')->with('success', 'Semua data sertifikat berhasil diimpor!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengkonfirmasi impor data: ' . $e->getMessage());
        }
    }
}