<?php

use Illuminate\Support\Facades\Route;
use App\Modules\JamMengajar\Controllers\JamMengajarController;

Route::controller(JamMengajarController::class)->middleware(['web','auth'])->name('jammengajar.')->group(function(){
	Route::get('/jammengajar', 'index')->name('index');
	Route::get('/jammengajar/data', 'data')->name('data.index');
	Route::get('/jammengajar/create', 'create')->name('create');
	Route::post('/jammengajar', 'store')->name('store');
	Route::get('/jammengajar/{jammengajar}', 'show')->name('show');
	Route::get('/jammengajar/{jammengajar}/edit', 'edit')->name('edit');
	Route::patch('/jammengajar/{jammengajar}', 'update')->name('update');
	Route::get('/jammengajar/{jammengajar}/delete', 'destroy')->name('destroy');
});