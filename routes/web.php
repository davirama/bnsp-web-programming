<?php

use App\Http\Controllers\AccountUserController;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\AuthenticateUser;
use Illuminate\Support\Facades\Route;


Route::view('/', 'index')->name('index');
// Route::view('/', 'index')->name('index');
Route::post('/login', [AccountUserController::class, 'login'])->name('login');
Route::post('/logout', [AccountUserController::class, 'logout'])->name('logout');
Route::post('/regispeserta', [AccountUserController::class, 'regispeserta'])->name('regispeserta');
// Route::view('/halamanregis', 'regis')->name('halamanregis');

// ROUTES UNTUK PAGE YANG BUTUH MIDDLEWARE USER HARUS LOGIN KELOMPOKKAN DIBAWAH SINI
Route::middleware([AuthenticateUser::class])->group(function () {
  Route::get('/dashboardpeserta', [AccountUserController::class, 'dashboardpeserta'])->name('dashboardpeserta');
});

Route::middleware([AdminOnly::class])->group(function () {
  Route::view('/halamanregis', 'regis')->name('halamanregis');
});
