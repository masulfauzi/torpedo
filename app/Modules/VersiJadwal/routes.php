<?php

use Illuminate\Support\Facades\Route;
use App\Modules\VersiJadwal\Controllers\VersiJadwalController;

Route::controller(VersiJadwalController::class)->middleware(['web','auth'])->name('versijadwal.')->group(function(){
	Route::get('/versijadwal', 'index')->name('index');
	Route::get('/versijadwal/data', 'data')->name('data.index');
	Route::get('/versijadwal/create', 'create')->name('create');
	Route::post('/versijadwal', 'store')->name('store');
	Route::get('/versijadwal/{versijadwal}', 'show')->name('show');
	Route::get('/versijadwal/{versijadwal}/edit', 'edit')->name('edit');
	Route::patch('/versijadwal/{versijadwal}', 'update')->name('update');
	Route::get('/versijadwal/{versijadwal}/delete', 'destroy')->name('destroy');
});