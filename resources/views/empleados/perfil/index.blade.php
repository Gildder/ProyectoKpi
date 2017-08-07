@extends('layouts.app')

@section('titulo')
	Perfil de Usuario
@endsection

@section('content')

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">Perfil del Usuario</p>
  </div>
  <div class="panel-body">

	@include('partials/alert/error')

    <div class="row col-xs-12 col-sm-6 col-md-6 col-lg-6">
        @include('empleados/perfil/ver')
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
</div>

@endsection
