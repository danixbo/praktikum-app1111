<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntriMejaController;
use App\Http\Controllers\EntriBarangController;
use App\Http\Controllers\EntriOrderController;
use App\Http\Controllers\EntriTransaksiController;
use App\Http\Controllers\LaporanController;

Route::get('login',[AdminController::class, 'login'])->name('login');
Route::post('login',[AdminController::class, 'cekUser']);
Route::post('logout',[AdminController::class, 'logout'])->name('logout');

Route::middleware('auth:user')->prefix('dashboard')->group(function() {
    Route::get('/', [AdminController::class, 'dashboardAdmin'])->name('dashboard');
    Route::get('/meja', [EntriMejaController::class, 'index'])->name('meja');
    Route::post('/meja', [EntriMejaController::class, 'tambah_data'])->name('meja.tambah');
    Route::get('/meja/edit/{id}', [EntriMejaController::class, 'edit_data'])->name('meja.edit');
    Route::post('/meja/edit/{id}', [EntriMejaController::class, 'update_date'])->name('meja.update');
    Route::get('/barang', [EntriBarangController::class, 'index'])->name('barang');
    Route::get('/order', [EntriOrderController::class, 'index'])->name('order');
    Route::get('/transaksi', [EntriTransaksiController::class, 'index'])->name('transaksi');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
});
