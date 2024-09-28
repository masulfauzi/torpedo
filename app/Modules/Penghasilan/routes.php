<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Penghasilan\Controllers\PenghasilanController;

Route::controller(PenghasilanController::class)->middleware(['web','auth'])->name('penghasilan.')->group(function(){
	Route::get('/penghasilan', 'index')->name('index');
	Route::get('/penghasilan/data', 'data')->name('data.index');
	Route::get('/penghasilan/create', 'create')->name('create');
	Route::post('/penghasilan', 'store')->name('store');
	Route::get('/penghasilan/{penghasilan}', 'show')->name('show');
	Route::get('/penghasilan/{penghasilan}/edit', 'edit')->name('edit');
	Route::patch('/penghasilan/{penghasilan}', 'update')->name('update');
	Route::get('/penghasilan/{penghasilan}/delete', 'destroy')->name('destroy');
});