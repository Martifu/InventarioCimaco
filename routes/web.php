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
    return view('auth.login');
});

Route::get('/principal', function () {
    return view('templates.base_dashboard');
});

Route::get('equipos','EquiposController@equipos');

Auth::routes();

Route::get('/principal', 'HomeController@index')->name('principal');

Route::get('/agregar', 'HomeController@agregar');