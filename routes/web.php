<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.pages.dashboard.dashboard');
});

Route::get('/vendors', function () {
    return view('admin.pages.vendors.vendors');
});

Route::get('/vendors/add', function () {
    return view('admin.pages.vendors.add_vendor');
});