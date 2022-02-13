<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UploadProfileController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/chat', function () {
        return view('users.messages');
    })->name('chat');
    Route::post('/upload-profile', [UploadProfileController::class, 'upload'])->name('upload');
    // Route::view('chat','users.messages');
});
