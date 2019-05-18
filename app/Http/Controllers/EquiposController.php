<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Equipos;
use Illuminate\Http\Request;

class EquiposController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function equipos()
    {
        $equipos = Equipos::all();
        return $equipos;
    }

    public function buscar_view()
    {
        $titulo = "Activo fijo";
        $equipos = Equipos::all();
        return view('buscar',compact('equipos','titulo'));
    }

    public function equipo_a_editar(Request $request)
    {
        $equipo = Equipos::where('id','=',$request->id)->get();
        return $equipo;
    }

   function equipo_a_eliminar($id){
        $Equipo = Equipos::findOrFail($id);
        $Equipo->delete($id);
        return redirect("/buscar");
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

}
