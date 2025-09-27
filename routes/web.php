<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.attempt');
Route::get('/register', [LoginController::class, 'showRegister'])->name('register.view');
Route::post('/register', [LoginController::class, 'register'])->name('register.save');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/admin/vendors', [VendorController::class, 'index'])->name('vendors.vendors');
Route::get('/admin/vendors/create', [VendorController::class, 'create'])->name('vendor.create');
Route::post('/vendor/store', [VendorController::class, 'store'])->name('vendor.store');
Route::get('/admin/vendors/{id}', [VendorController::class, 'show'])->name('vendors.show');

/*Product Pages*/

Route::get('/get-godowns/{vendor_id}', [VendorController::class, 'getGodowns']);
Route::get('/admin/product/add', [ProductController::class, 'create'])->name('admin.products.add');
Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');


/* category */
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/admin/category/create', [CategoryController::class, 'store'])->name('category.store');
Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/admin/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');