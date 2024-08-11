<?php

use App\Http\Controllers\CurdController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::post('/userInformation', [HomeController::class, 'userInformation'])->name('userInformation');
    Route::resource('/curd', CurdController::class);
    Route::get('/add-to-cart/{id}',[HomeController::class ,'addToCart'])->name('add-to-cart');
});
