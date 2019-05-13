@extends('templates.base')

@section('cssextra')
    <style type="text/css">
        body{
            background-color: #f2f2f2;
        }
        .contenido{
            margin-top: 35%;
        }
        .btn-inicio{
            border: 0px;
            background: linear-gradient(178.84deg, #17879D -61.99%, #1D82B1 -16.53%, #095B8D 41.42%, #001650 109.17%);
            box-shadow: 0px 2px 10px rgba(136, 136, 136, 0.53);
            border-radius: 19.5px;
            width: 30%;
            height: 39px;
            margin-left: 35%;
            margin-top: 5%;
            transition: .5s;
        }
        .btn-inicio:hover{
            transform: scale(1.1);
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
    {{--Navbar--}}
    <nav class="navbar navbar-light" style="background-color: white;">
        <a class="navbar-brand" href="#">
            <img src="{{asset('img/logo.png')}}" width="" height="40" alt="">
        </a>
    </nav>


    {{--Sección de logueo--}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-5 align-self-center ">
                    <div class="contenido">

                        {{csrf_field()}}
                        <div class="form-group text-center">
                            <label for="">Usuario:</label>
                            <input placeholder="Ingresa tu usuario" id="usuario" class="form-control" type="">
                        </div>
                        <div class="form-group text-center">
                            <label for="">Contraseña:</label>
                            <input placeholder="Ingresa tu contraseña" id="contrasena" class="form-control" type="password">
                        </div>

                        <div class="mensaje">

                        </div>

                        <button type="submit" class="btn btn-primary btn-inicio">Iniciar sesión</button>

                        {{--<div class="links">--}}
                            {{--<p>¿Olvidaste tu contraseña? <a style="color: #21B6CF;" href="" data-toggle="modal" data-target="#recoveryModal">Recuperala</a></p>--}}
                            {{--<br>--}}
                            {{--<p>¿No estás registrado? <a style="color: #21B6CF;" href="" data-toggle="modal" data-target="#exampleModalCenter">Registrate aquí</a></p>--}}
                        {{--</div>--}}
                    </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
      $(document).ready(function () {
          $('.btn-inicio').click(function () {
              var usuario = $('#usuario').val();
              var contra = $('#contrasena').val();
          });
      });
    </script>
@stop