<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\ManagementController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Form Registrasi
Route::get('/users', [UserController::class, 'index'])->name('admin.index');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.destroy');

//Form Pembayaran
Route::get('/form-pembayaran', [PembayaranController::class, 'formAdmin'])->name('admin.pembayaran.form-pembayaran');
Route::get('/form-pembayaran/create', [PembayaranController::class, 'create'])->name('admin.pembayaran.create-pembayaran');
Route::post('/admin/pembayaran/form-pembayaran/store', [PembayaranController::class, 'store'])->name('admin.pembayaran.store');
Route::get('/admin/pembayaran/form-pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('admin.pembayaran.form-pembayaran.edit');
Route::put('/admin/pembayaran/form-pembayaran/{id}', [PembayaranController::class, 'update'])->name('admin.pembayaran.form-pembayaran.update');
Route::delete('/admin/pembayaran/form-pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('admin.pembayaran.form-pembayaran.destroy');

//Form pengajuan penawaran
Route::get('/form-pengajuan', [PengajuanController::class, 'formAdmin'])->name('admin.pengajuan.form-pengajuan');
Route::get('/form-pengajuan/create', [PengajuanController::class, 'create'])->name('admin.pengajuan.create-pengajuan');
Route::post('/admin/pengajuan/form-pengajuan/store', [PengajuanController::class, 'store'])->name('admin.pengajuan.store');
Route::get('/admin/pengajuan/form-pengajuan/{id}/edit', [PengajuanController::class, 'edit'])->name('admin.pengajuan.form-pengajuan.edit');
Route::put('/admin/pengajuan/form-pengajuan/{id}', [PengajuanController::class, 'update'])->name('admin.pengajuan.form-pengajuan.update');
Route::delete('/admin/pengajuan/form-pengajuan/{id}', [PengajuanController::class, 'destroy'])->name('admin.pengajuan.form-pengajuan.destroy');

//Form Posting Proyek
Route::get('/form-proyek', [ProyekController::class, 'formAdmin'])->name('admin.proyek.form-proyek');
Route::get('/form-proyek/create', [ProyekController::class, 'create'])->name('admin.proyek.create-proyek');
Route::post('/admin/proyek/form-proyek/store', [ProyekController::class, 'store'])->name('admin.proyek.store');
Route::get('/admin/proyek/form-proyek/{id}/edit', [ProyekController::class, 'edit'])->name('admin.proyek.form-proyek.edit');
Route::put('/admin/proyek/form-proyek/{id}', [ProyekController::class, 'update'])->name('admin.proyek.form-proyek.update');
Route::delete('/admin/proyek/form-proyek/{id}', [ProyekController::class, 'destroy'])->name('admin.proyek.form-proyek.destroy');

//Form Ulasan
Route::get('/form-ulasan', [UlasanController::class, 'formAdmin'])->name('admin.ulasan.form-ulasan');
Route::get('/form-ulasan/create', [UlasanController::class, 'create'])->name('admin.ulasan.create-ulasan');
Route::post('/admin/ulasan/form-ulasan/store', [UlasanController::class, 'store'])->name('admin.ulasan.store');
Route::get('/admin/ulasan/form-ulasan/{id}/edit', [UlasanController::class, 'edit'])->name('admin.ulasan.form-ulasan.edit');
Route::put('/admin/ulasan/form-ulasan/{id}', [UlasanController::class, 'update'])->name('admin.ulasan.form-ulasan.update');
Route::delete('/admin/ulasan/form-ulasan/{id}', [UlasanController::class, 'destroy'])->name('admin.ulasan.form-ulasan.destroy');

//Form Portofolio
Route::get('/form-portofolio', [PortofolioController::class, 'formAdmin'])->name('admin.portofolio.form-portofolio');
Route::get('/admin/portofolio/create', [PortofolioController::class, 'create'])->name('admin.portofolio.create');
Route::post('/admin/portofolio/store', [PortofolioController::class, 'store'])->name('admin.portofolio.store');
Route::get('/admin/portofolio/{id}/edit', [PortofolioController::class, 'edit'])->name('admin.portofolio.edit');
Route::put('/admin/portofolio/{id}', [PortofolioController::class, 'update'])->name('admin.portofolio.update');
Route::delete('/admin/portofolio/{id}', [PortofolioController::class, 'destroy'])->name('admin.portofolio.destroy');

// Form Management
Route::get('/form-management', [ManagementController::class, 'formAdmin'])->name('admin.management.form-management');
Route::post('/admin/management/store', [ManagementController::class, 'store'])->name('admin.management.store');
Route::delete('/admin/management/delete/{id}', [ManagementController::class, 'destroy'])->name('admin.management.delete');

require __DIR__.'/auth.php';

