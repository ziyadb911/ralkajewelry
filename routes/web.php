<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

// ---------------START UMUM---------------
Route::get('/', [HomeController::class, 'index'])->name('home');

// login
Route::get('/login', [LoginController::class, 'loginTampil'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// ---------------END UMUM---------------

// ---------------START ADMIN---------------
Route::group(['middleware' => ['auth']], function () {
    // dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    
    // informasi perusahaan
    Route::get('/informasi-perusahaan', [InfoPerusahaanController::class, 'infoPerusahaanTampil'])->name('admin.infoperusahaan');
    Route::post('/informasi-perusahaan', [InfoPerusahaanController::class, 'ubahInfoPerusahaan'])->name('admin.infoperusahaan.post');

    // ubah akun
    Route::get('/ubah-akun', [UserController::class, 'ubahAkunTampil'])->name('admin.akun.ubah');
    Route::post('/ubah-akun', [UserController::class, 'ubahAkun'])->name('admin.akun.ubah.post'); 

    // ganti password
    Route::get('/ganti-password', [UserController::class, 'gantiPasswordTampil'])->name('admin.akun.gantipass');
    Route::post('/ganti-password', [UserController::class, 'gantiPassword'])->name('admin.akun.gantipass.post'); 
});
// ---------------END ADMIN---------------
