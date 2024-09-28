<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StatusPerkawinan\Controllers\StatusPerkawinanController;

Route::controller(StatusPerkawinanController::class)->middleware(['web','auth'])->name('statusperkawinan.')->group(function(){
	Route::get('/statusperkawinan', 'index')->name('index');
	Route::get('/statusperkawinan/data', 'data')->name('data.index');
	Route::get('/statusperkawinan/create', 'create')->name('create');
	Route::post('/statusperkawinan', 'store')->name('store');
	Route::get('/statusperkawinan/{statusperkawinan}', 'show')->name('show');
	Route::get('/statusperkawinan/{statusperkawinan}/edit', 'edit')->name('edit');
	Route::patch('/statusperkawinan/{statusperkawinan}', 'update')->name('update');
	Route::get('/statusperkawinan/{statusperkawinan}/delete', 'destroy')->name('destroy');
});