@extends('templates.base_dashboard')

@section('cssextra')
    <style type="text/css">
        #errmsg
        {
            color: red;
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
                            @if (Session::has('equipos'))
                                <script>
                                    var hulla = new hullabaloo();
                                    hulla.send("Equipo agregado", "success");
                                </script>
                            @endif
    <div class="header">
        <div class="row">
            <div class="col">
                <h2>Activo Fijo</h2>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col offset-5"></div>
            <div class="col">
                <button class="btn btn-outline-primary btn-activofijo">Generar reporte</button>
            </div>
            <div class="col">
                <button style="font-weight: bold; color: white; background-color: #45bc5d;" class="btn btn-outline-"data-toggle="modal" data-target="#modalForm">Agregar Equipo <i class="fas fa-plus-circle" style="color: white;"></i></button>
            </div>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>N° Serie</th>
            <th>Tipo Disp.</th>
            <th>Marca</th>
            <th>Departamento</th>
            <th>Responsable</th>
            <th>IP</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="tabla">
        @foreach($equipos as $equipo)
        <tr>
            <input type="hidden" class="id" value="{{$equipo->id}}" name="ids">
            <td>{{$equipo->num_serie}}</td>
            <td>{{$equipo->tipo['nombre']}}</td>
            <td>{{$equipo->marca['nombre']}}</td>
            <td>{{$equipo->departamento['nombre']}}</td>
            <td>{{$equipo->responsable}}</td>
            <td>{{$equipo->ip}}</td>
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
                                <label for="num">Numero de serie:</label>
                                <input type="text" class="form-control" id="num" name="serie" placeholder="Ingrese número de serie" value="{{old('num')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Tipo de dispositivo</label>
                                <select class="form-control" id="tipo" name="tipo">
                                    @foreach($tipos as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="mar">Marca:</label>
                                <select class="form-control" id="marca" name="marca">
                                    @foreach($marcas as $marca)
                                        <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="ubi">Departamento:</label>
                                <select class="form-control" id="" name="departamento">
                                    @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="ubi">Proveedor:</label>
                                <select class="form-control" id="" name="proveedor">
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="ubi">Tienda:</label>
                                <select class="form-control" id="departamento" name="tienda">
                                    @foreach($tiendas as $tienda)
                                        <option value="{{$tienda->id}}">{{$tienda->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="res">Responsable:</label>
                                <input type="text" class="form-control" id="res" name="responsable" placeholder="Ingrese responsable del equipo" value="{{old('res')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="ip">IP:</label>
                                <input type="text" class="form-control" id="ipe" name="ip" placeholder="Ingrese IP del equipo" value="{{old('ip')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="ip">Modelo:</label>
                                <input type="text" id="modelo" class="form-control" name="modelo" placeholder="Ingrese modelo del equipo" value="{{old(('modelo'))}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="precio">Precio del equipo:</label>
                                <input type="text" id="quantity" name="precio" placeholder="$ 0.00"><span id="errmsg"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" rows="3"
                                          name="descripcion" placeholder="Ingrese descripción de uso"></textarea>
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


    <div class="modal fade" id="exampleModalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{csrf_field()}}
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar equipo</h5>
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
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        {{csrf_field()}}
                        <h5 class="modal-title" id="exampleModalCenterTitle">Actualizar equipo</h5>
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
                                <label for="">Tipo Disp.</label> <input id="" class="tipo" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Marca</label> <input id="" class="marca" type="text">
                            </div>
                            <div class="col">
                                <label for="">Departamento</label> <input id="ubi" class="" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Responsable</label> <input id="respo" class="" type="text">
                            </div>
                            <div class="col">
                                <label for="">IP</label><br> <input id="ip" class="" type="text">
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
               var serie = $('input[name=serie]').val();
               var tipo = $('select[name=tipo]').val();
               var departamento = $('select[name=departamento]').val();
               var marca = $('select[name=marca]').val();
               var responsable = $('input[name=responsable]').val();
               var precio = $('input[name=precio]').val();
               var proveedor = $('select[name=proveedor]').val();
                var descripcion = $('textarea[name=descripcion]').val();
                var modelo = $('input[name=modelo]').val();
                var ip = $('input[name=ip]').val();
                var tienda = $('select[name=tienda]').val();
                var load = $('#agregar');
                load.html('Agregando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

                console.log(tipo + marca + departamento);
                $.ajax({
                    url: "/agregar",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        _token: token,
                        serie: serie,
                        tipo:tipo,
                        departamento:departamento,
                        marca:marca,
                        responsable:responsable,
                        precio:precio,
                        proveedor:proveedor,
                        descripcion:descripcion,
                        modelo:modelo,
                        ip:ip,
                        tienda:tienda
                    },
                    success: function (response) {
                        console.log(response);
                      location.href = '/buscar';
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                        console.log(jqXHR);
                    }
                });
               console.log(serie);
            });
            //Eliminar equipo
            $('.btn-eliminar').on("click",function () {
                var token = $('input[name=_token]').val();
                var id = $(this).parent().parent().find('.id').val();
                console.log(id);
                $.ajax({
                    url: "/aeliminar",
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
                        equipo.append('¿Desea eliminar '+'<strong style="color: #1d68a7; font-weight: bold">'+response[0].tipo["nombre"]+'</strong>' + ' con n° de serie: ' + '<strong style="color: #1d68a7; font-weight: bold">'+response[0].num_serie+'</strong>' + '?');
                        console.log(response);
                    }
                });

                $('.btn-eliminado').click(function () {
                    var load = $('#eliminado');
                    load.html('Eliminando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                    $.ajax({
                        url: "/eliminado",
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            id: id,
                            _token: token
                        },
                        success: function (response) {
                            location.href = '/buscar';
                        }
                    });
                });
            });
            //Carga datos del equipo a editar
            $('.btn-editar').on("click", function () {
                var token = $('input[name=_token]').val();
                var id = $(this).parent().parent().find('.id').val();
                var serie = $('#noserie');
                var tipo = $('.tipo');
                var marca = $('.marca');
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
                        $('#exampleModalCenter').modal('show');
                        serie.val(response[0].num_serie);
                        tipo.val(response[0].tipo['nombre']);
                        marca.val(response[0].marca['nombre']);
                        ubi.val(response[0].departamento['nombre']);
                        respo.val(response[0].responsable);
                        ip.val(response[0].ip);
                    }
                });

                //Guarda equipo editado
                $("#guardar").click(function () {
                    var token = $("input[name='_token']").val();
                    var serie = $('#noserie').val();
                    var tipo = $('#tipo').val();
                    var marca = $('#marca').val();
                    var ubi = $('#ubi').val();
                    var respo = $('#respo').val();
                    var ip = $('#ip').val();
                    var tabla = $('#tabla');
                    var tabla2 = "";
                    var load = $('#guardar');
                    load.html('Actualizando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
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

            $('.btn-activofijo').click(function () {
                var token = $('input[name=_token]').val();
                var values = [];
                $("input[name='ids']").each(function() {
                    values.push($(this).val());
                });
                console.log(values);
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
                    }
                });
            });
        
          



        });
    </script>






@stop















