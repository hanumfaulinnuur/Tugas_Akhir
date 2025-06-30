<?php

use App\Http\Controllers;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\JabatanPegawaiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SuratMasukController;
use App\Http\Controllers\Admin\RiwayatSuratController;
use App\Http\Controllers\Admin\KirimSuratController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\SuratKeluarEksternalController;
use App\Http\Controllers\Admin\SuratKeluarInternalController;
use App\Http\Controllers\Admin\UnitController;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group([
    'prefix' => 'admin'
], function () {
    Route::get("/data-master", [PegawaiController::class, "index"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.data-master.data');
    Route::post("/data-pegawai/tambah-data", [PegawaiController::class, "store"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.tambah-pegawai');
    Route::post("/data-pegawai/detail-data", [PegawaiController::class, "show"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.detail-pegawai');
    Route::put("/data-pegawai/update-data/{id}", [PegawaiController::class, "update"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.update-pegawai');
    Route::delete("/data-pegawai/hapus-data/{id}", [PegawaiController::class, "destroy"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.hapus-pegawai');

});

Route::group([
    'prefix' => 'admin'
], function () {
    Route::get("/data-unit", [UnitController::class, "index"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.data-master.unit');
    Route::post("/data-unit/tambah-data", [UnitController::class, "store"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.tambah-unit');
    Route::post("/data-unit/detail-data", [UnitController::class, "show"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.detail-unit');
    Route::put("/data-unit/update-data/{id}", [UnitController::class, "update"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.update-unit');
    Route::delete("/data-unit/hapus-data/{id}", [UnitController::class, "destroy"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.hapus-unit');

});

Route::group([
    'prefix' => 'admin'
], function () {
    Route::get("/data-jabatan", [JabatanController::class, "index"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.data-master.jabatan');
    Route::post("/data-jabatan/tambah-data", [JabatanController::class, "store"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.tambah-jabatan');
    Route::post("/data-jabatan/detail-data", [JabatanController::class, "show"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.detail-jabatan');
    Route::put("/data-jabatan/update-data/{id}", [JabatanController::class, "update"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.update-jabatan');
    Route::delete("/data-jabatan/hapus-data/{id}", [JabatanController::class, "destroy"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.hapus-jabatan');

});

Route::group([
    'prefix' => 'admin'
], function () {
    Route::get("/data-jabatan-pegawai", [JabatanPegawaiController::class, "index"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.data-master.jabatanpeg');
    Route::post("/data-jabatanpeg/tambah-data", [JabatanPegawaiController::class, "store"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.tambah-jabatanpeg');
    Route::post("/data-jabatanpeg/detail-data", [JabatanPegawaiController::class, "show"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.detail-jabatanpeg');
    Route::put("/data-jabatanpeg/update-data/{id}", [JabatanPegawaiController::class, "update"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.update-jabatanpeg');
    Route::delete("/data-jabatanpeg/hapus-data/{id}", [JabatanPegawaiController::class, "destroy"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.hapus-jabatanpeg');

});

Route::group([
    'prefix' => 'admin'
], function () {
    Route::get("/surat-masuk", [SuratMasukController::class, "index"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.surat-masuk');
    Route::post("/surat-masuk/tambah-data", [SuratMasukController::class, "store"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.tambah.surat');
        Route::get("/surat-masuk/detail-data", [SuratMasukController::class, "show"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.detail-data');
        Route::put("/surat-masuk/update-data/{id}", [SuratMasukController::class, "update"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.update-data');
        Route::delete("/surat-masuk/hapus-data/{id}", [SuratMasukController::class, "destroy"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.hapus-data');
});


Route::group([
    'prefix' => 'admin'
], function () {
    Route::get("/surat-keluar-eks", [SuratKeluarEksternalController::class, "index"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.surat-keluar-eks');
    Route::post("/surat-keluar-eks/tambah-data", [SuratKeluarEksternalController::class, "store"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.tambah-surat-keluareks');
    Route::get("/surat-keluar-eks/detail-data/{id}", [SuratKeluarEksternalController::class, "show"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.detail-data-keluareks');
    Route::put("/surat-keluar-eks/update-data/{id}", [SuratKeluarEksternalController::class, "update"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.update-data-keluareks');
    Route::delete("/surat-keluar-eks/hapus-data/{id}", [SuratKeluarEksternalController::class, "destroy"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.hapus-data-keluareks');
    Route::get('/surat-eksternal/{id}/preview', [SuratKeluarEksternalController::class, 'preview'])->name('komponen.preview-surat');
});

Route::group([
    'prefix' => 'admin'
], function () {
    Route::get("/surat-keluar-int", [SuratKeluarInternalController::class, "index"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.surat-keluar-int');
    Route::post("/surat-keluar-int/tambah-data", [SuratKeluarInternalController::class, "store"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.tambah.surat-keluarint');
        Route::get("/surat-keluar-int/detail-data", [SuratKeluarInternalController::class, "show"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.detail-data-keluarint');
        Route::put("/surat-keluar-int/update-data/{id}", [SuratKeluarInternalController::class, "update"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.update-data-keluarint');
        Route::delete("/surat-keluar-int/hapus-data/{id}", [SuratKeluarInternalController::class, "destroy"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.hapus-data-keluarint');
});

// Route::group([
//     'prefix' => 'admin'
// ], function () {
//     Route::get('/surat', [SuratKeluarEksternalController::class, 'index'])->name('surat.index');
//     Route::post('/surat', [SuratKeluarEksternalController::class, 'store'])->name('surat.store');
//     Route::get('/surat/{id}/preview', [SuratKeluarEksternalController::class, 'preview'])->name('surat.preview');
// });


Route::group([
    'prefix' => 'admin'
], function () {
    Route::get("/riwayat-surat", [RiwayatSuratController::class, "index"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.riwayat-surat');
    Route::delete("/riwayat-surat/hapus-riwayat/{id}", [RiwayatSuratController::class, "destroy"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.hapus-riwayat');

});

// Route::group([
//     'prefix' => 'admin'
// ], function () {
//     Route::get("/kirim-surat", [KirimSuratController::class, "index"])
//         ->middleware(['auth', 'verified'])
//         ->name('komponen.kirim-surat');
//     Route::post("/kirim-surat/tambah-data", [KirimSuratController::class, "index"])
//         ->middleware(['auth', 'verified'])
//         ->name('komponen.kirim-data-surat');
//     Route::get("/riwayat-surat", [RiwayatSuratController::class, "destroy"])
//         ->middleware(['auth', 'verified'])
//         ->name('komponen.hapus-riwayat');

// });



Route::middleware('auth')->group(function () {

    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

    // Route::get('login', [AuthenticatedSessionController::class, 'create'])
    //     ->name('login');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
