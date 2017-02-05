@extends('layouts.app')

@section('titulo')
	Nuevo Supervisor
@endsection

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">{{$departamento->id}} - {{$departamento->nombre}}</p>
      
  </div>
  <div class="panel-body">

	<div class="content">
		<div class="col-lg-12 breadcrumb">
			<a href="{{route('supervisores.supervisor.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
		</div>
		
		@include('partials/alert/error')


		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
				  <p class="titulo-panel">Seleccionar Empleado</p>
				</div>
				<div class="panel-body">
					@include('supervisores/supervisor/partials/tabla_empleados')
				</div>
			</div>
		</div>

		<div class="col-sm-6">
      		<p class="titulo-panel">Encargados - {{$departamento->nombre}}</p><br>
			@include('supervisores/supervisor/partials/tabla_agregados')
		</div>
	</div>
      
  </div>
  <div class="panel-footer text-right">
  </div>


</div>

@endsection





