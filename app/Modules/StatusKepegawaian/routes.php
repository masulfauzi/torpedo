<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StatusKepegawaian\Controllers\StatusKepegawaianController;

Route::controller(StatusKepegawaianController::class)->middleware(['web','auth'])->name('statuskepegawaian.')->group(function(){
	Route::get('/statuskepegawaian', 'index')->name('index');
	Route::get('/statuskepegawaian/data', 'data')->name('data.index');
	Route::get('/statuskepegawaian/create', 'create')->name('create');
	Route::post('/statuskepegawaian', 'store')->name('store');
	Route::get('/statuskepegawaian/{statuskepegawaian}', 'show')->name('show');
	Route::get('/statuskepegawaian/{statuskepegawaian}/edit', 'edit')->name('edit');
	Route::patch('/statuskepegawaian/{statuskepegawaian}', 'update')->name('update');
	Route::get('/statuskepegawaian/{statuskepegawaian}/delete', 'destroy')->name('destroy');
});