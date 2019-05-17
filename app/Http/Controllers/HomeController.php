<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipos;
use Closure;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('templates.base_dashboard');
    }

    public function agregar()
    {
        $title = 'Registro';
        return view('agregar');
    }

    function agregarequipo(Request $request)
    {
        $request->validate([
            'num' => 'required|max:100',
            'dis' => 'required|max:100',
            'mar' => 'required|max:100',
            'ubi' => 'required|max:100',
            'res' => 'required|max:100',
            'ip' => 'required|max:100',
              
        ],[
            'num.required' => 'El campo numero de serie es obligatorio',
            'dis.required' => 'El campo tipo de dispositivo es obligatorio',
            'mar.required' => 'El campo marca es obligatorio',
            'ubi.required' => 'El campo ubicacion es obligatorio',
            'res.required' => 'El campo responsable es obligatorio',
            'ip.required' => 'El campo IP es obligatorio',
           
        ]);
        
        $equipos = new Equipos();
        $equipos->num_serie=$request->input('num');
        $equipos->tipo_dispositivo=$request->input('dis');
        $equipos->marca=$request->input('mar');
        $equipos->ubicacion=$request->input('ubi');
        $equipos->responsable=$request->input('res');
        $equipos->ip=$request->input('ip');
        $equipos->fecha_alta = Carbon::now();
        $equipos->save();
        \Session::flash('equipos',$equipos);
        return \Redirect::back();

}
  public function handle($request, Closure $next)
    {
        
        
        return redirect('/');
    }


}