<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Pekerjaan\Controllers\PekerjaanController;

Route::controller(PekerjaanController::class)->middleware(['web','auth'])->name('pekerjaan.')->group(function(){
	Route::get('/pekerjaan', 'index')->name('index');
	Route::get('/pekerjaan/data', 'data')->name('data.index');
	Route::get('/pekerjaan/create', 'create')->name('create');
	Route::post('/pekerjaan', 'store')->name('store');
	Route::get('/pekerjaan/{pekerjaan}', 'show')->name('show');
	Route::get('/pekerjaan/{pekerjaan}/edit', 'edit')->name('edit');
	Route::patch('/pekerjaan/{pekerjaan}', 'update')->name('update');
	Route::get('/pekerjaan/{pekerjaan}/delete', 'destroy')->name('destroy');
});