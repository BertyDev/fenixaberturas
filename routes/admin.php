<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\EditProduct;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for Admin your application.
|
*/

Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProduct::class)
->name('admin.products.create');

Route::post('products/{product}/files', [ProductController::class, 'files'])
->name('admin.products.files');

Route::get('products/{product}/edit', EditProduct::class)
->name('admin.products.edit');

Route::get('categories', [CategoryController::class,'index'])
->name('admin.categories.index');