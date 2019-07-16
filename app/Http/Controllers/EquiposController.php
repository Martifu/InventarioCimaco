<?php

namespace App\Http\Controllers;

use Response;
use Barryvdh\DomPDF\Facade as PDF;
use App;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Equipos;
use App\Tipos;
use App\Departamentos;
use App\Marcas;
use App\Proveedores;
use App\Tiendas;
use App\User;
use Illuminate\Support\Str;
use Session;
use Auth;
use Illuminate\Support\Facades\Hash;
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
        if (auth()->user()->id_role == 1){
           $administrador =  auth()->user()->name;
            Session::put('administrador',$administrador);
        }
        else if (auth()->user()->id_role == 2){
            $usuario =  auth()->user()->name;
            Session::put('usuario',$usuario);
        }
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

    function info_equipo(Request $request){
        $equipo = Equipos::with('departamento','marca','tipo','proveedor','tienda')->where('id',$request->id)->get();
        return $equipo;
    }



    public function actualizarequipo(Request $request)
    {

        $fecha = Carbon::now('America/Mexico_City');
        $fecha_actualizacio = $fecha->format('d-m-Y H:i:s');
        $equipo = Equipos::where('id', $request->id)->update(['num_serie' => $request->serie,
            'id_tipo' => $request->tipo,
            'id_marca' => $request->marca,
            'id_departamento' => $request->departamento,
            'responsable' => $request->responsable,
            'id_tienda'=> $request->tienda,
            'id_proveedor'=> $request->proveedor,
            'ip' => $request->ip,
            'modelo' => $request->modelo,
            'descripcion'=> $request->descripcion,
            'precio' => $request->precio,
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
        for ($i=0; $i<sizeof($ids) - 1; $i++) {
            $equipo = Equipos::with('departamento','marca','tipo','proveedor','tienda')->where('id', $ids[$i])->get();
            $equipos[$i] = $equipo[0];
        }
        $nombre = end($ids);
        $fechaHoy = Carbon::now('America/Mexico_City');
        $fecha=$fechaHoy->format('d-m-Y');
        $hora = $fechaHoy->format('h:i:s A');
        $data = ['equipos' => $equipos,'titulo'=>$nombre,'fecha'=> $fecha,'hora'=>$hora];
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
            $equipos->nombre=$request->input('nombre');
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
    
     




    function usuarios(){
       $roles = DB::table('roles')->get();
       $usuarios = User::with('role')->get();
        return view('registrar', compact('roles', 'usuarios' ));

    }


    function tipousuario(request $request)
    {
         $token = Str::random(60);
         $usuario = new User();
         $usuario->name = $request->input('name');
         $usuario->password = Hash::make($request['contra']);
         $usuario->email = $request->input('email');
         $usuario->id_role = $request->get('tipo');
         $usuario->remember_token = $token;
         $usuario->save();

        \Session::flash('usuario',$usuario);
         return \Redirect::back();
    
    }

    function usuarioaeliminar(Request $request){
        $usuario = User::with('role')->where('id','=',$request->id)->get();
        return $usuario;
    }

    function eliminarusuario(Request $request){
        $usuario = User::findOrFail($request->id);
        $usuario->delete($request->id);
        \Session::flash('eliminado',$usuario);
        return \Redirect::back();
    }

    function usuarioaeditar(Request $request){
        $usuario = User::with('role')->where('id','=',$request->id)->get();
        return $usuario;
    }

    function editarusuario(Request $request){
        $password = Hash::make($request['contra']);
        $usuario = User::where('id', $request->id)->update(['name' => $request->nombre,
            'email' => $request->email,
            'id_role' => $request->tipo,
            'password' => $password]);

        return $usuario;
    }
    


}
