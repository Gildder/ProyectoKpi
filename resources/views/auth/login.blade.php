@section('titulo')
    Inicio de Sesion
@endsection

@extends('layouts.app')

<div class="container" style="margin-top: 10%;  ">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><b> Inicio Sesion</b></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}">
                        {{ csrf_field() }}

                        @include('partials/alert/error')

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Usuario</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('usernamae') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control" name="password">
                                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>

                                </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
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
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i><strong>Entrar</strong> 
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
