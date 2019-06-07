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
                <button class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalReporte">Generar reporte</button>
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
                <button type="button" class="btn btn-primary btn-informacion" ><i class="fas fa-eye"></i></button>
            </td>
        </tr>
        @endforeach
    </table>
{{--        Modal titulo reporte--}}
                      <div class="modal fade" id="exampleModalReporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      {{csrf_field()}}
                                      <h5 class="modal-title" id="exampleModalCenterTitle">Agregue título o nombre al reporte</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="row">
                                          <div class="col">
                                              <div class="form-group">
                                                  <label for="">Título:</label>
                                                      <input type="text" class="form-control titulo">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                      <button  type="button" id="confirmarReporte" class="btn btn-primary btn-activofijo">
                                          Confirmar</button>
                                  </div>
                              </div>
                          </div>
                      </div>

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
                                <input type="text" class="form-control" id="" name="serie" placeholder="Ingrese número de serie" value="{{old('num')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Tipo de dispositivo</label>
                                <select class="form-control" id="" name="tipo">
                                    @foreach($tipos as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="mar">Marca:</label>
                                <select class="form-control" id="" name="marca">
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
                                <label for="">Proveedor:</label>
                                <select class="form-control" id="" name="proveedor">
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="">Tienda:</label>
                                <select class="form-control" name="tienda">
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
                                <input type="text" class="form-control" id="" name="responsable" placeholder="Ingrese responsable del equipo" value="{{old('res')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="ip">IP:</label>
                                <input type="text" class="form-control" id="" name="ip" placeholder="Ingrese IP del equipo" value="{{old('ip')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="ip">Modelo:</label>
                                <input type="text" id="" class="form-control" name="modelo" placeholder="Ingrese modelo del equipo" value="{{old(('modelo'))}}">
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
                                <textarea class="form-control" id="" rows="3"
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
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalCenterTitle">Modificar equipo</h5>
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
                                <input type="text" class="form-control noserie" id="" name="noserie" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tipo">Tipo de dispositivo</label>
                                <select class="form-control " id="selectTipo" name="tipo">
                                    @foreach($tipos as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="mar">Marca:</label>
                                <select class="form-control " id="selectmarca" name="marca">
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
                                <label>Departamento:</label>
                                <select class="form-control " id="selectdepartamento" name="departamento">
                                    @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label>Proveedor:</label>
                                <select class="form-control " id="selectproveedor" name="proveedor">
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="">Tienda:</label>
                                <select class="form-control " id="selecttienda" name="tienda">
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
                                <input type="text" class="form-control responsable" id="" name="responsable" placeholder="" value="{{old('responsable')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color: #000000">
                                <label for="ip">IP:</label>
                                <input type="text" class="form-control " id="ip" name="ip" placeholder="" value="{{old('ip')}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="modelo">Modelo:</label>
                                <input type="text" class="form-control modelo" id="" name="modelo" value="{{old('modelo')}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="precio">Precio del equipo:</label>
                                <input class="form-control precio" type="text" id="" name="precio" placeholder="$ 0.00" value="{{old('precio')}}"><span id="errmsg"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control descripcion" id="" rows="3"
                                          name="descripcion" value="{{old('descripcion')}}" ></textarea>
                            </div>
                        </div>
                    </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button id="guardar" type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

                      <div class="modal fade bd-example-modal-largo" tabindex="-1" id="modalInfo" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      {{csrf_field()}}
                                      <h5 class="modal-title" id="exampleModalCenterTitle">Informacion completa</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="row">
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Numero de Serie:</label><br>
                                              <label for="" class="infoserie">029910923801928</label>
                                          </div>
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Tipo de dipositivo:</label><br>
                                              <label for="" class="infodipositivo"></label>
                                          </div>
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Marca:</label><br>
                                              <label for="" class="infomarca"></label>
                                          </div>
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Modelo:</label><br>
                                              <label for="" class="infomodelo"></label>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Tienda:</label><br>
                                              <label  for="" class="infotienda"></label>
                                          </div>
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Departamento:</label><br>
                                              <label for="" class="infodepa"></label>
                                          </div>
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Responsable:</label><br>
                                              <label for="" class="inforespo"></label>
                                          </div>
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Proveedor:</label><br>
                                              <label for="" class="infoprovee"></label>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col">
                                              <label class="font-weight-bold" for="">IP:</label><br>
                                              <label for="" class="infoip"></label>
                                          </div>
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Precio:</label><br>
                                              <label for="" class="infoprecio"></label>
                                          </div>
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Fecha de alta:</label><br>
                                              <label for="" class="infoalta"></label>
                                          </div>
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Fecha de modificacion:</label><br>
                                              <label for="" class="infomodif"></label>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col">
                                              <label class="font-weight-bold" for="">Descripcion:</label><br>
                                              <label for="" class="infodescr"></label>
                                          </div>
                                      </div>
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

            //Informacion completa
            $('.btn-informacion').on("click",function () {
                var token = $('input[name=_token]').val();
                var id = $(this).parent().parent().find('.id').val();
                var serie = $('.infoserie');
                var tipo = $('.infodipositivo');
                var departamento = $('.infodepa');
                var proveedor = $('.infoprovee');
                var marca = $('.infomarca');
                var tienda = $('.infotienda');
                var responsable = $('.inforespo');
                var ip = $('.infoip');
                var modelo = $('.infomodelo');
                var descripcion = $('.infodescr');
                var precio = $('.infoprecio');
                var fecha_alta = $('.infoalta');
                var fecha_modif = $('.infomodif');
                fecha_alta.html('');
                fecha_modif.html('');
                serie.html('');
                tipo.html('');
                marca.html('');
                responsable.html('');
                ip.html('');
                departamento.html('');
                proveedor.html('');
                tienda.html('');
                modelo.html('');
                descripcion.html('');
                precio.html('');
                $.ajax({
                    url: "/info_equipo",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function (response) {
                        console.log(response);
                        $('#modalInfo').modal('show');
                        serie.html(response[0].num_serie);
                        tipo.html(response[0].tipo['nombre']);
                        departamento.html(response[0].departamento['nombre']);
                        proveedor.html(response[0].proveedor['nombre']);
                        tienda.html(response[0].tienda['nombre']);
                        marca.html(response[0].marca['nombre']);
                        responsable.html(response[0].responsable);
                        ip.html(response[0].ip);
                        modelo.html(response[0].modelo);
                        descripcion.html(response[0].descripcion);
                        precio.html('$'+response[0].precio);
                        fecha_alta.html(response[0].fecha_alta);
                        fecha_modif.html(response[0].fecha_modificacion);
                    }
                });
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
                var serie = $('.noserie');
                var tipo = $('#tipo');
                var departamento = $('#departamento');
                var proveedor = $('#proveedor');
                var marca = $('#marca');
                var tienda = $('#tienda');
                var responsable = $('.responsable');
                var ip = $('#ip');
                var modelo = $('.modelo');
                var descripcion = $('.descripcion');
                var precio = $('.precio');
                serie.val('');
                tipo.val('');
                marca.val('');
                responsable.val('');
                ip.val('');
                departamento.val('');
                proveedor.val('');
                tienda.val('');
                modelo.val('');
                descripcion.val('');
                precio.val('');
                $.ajax({
                    url: "/equipo_a_editar",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function (response) {
                        console.log(response);
                        $('#exampleModalCenter').modal('show');
                        serie.val(response[0].num_serie);
                        $('#selectTipo').val(response[0].tipo['id']);
                        $('#selectdepartamento').val(response[0].departamento['id']);
                        $('#selectproveedor').val(response[0].proveedor['id']);
                        $('#selecttienda').val(response[0].tienda['id']);
                        $('#selectmarca').val(response[0].marca['id']);
                        responsable.val(response[0].responsable);
                        ip.val(response[0].ip);
                        modelo.val(response[0].modelo);
                        descripcion.val(response[0].descripcion);
                        precio.val(response[0].precio);
                    }
                });

                //Guarda equipo editado
                $("#guardar").click(function () {
                    var token = $("input[name='_token']").val();
                    var serie = $('.noserie').val();
                    var tipo = $('select[name=tipo]').val();
                    var departamento = $('select[name=departamento]').val();
                    var marca = $('select[name=marca]').val();
                    var proveedor = $('select[name=proveedor]').val();
                    var tienda = $('select[name=tienda]').val();
                    var responsable = $('.responsable').val();
                    var ip = $('#ip').val();
                    var modelo = $('.modelo').val();
                    var descripcion = $('.descripcion').val();
                    var precio = $('.precio').val();
                    var load = $('#guardar');
                    load.html('Actualizando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                  console.log(tipo,departamento,marca,proveedor,tienda, ip);
                    $.ajax({
                        url: "/actualizarequipo",
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            id: id,
                            serie: serie,
                            tipo: tipo,
                            departamento: departamento,
                            marca: marca,
                            proveedor: proveedor,
                            tienda: tienda,
                            responsable: responsable,
                            ip: ip,
                            modelo: modelo,
                            descripcion, descripcion,
                            precio, precio,
                            _token: token
                        },

                        success: function (response) {
                            $('#exampleModalCenter').modal('hide');
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















