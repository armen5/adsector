<?php

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


Auth::routes();

Route::get('/dashboard', 'AppController@index')->name('dashboard');
Route::get('/', 'PagesController@index')->name('landing');
Route::get('/features', 'PagesController@features')->name('features');
Route::get('/about', 'PagesController@about')->name('about');
