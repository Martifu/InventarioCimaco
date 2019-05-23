@extends('templates.base_dashboard')
@section('title')

    
@section('cssextra')
  <meta name="csrf-token" content="{{ csrf_token() }}">  
    <style type="text/css">
       
        .contenido{
            margin-top: 35%;
        }
     
        .form-control{
            margin: auto;
            width: 70%;
            margin-bottom: 10px;
            box-shadow: 0px 2px 10px rgba(136, 136, 136, 0.53);
            background-color: #F8F8F8;
            border-radius: 15px;
        }
     
    </style>
@stop
@section('content')
 <!-- Button to trigger modal -->
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


<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
    Open Contact Form
</button>



<!-- Modal -->
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



@stop
