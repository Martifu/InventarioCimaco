<?php

namespace App\Http\Controllers;

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
        $equipos = Equipos::all();
        return view('buscar',compact('equipos'));
    }

}
