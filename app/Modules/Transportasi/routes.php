<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Transportasi\Controllers\TransportasiController;

Route::controller(TransportasiController::class)->middleware(['web','auth'])->name('transportasi.')->group(function(){
	Route::get('/transportasi', 'index')->name('index');
	Route::get('/transportasi/data', 'data')->name('data.index');
	Route::get('/transportasi/create', 'create')->name('create');
	Route::post('/transportasi', 'store')->name('store');
	Route::get('/transportasi/{transportasi}', 'show')->name('show');
	Route::get('/transportasi/{transportasi}/edit', 'edit')->name('edit');
	Route::patch('/transportasi/{transportasi}', 'update')->name('update');
	Route::get('/transportasi/{transportasi}/delete', 'destroy')->name('destroy');
});