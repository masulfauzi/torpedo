<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Keluarga\Controllers\KeluargaController;

Route::controller(KeluargaController::class)->middleware(['web','auth'])->name('keluarga.')->group(function(){
	Route::get('/keluarga', 'index')->name('index');
	Route::get('/keluarga/data', 'data')->name('data.index');
	Route::get('/keluarga/create', 'create')->name('create');
	Route::post('/keluarga', 'store')->name('store');
	Route::get('/keluarga/{keluarga}', 'show')->name('show');
	Route::get('/keluarga/{keluarga}/edit', 'edit')->name('edit');
	Route::patch('/keluarga/{keluarga}', 'update')->name('update');
	Route::get('/keluarga/{keluarga}/delete', 'destroy')->name('destroy');
});