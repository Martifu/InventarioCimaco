@extends('templates.base_dashboard')

@section('cssextra')

@stop

@section('content')
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar usuario</div>

                <div class="card-body">
                    <form method="POST"  action="{{url('/registrar')}}  " aria-label="">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autofocus>


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                              
                            </div>
                        </div>
                         <div class="form-group row">
                          <label class="col-md-4 col-form-label text-md-right">Tipo</label>
                            <div class="col-md-6">
                                
                                <select class="form-control" id="" name="tipo">
                                    @foreach($usuario as $usuarios)
                                        <option value="{{$usuarios->id}}">{{$usuarios->rol}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                           <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password2" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                 <button  type="Submit" id="agregar" class="btn btn-primary btn-agregar">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            
            
            $('#agregar').click(function () {
                var token = $('input[name=_token]').val();
                var name = $('input[id=name]').val();
                var email = $('input[id=email]').val();
                var tipo = $('select[name=tipo]').val();
                var password = $('input[id=password]').val();
                var load = $('#agregar');
                load.html('Agregando '+' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
               console.log(tipo, name, password, email);
                $.ajax({
                    url: "/registrar",
                    type: 'POST',
                    datatype: 'json',
                    data: {
                        _token: token,
                        name: name,
                        email: email,
                        tipo: tipo,
                        password: password,
                    },
                    success: function (response) {
                       
                        location.href = '/registrar';
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                      
                    }
                });
            });
               });





    </script>
@stop