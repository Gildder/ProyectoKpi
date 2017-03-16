@extends('layouts.app')

@section('titulo')
	{{$evaluador->id}} - {{$evaluador->abreviatura}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	  <a href="{{route('evaluadores.evaluador.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
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
				<div class="content col-sm-6">

					@include('evaluadores/evaluador/partials/datos_evaluador')	

					@include("evaluadores/evaluador/delete")
				</div>
				<div class="col-sm-12 panel-footer text-right">
					<a href="{{route('evaluadores.evaluador.edit', $evaluador->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
					<a href="#"  data-toggle="modal" data-target="#modal-delete-{{$evaluador->id}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>
				</div>
			</div>

			{{-- Evaluadores --}}
			<div id="evaluadores" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br>
					<p>Elija a los empleados perteneceran a la Gerencia evaluadora <b>{{$evaluador->abreviatura}}</b>.</p><br>
				</div>

				{{-- Capa de Seleccion Empleado --}}
				<div class="col-sm-7">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Empleado</p>
						</div>
						<div class="panel-body">
							@include('evaluadores/evaluador/partials/empleados/tabla_empleados')
						</div>
					</div>
				</div>

				{{-- Capa de empleados Agregados --}}
				<div class="col-sm-5">
						<p class="titulo-panel">Evaluadores </p><br>
					@include('evaluadores/evaluador/partials/empleados/tabla_agregados')
				</div>
			</div>
			{{-- Fin Evaluadores --}}

			{{-- Cargos --}}
			<div id="cargos" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br>
					<p>Elija los cargos se evaluaran por Gerencia  <b>{{$evaluador->abreviatura}}</b>.</p><br>
				</div>
				{{-- Capa de Seleccion cargos --}}
				<div class="row col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Cargo</p>
						</div>
						<div class="panel-body">
							@include('evaluadores/evaluador/partials/cargos/tabla_cargos')
						</div>
					</div>
				</div>

				<div class="col-sm-6">
		      		<p class="titulo-panel">Cargos Agregados </p><br>
					@include('evaluadores/evaluador/partials/cargos/tabla_agregados')
				</div>
			</div>
			{{-- Fin cargos --}}.
		
		</div>
		<!-- Fin Panel Tab -->

	</div>
	<div class="panel-footer">
	</div>
		
</div>

@endsection


