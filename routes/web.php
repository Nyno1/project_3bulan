<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SertifikatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pencarian-sertifikat', function () {
    return view('sertifikat.index');
})->name('pencarian.sertifikat');

Route::get('/tambah-sertifikat', function () {
    return view('sertifikat.create');
})->name('tambah.sertifikat');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/sertifikat/create', [SertifikatController::class, 'create'])->name('sertifikat.create');
    Route::post('/sertifikat/store', [SertifikatController::class, 'store'])->name('sertifikat.store');
});

require __DIR__.'/auth.php';
