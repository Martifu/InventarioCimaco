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
Route::get('/agregar', 'EquiposController@agregar');
Route::post('/agregar','EquiposController@agregarequipo');
Route::get('/tipos', 'EquiposController@Tipos');
Route::post('/tipos','EquiposController@Tipos2');

//Eliminar
Route::post("/eliminado","EquiposController@equipo_a_eliminar");
Route::post('/aeliminar', 'EquiposController@aeliminar');

//Editar
Route::post('/equipo_a_editar', 'EquiposController@equipo_a_editar');
Route::post('/actualizarequipo', 'EquiposController@actualizarequipo');

//PDFs Reportes
Route::post('/reporte_activofijo','EquiposController@activofijo');

Route::get('/todo','EquiposController@todo');


//Agregar Marca
Route::get('/buscarmarca', 'EquiposController@agregarM');
Route::post('/buscarmarca','EquiposController@agregarMarca');
Route::get('buscarmarca', 'EquiposController@buscarmarca');

//Editar Marca
Route::post('/marca_a_editar', 'EquiposController@marca_a_editar');
Route::post('/actualizarmarca', 'EquiposController@actualizarmarca');