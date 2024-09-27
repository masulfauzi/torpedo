<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TempatTinggal\Controllers\TempatTinggalController;

Route::controller(TempatTinggalController::class)->middleware(['web','auth'])->name('tempattinggal.')->group(function(){
	Route::get('/tempattinggal', 'index')->name('index');
	Route::get('/tempattinggal/data', 'data')->name('data.index');
	Route::get('/tempattinggal/create', 'create')->name('create');
	Route::post('/tempattinggal', 'store')->name('store');
	Route::get('/tempattinggal/{tempattinggal}', 'show')->name('show');
	Route::get('/tempattinggal/{tempattinggal}/edit', 'edit')->name('edit');
	Route::patch('/tempattinggal/{tempattinggal}', 'update')->name('update');
	Route::get('/tempattinggal/{tempattinggal}/delete', 'destroy')->name('destroy');
});