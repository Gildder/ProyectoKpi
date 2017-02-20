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
			<a href="{{route('supervisores.supervisor.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
		</div>

		<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
			@include('partials/alert/error')
		</div>


		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p>Elije a los empleados que supervisaran el departamento <b>{{$departamento->nombre}}</b>.</p><br>
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
      		<p class="titulo-panel">Supervisores</p><br>
			@include('supervisores/supervisor/partials/tabla_agregados')
		</div>
	</div>
      
  </div>
  <div class="panel-footer text-right">
  </div>


</div>

@endsection





