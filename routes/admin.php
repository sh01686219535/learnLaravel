<?php

use App\Http\Controllers\backend\AjaxCurdController;
use App\Http\Controllers\CurdController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::post('/userInformation', [HomeController::class, 'userInformation'])->name('userInformation');
    Route::resource('/curd', CurdController::class);
    Route::get('/add-to-cart/{id}',[HomeController::class ,'addToCart'])->name('add-to-cart');
    Route::post('/event/store',[HomeController::class ,'eventStore'])->name('event.store');
    Route::get('/send/otp',[HomeController::class ,'sendOtp'])->name('send-otp');
   
    Route::get('/ajax/curd',[AjaxCurdController::class,'ajaxCurd'])->name('ajax.curd');
    Route::post('/add/curd',[AjaxCurdController::class,'addCurd'])->name('add.curd');
    Route::post('/edit/curd',[AjaxCurdController::class,'editCurd'])->name('edit.curd');
    Route::post('/delete/curd',[AjaxCurdController::class,'deleteCurd'])->name('delete.curd');
    Route::get('/pagination/paginate-data',[AjaxCurdController::class,'pagination']);
    Route::get('/ajax/search',[AjaxCurdController::class,'ajaxSearch']);
});
