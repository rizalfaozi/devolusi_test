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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', 'HomeController@index');
Route::get('/create', 'HomeController@create');
Route::get('/edit/{iduser}', 'HomeController@edit');
Route::post('/update/{iduser}', 'HomeController@update');
Route::post('/store', 'HomeController@store');
Route::get('/delete/{iduser}', 'HomeController@destory');

Route::post('/kabupaten', 'HomeController@kabupaten');
Route::post('/kecamatan', 'HomeController@kecamatan');
Route::post('/kelurahan', 'HomeController@kelurahan');