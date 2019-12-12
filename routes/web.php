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
// Route::get('{path}', "HomeController@index")->where('path', '([A-z\d-\/_.]+)?');
// Route::get('{path}/{path1}', "HomeController@index")->where('path', '([A-z\d-\/_.]+)?');

Route::view('/{any}', 'home');
Route::view('{any}/{any1}', 'home');
