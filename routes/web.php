<?php

use App\Http\Controllers\AccountUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\PesertaOnly;
use Illuminate\Support\Facades\Route;


Route::view('/', 'index')->name('index');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');;

// ROUTES UNTUK PAGE YANG BUTUH MIDDLEWARE PESERTA HARUS LOGIN KELOMPOKKAN DIBAWAH SINI
Route::middleware([PesertaOnly::class])->group(function () {
  Route::get('/dashboardpeserta', [PesertaController::class, 'dashboardpeserta'])->name('dashboardpeserta');
  Route::get('/formpendaftaran', [PesertaController::class, 'formpendaftaran'])->name('formpendaftaran');
  Route::post('/updatedatapendaftaran', [PesertaController::class, 'updateDataPendaftaran'])->name('updateDataPendaftaran');
});

// ROUTES UNTUK PAGE YANG BUTUH MIDDLEWARE ADMIN HARUS LOGIN KELOMPOKKAN DIBAWAH SINI
Route::middleware([AdminOnly::class])->group(function () {
  Route::view('/halamanregis', 'admin.regis')->name('halamanregis');
  Route::post('/regispeserta', [AdminController::class, 'regispeserta'])->name('regispeserta');
  Route::get('/dashboardadmin', [AdminController::class, 'dashboardadmin'])->name('dashboardadmin');
  Route::get('/listakunpengguna', [AdminController::class, 'listakunpengguna'])->name('listakunpengguna');
  // Route untuk halaman edit pengguna
  Route::get('/editpengguna/{user_id}', [AdminController::class, 'editpengguna'])->name('editpengguna');
  // Route untuk update pengguna
  Route::put('/updatepengguna/{user_id}', [AdminController::class, 'updatepengguna'])->name('updatepengguna');

  // Route untuk validasi pendaftar
  Route::get('/halamanvalidasi/{user_id}', [AdminController::class, 'formvalidasi'])->name('formvalidasi');

  // Route untuk update pendaftar
  Route::put('/updatependaftar/{user_id}', [AdminController::class, 'updatependaftar'])->name('updatependaftar');

  Route::put('/terima-validasi/{user_id}', [AdminController::class, 'terimaValidasi'])->name('terimaValidasi');
  Route::put('/tolak-validasi/{user_id}', [AdminController::class, 'tolakValidasi'])->name('tolakValidasi');
});
