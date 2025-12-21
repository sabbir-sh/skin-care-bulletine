<?php

use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\BlogPostController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ContactMessageController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\CategoryListController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




// Frontend

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

// Home page showing all blogs
Route::get('/blog', [BlogController::class, 'index'])->name('home');
// Single blog view by slug
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/search', [BlogController::class, 'search'])->name('blog.search');

// category wise blog listing
Route::get('/category/{slug}', [CategoryListController::class, 'show'])->name('category.show');

Route::get('/about-us', [AboutUsController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contact-us', [ContactController::class, 'contact'])->name('contactUs');
Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact.submit');



// Backend

// Blog Post 
Route::prefix('blog-post')->name('blog.')->group(function () {
    Route::get('/', [BlogPostController::class, 'index'])->name('list');
    Route::get('create', [BlogPostController::class, 'create'])->name('create');
    Route::post('store', [BlogPostController::class, 'store'])->name('store');
    // Using {id} as requested
    Route::get('edit/{id}', [BlogPostController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [BlogPostController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [BlogPostController::class, 'destroy'])->name('destroy');
    
});

Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('list');
    Route::get('create', [CategoryController::class, 'create'])->name('create');
    Route::post('store', [CategoryController::class, 'store'])->name('store');
    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactMessageController::class, 'index'])->name('list');
    Route::get('show/{id}', [ContactMessageController::class, 'show'])->name('show');
    Route::delete('delete/{id}', [ContactMessageController::class, 'destroy'])->name('destroy');
});

Route::prefix('faq')->name('faq.')->group(function () {
    Route::get('/', [FaqController::class, 'index'])->name('list');
    Route::get('create', [FaqController::class, 'create'])->name('create');
    Route::post('store', [FaqController::class, 'store'])->name('store');
    Route::get('edit/{id}', [FaqController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [FaqController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [FaqController::class, 'destroy'])->name('destroy');
});

Route::prefix('author')->name('author.')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('list');
    Route::get('create', [AuthorController::class, 'create'])->name('create');
    Route::post('store', [AuthorController::class, 'store'])->name('store');
    Route::get('edit/{id}', [AuthorController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [AuthorController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [AuthorController::class, 'destroy'])->name('destroy');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
