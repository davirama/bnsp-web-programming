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
});
