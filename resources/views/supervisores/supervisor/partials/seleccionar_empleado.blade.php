@extends('layouts.app')

@section('titulo')
	Nuevo Supervisor
@endsection

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
	<a href="{{route('supervisores.supervisor.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>

      <p class="titulo-panel">@if($tipo == 0) Cargo @else Departamento @endif {{$lista->id}}: {{$lista->nombre}}</p>
      
  </div>
  <div class="panel-body">
	<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
		@include('partials/alert/error')
	</div>


	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<p>Elije a los empleados que supervisaran el @if($tipo == 0) cargo @else departamento @endif <b>{{$lista->nombre}}</b>.</p><br>
	</div>

	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">
			  <p class="titulo-panel">Seleccionar Empleado</p>
			</div>
			<div class="panel-body">
				@include('supervisores/supervisor/partials/tabla_empleados')
			</div>
		</div>
	</div>

	<div class="col-sm-4">
  		<p class="titulo-panel">Supervisores</p><hr>
		@include('supervisores/supervisor/partials/tabla_agregados')
	</div>
      
  </div>
  <div class="panel-footer text-right">
  </div>


</div>

@endsection





