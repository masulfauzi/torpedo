<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Jadwal\Controllers\JadwalController;

Route::controller(JadwalController::class)->middleware(['web','auth'])->name('jadwal.')->group(function(){
	Route::get('/jadwal', 'index')->name('index');
	Route::get('/jadwal/data', 'data')->name('data.index');
	Route::get('/jadwal/create', 'create')->name('create');
	Route::post('/jadwal', 'store')->name('store');
	Route::get('/jadwal/{jadwal}', 'show')->name('show');
	Route::get('/jadwal/{jadwal}/edit', 'edit')->name('edit');
	Route::patch('/jadwal/{jadwal}', 'update')->name('update');
	Route::get('/jadwal/{jadwal}/delete', 'destroy')->name('destroy');
});