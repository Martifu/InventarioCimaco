@extends('templates.base_dashboard')

@section('cssextra')
    <style type="text/css">
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
     
                            @if (Session::has('equipos'))
                                <div class="alert alert-info" role="alert" id="resultado">
                                    <strong> Equipo registrado</strong>
                                </div>
                            @endif

    <div >
        <h2>Activo Fijo</h2>
    </div>
    {{csrf_field()}}
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>N° Serie</th>
            <th>Tipo Disp.</th>
            <th>Marca</th>
            <th>Ubicación</th>
            <th>Responsable</th>
            <th>IP</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="tabla">
        @foreach($equipos as $equipo)
        <tr>
            <input type="hidden" class="id" value="{{$equipo->id}}">
            <td>{{$equipo->num_serie}}</td>
            <td>{{$equipo->tipo_dispositivo}}</td>
            <td>{{$equipo->marca}}</td>
            <td>{{$equipo->ubicacion}}</td>
            <td>{{$equipo->responsable}}</td>
            <td>{{$equipo->ip}}</td>
            <td><button id="editar" style="background-color: #16c7ff; border: 0px;" class="btn btn-primary btn-editar" href="#exampleModalCenter"><i class="far fa-edit"></i></button>
                <button id="eliminar" style=" background-color: red; border: 0px;" class="btn btn-warning"><i class="far fa-trash-alt" style="color: white;"></i></button>
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalForm"><i class="far fa-trash-alt" style="color: white;"></i></button>


            </td>
        </tr>
        @endforeach
    </table>

<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Contact Form</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                

                <form method="POST" action="{{url('/agregar')}}" class="needs-validation"  novalidate>
                          
                    

                            {{csrf_field()}}
                          

                            <div class="form-group" style="color: #000000">
                                <label for="num">Numero de serie:</label>
                                <input type="text" class="form-control" id="num" name="num" placeholder="" value="{{old('num')}}">
                            </div>
                            
                             <div class="form-group" style="color: #000000">
                                <label for="dis">Tipo de dispositivo:</label>
                                <input type="text" class="form-control" id="dis" name="dis" placeholder="" value="{{old('dis')}}">
                            </div>

                            <div class="form-group" style="color: #000000">
                                <label for="mar">Marca:</label>
                                <input type="text" class="form-control" id="mar" name="mar" placeholder="" value="{{old('mar')}}">
                            </div>

                            <div class="form-group" style="color: #000000">
                                <label for="ubi">Ubicacion:</label>
                                <input type="text" class="form-control" id="ubi" name="ubi" placeholder="" value="{{old('ubi')}}">
                            </div>

                            <div class="form-group" style="color: #000000">
                                <label for="res">Responsable:</label>
                                <input type="text" class="form-control" id="res" name="res" placeholder="" value="{{old('res')}}">
                            </div>
                            <div class="form-group" style="color: #000000">
                                <label for="ip">IP:</label>
                                <input type="text" class="form-control" id="ip" name="ip" placeholder="" value="{{old('ip')}}">
                            </div>
                             


                       
                           


                          <button id="guardar" type="Submit" class="btn btn-primary">Guardar</button>
                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>


                        </form>
            </div>
            
            <!-- Modal Footer -->
           
        </div>
    </div>
</div>


























    <!-- Modal Editar-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{csrf_field()}}
                    <h5 class="modal-title" id="exampleModalCenterTitle">Agregar nuevo equipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="noserie">N° Serie</label> <input id="noserie" class="" type="text">
                        </div>
                        <div class="col">
                            <label for="">Tipo Disp.</label> <input id="tipo" class="" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Marca</label> <input id="marca" class="" type="text">
                        </div>
                        <div class="col">
                            <label for="">Ubicación</label> <input id="ubi" class="" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Responsable</label> <input id="respo" class="" type="text">
                        </div>
                        <div class="col">
                            <label for="">IP</label> <input id="ip" class="" type="text">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
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
            //Carga datos del equipo a editar
            $('.btn-editar').on("click", function () {
                var token = $('input[name=_token]').val();
                var id = $(this).parent().parent().find('.id').val();
                $('#exampleModalCenter').modal('show');
                var serie = $('#noserie');
                var tipo = $('#tipo');
                var marca = $('#marca');
                var ubi = $('#ubi');
                var respo = $('#respo');
                var ip = $('#ip');
                serie.val('');
                tipo.val('');
                marca.val('');
                ubi.val('');
                respo.val('');
                ip.val('');
                $.ajax({
                    url: "/equipo_a_editar",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function (response) {
                        serie.val(response[0].num_serie);
                        tipo.val(response[0].tipo_dispositivo);
                        marca.val(response[0].marca);
                        ubi.val(response[0].ubicacion);
                        respo.val(response[0].responsable);
                        ip.val(response[0].ip);
                    }
                });
                //Guarda equipo editado
                $("#guardar").click(function () {
                    // var id = $(this).parent().parent().find('#id').val();
                    var token = $("input[name='_token']").val();
                    var serie = $('#noserie').val();
                    var tipo = $('#tipo').val();
                    var marca = $('#marca').val();
                    var ubi = $('#ubi').val();
                    var respo = $('#respo').val();
                    var ip = $('#ip').val();
                    var tabla = $('#tabla');
                    var tabla2 = "";
                    $.ajax({
                        url: "/actualizarequipo",
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            id: id,
                            serie: serie,
                            tipo: tipo,
                            marca: marca,
                            ubi: ubi,
                            respo: respo,
                            ip: ip,
                            _token: token
                        },
                        success: function (response) {
                            $('#exampleModalCenter').modal('hide');
                            console.log(response);
                            // $.each(response, function(i,v){
                            //     tabla2+=("<tr>");
                            //     tabla2+=("<td>"+v.num_serie+"</td>");
                            //     tabla2+=("<td>"+v.tipo_dispositivo+"</td>");
                            //     tabla2+=("<td>"+v.marca+"</td>");
                            //     tabla2+=("<td>"+v.ubicacion+"</td>");
                            //     tabla2+=("<td>"+v.responsable+"</td>");
                            //     tabla2+=("<td>"+v.ip+"</td>");
                            //     tabla2+=("<td id='editar'>" + "<button id='editar' style='background-color: #16c7ff; border: 0px;' class='btn btn-primary btn-editar' href='#exampleModalCenter'><i class='far fa-edit'></i></button>" + "<button id='eliminar' style='background-color: red; border: 0px;' class='btn btn-warning'><i class='far fa-trash-alt' style='color: white;'></i></button>"+"</td>");
                            //     tabla2+=("</tr>");
                            // });
                            // tabla.html(tabla2);
                            location.href='/buscar';
                        }
                    });
                });
            });
        });
    </script>
@stop