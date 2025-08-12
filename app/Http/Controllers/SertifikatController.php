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
}