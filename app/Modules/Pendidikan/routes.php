<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Pendidikan\Controllers\PendidikanController;

Route::controller(PendidikanController::class)->middleware(['web','auth'])->name('pendidikan.')->group(function(){
	Route::get('/pendidikan', 'index')->name('index');
	Route::get('/pendidikan/data', 'data')->name('data.index');
	Route::get('/pendidikan/create', 'create')->name('create');
	Route::post('/pendidikan', 'store')->name('store');
	Route::get('/pendidikan/{pendidikan}', 'show')->name('show');
	Route::get('/pendidikan/{pendidikan}/edit', 'edit')->name('edit');
	Route::patch('/pendidikan/{pendidikan}', 'update')->name('update');
	Route::get('/pendidikan/{pendidikan}/delete', 'destroy')->name('destroy');
});