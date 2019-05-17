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

Route::post('/agregar','HomeController@agregarequipo');

Route::get('/buscar','EquiposController@buscar_view');
//<<<<<<< HEAD
//>>>>>>> 099d7d7a9861f4cfa5a5c5613fbe1ca15d95e643


//=======

Route::post('/equipo_a_editar', 'EquiposController@equipo_a_editar');

Route::post('/actualizarequipo', 'EquiposController@actualizarequipo');
//>>>>>>> 74a2f19857ef0d05a81f86bda925152182fb8380
