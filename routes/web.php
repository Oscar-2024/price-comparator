<?php

use App\Http\Controllers\PriceComparatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', ProductController::class)
    ->name('products.index');

Route::get('/compare/{product}', PriceComparatorController::class)
    ->name('products.price-comparator');
