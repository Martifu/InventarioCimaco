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

class EquiposController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function equipos()
    {
        $equipos = Equipos::with('departamento','marca','tipo','proveedor','tienda')->get();
        return $equipos;
    }

    public function buscar_view()
    {
        $titulo = "Activo fijo";
        $equipos = Equipos::with('departamento','marca','tipo','proveedor','tienda')->get();
        $tipos = Tipos::all();
        $departamentos = Departamentos::all();
        $marcas = Marcas::all();
        $tiendas = Tiendas::all();
        $proveedores = Proveedores::all();

        return view('buscar',compact('equipos','titulo','tipos','departamentos','marcas',
            'tiendas','proveedores'));
    }

    public function equipo_a_editar(Request $request)
    {
        $equipo = Equipos::with('departamento','marca','tipo','proveedor','tienda')->where('id','=',$request->id)->get();
        return $equipo;
    }

    function aeliminar(Request $request)
    {
        $equipo = Equipos::with('tipo')->where('id','=',$request->id)->get();
        return $equipo;
    }

   function equipo_a_eliminar(Request $request){
        $Equipo = Equipos::findOrFail($request->id);
        $Equipo->delete($request->id);
       \Session::flash('equipo',$Equipo);
       return \Redirect::back();
    }

    



    public function actualizarequipo(Request $request)
    {

        $fecha = Carbon::now('America/Mexico_City');
        $fecha_actualizacio = $fecha->format('d-m-Y H:i:s');
        $equipo = Equipos::where('id', $request->id)->update(['num_serie' => $request->serie,
            'tipo_dispositivo' => $request->tipo,
            'marca' => $request->marca,
            'ubicacion' => $request->ubi,
            'responsable' => $request->respo,
            'ip' => $request->ip,
            'fecha_modificacion'=>$fecha_actualizacio]);

        $equipos = Equipos::all();

        return $equipos;
    }

    //reportes
    function activofijo(Request $request)
    {
//        $pdf = App::make('dompdf.wrapper');
//        $pdf->loadHTML('<h1>Test</h1>');
//        return $pdf->stream();
        $ids = $request->ids;
        $equipos = [];
        for ($i=0; $i<sizeof($ids); $i++)
        {
            $equipo = Equipos::where('id',$ids[$i])->get();
            $equipos[$i] = $equipo[0];
        }
        $data = ['equipos' => $equipos];
        $pdf = PDF::loadView('reportes.activofijo', $data);
        return base64_encode($pdf->stream('invoice.pdf'));
    }

    function todo()
    {
        $todo =  Equipos::with('departamento','marca','tipo','proveedor','tienda')->get();
        return $todo;
    }

    public function agregar()
    {
        $title = 'Registro';
        $tipos = DB::table('tipos')->get();
        return view('buscar', compact('tipos'));
    }

    function agregarequipo(Request $request)
    {
       $num_serie = $request->input('serie');
       $precio_verificando = $request->input('precio');
        $equipo_existente = Equipos::where('num_serie',$num_serie)->get();
        if ($equipo_existente->isEmpty()){
            $equipos = new Equipos();
            $equipos->num_serie=$request->input('serie');
            $equipos->responsable=$request->input('responsable');
            $equipos->id_tipo = $request->get('tipo');
            $equipos->id_marca = $request->get('marca');
            $equipos->id_departamento = $request->get('departamento');
            $equipos->id_proveedor = $request->get('proveedor');
            $equipos->id_tienda = $request->get('tienda');
            $equipos->ip=$request->input('ip');
            $equipos->precio = $request->input('precio');
            $equipos->modelo = $request->input('modelo');
            $equipos->descripcion = $request->input('descripcion');
            $equipos->fecha_alta = Carbon::now();
            $equipos->save();
            $equipos = Tipos::all();
            \Session::flash('equipos',$equipos);
            return \Redirect::back();
        }
       if ($equipo_existente[0]->num_serie){
           return 'El numero de serie ya existe';
       }






}
 public function equipo_a_agregar(Request $request)
    {
        $equipo = Equipos::where('id','=',$request->id)->get();
        return $equipo;
    }
    
     

}
