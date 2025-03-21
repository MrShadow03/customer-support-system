<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class,'register'])->name('user.register');
Route::post('/login', [AuthController::class,'login'])->name('user.login');

// authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('tickets', [TicketController::class, 'index']);
    Route::post('tickets', [TicketController::class, 'store'])->middleware(['role:customer']);
    Route::patch('tickets', [TicketController::class, 'update']);
    Route::get('tickets\{ticket}', [TicketController::class, 'show']);
    Route::delete('tickets\{ticket}', [TicketController::class, 'destroy']);


    Route::post('/logout', [AuthController::class,'logout'])->name('user.logout')->middleware('auth:sanctum');
});

// customer routes


