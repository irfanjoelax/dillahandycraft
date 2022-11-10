<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// FRONT END WEB
Route::get('/', [App\Http\Controllers\Web\BerandaController::class, 'index']);
Route::get('/profile', [App\Http\Controllers\Web\ProfileTokoController::class, 'index']);
Route::get('/cara-pembelian', [App\Http\Controllers\Web\CaraPembelianController::class, 'index']);
Route::get('/detail/barang/{slug}', [App\Http\Controllers\Web\DetailBarangController::class, 'index']);

// SHIPPING RAJA ONGKIR
Route::get('/cekongkir/get-kota/{id}', [App\Http\Controllers\Web\CekOngkirController::class, 'getKota']);
Route::get('/cekongkir/{idKota}/{kurir}', [App\Http\Controllers\Web\CekOngkirController::class, 'checkOngkir']);

// AUTHENTICATION ROUTE
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ROLE ADMIN
Route::get('/admin/dashboard', [App\Http\Controllers\Role\Admin\DashboardController::class, 'index']);
Route::get('/admin/pelanggan', [App\Http\Controllers\Role\Admin\PelangganController::class, 'index']);
Route::resource('/admin/kategori', App\Http\Controllers\Role\Admin\KategoriController::class);
Route::resource('/admin/barang', App\Http\Controllers\Role\Admin\BarangController::class);
Route::resource('/admin/banner', App\Http\Controllers\Role\Admin\BannerController::class);
Route::get('/admin/pengaturan', [App\Http\Controllers\Role\Admin\PengaturanController::class, 'index']);
Route::post('/admin/pengaturan', [App\Http\Controllers\Role\Admin\PengaturanController::class, 'update']);
Route::get('/admin/pembelian', [App\Http\Controllers\Role\Admin\PembelianController::class, 'index']);
Route::get('/admin/pembelian/{id}/detail', [App\Http\Controllers\Role\Admin\PembelianController::class, 'detail']);
Route::get('/admin/pembelian/{id}/download', [App\Http\Controllers\Role\Admin\PembelianController::class, 'download']);
Route::get('/admin/pembelian/{id}/{status}', [App\Http\Controllers\Role\Admin\PembelianController::class, 'update_status']);

// ROLE PELANGGAN
Route::get('/pelanggan/dashboard', [App\Http\Controllers\Role\Pelanggan\DashboardController::class, 'index']);
Route::get('/pelanggan/keranjang', [App\Http\Controllers\Role\Pelanggan\KeranjangController::class, 'index']);
Route::post('/pelanggan/keranjang/store/{id}', [App\Http\Controllers\Role\Pelanggan\KeranjangController::class, 'store']);
Route::get('/pelanggan/keranjang/delete/{id}', [App\Http\Controllers\Role\Pelanggan\KeranjangController::class, 'delete']);
Route::post('/pelanggan/checkout', [App\Http\Controllers\Role\Pelanggan\CheckoutController::class, 'store']);
Route::get('/pelanggan/pembelian/{id}/detail', [App\Http\Controllers\Role\Pelanggan\DashboardController::class, 'detail']);
Route::post('/pelanggan/pembelian/{id}/upload', [App\Http\Controllers\Role\Pelanggan\DashboardController::class, 'upload']);
