<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginAdmin'])->name('login');
Route::post('/login', [AuthController::class, 'loginAdmin'])->name('login.process');

Route::middleware('auth')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin.index');
    })->name('dashboard.admin');

    // Dashboard Perangkat
    Route::get('/dashboard/perangkat', function () {
        return view('dashboard.perangkat');
    })->name('dashboard.perangkat');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
