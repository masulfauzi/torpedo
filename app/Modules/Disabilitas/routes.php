<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Disabilitas\Controllers\DisabilitasController;

Route::controller(DisabilitasController::class)->middleware(['web','auth'])->name('disabilitas.')->group(function(){
	Route::get('/disabilitas', 'index')->name('index');
	Route::get('/disabilitas/data', 'data')->name('data.index');
	Route::get('/disabilitas/create', 'create')->name('create');
	Route::post('/disabilitas', 'store')->name('store');
	Route::get('/disabilitas/{disabilitas}', 'show')->name('show');
	Route::get('/disabilitas/{disabilitas}/edit', 'edit')->name('edit');
	Route::patch('/disabilitas/{disabilitas}', 'update')->name('update');
	Route::get('/disabilitas/{disabilitas}/delete', 'destroy')->name('destroy');
});