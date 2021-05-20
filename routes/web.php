<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\KanriController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('create', 'App\Http\Controllers\KanriController@create');
    Route::post('/create/store', 'App\Http\Controllers\KanriController@store')->name('store');

Route::post('/kanris/delete/{id}','App\Http\Controllers\KanriController@destroy')->name('delete');

Route::get('/kanris/edit/{id}','App\Http\Controllers\KanriController@edit')->name('edit');

Route::post('/kanris/update/{id}','App\Http\Controllers\KanriController@update')->name('update');

});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// 予備
// Route::post('/create/store', 'App\Http\Controllers\KanriController@store')->name('store');

// Route::post('/kanris/delete/{id}','App\Http\Controllers\KanriController@destroy')->name('delete');

// Route::get('/kanris/edit/{id}','App\Http\Controllers\KanriController@edit')->name('edit');

// Route::post('/kanris/update/{id}','App\Http\Controllers\KanriController@update')->name('update');


