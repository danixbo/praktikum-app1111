<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntriMejaController;
use App\Http\Controllers\EntriBarangController;
use App\Http\Controllers\EntriOrderController;
use App\Http\Controllers\EntriTransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;

Route::get('login',[AdminController::class, 'login'])->name('login');
Route::post('login',[AdminController::class, 'cekUser']);
Route::post('logout',[AdminController::class, 'logout'])->name('logout');

Route::middleware('auth:user')->prefix('dashboard')->group(function() {
    Route::get('/', [AdminController::class, 'dashboardAdmin'])->name('dashboard');


    Route::get('/meja', [EntriMejaController::class, 'index'])->name('meja');
    Route::post('/meja', [EntriMejaController::class, 'store'])->name('meja.store');
    Route::get('/meja/{id}/edit', [EntriMejaController::class, 'edit_data'])->name('meja.edit');
    Route::put('/meja/{id}', [EntriMejaController::class, 'update'])->name('meja.update');
    Route::delete('/meja/{id}', [EntriMejaController::class, 'destroy'])->name('meja.destroy');


    Route::get('/barang', [EntriBarangController::class, 'index'])->name('barang');
    Route::post('/barang', [EntriBarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id_menu}/edit', [EntriBarangController::class, 'edit_data'])->name('barang.edit');
    Route::put('/barang/{id_menu}', [EntriBarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id_menu}', [EntriBarangController::class, 'destroy'])->name('barang.destroy');

    
    Route::get('/order', [EntriOrderController::class, 'index'])->name('order');
    Route::post('/order', [EntriOrderController::class, 'store'])->name('order.store');
    Route::get('/order/{id_pesanan}/edit', [EntriOrderController::class, 'edit_data'])->name('order.edit');
    Route::put('/order/{id_pesanan}', [EntriOrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{id_pesanan}', [EntriOrderController::class, 'destroy'])->name('order.destroy');


    Route::get('/transaksi', [EntriTransaksiController::class, 'index'])->name('transaksi');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');


    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan');
    Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('/pelanggan/{id_pelanggan}/edit', [PelangganController::class, 'edit_data'])->name('pelanggan.edit');
    Route::put('/pelanggan/{id_pelanggan}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/pelanggan/{id_pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
});
