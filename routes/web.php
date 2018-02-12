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
Route::post('api/login', 'Auth\LoginController@login')->name('login');
Route::post('api/register', 'Auth\LoginController@register')->name('register');
Route::post('api/authcheck', 'Auth\LoginController@authcheck')->name('authcheck');
Route::post('api/logout', 'Auth\LoginController@logout')->name('logout');
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
