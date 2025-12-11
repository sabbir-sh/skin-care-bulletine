<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogPostApiController;
use App\Http\Controllers\Api\CategoryApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Blog API Routes
Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogPostApiController::class, 'index']);
    Route::post('/', [BlogPostApiController::class, 'store']);
    Route::get('/{id}', [BlogPostApiController::class, 'show']);
    Route::post('/update/{id}', [BlogPostApiController::class, 'update']); 
    Route::delete('/{id}', [BlogPostApiController::class, 'destroy']);
});

// Category API Routes
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryApiController::class, 'index']);
    Route::post('/', [CategoryApiController::class, 'store']);
    Route::get('/{id}', [CategoryApiController::class, 'show']);
    Route::post('/update/{id}', [CategoryApiController::class, 'update']);
    Route::delete('/{id}', [CategoryApiController::class, 'destroy']);
});