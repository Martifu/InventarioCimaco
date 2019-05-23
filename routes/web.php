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

Route::get('/buscar', function () {
    return view('templates.base_dashboard');
});

Route::get('equipos','EquiposController@equipos');

Auth::routes();

Route::get('/principal', 'HomeController@index')->name('principal');
Route::get('/buscar','EquiposController@buscar_view');

//Agregar
Route::get('/agregar', 'HomeController@agregar');
Route::post('/agregar','HomeController@agregarequipo');

//Eliminar
Route::post("/eliminado","EquiposController@equipo_a_eliminar");
Route::post('/aeliminar', 'EquiposController@aeliminar');

//Editar
Route::post('/equipo_a_editar', 'EquiposController@equipo_a_editar');
Route::post('/actualizarequipo', 'EquiposController@actualizarequipo');

//PDFs Reportes
Route::post('/reporte_activofijo','EquiposController@activofijo');

Route::get('/todo','EquiposController@todo');

