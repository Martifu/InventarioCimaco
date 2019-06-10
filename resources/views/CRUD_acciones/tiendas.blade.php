@extends('templates.base_dashboard')

@section('cssextra')

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
    @if (Session::has('tiendas'))
        <script>
            var hulla = new hullabaloo();
            hulla.send("Tienda agregado", "success");
        </script>
    @endif
    <div class="header">
        <div class="row">
            <div class="col">
                <h2>Tiendas</h2>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col offset-5"></div>
            <div class="col">
                <button style="font-weight: bold; color: white; background-color: #45bc5d;" class="btn btn-outline-"data-toggle="modal" data-target="#modalForm">Agregar Tienda <i class="fas fa-plus-circle" style="color: white;"></i></button>
            </div>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Tienda</th>
            <th>Fecha de Creación</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="tabla">
        @foreach($tiendas as $tienda)
            <tr>
                <input type="hidden" class="id" value="{{$tienda->id}}" name="ids">
                <td>{{$tienda->nombre}}</td>
                <td>{{$tienda->created_at}}</td>
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Agregar nuevo tienda</h5>
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
                                <input type="text" class="form-control" id="" name="nombre" placeholder="Ingrese nombre de la tienda" value="{{old('num')}}">
                            </div>
                        </div>
                    </div>
                    <button  type="Submit" id="agregar" class="btn btn-primary btn-agregar">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Tienda</h5>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="eliminado" type="button" class="btn btn-primary btn-eliminado">
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modificar Tienda</h5>
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
                                <label for="num">Nombre de Tienda:</label>
                                <input type="text" class="form-control nombre" id="" name="nombre" >
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="guardar" type="button" class="btn btn-primary">Guardar</button>
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
            //Agregar equipo
            $('.btn-agregar').on("click",function () {
                var token = $('input[name=_token]').val();
                var nombre = $('input[name=nombre]').val();

                var load = $('#agregar');
                load.html('Agregando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "/agregartienda",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        _token: token,
                        nombre: nombre,
                    },
                    success: function (response) {
                        console.log(response);
                        location.href = '/tiendas';
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
                    url: "/tiendaaeliminar",
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
                        url: "/eliminartienda",
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            id: id,
                            _token: token
                        },
                        success: function (response) {
                            location.href = '/tiendas';
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
                    url: "/tienda_a_editar",
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
                        url: "/actualizartienda",
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            id: id,
                            nombre: nombre,
                            _token: token
                        },
                        success: function (response) {
                            $('#exampleModalCenter').modal('hide');
                            location.href='/tiendas';
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
                        location.href='/tiendas';
                    }
                });
            });

        });





    </script>
@stop