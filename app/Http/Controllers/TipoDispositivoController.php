<?php

namespace App\Http\Controllers;

use App\Tipos;
use Illuminate\Http\Request;

class TipoDispositivoController extends Controller
{
    function viewtipos(){
        $dispositivos = Tipos::all();
        return view('CRUD_acciones.tipo_dispositivo',compact('dispositivos'));
    }

    function agregartipo(Request $request){
        $nombre = $request->nombre;

        $tipo = new Tipos();
        $tipo->nombre = $nombre;
        $tipo->save();
        \Session::flash('tipo',$tipo);
        return \Redirect::back();
    }

    function tipoaeliminar(Request $request){
        $dispositivo = Tipos::where('id',$request->id)->get();
        return $dispositivo;
    }

    function eliminartipo(Request $request){
        $dispositivo_eli = Tipos::findOrFail($request->id);
        $dispositivo_eli->delete($request->id);
        \Session::flash('eliminado',$dispositivo_eli);
        return \Redirect::back();
    }

    function tipoaeditar(Request $request){
        $dispositivo = Tipos::where('id',$request->id)->get();
        return $dispositivo;
    }

    function actualizartipo(Request $request){
        $tipodis = Tipos::where('id',$request->id)->update(['nombre'=>$request->nombre]);
        \Session::flash('editado',$tipodis);
        return \Redirect::back();

    }
}
