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
                            @if (Session::has('marcas'))
                                <script>
                                    var hulla = new hullabaloo();
                                    hulla.send("Equipo agregado", "success");
                                </script>
                            @endif
    <div class="header">
        <div class="row">
            <div class="col">
                <h2>Marca</h2>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col offset-5"></div>
            <div class="col">
                <button style="font-weight: bold; color: white; background-color: #45bc5d;" class="btn btn-outline-"data-toggle="modal" data-target="#modalForm">Agregar marca <i class="fas fa-plus-circle" style="color: white;"></i></button>
            </div>
        </div>
    </div>
    <center>
      <table id="example" class="table table-striped table-bordered" style="width:70%">
        <thead>
        <tr>

            <th>Nombre</th>
             <th style="width: 10%">Acciones</th>
        </tr>


        </thead>
             <tbody id="tabla">
        @foreach($marcas as $marca)
        <tr>
            <input type="hidden" class="id" value="{{$marca->id}}" name="ids">
            <td>{{$marca->nombre}}</td>
            <td>
                <button id="editar" style="background-color: #16c7ff; border: 0px;" class="btn btn-primary btn-editar" href="#exampleModalCenter"><i class="far fa-edit"></i></button>
                <button id="eliminar" style=" background-color: red; border: 0px;" class="btn btn-warning btn-eliminar"  href="#exampleModalEliminar"><i class="far fa-trash-alt" style="color: white;"></i></button>
            </td>
        </tr>
        @endforeach
    </table>  
    </center>
        



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
                                <label for="marca">Nombre:</label>
                                <input type="text" class="form-control" id="marca" name="marca" placeholder="Ingrese marca" value="{{old('marca')}}">
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
                   <h5 class="modal-title" id="exampleModalCenterTitle">Modificar marca</h5>
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
                                <label for="mar">Marca:</label>
                                <input type="text" class="form-control" id="marca" name="marca" >
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
               var marca = $('input[name=marca]').val();
              
                var load = $('#agregar');
                load.html('Agregando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

                console.log(marca);
                $.ajax({
                    url: "/marca",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        _token: token,
                       
                        marca:marca
                       
                    },
                    success: function (response) {
                        console.log(response);
                      location.href ='/buscarmarca';
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
                var marca = $('#marca');
               
                marca.val('');
                               $.ajax({
                    url: "/marca_a_editar",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function (response) {
                        $('#exampleModalCenter').modal('show');
                        marca.val(response[0].nombre);
                    }
                });

                //Guarda equipo editado
                $("#guardar").click(function () {
                    var token = $("input[name='_token']").val();
                    var marca = $('#marca').val();
                    
                    var tabla = $('#tabla');
                    var tabla2 = "";
                    var load = $('#guardar');
                    load.html('Actualizando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                  console.log(id,marca);
                    $.ajax({
                        url: "/actualizarmarca",
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            id: id,
                           
                            marca: marca,

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
                            location.href='/marca';
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















