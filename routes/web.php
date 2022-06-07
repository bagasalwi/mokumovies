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

Route::get('/', 'MainController@home')->name('home');


Route::get('/movie/{id}/{slug}', 'MainController@movieDetail')->name('detail');
Route::get('/movie/search', 'MainController@searchMovie')->name('search');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');