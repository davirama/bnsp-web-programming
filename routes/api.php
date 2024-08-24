<?php

use App\Http\Controllers\AccountUserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Middleware\PelangganOnly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/webhooks/midtrans', [CheckoutController::class, 'webhook']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/pelanggan/berhasil-order', [CheckoutController::class, 'berhasilOrder'])->name('checkout.berhasilOrder');

Route::get('/restore-kuota', [AccountUserController::class, 'restoreKuota']);
