<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;

Route::apiResource('siswas', SiswaController::class);
Route::apiResource('pasiens', PasienController::class);
Route::apiResource('obats', ObatController::class);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
