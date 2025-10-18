<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
});

// Route::group(['prefix' => 'admin/promocode'], function () {
//         Route::get('/', [PromoCodeController::class, 'index'])->name('promoCodeList');
//         Route::get('create', [PromoCodeController::class, 'create'])->name('promoCodeCreate');
//         Route::post('store', [PromoCodeController::class, 'store'])->name('promoCodeStore');
//         Route::get('edit/{id}', [PromoCodeController::class, 'edit'])->name('promoCodeEdit');
//         Route::patch('update/{id}', [PromoCodeController::class, 'update'])->name('promoCodeUpdate');
//         Route::get('delete/{id}', [PromoCodeController::class, 'destroy'])->name('promoCodeDestroy');
//        	Route::post('promo-code/status', [PromoCodeController::class, 'updateStatus'])->name('promoCodeStatus');
//     });