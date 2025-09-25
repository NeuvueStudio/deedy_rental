<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.attempt');
Route::get('/register', [LoginController::class, 'showRegister'])->name('register.view');
Route::post('/register', [LoginController::class, 'register'])->name('register.save');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');