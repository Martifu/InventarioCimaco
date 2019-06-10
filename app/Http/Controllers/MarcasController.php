<?php

namespace App\Http\Controllers;


use Response;
use App;
use App\Marcas;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    function viewmarcas(){
        $marcas = Marcas::all();
        return view('CRUD_acciones.marca',compact('marcas'));
    }

    function agregarmarca(Request $request){
        $nombre = $request->nombre;
        $marca = new Marcas();
        $marca->nombre = $nombre;
        $marca->save();
        \Session::flash('tipo',$marca);
        return \Redirect::back();
    }

    function marcaaeliminar(Request $request){
        $marca = Marcas::where('id',$request->id)->get();
        return $marca;
    }

    function eliminarmarca(Request $request){
        $marca_eli = Marcas::findOrFail($request->id);
        $marca_eli->delete($request->id);
        \Session::flash('eliminado',$marca_eli);
        return \Redirect::back();
    }

    function marcaaeditar(Request $request){
        $marca = Marcas::where('id',$request->id)->get();
        return $marca;
    }

    function actualizarmarca(Request $request){
        $marca = Marcas::where('id',$request->id)->update(['nombre'=>$request->nombre]);
        \Session::flash('editado',$marca);
        return \Redirect::back();

    }
}
