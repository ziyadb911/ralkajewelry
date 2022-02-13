<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'dashboard']);
Route::get('/login', [HomeController::class, 'index']);
