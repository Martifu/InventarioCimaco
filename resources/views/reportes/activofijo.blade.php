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
    <title>Activo fijo</title>
</head>
<body>
<style>

</style>
<table class="table">
    <thead>
    <tr>
        <th scope="col">N° serie</th>
        <th scope="col">Tipo dispositivo</th>
        <th scope="col">Ip</th>
        <th scope="col">N° serie</th>
        <th scope="col">Tipo dispositivo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($equipos as $equipo)
    <tr>
        <td>{{$equipo->num_serie}}</td>
        <td>{{$equipo->tipo_dispositivo}}</td>
        <td>{{$equipo->ip}}</td>
        <td>{{$equipo->num_serie}}</td>
        <td>{{$equipo->tipo_dispositivo}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>