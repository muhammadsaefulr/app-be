<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('pegawai')->group(function () {
    Route::apiResource('data', App\Http\Controllers\PegawaiController::class);
    Route::apiResource('tempat-tugas', App\Http\Controllers\TempatTugasPegawaiController::class);
    Route::apiResource('unit-tugas', App\Http\Controllers\UnitTugasController::class);
    Route::apiResource('kontak', App\Http\Controllers\KontakPegawaiController::class);
});
