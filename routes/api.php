<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('tickets', TicketController::class);

// authentication routes
Route::post('/register', [AuthController::class,'register'])->name('user.register');
Route::post('/login', [AuthController::class,'login'])->name('user.login');
Route::post('/logout', [AuthController::class,'logout'])->name('user.logout');
