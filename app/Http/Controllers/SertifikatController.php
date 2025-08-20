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
        $sertifikats = Sertifikat::latest()->take(5)->get();
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
            'foto_sertifikat' => null,
        ]);

        return redirect()->route('dashboard')->with('success', 'Siswa baru berhasil ditambahkan!');
    }

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

        $fotoPath = $request->file('foto_sertifikat')->store('sertifikat_photos', 'public');

        try {
            if ($sertifikat->foto_sertifikat && Storage::disk('public')->exists($sertifikat->foto_sertifikat)) {
                Storage::disk('public')->delete($sertifikat->foto_sertifikat);
            }

            $sertifikat->update(['foto_sertifikat' => $fotoPath]);

            return redirect()->route('dashboard')->with('success', 'Foto sertifikat berhasil diperbarui!');
        } catch (\Exception $e) {
            Storage::disk('public')->delete($fotoPath);
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    // 🔹 FITUR UPLOAD MASSAL FOTO BERDASARKAN NIS
    public function uploadMassal(Request $request)
    {
        $request->validate([
            'foto_sertifikat.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        foreach ($request->file('foto_sertifikat') as $file) {
            $nis = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $sertifikat = Sertifikat::where('nis', $nis)->first();

            if ($sertifikat) {
                $path = $file->store('sertifikats', 'public');
                $sertifikat->update([
                    'foto_sertifikat' => $path,
                ]);
            } else {
                Sertifikat::create([
                    'nis' => $nis,
                    'nama_siswa' => 'Belum diisi',
                    'jenis_sertifikat' => null,
                    'judul_sertifikat' => null,
                    'tanggal_diraih' => null,
                    'foto_sertifikat' => $file->store('sertifikats', 'public'),
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Upload massal berhasil!');
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
            'nama_siswa' => 'required|string',
            'jenis_sertifikat' => 'nullable|string',
            'judul_sertifikat' => 'nullable|string',
            'tanggal_diraih' => 'nullable|date',
            'foto_sertifikat' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only(['nama_siswa','jenis_sertifikat','judul_sertifikat','tanggal_diraih']);

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
        $sertifikat = Sertifikat::findOrFail($id);
        return view('sertifikat.detail', compact('sertifikat'));
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
            $fotoPath = null;
            if ($request->hasFile("foto_sertifikat.$index")) {
                $fotoPath = $request->file("foto_sertifikat.$index")->store('sertifikat', 'public');
            }

            Sertifikat::create([
                'nis' => $data['nis'],
                'nama_siswa' => $data['nama_siswa'],
            ]);
        }

        $request->session()->forget('imported_sertifikats');

        return redirect()->route('dashboard')->with('success', 'Semua data berhasil diimpor!');
    }
}
