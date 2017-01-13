@extends('layouts.app')

@section('titulo')
	Empleados
@endsection

@section('content')


<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">Empleados</p>

  </div>
  <div class="panel-body">
  	
	@include('partials/alert/error')
	
	<div class="text-left col-lg-12 breadcrumb">
		<a  href="{{route('empleados.empleado.create')}}" class="btn btn-primary btn-sm" ><b>Nuevo</b> </a>
	</div>
	<div class="row">
		<div class="col-lg-12">
			@include('empleados/empleado/partials/tabla_empleado')
		</div>
	</div>

  </div>
</div>
@endsection