<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AlasanPip\Controllers\AlasanPipController;

Route::controller(AlasanPipController::class)->middleware(['web','auth'])->name('alasanpip.')->group(function(){
	Route::get('/alasanpip', 'index')->name('index');
	Route::get('/alasanpip/data', 'data')->name('data.index');
	Route::get('/alasanpip/create', 'create')->name('create');
	Route::post('/alasanpip', 'store')->name('store');
	Route::get('/alasanpip/{alasanpip}', 'show')->name('show');
	Route::get('/alasanpip/{alasanpip}/edit', 'edit')->name('edit');
	Route::patch('/alasanpip/{alasanpip}', 'update')->name('update');
	Route::get('/alasanpip/{alasanpip}/delete', 'destroy')->name('destroy');
});