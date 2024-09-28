<?php

use Illuminate\Support\Facades\Route;
use App\Modules\NamaJurusan\Controllers\NamaJurusanController;

Route::controller(NamaJurusanController::class)->middleware(['web','auth'])->name('namajurusan.')->group(function(){
	Route::get('/namajurusan', 'index')->name('index');
	Route::get('/namajurusan/data', 'data')->name('data.index');
	Route::get('/namajurusan/create', 'create')->name('create');
	Route::post('/namajurusan', 'store')->name('store');
	Route::get('/namajurusan/{namajurusan}', 'show')->name('show');
	Route::get('/namajurusan/{namajurusan}/edit', 'edit')->name('edit');
	Route::patch('/namajurusan/{namajurusan}', 'update')->name('update');
	Route::get('/namajurusan/{namajurusan}/delete', 'destroy')->name('destroy');
});