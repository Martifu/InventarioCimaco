@extends('templates.base_dashboard')

@section('cssextra')
    <style>
        .btn-add{
            border: 0px;
            background: linear-gradient(178.84deg, #17879D -61.99%, #1D82B1 -16.53%, #095B8D 41.42%, #001650 109.17%);
            box-shadow: 0px 2px 10px rgba(0, 99, 136, 0.53);
            border-radius: 19.5px;
            width: 100%;
            height: 39px;
            margin-top: 5%;
            transition: .5s;
        }
        .btn-add:hover{
            transform: scale(1.05);
        }

        .btn-editar{
            background: linear-gradient(178.84deg, #17879D -61.99%, #1D82B1 -16.53%, #095B8D 41.42%, #001650 109.17%);
            box-shadow: 0px 2px 10px rgba(0, 84, 136, 0.53);
        }
        .btn-editar:hover{
            transform: scale(1.05);
        }

        .btn-eliminar{
            background: linear-gradient(0.67deg, #760D0D -50.08%, #860D0D -24.69%, #961313 17.51%, #D01313 71.02%, #D30F0F 97.53%, #D61D1D 175%, #FF0000 208.61%);
            box-shadow: 0px 10px 10px rgba(255, 3, 18, 0.25);
        }
        .btn-eliminar:hover{
            transform: scale(1.05);
        }

        .btn-generico{
            border: 0px;
            background: linear-gradient(178.84deg, #17879D -61.99%, #1D82B1 -16.53%, #095B8D 41.42%, #001650 109.17%);
            box-shadow: 0px 2px 10px rgba(0, 28, 136, 0.53);
        }
        .btn-generico-cancelar{
            border: 0px;
            background: linear-gradient(358.64deg, #343333 -28.63%, #555555 -5.54%, #7C7979 32.82%, #989595 81.47%, #B9B9B9 105.57%, #B7B7B7 176.01%, #C2C2C2 206.57%);
            box-shadow: 0px 2px 10px rgba(110, 106, 110, 0.75);
        }
    </style>
@stop

@section('content')
    <div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Por favor corrige estos errores:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    @if (Session::has('tipo'))
        <script>
            var hulla = new hullabaloo();
            hulla.send("Tipo de dispositivo agregado", "success");
        </script>
    @endif
    <div class="header">
        <div class="row">
            <div class="col">
                <h2>Tipos de dispositivos</h2>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col offset-5"></div>
            <div class="col">
                <button style="font-weight: bold; color: white; background-color: #45bc5d;" class="btn btn-outline- btn-add"data-toggle="modal" data-target="#modalForm">Agregar Equipo <i class="fas fa-plus-circle" style="color: white;"></i></button>
            </div>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Tipo de Dispositivo</th>
            <th>Fecha de Creación</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="tabla">
        @foreach($dispositivos as $dispositivo)
            <tr>
                <input type="hidden" class="id" value="{{$dispositivo->id}}" name="ids">
                <td>{{$dispositivo->nombre}}</td>
                <td>{{$dispositivo->created_at}}</td>
                <td>
                    <button id="editar" style="background-color: #16c7ff; border: 0px;" class="btn btn-primary btn-editar" href="#exampleModalCenter"><i class="far fa-edit"></i></button>
                    <button id="eliminar" style=" background-color: red; border: 0px;" class="btn btn-warning btn-eliminar"  href="#exampleModalEliminar"><i class="far fa-trash-alt" style="color: white;"></i></button>
                </td>
            </tr>
        @endforeach
    </table>


    <!-- MODAL AGREGAR-->
    <div class="modal fade bd-example-modal-lg" id="modalForm" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Agregar nuevo equipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="num">Nombre:</label>
                                <input type="text" class="form-control" id="" name="nombre" placeholder="Ingrese nombre del tipo de dispositivo" value="{{old('num')}}">
                            </div>
                        </div>
                    </div>
                    <button  type="Submit" id="agregar" class="btn btn-primary btn-agregar btn-generico">Guardar</button>
                    <button type="button" class="btn btn-secondary btn-generico-cancelar" data-dismiss="modal">Cerrar</button>
                </div>

                <!-- Modal Footer -->

            </div>
        </div>
    </div>

{{--    Modal eliminar--}}
    <div class="modal fade" id="exampleModalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{csrf_field()}}
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Tipo de dispositivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label id="aeliminar" for=""></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-generico-cancelar" data-dismiss="modal">Cancelar</button>
                    <button id="eliminado" type="button" class="btn btn-primary btn-eliminado btn-generico">
                        Confirmar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Editar-->
    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modificar tipo de dispositivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="num">Nombre de tipo de dispositivo:</label>
                                <input type="text" class="form-control nombre" id="" name="nombre" >
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary btn-generico-cancelar" data-dismiss="modal">Cancelar</button>
                    <button id="guardar" type="button" class="btn btn-primary btn-generico">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                "bPaginate": false,
            });
            //called when key is pressed in textbox
            $("#quantity").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $("#errmsg").html("Solo dígitos numéricos").show().fadeOut("slow");
                    return false;
                }
            });
            //Agregar equipo
            $('.btn-agregar').on("click",function () {
                var token = $('input[name=_token]').val();
                var nombre = $('input[name=nombre]').val();

                var load = $('#agregar');
                load.html('Agregando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "/agregartipo",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        _token: token,
                        nombre: nombre,
                    },
                    success: function (response) {
                        console.log(response);
                        location.href = '/tipos';
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                        console.log(jqXHR);
                    }
                });
            });
            //Eliminar equipo
            $('.btn-eliminar').on("click",function () {
                var token = $('input[name=_token]').val();
                var id = $(this).parent().parent().find('.id').val();
                console.log(id);
                $.ajax({
                    url: "/tipoaeliminar",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function (response) {
                        var equipo = $('#aeliminar');
                        console.log(response);
                        equipo.html('');
                        $('#exampleModalEliminar').modal('show');
                        equipo.append('¿Desea eliminar '+'<strong style="color: #1d68a7; font-weight: bold">'+response[0].nombre+'</strong>' + '?');
                        console.log(response);
                    }
                });

                $('.btn-eliminado').click(function () {
                    var load = $('#eliminado');
                    load.html('Eliminando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                    $.ajax({
                        url: "/eliminartipo",
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            id: id,
                            _token: token
                        },
                        success: function (response) {
                            location.href = '/tipos';
                        }
                    });
                });
            });
            //Carga datos del equipo a editar
            $('.btn-editar').on("click", function () {
                var token = $('input[name=_token]').val();
                var id = $(this).parent().parent().find('.id').val();
                var nombre = $('.nombre');
                nombre.val('');
                $.ajax({
                    url: "/tipo_a_editar",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function (response) {
                        console.log(response);
                        $('#exampleModalCenter').modal('show');
                        nombre.val(response[0].nombre);
                    }
                });

                //Guarda equipo editado
                $("#guardar").click(function () {
                    var token = $("input[name='_token']").val();
                    var nombre = $('.nombre').val();
                    var load = $('#guardar');
                    load.html('Actualizando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                    $.ajax({
                        url: "/actualizartipo",
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            id: id,
                            nombre: nombre,
                            _token: token
                        },
                        success: function (response) {
                            $('#exampleModalCenter').modal('hide');
                            location.href='/tipo';
                        }
                    });
                });
            });

            $('.btn-activofijo').click(function () {
                var token = $('input[name=_token]').val();
                var values = [];
                $("input[name='ids']").each(function() {
                    values.push($(this).val());
                });
                var titulo = $('.titulo').val();
                values.push(titulo);
                console.log(values);
                var load = $('#confirmarReporte');
                load.html('Generando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "/reporte_activofijo",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        ids: values,
                        _token: token
                    },
                    success: function (response) {
                        var pdf= window.open("");
                        pdf.document.write("<iframe width='100%' height='100%'"+
                            " src='data:application/pdf;base64, " + encodeURI(response)+"'></iframe>");
                        location.href='/buscar';
                    }
                });
            });

        });





    </script>
@stop