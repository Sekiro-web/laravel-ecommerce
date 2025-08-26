<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::controller(FirstController::class)->group(function () {
    Route::get('/', 'MainPage')->name('main');
    Route::get('/contact', 'ContactPage')->name('contact');
    Route::get('/cart', 'CartPage')->name('cart');
    Route::get('/checkOut', 'checkOut')->name('checkOut');
});

Route::controller(AboutController::class)->group(function () {
    Route::get('/about', 'AboutPage')->name('about');
    Route::post('/storefeedback', 'StoreFeedback')->name('StoreFeedback');
    Route::get('/feedback/{status?}', 'ReviewFeedback')->name('ReviewFeedback')->middleware(['auth', 'privilage:adminOrOwner']);
    Route::post('/ApproveFeedback/{id}', 'ApproveFeedback')->name('ApproveFeedback')->middleware(['auth', 'privilage:adminOrOwner']);
    Route::post('/RejectFeedback', 'RejectFeedback')->name('RejectFeedback')->middleware(['auth', 'privilage:adminOrOwner']);
    Route::get('/DeleteFeedback/{id}', 'DeleteFeedback')->name('DeleteFeedback')->middleware(['auth', 'privilage:owner']);
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products/{name?}',  'ProductPage')->name('products');
    Route::get('/productDetails/{id}',  'productDetails')->name('productDetails');
    Route::get('/ProductsTable',  'ProductsTable')->name('ProductsTable')->middleware(['auth', 'privilage:adminOrOwner']);
    Route::get('/addproduct', 'addProduct')->name('addProducts')->middleware(['auth', 'privilage:adminOrOwner']);
    Route::post('/storeproduct', 'ControlProduct')->name('controlProduct')->middleware(['auth', 'privilage:adminOrOwner']);
    Route::get('/deleteproduct/{id}', 'deleteProduct')->name('deleteProduct')->middleware(['auth', 'privilage:adminOrOwner']);
    Route::get('/editproduct/{id}', 'editProduct')->name('editProduct')->middleware(['auth', 'privilage:adminOrOwner']);
    Route::post('/doeditproduct', 'ControlProduct')->name('controlProduct')->middleware(['auth', 'privilage:adminOrOwner']);
    Route::post('/addProductImage', 'addProductImage')->name('addProductImage')->middleware(['auth', 'privilage:adminOrOwner']);
    Route::get('/deleteProductImage/{id}', 'deleteProductImage')->name('deleteProductImage')->middleware(['auth', 'privilage:adminOrOwner']);
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories',  'index')->name('categories');
    Route::get('/addCategory', 'addCategory')->name('addCategory')->middleware(['auth', 'privilage:owner']);
    Route::post('/storeCategory', 'ControlCategory')->name('controlCategory')->middleware(['auth', 'privilage:owner']);
    Route::get('/deleteCategory/{id}', 'deleteCategory')->name('deleteCategory')->middleware(['auth', 'privilage:owner']);
    Route::get('/editCategory/{id}', 'editCategory')->name('editCategory')->middleware(['auth', 'privilage:owner']);
    Route::post('/doeditCategory', 'ControlCategory')->name('controlCategory')->middleware(['auth', 'privilage:owner']);
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware(['auth', 'privilage:adminOrOwner']);
