<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\KanriController@index')->name('index');
Route::post('/', 'App\Http\Controllers\KanriController@index')->name('index');
Route::get('/search', 'App\Http\Controllers\KanriController@search')->name('search');

Route::group(['middleware' => 'auth'], function () 
{
    Route::get('/create', 'App\Http\Controllers\KanriController@create')->name('create');
    Route::post('/create/store', 'App\Http\Controllers\KanriController@store')->name('store');
    Route::get('/kanris/edit/{id}','App\Http\Controllers\KanriController@edit')->name('edit');
    Route::post('/kanris/update/{id}','App\Http\Controllers\KanriController@update')->name('update');
    Route::get('/kanris/show/{id}','App\Http\Controllers\KanriController@show')->name('show');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


