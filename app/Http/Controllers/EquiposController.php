<?php

namespace App\Http\Controllers;

use App\Equipos;
use Illuminate\Http\Request;

class EquiposController extends Controller
{
    function equipos()
    {
        $equipos = Equipos::all();
        return $equipos;
    }
}
