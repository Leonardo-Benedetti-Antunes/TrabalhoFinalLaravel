<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [ProductController::class, 'index'])->name('product');

//Rotas do admin 
Route::get('/admin/product', [AdminProductController::class, 'index'])->name('admin.product');

Route::get('/admin/product/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
Route::get('/admin/product/create', [AdminProductController::class, 'create'])->name('admin.product.create');

Route::post('/admin/product', [AdminProductController::class, 'store'])->name('admin.product.store');
Route::put('/admin/product/{product}', [AdminProductController::class, 'update'])->name('admin.product.update');

Route::get('/admin/product/{product}/delete', [AdminProductController::class, 'delete'])->name('admin.product.delete');

//Rotas do carrinho
Route::get('/shoppingcart', [ShoppingCartController::class, 'index'])->name('shopping_cart');
Route::post('/shoppingcart/add', [ShoppingCartController::class, 'add'])->name('cart.add');
Route::delete('/shoppingcart/remove/{id}', [ShoppingCartController::class, 'remove'])->name('cart.remove');
Route::post('/shoppingcart/checkout', [ShoppingCartController::class, 'checkout'])->name('cart.checkout');

Route::get('/payment', [PaymentController::class, 'index'])->name('payment');