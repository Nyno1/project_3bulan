<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SertifikatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pencarian-sertifikat', function () {
    return view('sertiuser.index');
})->name('pencarian.sertifikat');

// Halaman tambah sertifikat
Route::get('/tambah-sertifikat', [SertifikatController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('tambah.sertifikat');

// Halaman form upload foto sertifikat
Route::get('/sertifikat/upload', function () {
    return view('sertifikat.upload');
})->middleware(['auth', 'verified'])->name('sertifikat.upload');

// Proses simpan foto sertifikat
Route::post('/sertifikat/upload', [SertifikatController::class, 'storePhoto'])
    ->middleware(['auth', 'verified'])
    ->name('sertifikat.upload.post');

// Dashboard ambil data sertifikat terbaru
Route::get('/dashboard', [SertifikatController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/sertifikat/import/template', [SertifikatController::class, 'downloadTemplate'])
    ->name('sertifikat.import.template');

    Route::post('/sertifikat/upload-massal', [SertifikatController::class, 'uploadMassal'])->name('sertifikat.upload.massal');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/sertifikat/import', [\App\Http\Controllers\SertifikatController::class, 'importForm'])->name('sertifikat.import.form');
    Route::post('/sertifikat/import', [\App\Http\Controllers\SertifikatController::class, 'importExcel'])->name('sertifikat.import.excel');
    Route::get('/sertifikat/preview', [\App\Http\Controllers\SertifikatController::class, 'previewImport'])->name('sertifikat.preview');
    Route::post('/sertifikat/confirm-import', [\App\Http\Controllers\SertifikatController::class, 'confirmImport'])->name('sertifikat.import.confirm');

    Route::get('/sertifikat/create', [SertifikatController::class, 'create'])->name('sertifikat.create');
    Route::post('/sertifikat/store', [SertifikatController::class, 'store'])->name('sertifikat.store');

});

// Route baru untuk pencarian
Route::get('/cari-sertifikat', [SertifikatController::class, 'search'])->name('sertifikat.search');
Route::post('/cari-sertifikat', [SertifikatController::class, 'doSearch'])->name('sertifikat.do-search');

// API Routes untuk AJAX
Route::post('/api/sertifikat/search', [SertifikatController::class, 'searchApi'])->name('sertifikat.search.api');
Route::get('/sertifikat/{id}', [SertifikatController::class, 'show'])->name('sertifikat.show');
Route::post('/api/sertifikat/verify', [SertifikatController::class, 'verify'])->name('sertifikat.verify');

require __DIR__.'/auth.php';
