<?php
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\WilayahController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginAdmin'])->name('login');
Route::post('/login', [AuthController::class, 'loginAdmin'])->name('login.process');

Route::middleware('auth')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin.index');
    })->name('dashboard.admin');
    // Kartu Keluarga Management
   Route::get('/dashboard/admin/kartu-keluarga', [KartuKeluargaController::class, 'index'])
    ->name('dashboard.admin.kartu_keluarga');
    Route::post('/dashboard/admin/kartu-keluarga/store', [KartuKeluargaController::class, 'store'])->name('kartu_keluarga.store');
Route::put('/kartu-keluarga/{id}', [KartuKeluargaController::class, 'update'])
    ->name('kartu_keluarga.update');
Route::get('/kartu-keluarga/{id}/detail', [KartuKeluargaController::class, 'detail']);
    
    // Dashboard Perangkat
    Route::get('/dashboard/perangkat', function () {
        return view('dashboard.perangkat.index');
    })->name('dashboard.perangkat');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
}); 

Route::middleware('auth')->group(function () {
 // routes/web.php
Route::get('/api/provinces', [WilayahController::class, 'getProvinces']);
Route::get('/api/regencies/{provCode}', [WilayahController::class, 'getRegencies']);
Route::get('/api/districts/{provCode}/{kabCode}', [WilayahController::class, 'getDistricts']);
Route::get('/api/villages/{provCode}/{kabCode}/{kecCode}', [WilayahController::class, 'getVillages']);

});
