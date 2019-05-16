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
    <div class="container">
        <div class="row">
            <div class="col col-md-7 align-self-center">
                <div class="card text-white  mb-3">

                    <div class="card-header bg-dark">
                        Registro
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
                    <div class="card-body">
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
                             


                            
                            @if (Session::has('equipos'))
                                <div class="alert alert-info" role="alert" id="resultado">
                                    <strong> Equipo registrado</strong>
                                </div>
                            @endif

                           


                            <button type="submit" id="dd" class="btn btn-primary btn-registrar">Registrar</button>
                           


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop

   
{{--@section('javascript')
  <script>
        $(document).ready(function () {
          $('#dd').click(function () {
                  
                  token = $("input[name = '_token']").val();
            
                        $.ajax({
                     url:"/agregar",
                     data:{token: token},
                     type:'GET',
                     datatype: 'json',
                     success:function (response) {
                          console.log(token);
                      
                     
                       
                     }
                 });
        
                 
 });
   
 });

       
    </script> --}}
@stop