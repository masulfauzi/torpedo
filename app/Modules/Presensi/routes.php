<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Presensi\Controllers\PresensiController;

Route::controller(PresensiController::class)->middleware(['web','auth'])->name('presensi.')->group(function(){
	Route::get('/presensi', 'index')->name('index');
	Route::get('/presensi/data', 'data')->name('data.index');
	Route::get('/presensi/create', 'create')->name('create');
	Route::post('/presensi', 'store')->name('store');
	Route::get('/presensi/{presensi}', 'show')->name('show');
	Route::get('/presensi/{presensi}/edit', 'edit')->name('edit');
	Route::patch('/presensi/{presensi}', 'update')->name('update');
	Route::get('/presensi/{presensi}/delete', 'destroy')->name('destroy');
});