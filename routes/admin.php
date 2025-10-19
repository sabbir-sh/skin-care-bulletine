<?php

// use App\Http\Controllers\Backend\BlogPostController;
// use Illuminate\Routing\Route;

// Route::prefix('blog-post')->group(function() {
//     Route::get('/', [BlogPostController::class, 'index'])->name('blogList');
//     Route::get('create', [BlogPostController::class, 'create'])->name('blogCreate');
//     Route::post('store', [BlogPostController::class, 'store'])->name('blogStore');
//     Route::get('edit/{id}', [BlogPostController::class, 'edit'])->name('blogEdit');
//     Route::patch('update/{id}', [BlogPostController::class, 'update'])->name('blogUpdate');
//     Route::delete('delete/{id}', [BlogPostController::class, 'destroy'])->name('blogDestroy');
// });

// Category

// use App\Http\Controllers\Backend\CategoryController;
// use Illuminate\Routing\Route;

// Route::prefix('category')->name('category.')->group(function () {
//     Route::get('/', [CategoryController::class, 'index'])->name('list');
//     Route::get('create', [CategoryController::class, 'create'])->name('create');
//     Route::post('store', [CategoryController::class, 'store'])->name('store');
//     Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
//     Route::patch('update/{id}', [CategoryController::class, 'update'])->name('update');
//     Route::delete('delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
// });