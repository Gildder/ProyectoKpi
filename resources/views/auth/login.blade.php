@extends('layouts.login')

@section('titulo')
    @lang('labels.titlesPage.ttlInicioSesion')
@endsection

@section('content')

    <div class="container container-login">
        <div class="row" id="panel-login">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <label  class="tituloLogin">
                        @lang('labels.panels.pnsInicioSesion')
                    </label>
                </div>
                <div class="panel-body" >
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 labelLogin">
	                            @lang('labels.labels.lbsUsuario')
                            </label>

                            <div class="col-xs-12 col-md-12">
                                <div class="input-group input-group-lg">
                                    <input id="name" type="text"
                                           class="form-control"
                                           placeholder="@lang('labels.pladers.phsUsuario')"
                                           name="name" value="{{ old('name') }}">
                                    <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                    </div>
                                </div>
	                            @if ($errors->has('name'))
		                            <p class="help-block">
			                            {{ $errors->first('name') }}
		                            </p>
	                            @endif
                            </div>
                            
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 labelLogin">
	                            @lang('labels.labels.lbsContrasenia')
                            </label>
                            <div class="col-xs-12 col-md-12">
                                <div class="input-group input-group-lg">
                                    <input id="password"
                                           type="password"
                                           placeholder="@lang('labels.pladers.phsContrasenia')"
                                           class="form-control" name="password">
	                                
                                    <div class="input-group-btn">
                                        <a id="btnPass"
                                           class="btn btn-danger">
	                                        <i class="fa fa-eye" ></i>
                                        </a>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
		                            <p class="help-block">
			                            {{ $errors->first('password') }}
		                            </p>
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
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                                <button type="submit"
                                        class="btn btn-warning btn-sm btnLogin col-xs-12 col-sm-6">
                                    <i class="fa fa-lock"></i>
		                                @lang('labels.buttons.btnEntrar')
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

<script>
    $('#btnPass').on('click', function (e) {
        e.preventDefault();
        
        eventBtnPassword();
    })
    function eventBtnPassword() {
        let inpPass = $('input[name="password"]');
        let btnPass = $('#btnPass');
        let iconPass = btnPass.children('i');
        
        if(inpPass.attr('type') === 'password')
        {
            btnPass.removeClass('btn-danger');
            btnPass.addClass('btn-success');

            inpPass.attr('type', 'text');
            
            iconPass.removeClass('fa-eye');
            iconPass.addClass('fa-eye-slash');
        }else{
            btnPass.removeClass('btn-success');
            btnPass.addClass('btn-danger');

            inpPass.attr('type', 'password');

            iconPass.removeClass('fa-eye-slash');
            iconPass.addClass('fa-eye');
        }
    }
</script>
@endsection

