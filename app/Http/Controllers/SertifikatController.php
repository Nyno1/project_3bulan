<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Sertifikat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class SertifikatController extends Controller
{
    public function index()
    {
        $siswas = Siswa::orderBy('nama')->paginate(10);

        // Kalau mau tabel “Sertifikat Terbaru” juga, ambil terpisah (opsional)
        $sertifikats = Sertifikat::with('siswa')
            ->orderByDesc('tanggal_diraih')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        $totalSertifikasi = Sertifikat::count();
        $totalSiswa = Siswa::count();
        $totalAdminAktif = User::where('role', 'admin')->count();
        $totalSertifikatBulanIni = Sertifikat::whereMonth('tanggal_diraih', now()->month)
            ->whereYear('tanggal_diraih', now()->year)
            ->count();

        return view('dashboard', compact(
            'siswas',
            'sertifikats', // opsional kalau tabel sertifikat terbaru dipakai
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
            'nis' => 'required|string|unique:siswas,nis',
            'nama' => 'required|string',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
        ]);

        return redirect()->route('dashboard')->with('success', 'Siswa baru berhasil ditambahkan.');
    }

    public function storePhoto(Request $request)
    {
        $request->validate([
            'sertifikat_id' => 'required|exists:sertifikats,id',
            'foto_sertifikat' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $sertifikat = Sertifikat::findOrFail($request->sertifikat_id);

        $fotoPath = $request->file('foto_sertifikat')->store('sertifikat_photos', 'public');

        try {
            if ($sertifikat->foto_sertifikat && Storage::disk('public')->exists($sertifikat->foto_sertifikat)) {
                Storage::disk('public')->delete($sertifikat->foto_sertifikat);
            }

            $sertifikat->update(['foto_sertifikat' => $fotoPath]);

            return redirect()->route('dashboard')->with('success', 'Foto sertifikat berhasil diperbarui!');
        } catch (\Exception $e) {
            Storage::disk('public')->delete($fotoPath);
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    // 🔹 FITUR UPLOAD MASSAL FOTO BERDASARKAN NIS
    public function uploadMassal(Request $request)
    {
        $request->validate([
            'foto_sertifikat' => ['required', 'array'],
            'foto_sertifikat.*' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'jenis_sertifikat' => ['required', 'string', 'max:100'],
            'judul_sertifikat' => ['required', 'string', 'max:255'],
            'tanggal_diraih' => ['required', 'date'],
        ]);

        $jenis = $request->string('jenis_sertifikat')->toString();
        $judul = $request->string('judul_sertifikat')->toString();
        $tanggal = Carbon::parse($request->input('tanggal_diraih'))->toDateString();

        $ok = $skipped = [];

        foreach ($request->file('foto_sertifikat') as $file) {
            // Ambil NIS dari nama file
            $nis = trim(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

            // Cek apakah siswa dengan NIS tersebut ada
            $siswa = Siswa::where('nis', $nis)->first();
            if (!$siswa) {
                $skipped[] = "{$nis} (siswa tidak ditemukan)";
                continue;
            }

            // Simpan file sertifikat
            $ext = strtolower($file->getClientOriginalExtension());
            $filename = "{$nis}-" . now()->format('YmdHis') . "-" . Str::random(4) . ".{$ext}";
            $path = $file->storeAs('sertifikats', $filename, 'public');

            // Buat sertifikat baru
            Sertifikat::create([
                'nis' => $siswa->nis,
                'jenis_sertifikat' => $jenis,
                'judul_sertifikat' => $judul,
                'tanggal_diraih' => $tanggal,
                'foto_sertifikat' => $path
            ]);

            $ok[] = "{$nis} → {$filename}";
        }

        $msg = "Upload massal selesai. Berhasil: " . count($ok);
        if ($skipped) {
            $msg .= ". Dilewati: " . count($skipped);
        }

        return redirect()->route('dashboard')
            ->with('success', $msg)
            ->with('skipped', $skipped);
    }
    // ===== Tambahan dari controller lama (Edit, Update, Destroy) =====
    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        return view('sertifikat.edit', compact('sertifikat'));
    }

    public function update(Request $request, $id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        $request->validate([
            'jenis_sertifikat' => 'nullable|string',
            'judul_sertifikat' => 'nullable|string',
            'tanggal_diraih' => 'nullable|date',
            'foto_sertifikat' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only(['nama_siswa', 'jenis_sertifikat', 'judul_sertifikat', 'tanggal_diraih']);

        if ($request->hasFile('foto_sertifikat')) {
            if ($sertifikat->foto_sertifikat && Storage::disk('public')->exists($sertifikat->foto_sertifikat)) {
                Storage::disk('public')->delete($sertifikat->foto_sertifikat);
            }
            $data['foto_sertifikat'] = $request->file('foto_sertifikat')->store('sertifikat_photos', 'public');
        }

        $sertifikat->update($data);

        return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        if ($sertifikat->foto_sertifikat && Storage::disk('public')->exists($sertifikat->foto_sertifikat)) {
            Storage::disk('public')->delete($sertifikat->foto_sertifikat);
        }

        $sertifikat->delete();

        return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus!');
    }

    // ====== Search & API ======
    public function search()
    {
        return view('sertifikat.search');
    }

    /**
     * Proses pencarian sertifikat (untuk form biasa)
     */
    public function doSearch(Request $request)
    {
        $request->validate([
            'search_type' => 'required|in:nama,nis',
            'search_term' => 'required|string|max:255',
        ]);

        $query = Sertifikat::with('siswa');

        if ($request->search_type === 'nama') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama', 'LIKE', "%{$request->search_term}%");
            });
        } else {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nis', 'LIKE', "%{$request->search_term}%");
            });
        }

        $results = $query->orderBy('tanggal_diraih', 'desc')->get();

        return view('sertifikat.results', compact('results'))
            ->with('searchTerm', $request->search_term)
            ->with('searchType', $request->search_type);
    }

    /**
     * API pencarian sertifikat (untuk AJAX)
     */
    public function searchApi(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|in:nama,nis',
                'term' => 'required|string|max:255',
            ]);

            $query = Sertifikat::with('siswa');

            if ($request->type === 'nama') {
                // Cari berdasarkan nama siswa
                $query->whereHas('siswa', function ($q) use ($request) {
                    $q->where('nama', 'LIKE', '%' . $request->term . '%');
                });
            } else {
                // Cari berdasarkan NIS siswa
                $query->whereHas('siswa', function ($q) use ($request) {
                    $q->where('nis', 'LIKE', '%' . $request->term . '%');
                });
            }

            $results = $query->orderBy('tanggal_diraih', 'desc')->limit(50)->get();

            // Format data untuk response dengan relasi siswa
            $formattedResults = $results->map(function ($sertifikat) {
                return [
                    'id' => $sertifikat->id,
                    'jenis_sertifikat' => $sertifikat->jenis_sertifikat,
                    'judul_sertifikat' => $sertifikat->judul_sertifikat,
                    'tanggal_diraih' => $sertifikat->tanggal_diraih,
                    'foto_sertifikat' => $sertifikat->foto_sertifikat,
                    'nama_siswa' => $sertifikat->siswa ? $sertifikat->siswa->nama : 'N/A',
                    'nis' => $sertifikat->siswa ? $sertifikat->siswa->nis : 'N/A',
                ];
            });

            return response()->json([
                'success' => true,
                'count' => $formattedResults->count(),
                'data' => $formattedResults
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $sertifikat = Sertifikat::with('siswa')->findOrFail($id);

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'id' => $sertifikat->id,
                        'jenis_sertifikat' => $sertifikat->jenis_sertifikat,
                        'judul_sertifikat' => $sertifikat->judul_sertifikat,
                        'tanggal_diraih' => $sertifikat->tanggal_diraih,
                        'foto_sertifikat' => $sertifikat->foto_sertifikat,
                        'nama' => $sertifikat->siswa ? $sertifikat->siswa->nama : 'N/A',
                        'nis' => $sertifikat->siswa ? $sertifikat->siswa->nis : 'N/A',
                    ]
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

    public function downloadTemplate()
    {
        $filePath = public_path('templates/data siswa.xlsx');
        if (!file_exists($filePath)) {
            // Cek juga di storage
            $storagePath = storage_path('app/templates/data siswa.xlsx');
            if (file_exists($storagePath)) {
                $filePath = $storagePath;
            } else {
                return redirect()->back()->with('error', 'File template tidak ditemukan di: ' . $filePath);
            }
        }
        
        // Cek apakah file bisa dibaca
        if (!is_readable($filePath)) {
            return redirect()->back()->with('error', 'File template tidak dapat dibaca. Periksa permission file.');
        }
        
        try {
            return response()->download($filePath, 'template-sertifikat.xlsx', [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mendownload template: ' . $e->getMessage());
        }
    }

    
    

}
