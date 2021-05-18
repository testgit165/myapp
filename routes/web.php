<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\KanriController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('create', 'App\Http\Controllers\KanriController@create');
});

Route::post('/create/store', 'App\Http\Controllers\KanriController@store')->name('store');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
