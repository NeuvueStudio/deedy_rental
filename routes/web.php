<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendorController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.attempt');
Route::get('/register', [LoginController::class, 'showRegister'])->name('register.view');
Route::post('/register', [LoginController::class, 'register'])->name('register.save');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/admin/vendors', function () {
    return view('admin.pages.vendors.vendors');
});

Route::get('/admin/vendors', [VendorController::class, 'index'])->name('vendors.vendors');
Route::get('/admin/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
Route::post('/vendor/store', [VendorController::class, 'store'])->name('vendor.store');
Route::get('/admin/vendors/{id}', [VendorController::class, 'show'])->name('vendors.show');
