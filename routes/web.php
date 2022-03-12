<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

// ---------------START UMUM---------------
// home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/kontak', [HomeController::class, 'contact'])->name('kontak');

// artikel
Route::prefix('/artikel')->group(function () {
    Route::get('/', [HomeController::class, 'artikel'])->name('artikel');
    Route::get('/{article:slug}', [HomeController::class, 'artikelDetail'])->name('artikel.detail');
});

// login
Route::get('/login', [LoginController::class, 'loginTampil'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// ---------------END UMUM---------------

// ---------------START ADMIN---------------
Route::group(['middleware' => ['auth']], function () {
    Route::prefix('/admin')->group(function () {
        // dashboard
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // tag
        Route::resource('tag', TagController::class)->parameters([
            'tag' => 'tag'
        ])->names([
            'index' => 'admin.tag',
            'create' => 'admin.tag.tambah',
            'show' => 'admin.tag.lihat',
            'store' => 'admin.tag.tambah.post',
            'edit' => 'admin.tag.ubah',
            'update' => 'admin.tag.ubah.put',
            'destroy' => 'admin.tag.hapus',
        ]);

        // kategori artikel
        Route::resource('kategori-artikel', ArticleCategoryController::class)->parameters([
            'kategori-artikel' => 'articleCategory'
        ])->names([
            'index' => 'admin.kategoriartikel',
            'create' => 'admin.kategoriartikel.tambah',
            'show' => 'admin.kategoriartikel.lihat',
            'store' => 'admin.kategoriartikel.tambah.post',
            'edit' => 'admin.kategoriartikel.ubah',
            'update' => 'admin.kategoriartikel.ubah.put',
            'destroy' => 'admin.kategoriartikel.hapus',
        ]);

        // artikel
        Route::post('artikel/{article}', [ArticleController::class, 'update'])->name('admin.artikel.ubah.post');
        Route::put('artikel/publish/{article}', [ArticleController::class, 'publish'])->name('admin.artikel.publish');
        Route::resource('artikel', ArticleController::class)->except('update')->parameters([
            'artikel' => 'article'
        ])->names([
            'index' => 'admin.artikel',
            'create' => 'admin.artikel.tambah',
            'store' => 'admin.artikel.tambah.post',
            'show' => 'admin.artikel.lihat',
            'edit' => 'admin.artikel.ubah',
            'destroy' => 'admin.artikel.hapus',
        ]);

        // respon customer
        Route::post('respon-customer/read/{customerResponse}', [CustomerResponseController::class, 'read'])->name('admin.responcustomer.read');
        Route::post('respon-customer/unread/{customerResponse}', [CustomerResponseController::class, 'unread'])->name('admin.responcustomer.unread');
        Route::resource('respon-customer', CustomerResponseController::class)->except(['create', 'edit ', 'update'])->parameters([
            'respon-customer' => 'customerResponse'
        ])->names([
            'index' => 'admin.responcustomer',
            'show' => 'admin.responcustomer.lihat',
            'store' => 'admin.responcustomer.tambah.post',
            'destroy' => 'admin.responcustomer.hapus',
        ]);

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
});
// ---------------END ADMIN---------------
