<?php

use App\Http\Controllers\Backend\BlogPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




// Frontend
Route::get('/', function () {
    return view('frontend.home');
});




// Backend
Route::prefix('blog-post')->group(function() {
    Route::get('/', [BlogPostController::class, 'index'])->name('blogList');
    Route::get('create', [BlogPostController::class, 'create'])->name('blogCreate');
    Route::post('store', [BlogPostController::class, 'store'])->name('blogStore');
    Route::get('edit/{id}', [BlogPostController::class, 'edit'])->name('blogEdit');
    Route::patch('update/{id}', [BlogPostController::class, 'update'])->name('blogUpdate');
    Route::delete('delete/{id}', [BlogPostController::class, 'destroy'])->name('blogDestroy');
});

















Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
