<?php

use Illuminate\Support\Facades\Route;
use App\Modules\HubKeluarga\Controllers\HubKeluargaController;

Route::controller(HubKeluargaController::class)->middleware(['web','auth'])->name('hubkeluarga.')->group(function(){
	Route::get('/hubkeluarga', 'index')->name('index');
	Route::get('/hubkeluarga/data', 'data')->name('data.index');
	Route::get('/hubkeluarga/create', 'create')->name('create');
	Route::post('/hubkeluarga', 'store')->name('store');
	Route::get('/hubkeluarga/{hubkeluarga}', 'show')->name('show');
	Route::get('/hubkeluarga/{hubkeluarga}/edit', 'edit')->name('edit');
	Route::patch('/hubkeluarga/{hubkeluarga}', 'update')->name('update');
	Route::get('/hubkeluarga/{hubkeluarga}/delete', 'destroy')->name('destroy');
});