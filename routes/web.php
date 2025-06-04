<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group([
    'prefix' => 'admin'
], function () {
    Route::get("/surat-masuk", [Controllers\Admin\SuratMasukController::class, "index"])
        ->middleware(['auth', 'verified'])
        ->name('surat-masuk');
    Route::post("/surat-masuk/tambah-data", [Controllers\Admin\SuratMasukController::class, "store"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.tambah.surat');
        Route::get("/surat-masuk/detail-data", [Controllers\Admin\SuratMasukController::class, "show"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.detail-data');
        Route::put("/surat-masuk/update-data/{id}", [Controllers\Admin\SuratMasukController::class, "update"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.update-data');
        Route::delete("/surat-masuk/hapus-data/{id}", [Controllers\Admin\SuratMasukController::class, "destroy"])
        ->middleware(['auth', 'verified'])
        ->name('komponen.hapus-data');
});
// Route::group([
//     'prefix' => 'admin'
// ], function () {
//     Route::get("/riwayat-surat", [Controllers\Admin\RiwayatSuratController::class, "index"])
//         ->middleware(['auth', 'verified'])
//         ->name('riwayat-surat');

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
