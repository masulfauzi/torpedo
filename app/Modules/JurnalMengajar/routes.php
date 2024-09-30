<?php

use Illuminate\Support\Facades\Route;
use App\Modules\JurnalMengajar\Controllers\JurnalMengajarController;

Route::controller(JurnalMengajarController::class)->middleware(['web','auth'])->name('jurnalmengajar.')->group(function(){
	Route::get('/jurnalmengajar', 'index')->name('index');
	Route::get('/jurnalmengajar/data', 'data')->name('data.index');
	Route::get('/jurnalmengajar/create', 'create')->name('create');
	Route::post('/jurnalmengajar', 'store')->name('store');
	Route::get('/jurnalmengajar/{jurnalmengajar}', 'show')->name('show');
	Route::get('/jurnalmengajar/{jurnalmengajar}/edit', 'edit')->name('edit');
	Route::patch('/jurnalmengajar/{jurnalmengajar}', 'update')->name('update');
	Route::get('/jurnalmengajar/{jurnalmengajar}/delete', 'destroy')->name('destroy');
});