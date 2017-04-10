@extends('layouts.app')

@section('titulo')
	Perfil de Usuario
@endsection

@section('content')


<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">Perfil del Usuario</p>

  </div>
  <div class="panel-body">
  	
	@include('partials/alert/error')
	
	<div class="row">
		<div class="col-lg-6">
			@include('empleados/perfil/ver')
		</div>
	</div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection