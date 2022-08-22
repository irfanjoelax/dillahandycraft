<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('beranda');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', [App\Http\Controllers\Role\Admin\DashboardController::class, 'index']);
Route::resource('/admin/kategori', App\Http\Controllers\Role\Admin\KategoriController::class);

Route::get('/pelanggan/dashboard', [App\Http\Controllers\Role\Pelanggan\DashboardController::class, 'index']);
