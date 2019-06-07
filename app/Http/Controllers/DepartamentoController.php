<?php

namespace App\Http\Controllers;

use App\Departamentos;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    function viewdepartamentos(){
        $departamentos = Departamentos::all();
        return view('CRUD_acciones.departamento',compact('departamentos'));
    }

    function agregardepartamento(Request $request){
        $nombre = $request->nombre;

        $departamento = new Departamentos();
        $departamento->nombre = $nombre;
        $departamento->save();
        \Session::flash('tipo',$departamento);
        return \Redirect::back();
    }

    function departamentoaeliminar(Request $request){
        $departamento = Departamentos::where('id',$request->id)->get();
        return $departamento;
    }

    function eliminardepartamento(Request $request){
        $departamento_eli = Departamentos::findOrFail($request->id);
        $departamento_eli->delete($request->id);
        \Session::flash('eliminado',$departamento_eli);
        return \Redirect::back();
    }

    function departamentoaeditar(Request $request){
        $departamento = Departamentos::where('id',$request->id)->get();
        return $departamento;
    }

    function actualizardepartamento(Request $request){
        $departamento = Departamentos::where('id',$request->id)->update(['nombre'=>$request->nombre]);
        \Session::flash('editado',$departamento);
        return \Redirect::back();

    }
}
