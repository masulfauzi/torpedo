<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AlasanTolakKip\Controllers\AlasanTolakKipController;

Route::controller(AlasanTolakKipController::class)->middleware(['web','auth'])->name('alasantolakkip.')->group(function(){
	Route::get('/alasantolakkip', 'index')->name('index');
	Route::get('/alasantolakkip/data', 'data')->name('data.index');
	Route::get('/alasantolakkip/create', 'create')->name('create');
	Route::post('/alasantolakkip', 'store')->name('store');
	Route::get('/alasantolakkip/{alasantolakkip}', 'show')->name('show');
	Route::get('/alasantolakkip/{alasantolakkip}/edit', 'edit')->name('edit');
	Route::patch('/alasantolakkip/{alasantolakkip}', 'update')->name('update');
	Route::get('/alasantolakkip/{alasantolakkip}/delete', 'destroy')->name('destroy');
});