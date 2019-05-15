@extends('templates.base')

@section('cssextra')
    <style type="text/css">
        body{
            background-color: #f2f2f2;
        
    
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

@stop

@section('javascript')

@stop