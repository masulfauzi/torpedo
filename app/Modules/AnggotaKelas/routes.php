<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AnggotaAnggotaKelas\Controllers\AnggotaAnggotaKelasController;

Route::controller(AnggotaKelasController::class)->middleware(['web','auth'])->name('anggotakelas.')->group(function(){
	Route::get('/anggotakelas', 'index')->name('index');
	Route::get('/anggotakelas/data', 'data')->name('data.index');
	Route::get('/anggotakelas/create', 'create')->name('create');
	Route::post('/anggotakelas', 'store')->name('store');
	Route::get('/anggotakelas/{anggotakelas}', 'show')->name('show');
	Route::get('/anggotakelas/{anggotakelas}/edit', 'edit')->name('edit');
	Route::patch('/anggotakelas/{anggotakelas}', 'update')->name('update');
	Route::get('/anggotakelas/{anggotakelas}/delete', 'destroy')->name('destroy');
});