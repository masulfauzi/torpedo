<?php

use Illuminate\Support\Facades\Route;
use App\Modules\JenisSekolah\Controllers\JenisSekolahController;

Route::controller(JenisSekolahController::class)->middleware(['web','auth'])->name('jenissekolah.')->group(function(){
	Route::get('/jenissekolah', 'index')->name('index');
	Route::get('/jenissekolah/data', 'data')->name('data.index');
	Route::get('/jenissekolah/create', 'create')->name('create');
	Route::post('/jenissekolah', 'store')->name('store');
	Route::get('/jenissekolah/{jenissekolah}', 'show')->name('show');
	Route::get('/jenissekolah/{jenissekolah}/edit', 'edit')->name('edit');
	Route::patch('/jenissekolah/{jenissekolah}', 'update')->name('update');
	Route::get('/jenissekolah/{jenissekolah}/delete', 'destroy')->name('destroy');
});