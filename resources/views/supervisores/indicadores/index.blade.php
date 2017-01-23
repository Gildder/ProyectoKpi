@extends('layouts.app')

@section('titulo')
	Empleados
@endsection

@section('content')


<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">Supervisados</p>

  </div>
  <div class="panel-body">
  	
	@include('partials/alert/error')
	
	<div class="row">
		<div class="col-lg-12">
			@include('supervisores/indicadores/partials/tabla_empleado')
		</div>
	</div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection