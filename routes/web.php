<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\website\DashboardWebController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataPesananController;


Route::get('/', function () {
    return redirect()->route('website.dashboard-website');
});
Route::get('/dashboard', [DashboardWebController::class, 'dashboardWebsite'])->name('website.dashboard-website');

// website
Route::get('/beranda-website', [BerandaWebsiteController::class, 'dtBeranda'])->name('beranda');
Route::post('/beranda-website', [BerandaWebsiteController::class, 'storeBeranda'])->name('beranda.store');
Route::get('/beranda-website/{id_beranda}/edit', [BerandaWebsiteController::class, 'editBeranda'])->name('beranda.edit');
Route::put('/beranda-website/{id_beranda}', [BerandaWebsiteController::class, 'updateBeranda'])->name('beranda.update');
Route::delete('/beranda-website/{id_beranda}', [BerandaWebsiteController::class, 'destroyBeranda'])->name('beranda.destroy');

// admin
Route::get('/dashboard-admin', [DashboardController::class, 'DashboardAdmin'])->name('dashboard');

// pesanan
Route::get('/data-pesanan', [DataPesananController::class, 'dtPesanan'])->name('datapesanan');
Route::post('/data-pesanan', [DataPesananController::class, 'storePesanan'])->name('datapesanan.store');
Route::get('/data-pesanan/{id_pesanan}/edit', [DataPesananController::class, 'editPesanan'])->name('datapesanan.edit');
Route::put('/data-pesanan/{id_pesanan}', [DataPesananController::class, 'updatePesanan'])->name('datapesanan.update');
Route::delete('/data-pesanan/{id_pesanan}', [DataPesananController::class, 'destroyPesanan'])->name('datapesanan.destroy');
