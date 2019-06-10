<?php

namespace App\Http\Controllers;
use Response;
use Barryvdh\DomPDF\Facade as PDF;
use App;
use Carbon\Carbon;
use App\Equipos;
use App\Tipos;
use App\Departamentos;
use App\Marcas;
use App\Proveedores;
use App\Tiendas;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
     
     public function agregarM()
    {
        $title = 'Marca';
        return view('marca');
    }

public function agregarMarca(Request $request){

        
        $marcas = new Marcas(); 
        $marcas->nombre=$request->input('marca');
        $marcas->save();
               

          \Session::flash('marcas',$marcas);
            return \Redirect::back();
}

  public function buscarmarca()
    {
      $marcas = Marcas::all();
      
        return view('marca', compact('marcas'));
    }


	  function marcaaeditar(Request $request){
        $marca = Marcas::where('id',$request->id)->get();
        return $marca;
    }

    function actualizarmarca(Request $request){
        $marca = Marcas::where('id',$request->id)->update(['nombre'=>$request->marca]);
        \Session::flash('marca',$marca);
        return \Redirect::back();

    }


       public function eliminarmarca(Request $request)
    {
        $marca = Marcas::all()->get();
        return $marca;
    }

  public function marca_a_eliminar(Request $request){
        $marca = Marcas::findOrFail($request->id);
        $marca->delete($request->id);
       \Session::flash('marca',$marca);
       return \Redirect::back();
    }

}
