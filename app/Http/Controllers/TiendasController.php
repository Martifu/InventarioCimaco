<?php

namespace App\Http\Controllers;

use App\Tiendas;
use Illuminate\Http\Request;

class TiendasController extends Controller
{
    function viewtiendas(){
        $tiendas = Tiendas::all();
        return view('CRUD_acciones.tiendas',compact('tiendas'));
    }

    function agregartienda(Request $request){
        $nombre = $request->nombre;

        $tienda = new Tiendas();
        $tienda->nombre = $nombre;
        $tienda->save();
        \Session::flash('tipo',$tienda);
        return \Redirect::back();
    }

    function tiendaaeliminar(Request $request){
        $tienda = Tiendas::where('id',$request->id)->get();
        return $tienda;
    }

    function eliminartienda(Request $request){
        $tienda_eli = Tiendas::findOrFail($request->id);
        $tienda_eli->delete($request->id);
        \Session::flash('eliminado',$tienda_eli);
        return \Redirect::back();
    }

    function tiendaaeditar(Request $request){
        $tienda = Tiendas::where('id',$request->id)->get();
        return $tienda;
    }

    function actualizartienda(Request $request){
        $tienda = Tiendas::where('id',$request->id)->update(['nombre'=>$request->nombre]);
        \Session::flash('editado',$tienda);
        return \Redirect::back();

    }
}
