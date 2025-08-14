<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

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
        // Tampilkan form tambah sertifikat
        return view('sertifikat.create');
    }

    // Metode untuk menambahkan sertifikat lengkap TANPA FOTO
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string', // Pastikan NIS adalah string
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

    /**
     * Metode untuk mengunggah foto sertifikat dan menautkannya ke NIS yang sudah ada.
     * NIS akan divalidasi apakah sudah ada di tabel 'sertifikats'.
     * Data lain (nama_siswa, jenis_sertifikat, dll.) akan diambil dari record sertifikat yang sudah ada
     * untuk NIS tersebut agar sesuai dengan skema database yang ada.
     */
    public function storePhoto(Request $request)
    {
        $request->validate([
            'nis' => [
                'required',
                'string',
                // Validasi bahwa NIS harus ada di tabel 'sertifikats'.
                // Ini penting agar foto hanya bisa ditautkan ke siswa yang sudah terdaftar.
                'exists:sertifikats,nis',
            ],
            'foto_sertifikat' => 'required|image|mimes:jpg,jpeg,png|max:5120' // Maksimal 5MB
        ]);

        // Cari data sertifikat yang sudah ada untuk NIS ini.
        // Kita akan mencari sertifikat yang pertama ditemukan untuk NIS ini.
        // Jika Anda memiliki logika lain (misalnya, memperbarui sertifikat tertentu),
        // sesuaikan query di bawah ini.
        $existingSertifikat = Sertifikat::where('nis', $request->nis)->first();

        // Logika ini seharusnya tidak tercapai karena validasi 'exists:sertifikats,nis'
        // sudah memastikan NIS ada. Namun, sebagai fallback, kita tetap cek.
        if (!$existingSertifikat) {
            return redirect()->back()->with('error', 'NIS tidak ditemukan di database.');
        }

        // Unggah foto sertifikat ke storage 'public/sertifikat_photos'
        $fotoPath = $request->file('foto_sertifikat')->store('sertifikat_photos', 'public');

        try {
            // Jika sudah ada foto sebelumnya untuk sertifikat ini, hapus foto lama dari storage untuk menghemat ruang.
            // Ini mencegah penumpukan file foto yang tidak lagi digunakan.
            if ($existingSertifikat->foto_sertifikat && Storage::disk('public')->exists($existingSertifikat->foto_sertifikat)) {
                Storage::disk('public')->delete($existingSertifikat->foto_sertifikat);
            }

            // Perbarui entri Sertifikat yang sudah ada dengan foto baru.
            // Hanya kolom 'foto_sertifikat' yang diupdate, sedangkan kolom lainnya tetap utuh.
            $existingSertifikat->update([
                'foto_sertifikat' => $fotoPath, // Simpan path foto yang baru diunggah
            ]);

            // Ubah redirect ke dashboard
            return redirect()->route('dashboard')->with('success', 'Foto sertifikat berhasil diunggah dan diperbarui untuk NIS ' . $request->nis . '!');

        } catch (\Exception $e) {
            // Jika terjadi kesalahan saat menyimpan ke database, hapus foto yang sudah terlanjur diunggah
            Storage::disk('public')->delete($fotoPath);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    // Method untuk menampilkan halaman pencarian
    public function search()
    {
        return view('sertifikat.search');
    }

    // Method untuk melakukan pencarian
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

        // Jika request AJAX, return JSON
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

    // Method untuk API pencarian (untuk AJAX)
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

    // Method untuk mendapatkan detail sertifikat
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

    // Method untuk verifikasi sertifikat berdasarkan ID atau nomor tertentu
    public function verify(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string'
        ]);

        $identifier = $request->input('identifier');

        try {
            // Cari berdasarkan ID atau NIS
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

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            $import = new \App\Imports\SertifikatImport;
            Excel::import($import, $request->file('file'));
            $importedData = $import->data; // Get the imported data from the public property

            // Store data in session for preview
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
        // Data is already in session, just display the view
        return view('sertifikat.preview');
    }

    public function confirmImport(Request $request)
    {
        $request->validate([
            'sertifikats.*.nis'             => 'required|string',
            'sertifikats.*.nama_siswa'      => 'required|string',
            'sertifikats.*.jenis_sertifikat' => 'required|string',
            'sertifikats.*.judul_sertifikat' => 'required|string',
            'sertifikats.*.tanggal_diraih'  => 'required|date',
            'foto_sertifikat.*'             => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $sertifikatsToImport = $request->input('sertifikats');

        if (empty($sertifikatsToImport)) {
            return redirect()->route('sertifikat.import.form')->with('error', 'Tidak ada data untuk diimpor. Silakan unggah file Excel terlebih dahulu.');
        }

        try {
            foreach ($sertifikatsToImport as $index => $data) {
                // Handle foto_sertifikat upload if provided
                $fotoPath = null;
                if ($request->hasFile('foto_sertifikat.' . $index)) {
                    $fotoPath = $request->file('foto_sertifikat.' . $index)->store('sertifikat', 'public');
                }

                Sertifikat::create([
                    'nis'             => $data['nis'],
                    'nama_siswa'      => $data['nama_siswa'],
                    'jenis_sertifikat'  => $data['jenis_sertifikat'],
                    'judul_sertifikat'  => $data['judul_sertifikat'],
                    'tanggal_diraih'    => $data['tanggal_diraih'],
                    'foto_sertifikat'   => $fotoPath,
                ]);
            }

            // Clear session data after successful import, as data is now processed from request
            $request->session()->forget('imported_sertifikats');

            return redirect()->route('dashboard')->with('success', 'Semua data sertifikat berhasil diimpor!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengkonfirmasi impor data: ' . $e->getMessage());
        }
    }
}
