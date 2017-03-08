@extends('layouts.app')

@section('titulo')
	{{$evaluador->id}} - {{$evaluador->abreviatura}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel">{{$evaluador->abreviatura}} - {{$evaluador->descripcion}}</p>
	</div>

	<div class="panel-body">

  		@include('partials/alert/error')
		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
		  <li ><a data-toggle="tab" href="#evaluadores">Evaluadores</a></li>
		  <li ><a data-toggle="tab" href="#cargos">Cargos</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="{{route('empleados.evaluador.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
				</div>
				<div class="content col-sm-6">

					@include('empleados/evaluador/partials/datos_evaluador')	

					@include("empleados/evaluador/delete")
				</div>
				<div class="col-sm-12 panel-footer text-right">
					<a href="{{route('empleados.evaluador.edit', $evaluador->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
					<a href="#"  data-toggle="modal" data-target="#modal-delete-{{$evaluador->id}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>
				</div>
			</div>

			{{-- Evaluadores --}}
			<div id="evaluadores" class="tab-pane">
				<div class="col-lg-12 breadcrumb">
					<a href="{{route('empleados.evaluador.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
				</div>
				{{-- Capa de Seleccion Empleado --}}
				<div class="col-sm-7">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Empleado</p>
						</div>
						<div class="panel-body">
							@include('empleados/evaluador/partials/empleados/tabla_empleados')
						</div>
					</div>
				</div>

				{{-- Capa de empleados Agregados --}}
				<div class="col-sm-5">
						<p class="titulo-panel">Evaluadores </p><br>
					@include('empleados/evaluador/partials/empleados/tabla_agregados')
				</div>
			</div>
			{{-- Fin Evaluadores --}}

			{{-- Evaluadores --}}
			<div id="cargos" class="tab-pane">
				<div class="col-lg-12 breadcrumb">
					<a href="{{route('empleados.evaluador.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
				</div>
				{{-- Capa de Seleccion cargos --}}

				<div class="row col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Cargo</p>
						</div>
						<div class="panel-body">
							@include('empleados/evaluador/partials/cargos/tabla_cargos')
						</div>
					</div>
				</div>

				<div class="col-sm-6">
		      		<p class="titulo-panel">Cargos Agregados </p><br>
					@include('empleados/evaluador/partials/cargos/tabla_agregados')
				</div>
			</div>
			{{-- Fin cargos --}}
		</div>
		<!-- Fin Panel Tab -->

	</div>
	<div class="panel-footer">
	</div>
		
</div>

@endsection


