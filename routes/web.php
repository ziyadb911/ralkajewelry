<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

// UMUM
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'loginTampil'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ADMIN
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');

    // ganti password
    Route::get('/ganti-password', [UserController::class, 'gantiPasswordTampil'])->name('admin.akun.gantipass');
    Route::post('/ganti-password', [UserController::class, 'gantiPassword'])->name('admin.akun.gantipass.post'); 
});
