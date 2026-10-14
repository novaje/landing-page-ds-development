<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\website\DashboardWebController;
use App\Http\Controllers\website\BerandaWebsiteController;
use App\Http\Controllers\website\TentangWebsiteController;
use App\Http\Controllers\website\KoleksiWebsiteController;
use App\Http\Controllers\website\GaleriWebsiteController;
use App\Http\Controllers\website\KlienWebsiteController;
use App\Http\Controllers\website\KontakWebsiteController;
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

Route::get('/tentang-website', [TentangWebsiteController::class, 'dtTentang'])->name('tentang');
Route::post('/tentang-website', [TentangWebsiteController::class, 'storeTentang'])->name('tentang.store');
Route::get('/tentang-website/{id_tentang}/edit', [TentangWebsiteController::class, 'editTentang'])->name('tentang.edit');
Route::put('/tentang-website/{id_tentang}', [TentangWebsiteController::class, 'updateTentang'])->name('tentang.update');
Route::delete('/tentang-website/{id_tentang}', [TentangWebsiteController::class, 'destroyTentang'])->name('tentang.destroy');

Route::get('/koleksi-website', [KoleksiWebsiteController::class, 'dtKoleksi'])->name('koleksi');
Route::post('/koleksi-website', [KoleksiWebsiteController::class, 'storeKoleksi'])->name('koleksi.store');
Route::get('/koleksi-website/{id_koleksi}/edit', [KoleksiWebsiteController::class, 'editKoleksi'])->name('koleksi.edit');
Route::put('/koleksi-website/{id_koleksi}', [KoleksiWebsiteController::class, 'updateKoleksi'])->name('koleksi.update');
Route::delete('/koleksi-website/{id_koleksi}', [KoleksiWebsiteController::class, 'destroyKoleksi'])->name('koleksi.destroy');

Route::get('/galeri-website', [GaleriWebsiteController::class, 'dtGaleri'])->name('galeri');
Route::post('/galeri-website', [GaleriWebsiteController::class, 'storeGaleri'])->name('galeri.store');
Route::get('/galeri-website/{id_galeri}/edit', [GaleriWebsiteController::class, 'editGaleri'])->name('galeri.edit');
Route::put('/galeri-website/{id_galeri}', [GaleriWebsiteController::class, 'updateGaleri'])->name('galeri.update');
Route::delete('/galeri-website/{id_galeri}', [GaleriWebsiteController::class, 'destroyGaleri'])->name('galeri.destroy');

Route::get('/klien-website', [KlienWebsiteController::class, 'dtKlien'])->name('klien');
Route::post('/klien-website', [KlienWebsiteController::class, 'storeKlien'])->name('klien.store');
Route::get('/klien-website/{id_klien}/edit', [KlienWebsiteController::class, 'editKlien'])->name('klien.edit');
Route::put('/klien-website/{id_klien}', [KlienWebsiteController::class, 'updateKlien'])->name('klien.update');
Route::delete('/klien-website/{id_klien}', [KlienWebsiteController::class, 'destroyKlien'])->name('klien.destroy');

// Route::get('/kontak-website', [KontakWebsiteController::class, 'dtKontak'])->name('kontak');
// Route::post('/kontak-website', [KontakWebsiteController::class, 'storeKontak'])->name('kontak.store');
// Route::get('/kontak-website/{id_kontak}/edit', [KontakWebsiteController::class, 'editKontak'])->name('kontak.edit');
// Route::put('/kontak-website/{id_kontak}', [KontakWebsiteController::class, 'updateKontak'])->name('kontak.update');
// Route::delete('/kontak-website/{id_kontak}', [KontakWebsiteController::class, 'destroyKontak'])->name('kontak.destroy');

// admin
Route::get('/dashboard-admin', [DashboardController::class, 'DashboardAdmin'])->name('dashboard');

// pesanan
Route::get('/data-pesanan', [DataPesananController::class, 'dtPesanan'])->name('datapesanan');
Route::post('/data-pesanan', [DataPesananController::class, 'storePesanan'])->name('datapesanan.store');
Route::get('/data-pesanan/{id_pesanan}/edit', [DataPesananController::class, 'editPesanan'])->name('datapesanan.edit');
Route::put('/data-pesanan/{id_pesanan}', [DataPesananController::class, 'updatePesanan'])->name('datapesanan.update');
Route::delete('/data-pesanan/{id_pesanan}', [DataPesananController::class, 'destroyPesanan'])->name('datapesanan.destroy');
