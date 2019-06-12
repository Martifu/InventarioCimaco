<?php

namespace App\Http\Controllers;

use App\Proveedores;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    function viewproveedores(){
        $proveedores = Proveedores::all();
        return view('CRUD_acciones.proveedores',compact('proveedores'));
    }

    function agregarproveedor(Request $request){
        $nombre = $request->nombre;

        $proveedor = new Proveedores();
        $proveedor->nombre = $nombre;
        $proveedor->save();
        \Session::flash('tipo',$proveedor);
        return \Redirect::back();
    }

    function proveedoraeliminar(Request $request){
        $proveedor = Proveedores::where('id',$request->id)->get();
        return $proveedor;
    }

    function eliminarproveedor(Request $request){
        $proveedor_eli = Proveedores::findOrFail($request->id);
        $proveedor_eli->delete($request->id);
        \Session::flash('eliminado',$proveedor_eli);
        return \Redirect::back();
    }

    function proveedoraeditar(Request $request){
        $proveedor = Proveedores::where('id',$request->id)->get();
        return $proveedor;
    }

    function actualizarproveedor(Request $request){
        $proveedor = Proveedores::where('id',$request->id)->update(['nombre'=>$request->nombre]);
        \Session::flash('editado',$proveedor);
        return \Redirect::back();

    }
}
