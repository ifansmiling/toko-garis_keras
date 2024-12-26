<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PublicTestimonialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;


Route::get('/', [ProductController::class, 'showProducts'])->name('home');

// web.php
Route::get('/products', [ProductController::class, 'showProducts'])->name('products.index');
Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
Route::post('/testimonials', [PublicTestimonialController::class, 'store'])->name('testimonials.store');
Route::get('/testimonials', [TestimonialController::class, 'userIndex'])->name('testimonials.index');
Route::post('/checkout', [TransactionController::class, 'store'])->name('transactions.store');
Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Tambahkan prefix "admin" untuk fitur admin
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('testimonials', TestimonialController::class);
});



require __DIR__.'/auth.php';
