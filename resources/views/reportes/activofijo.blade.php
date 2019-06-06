<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <title></title>
</head>
<body>
<style>
    body{
        font-size: 9px;
    }
    table{
        table-layout: fixed;
        width: 100%;
    }

    th, td {
        width: 140px;
        word-wrap: break-word;
    }
    .contenedor{
        background-color:#CCC;
        width:2900px;
        height:50px;
        display:flex;
        justify-content: space-between;
    }
    .contenido{
        height:35px;
        width:10%;
        float:left;
        margin: 10px;
    }
</style>
<header style="margin: auto; margin-left: 280px">Compañía Comercial Cimaco S.A. de C.V.</header>
<div class="contenedor">
    <div class="contenido">{{$fecha}}</div>
    <div class="contenido">Sistema de Activo Fijo
        <br><br> Reporte de Consultas</div>
    <div class="contenido">{{$hora}}</div>
</div>
<h2>{{$titulo}}</h2>

<TABLE border="1" frame="border" rules="groups">
    <COLGROUP align="center">
    <COLGROUP align="left">
    <COLGROUP align="center" span="2">
    <COLGROUP align="center" span="3">

    <THEAD valign="top">
    <tr>
        <th>N° serie</th>
        <th>Descripcion</th>
        <th>Departamento</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Tipo dispositivo</th>
        <th>Tienda</th>
        <th>Proveedor</th>
        <th>Precio</th>
        <th>Fecha</th>
        <th>Responsable</th>
    </tr>
    <TBODY>
    @foreach($equipos as $equipo)
        <tr>
            <td>{{$equipo->num_serie}}</td>
            <td>{{$equipo->descripcion}}</td>
            <td>{{$equipo->departamento['nombre']}}</td>
            <td>{{$equipo->marca['nombre']}}</td>
            <td>{{$equipo->modelo}}</td>
            <td>{{$equipo->tipo['nombre']}}</td>
            <td>{{$equipo->tienda['nombre']}}</td>
            <td>{{$equipo->proveedor['nombre']}}</td>
            <td>$ {{$equipo->precio}}</td>
            <td>{{$equipo->fecha_alta}}</td>
            <td>{{$equipo->responsable}}</td>
        </tr>
    @endforeach
    <TBODY>
</TABLE>
{{--<table class="">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>N° serie</th>--}}
{{--        <th>Descripcion</th>--}}
{{--        <th>Departamento</th>--}}
{{--        <th>Marca</th>--}}
{{--        <th>Modelo</th>--}}
{{--        <th>Tipo dispositivo</th>--}}
{{--        <th>Tienda</th>--}}
{{--        <th>Proveedor</th>--}}
{{--        <th>Precio</th>--}}
{{--        <th>Fecha</th>--}}
{{--        <th>Responsable</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($equipos as $equipo)--}}
{{--    <tr>--}}
{{--        <td>{{$equipo->num_serie}}</td>--}}
{{--        <td>{{$equipo->descripcion}}</td>--}}
{{--        <td>{{$equipo->departamento['nombre']}}</td>--}}
{{--        <td>{{$equipo->marca['nombre']}}</td>--}}
{{--        <td>{{$equipo->modelo}}</td>--}}
{{--        <td>{{$equipo->tipo_dispositivo}}</td>--}}
{{--        <td>{{$equipo->tienda['nombre']}}</td>--}}
{{--        <td>{{$equipo->proveedor['nombre']}}</td>--}}
{{--        <td>{{$equipo->precio}}</td>--}}
{{--        <td>{{$equipo->fecha_alta}}</td>--}}
{{--        <td>{{$equipo->responsable}}</td>--}}
{{--    </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}
</body>
</html>