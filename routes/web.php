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
//Info
Route::post('/info_equipo','EquiposController@info_equipo');
//PDFs Reportes
Route::post('/reporte_activofijo','EquiposController@activofijo');



//Agregar Marca
Route::get('/marcas', 'MarcasController@viewmarcas');
Route::post('/agregarmarca','MarcasController@agregarmarca');
Route::post('/marcaaeliminar','MarcasController@marcaaeliminar');
Route::post('/eliminarmarca','MarcasController@eliminarmarca');
Route::post('/marca_a_editar','MarcasController@marcaaeditar');
Route::post('/actualizarmarca','MarcasController@actualizarmarca');




//Tipos de dispositivo
Route::get('/tipos', 'TipoDispositivoController@viewtipos');
Route::post('/agregartipo','TipoDispositivoController@agregartipo');
Route::post('/tipoaeliminar','TipoDispositivoController@tipoaeliminar');
Route::post('/eliminartipo','TipoDispositivoController@eliminartipo');
Route::post('/tipo_a_editar','TipoDispositivoController@tipoaeditar');
Route::post('/actualizartipo','TipoDispositivoController@actualizartipo');

//Departamentos
Route::get('/departamentos', 'DepartamentoController@viewdepartamentos');
Route::post('/agregardepartamento','DepartamentoController@agregardepartamento');
Route::post('/departamentoaeliminar','DepartamentoController@departamentoaeliminar');
Route::post('/eliminardepartamento','DepartamentoController@eliminardepartamento');
Route::post('/departamento_a_editar','DepartamentoController@departamentoaeditar');
Route::post('/actualizardepartamento','DepartamentoController@actualizardepartamento');

//Proveedores
Route::get('/proveedores', 'ProveedoresController@viewproveedores');
Route::post('/agregarproveedor','ProveedoresController@agregarproveedor');
Route::post('/proveedoraeliminar','ProveedoresController@proveedoraeliminar');
Route::post('/eliminarproveedor','ProveedoresController@eliminarproveedor');
Route::post('/proveedor_a_editar','ProveedoresController@proveedoraeditar');
Route::post('/actualizarproveedor','ProveedoresController@actualizarproveedor');

//Tiendas
Route::get('/tiendas', 'TiendasController@viewtiendas');
Route::post('/agregartienda','TiendasController@agregartienda');
Route::post('/tiendaaeliminar','TiendasController@tiendaaeliminar');
Route::post('/eliminartienda','TiendasController@eliminartienda');
Route::post('/tienda_a_editar','TiendasController@tiendaaeditar');
Route::post('/actualizartienda','TiendasController@actualizartienda');





//Usuarios
Route::get('/registrar', 'EquiposController@usuarios');
Route::post('/registrar','EquiposController@tipousuario');

Route::post('/usuarioaeliminar','EquiposController@usuarioaeliminar');
Route::post('/eliminarusuario','EquiposController@eliminarusuario');

Route::post('/usuarioaeditar','EquiposController@usuarioaeditar');
Route::post('/editarusuario','EquiposController@editarusuario');
