@extends('layouts.app')

@section('cssextra')
    <style type="text/css">
        body {
            font-size: 1.0rem;
            background-color: #fcfaff;
            font-family: proxima-nova;
        }
        .btn-inicio{
            border: 0px;
            background: linear-gradient(178.84deg, #17879D -61.99%, #1D82B1 -16.53%, #095B8D 41.42%, #001650 109.17%);
            box-shadow: 0px 2px 10px rgba(136, 136, 136, 0.53);
            border-radius: 19.5px;
            width: 80%;
            height: 39px;
            margin-top: 5%;
            transition: .5s;
        }
        .btn-inicio:hover{
            transform: scale(1.05);
        }
        .form-control{
            margin: auto;
            margin-bottom: 10px;
            box-shadow: 0px 2px 10px rgba(136, 136, 136, 0.33);
            background-color: #ffffff;
            border-radius: 15px;
        }
        @font-face {
            font-family: 'proxima-nova';
            src: url('/public/fonts/ProximaNova-Regular.otf');
        }
    </style>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card ">
                <div style="color: white; background-color: #31353D;" class="card-header">{{ __('Inicio de sesión') }}</div>

                <div class="card-body text-center">
                    <form class="" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="email" class="col-sm-4 col-form-label ">{{ __('Usuario:') }}</label>

                            <div class="col-md-8" style="margin: auto;">
                                <input id="email" type="" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password" class="col-md-4 col-form-label ">{{ __('Contraseña:') }}</label>

                            <div class="col-md-8" style="margin: auto;">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-md-6 "  style="margin: auto;">
                                <div class="form-check" >
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember" >
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-5"  style="margin: auto;">
                                <button type="submit" class="btn btn-primary btn-inicio font-weight-bold">
                                    {{ __('Iniciar sesión') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
