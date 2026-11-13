<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Dashboard: ringkasan jumlah produk dan total stok
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// CRUD produk: products.index, create, store, show, edit, update, destroy
Route::resource('products', ProductController::class);
