@extends('templates.base_dashboard')

@section('content')
    <div ></div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>N° Serie</th>
            <th>Tipo Disp.</th>
            <th>Marca</th>
            <th>Ubicación</th>
            <th>Responsable</th>
            <th>IP</th>
        </tr>
        </thead>
        <tbody>
        @foreach($equipos as $equipo)
        <tr>
            <input type="hidden" class="id col1" value="{{$equipo->id}}">
            <td>{{$equipo->num_serie}}</td>
            <td>{{$equipo->tipo_dispositivo}}</td>
            <td>{{$equipo->marca}}</td>
            <td>{{$equipo->ubicacion}}</td>
            <td>{{$equipo->responsable}}</td>
            <td>{{$equipo->ip}}</td>
        </tr>
        @endforeach
    </table>






@stop



@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable( {
                "pagingType": "full_numbers"
            } );
        } );

    </script>
@stop

