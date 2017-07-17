@extends('layouts.app')

@section('titulo')
    Iniciar Sesion
@endsection

@section('content')

    <div class="container" style="margin-top: 10%;  ">
        <div class="row">
        <div class="row" id="panel-login">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading"><b style='font-family: "verdana", "sans-serif";'> Inicio Sesion</b></div>
                <div class="panel-body" >
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label" style="text-align: left;">Usuario</label>

                            <div class="col-xs-12 col-md-12">
                                <div class="input-group input-group-lg">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                </div>
            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>
                            
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label" style="text-align: left;">Contraseña</label>

                            <div class="col-xs-12 col-md-12">
                                <div class="input-group input-group-lg">
                                    <input id="password" type="@{{ type_pass == true? 'password':'text' }}" class="form-control" name="password">
                                    <div class="input-group-btn"
                                         >
                                        <a @click="mostrarContrasenia($event)"  class="btn @{{ type_pass == true? 'btn-danger':'btn-success' }}"><i class="fa fa-lock @{{ type_pass == true? 'fa-lock':'fa-unlock' }}" ></i></a>
                                        </div>

                                </div>
            @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                            </div>
                        </div>

                      {{--  <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recuerdame
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <div class="col-xs-12 col-md-6 ">
                                <button type="submit" class="btn btn-warning btn-lg  col-sm-5 col-md-5 col-lg-6" style="box-shadow: 1px 2px 1px #1c2529;">
                                    <i class="fa fa-btn fa-sign-in"></i> <strong style="text-shadow: 1px 1px 1px grey;">Entrar</strong>
                                </button>

                                {{-- <a class="btn btn-link" href="{{ url('/password/reset') }}">Recuperar Contraseña?</a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

