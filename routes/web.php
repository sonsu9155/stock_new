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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','HomeController@index')->name('home');
Route::get('/neirong','HomeController@neirong')->name('neirong');
Route::get('/about','HomeController@about')->name('about');
Route::get('/rule','HomeController@rule')->name('rule');
Route::get('/auth/login','Auth\LoginController@index')->name('login');


