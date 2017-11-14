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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('active', 'HomeController@activeuser');
Route::post('inactive', 'HomeController@inactiveuser');
Route::post('add3time', 'HomeController@add3time');
Route::post('remove3time', 'HomeController@remove3time');
