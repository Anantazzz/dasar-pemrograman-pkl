<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

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

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // Form Registrasi (User)
    Route::get('/users', [UserController::class, 'index'])
        ->middleware('permission:view_user')
        ->name('admin.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])
        ->middleware('permission:edit_user')
        ->name('admin.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])
        ->middleware('permission:edit_user')
        ->name('admin.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->middleware('permission:delete_user')
        ->name('admin.destroy');

    // Form Pembayaran
    Route::resource('pembayaran', PembayaranController::class)->names([
        'index'   => 'admin.pembayaran.index',
        'create'  => 'admin.pembayaran.create',
        'store'   => 'admin.pembayaran.store',
        'show'    => 'admin.pembayaran.show',
        'edit'    => 'admin.pembayaran.edit',
        'update'  => 'admin.pembayaran.update',
        'destroy' => 'admin.pembayaran.destroy',
    ]);


    // Form Pengajuan
    Route::resource('pengajuan', PengajuanController::class)->names([
        'index'   => 'admin.pengajuan.index',
        'create'  => 'admin.pengajuan.create',
        'store'   => 'admin.pengajuan.store',
        'show'    => 'admin.pengajuan.show',
        'edit'    => 'admin.pengajuan.edit',
        'update'  => 'admin.pengajuan.update',
        'destroy' => 'admin.pengajuan.destroy',
     ]);

    // Form Proyek
    Route::resource('proyek', ProyekController::class)->names([
        'index'   => 'admin.proyek.index',
        'create'  => 'admin.proyek.create',
        'store'   => 'admin.proyek.store',
        'show'    => 'admin.proyek.show',
        'edit'    => 'admin.proyek.edit',
        'update'  => 'admin.proyek.update',
        'destroy' => 'admin.proyek.destroy',
    ]);

    // Form Ulasan
    Route::resource('ulasan', UlasanController::class)->names([
        'index'   => 'admin.ulasan.index',
        'create'  => 'admin.ulasan.create',
        'store'   => 'admin.ulasan.store',
        'show'    => 'admin.ulasan.show',
        'edit'    => 'admin.ulasan.edit',
        'update'  => 'admin.ulasan.update',
        'destroy' => 'admin.ulasan.destroy',
    ]);
   
    // Form Portofolio
    Route::resource('portofolio', PortofolioController::class)->names([
        'index'   => 'admin.portofolio.index',
        'create'  => 'admin.portofolio.create',
        'store'   => 'admin.portofolio.store',
        'show'    => 'admin.portofolio.show',
        'edit'    => 'admin.portofolio.edit',
        'update'  => 'admin.portofolio.update',
        'destroy' => 'admin.portofolio.destroy',
     ]);

    // Form Management
    Route::resource('management', ManagementController::class)->names([
        'index'   => 'admin.management.index',
        'create'  => 'admin.management.create',
        'store'   => 'admin.management.store',
        'show'    => 'admin.management.show',
        'edit'    => 'admin.management.edit',
        'update'  => 'admin.management.update',
        'destroy' => 'admin.management.destroy',
     ]);

     // ---------------- Roles (khusus admin/superadmin) ----------------
    Route::resource('roles', RoleController::class)->names([
        'index'   => 'roles.index',
        'create'  => 'roles.create',
        'store'   => 'roles.store',
        'show'    => 'roles.show',
        'edit'    => 'roles.edit',
        'update'  => 'roles.update',
        'destroy' => 'roles.destroy',
    ]);

    Route::resource('permissions', PermissionController::class)->names([
        'index'   => 'permissions.index',
        'create'  => 'permissions.create',
        'store'   => 'permissions.store',
        'show'    => 'permissions.show',
        'edit'    => 'permissions.edit',
        'update'  => 'permissions.update',
        'destroy' => 'permissions.destroy',
    ]);
});

require __DIR__.'/auth.php';