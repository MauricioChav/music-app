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

Route::get('/', [
	'uses' => 'App\Http\Controllers\HomeController@mainSite',
	'as' => 'index']);


//Te crea todas las rutas que corresponden a las funciones


Auth::routes();

Route::group(['middleware' => 'auth'], function(){

	Route::get('albums/chooseCreate', 'App\Http\Controllers\AlbumController@chooseCreate')->name('albums.chooseCreate');
	Route::resource('/albums', 'App\Http\Controllers\AlbumController');

	Route::resource('/songs', 'App\Http\Controllers\SongController');

	Route::get('/admin', [
	'uses' => 'App\Http\Controllers\HomeController@index',
	'as' => 'home'
	]);
});

