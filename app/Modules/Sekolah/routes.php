<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Sekolah\Controllers\SekolahController;

Route::controller(SekolahController::class)->middleware(['web','auth'])->name('sekolah.')->group(function(){
	Route::get('/sekolah', 'index')->name('index');
	Route::get('/sekolah/data', 'data')->name('data.index');
	Route::get('/sekolah/create', 'create')->name('create');
	Route::post('/sekolah', 'store')->name('store');
	Route::get('/sekolah/{sekolah}', 'show')->name('show');
	Route::get('/sekolah/{sekolah}/edit', 'edit')->name('edit');
	Route::patch('/sekolah/{sekolah}', 'update')->name('update');
	Route::get('/sekolah/{sekolah}/delete', 'destroy')->name('destroy');
});