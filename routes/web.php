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
Route::get('/movie/addfavorites', 'FavoriteMovieController@addFavorites')->name('addfav');
Route::get('/movie/delfavorites', 'FavoriteMovieController@delFavorites')->name('delfav');

Route::get('/user/favorite', 'FavoriteMovieController@index')->name('favorite');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('index');
Route::get('lang/{lang}', 'MainController@switchLang')->name('lang.switch');