<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;

Route::get('/user', function (Request $request) {
    $user = $request->user();
    $user->load('roles');
    return $user;
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class,'register'])->name('user.register');
Route::post('/login', [AuthController::class,'login'])->name('user.login');

// authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('tickets', [TicketController::class, 'index']);
    Route::post('tickets', [TicketController::class, 'store'])->middleware(['role:customer']);
    Route::patch('tickets/{ticket}', [TicketController::class, 'update']);
    Route::get('tickets/{ticket}', [TicketController::class, 'show']);
    Route::delete('tickets/{ticket}', [TicketController::class, 'destroy']);

    Route::get('comments/{ticket}', [CommentController::class, 'index']);
    Route::post('comments/{ticket}', [CommentController::class, 'store']);
    Route::patch('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

    Route::get('chats/{ticket}', [ChatMessageController::class, 'index']);
    Route::post('chats/{ticket}', [ChatMessageController::class,'store']);
    
    Route::post('/logout', [AuthController::class,'logout'])->name('user.logout')->middleware('auth:sanctum');
});

// customer routes


