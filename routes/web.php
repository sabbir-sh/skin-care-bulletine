<?php

use App\Http\Controllers\Backend\BlogPostController;
use App\Http\Controllers\Frontend\AboutUsController;
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


Route::get('/about-us', [AboutUsController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contact-us', [ContactController::class, 'contact'])->name('contactUs');
Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact.submit');



// Backend
Route::prefix('blog-post')->name('blog.')->group(function () {
    Route::get('/', [BlogPostController::class, 'index'])->name('list');
    Route::get('create', [BlogPostController::class, 'create'])->name('create');
    Route::post('store', [BlogPostController::class, 'store'])->name('store');
    Route::get('edit/{id}', [BlogPostController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [BlogPostController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [BlogPostController::class, 'destroy'])->name('destroy');
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
