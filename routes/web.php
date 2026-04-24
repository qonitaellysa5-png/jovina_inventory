<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| PUBLIC (BELUM LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'landing'])->name('landing');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', [AuthController::class, 'forgotPasswordForm'])
    ->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'updatePassword'])
    ->name('forgot.password.update');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED (SUDAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('checkAdmin')->group(function () {

    // ================= DASHBOARD =================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ================= BARANG =================
    Route::get('/data-barang', [BarangController::class, 'index'])->name('data-barang');

    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('/barang/print', [BarangController::class, 'print'])->name('barang.print');
    Route::get('/barang/export/excel', [BarangController::class, 'exportExcel'])->name('barang.export.excel');
    Route::get('/barang/export/pdf', [BarangController::class, 'exportPdf'])->name('barang.export.pdf');
    Route::post('/barang/import/excel', [BarangController::class, 'importExcel'])->name('barang.import.excel');
    Route::post('/barang/import/pdf', [BarangController::class, 'importPdf'])->name('barang.import.pdf');

    // ================= STOK MASUK =================
    Route::get('/stok-masuk', [StokMasukController::class, 'index'])->name('stok-masuk');
    Route::post('/stok-masuk', [StokMasukController::class, 'store'])->name('stok-masuk.store');
    Route::put('/stok-masuk/{stokMasuk}', [StokMasukController::class, 'update'])->name('stok-masuk.update');
    Route::delete('/stok-masuk/{stokMasuk}', [StokMasukController::class, 'destroy'])->name('stok-masuk.destroy');

    Route::get('/stok-masuk/print', [StokMasukController::class, 'print'])->name('stok-masuk.print');
    Route::get('/stok-masuk/export/excel', [StokMasukController::class, 'exportExcel'])->name('stok-masuk.export.excel');
    Route::get('/stok-masuk/export/pdf', [StokMasukController::class, 'exportPdf'])->name('stok-masuk.export.pdf');
    Route::post('/stok-masuk/import/excel', [StokMasukController::class, 'importExcel'])->name('stok-masuk.import.excel');
    Route::post('/stok-masuk/import/pdf', [StokMasukController::class, 'importPdf'])->name('stok-masuk.import.pdf');

    // ================= STOK KELUAR =================
    Route::get('/stok-keluar', [StokKeluarController::class, 'index'])->name('stok-keluar');
    Route::post('/stok-keluar', [StokKeluarController::class, 'store'])->name('stok-keluar.store');
    Route::put('/stok-keluar/{stokKeluar}', [StokKeluarController::class, 'update'])->name('stok-keluar.update');
    Route::delete('/stok-keluar/{stokKeluar}', [StokKeluarController::class, 'destroy'])->name('stok-keluar.destroy');

    Route::get('/stok-keluar/print', [StokKeluarController::class, 'print'])->name('stok-keluar.print');
    Route::get('/stok-keluar/export/excel', [StokKeluarController::class, 'exportExcel'])->name('stok-keluar.export.excel');
    Route::get('/stok-keluar/export/pdf', [StokKeluarController::class, 'exportPdf'])->name('stok-keluar.export.pdf');
    Route::post('/stok-keluar/import/excel', [StokKeluarController::class, 'importExcel'])->name('stok-keluar.import.excel');
    Route::post('/stok-keluar/import/pdf', [StokKeluarController::class, 'importPdf'])->name('stok-keluar.import.pdf');

    // ================= RETUR =================
    Route::get('/retur', [ReturController::class, 'index'])->name('retur');
    Route::post('/retur', [ReturController::class, 'store'])->name('retur.store');
    Route::put('/retur/{id}', [ReturController::class, 'update'])->name('retur.update');
    Route::delete('/retur/{id}', [ReturController::class, 'destroy'])->name('retur.destroy');

    Route::get('/retur/print', [ReturController::class, 'print'])->name('retur.print');
    Route::get('/retur/export/excel', [ReturController::class, 'exportExcel'])->name('retur.export.excel');
    Route::get('/retur/export/pdf', [ReturController::class, 'exportPdf'])->name('retur.export.pdf');
    Route::post('/retur/import/excel', [ReturController::class, 'importExcel'])->name('retur.import.excel');
    Route::post('/retur/import/pdf', [ReturController::class, 'importPdf'])->name('retur.import.pdf');

    // ================= MUTASI =================
    Route::get('/mutasi', [MutasiController::class,'index'])->name('mutasi');
    Route::post('/mutasi', [MutasiController::class,'store'])->name('mutasi.store');
    Route::put('/mutasi/{id}', [MutasiController::class,'update'])->name('mutasi.update');
    Route::delete('/mutasi/{id}', [MutasiController::class,'destroy'])->name('mutasi.destroy');

    Route::get('/mutasi/print', [MutasiController::class, 'print'])->name('mutasi.print');
    Route::get('/mutasi/export/excel', [MutasiController::class, 'exportExcel'])->name('mutasi.export.excel');
    Route::get('/mutasi/export/pdf', [MutasiController::class, 'exportPdf'])->name('mutasi.export.pdf');
    Route::post('/mutasi/import/excel', [MutasiController::class, 'importExcel'])->name('mutasi.import.excel');
    Route::post('/mutasi/import/pdf', [MutasiController::class, 'importPdf'])->name('mutasi.import.pdf');

    
    // ================= GUDANG =================
    Route::get('/gudang', [GudangController::class, 'index'])->name('gudang');

    Route::post('/gudang', [GudangController::class, 'store'])->name('gudang.store');
    Route::put('/gudang/{gudang}', [GudangController::class, 'update'])->name('gudang.update');
    Route::delete('/gudang/{gudang}', [GudangController::class, 'destroy'])->name('gudang.destroy');

    Route::get('/gudang/masuk', [GudangController::class, 'barangMasuk'])->name('gudang.masuk');
    Route::get('/gudang/penjualan', [GudangController::class, 'barangPenjualan'])->name('gudang.penjualan');
    Route::get('/gudang/rusak', [GudangController::class, 'barangRusak'])->name('gudang.rusak');
    Route::get('/gudang/retur', [GudangController::class, 'barangRetur'])->name('gudang.retur');

    // ================= PAYMENT =================
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment/process', [App\Http\Controllers\PaymentController::class, 'process'])->name('payment.process');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});