@extends('templates.base_dashboard')

@section('cssextra')
    <style>
        .btn-add{
            border: 0px;
            background: linear-gradient(178.84deg, #17879D -61.99%, #1D82B1 -16.53%, #095B8D 41.42%, #001650 109.17%);
            box-shadow: 0px 2px 10px rgba(0, 99, 136, 0.53);
            border-radius: 19.5px;
            width: 80%;
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
            box-shadow: 0px 2px 10px rgba(136, 136, 136, 0.53);
        }
        .btn-generico-cancelar{
            border: 0px;
            background: linear-gradient(358.64deg, #343333 -28.63%, #555555 -5.54%, #7C7979 32.82%, #989595 81.47%, #B9B9B9 105.57%, #B7B7B7 176.01%, #C2C2C2 206.57%);
            box-shadow: 0px 10px 10px rgba(110, 106, 110, 0.75);
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
    @if (Session::has('marcas'))
        <script>
            var hulla = new hullabaloo();
            hulla.send("Marca agregada", "success");
        </script>
    @endif
    <div class="header">
        <div class="row">
            <div class="col">
                <h2 class="font-weight-bold">Usuarios</h2>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col offset-5"></div>
            <div class="col">
                <button style="font-weight: bold; color: white; background-color: #45bc5d;" class="btn btn-primary btn-add"data-toggle="modal" data-target="#modalForm">Agregar Usuario <i class="fas fa-plus-circle" style="color: white;"></i></button>
            </div>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>

        </tr>
        </thead>
        <tbody id="tabla">
        @foreach($usuarios as $usuario)
            <tr>
                <input type="hidden" class="id" value="{{$usuario->id}}" name="ids">
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->email}}</td>
                <td>{{$usuario->role['rol']}}</td>
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Agregar nueva marca</h5>
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
                                <input type="text" class="form-control" id="name" name="" placeholder="Ingrese nombre del usuario" value="{{old('nombre')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="num">Email:</label>
                                <input type="email" class="form-control" id="email" name="" placeholder="Ingrese el email" value="{{old('email')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="num">Contraseña:</label>
                                <input type="password" class="form-control" id="contra" name="" placeholder="Ingrese contraseña" value="{{old('contra')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="num">Confirme contraseña:</label>
                                <input type="password" class="form-control" id="contra2" name="" placeholder="Confirmar contraseña" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="num">Tipo de usuario:</label>
                                <select class="form-control" id="tipo" name="">
                                    @foreach($roles as $rol)
                                        <option value="{{$rol->id}}">{{$rol->rol}}</option>
                                    @endforeach
                                </select>
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

        Modal eliminar
    <div class="modal fade" id="exampleModalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{csrf_field()}}
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar usuario</h5>
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modificar usuario</h5>
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
                                <input type="text" class="form-control name" id="" name="" placeholder="Ingrese nombre del usuario" value="{{old('nombre')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="num">Email:</label>
                                <input type="email" class="form-control email" id="" name="" placeholder="Ingrese el email" value="{{old('email')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="num">Contraseña:</label>
                                <input type="password" class="form-control contra" id="" name="" placeholder="Ingrese nueva contraseña" value="{{old('contra')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="num">Confirme contraseña:</label>
                                <input type="password" class="form-control contra2" id="" name="" placeholder="Confirmar nueva contraseña" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="num">Tipo de usuario:</label>
                                <select class="form-contro tipo" id="selectTipo" name="">
                                    @foreach($roles as $rol)
                                        <option value="{{$rol->id}}">{{$rol->rol}}</option>
                                    @endforeach
                                </select>
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
            //Agregar usuario
            $('#agregar').click(function () {
                var token = $('input[name=_token]').val();
                var name = $('input[id=name]').val();
                var email = $('input[id=email]').val();
                var tipo = $('select[id=tipo]').val();
                var contra = $('input[id=contra]').val();
                var load = $('#agregar');
                load.html('Agregando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                console.log(tipo, name, contra, email);
                $.ajax({
                    url: "/registrar",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        _token: token,
                        name: name,
                        email: email,
                        tipo: tipo,
                        contra: contra,
                    },
                    success: function (response) {

                        location.href = '/registrar';
                    },
                    error: function( jqXHR, textStatus, errorThrown ){

                    }
                });
            });
            //Eliminar usuario
            $('.btn-eliminar').on("click",function () {
                var token = $('input[name=_token]').val();
                var id = $(this).parent().parent().find('.id').val();
                console.log(id);
                $.ajax({
                    url: "/usuarioaeliminar",
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
                        equipo.append('¿Desea eliminar '+'<strong style="color: #1d68a7; font-weight: bold">'+response[0].name+'</strong>' + '?');
                        console.log(response);
                    }
                });

                $('.btn-eliminado').click(function () {
                    var load = $('#eliminado');
                    load.html('Eliminando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

                    $.ajax({
                        url: "/eliminarusuario",
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            id: id,
                            _token: token
                        },
                        success: function (response) {
                            location.href = '/registrar';
                        }
                    });
                });
            });
            //Carga datos del equipo a editar
            $('.btn-editar').on("click", function () {
                var token = $('input[name=_token]').val();
                var id = $(this).parent().parent().find('.id').val();
                var nombre = $('.name');
                var email = $('.email');
                var contra = $('#contra');
                var contra2 = $('#contra2');
                var tipo = $('#tipo');
                nombre.val('');
                email.val('');
                contra.val('');
                contra2.val('');
                tipo.val('');
                console.log(id,nombre,email,contra,contra2,tipo);
                $.ajax({
                    url: "/usuarioaeditar",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function (response) {
                        console.log(response);
                        $('#exampleModalCenter').modal('show');
                        nombre.val(response[0].name);
                        email.val(response[0].email);
                        $('#selectTipo').val(response[0].role['id']);
                    }
                });

                //Guarda equipo editado
                $("#guardar").click(function () {
                    var token = $("input[name='_token']").val();
                    var nombre = $('.name').val();
                    var tipo = $('.tipo').val();
                    var email = $('.email').val();
                    var contra = $('.contra').val();
                    var load = $('#guardar');
                    load.html('Actualizando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                    console.log(nombre,tipo,email,contra);
                    $.ajax({
                        url: "/editarusuario",
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            id: id,
                            nombre: nombre,
                            tipo: tipo,
                            email: email,
                            contra: contra,
                            _token: token
                        },

                        success: function (response) {
                            $('#exampleModalCenter').modal('hide');
                            location.href='/registrar';
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

{{--@section('content')--}}
{{--  <div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">Registrar usuario</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST"  action="{{url('/registrar')}}  " aria-label="">--}}
{{--                        {{ csrf_field() }}--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control" name="name" value="" required autofocus>--}}


{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo electronico</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}


{{--                            </div>--}}
{{--                        </div>--}}
{{--                         <div class="form-group row">--}}
{{--                          <label class="col-md-4 col-form-label text-md-right">Tipo</label>--}}
{{--                            <div class="col-md-6">--}}

{{--                                <select class="form-control" id="" name="tipo">--}}
{{--                                    @foreach($usuario as $usuarios)--}}
{{--                                        <option value="{{$usuarios->id}}">{{$usuarios->rol}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                           <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control" name="password" >--}}


{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar contraseña</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password2" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                 <button  type="Submit" id="agregar" class="btn btn-primary btn-agregar">Guardar</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@stop--}}
{{--@section('javascript')--}}
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function() {--}}
{{--            --}}
{{--            --}}
{{--            $('#agregar').click(function () {--}}
{{--                var token = $('input[name=_token]').val();--}}
{{--                var name = $('input[id=name]').val();--}}
{{--                var email = $('input[id=email]').val();--}}
{{--                var tipo = $('select[name=tipo]').val();--}}
{{--                var password = $('input[id=password]').val();--}}
{{--                var load = $('#agregar');--}}
{{--                load.html('Agregando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');--}}
{{--               console.log(tipo, name, password, email);--}}
{{--                $.ajax({--}}
{{--                    url: "/registrar",--}}
{{--                    type: 'POST',--}}
{{--                    datatype: 'json',--}}
{{--                    data: {--}}
{{--                        _token: token,--}}
{{--                        name: name,--}}
{{--                        email: email,--}}
{{--                        tipo: tipo,--}}
{{--                        password: password,--}}
{{--                    },--}}
{{--                    success: function (response) {--}}
{{--                       --}}
{{--                        location.href = '/registrar';--}}
{{--                    },--}}
{{--                    error: function( jqXHR, textStatus, errorThrown ){--}}
{{--                      --}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--               });--}}





{{--    </script>--}}
{{--@stop--}}