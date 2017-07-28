@extends('layouts.app')

@section('titulo')
	{{$evaluador->id}} - {{$evaluador->abreviatura}}
@endsection

@section('content')

<script type="text/javascript">
$(document).ready(function(){
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});

	
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
});
</script>


<div class="panel panel-default">
	<div class="panel-heading">
	  <a href="{{route('evaluadores.evaluador.index')}}" @click="mostrarModalLoading()"  class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">{{$evaluador->abreviatura}} - {{$evaluador->descripcion}}</p>
	</div>

	<div class="panel-body">

  		@include('partials/alert/error')
		<!--panelTab -->
		<ul class="nav nav-tabs" id="myTab">
		  <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
		  <li ><a data-toggle="tab" href="#evaluadores">Evaluadores</a></li>
		  <li ><a data-toggle="tab" href="#cargos">Cargos</a></li>
		  <li ><a data-toggle="tab" href="#indicadores">Indicadores</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="content col-sm-6">

					@include('evaluadores/evaluador/partials/datos_evaluador')	

					@include("evaluadores/evaluador/delete")
				</div>
				<div class="col-sm-12 panel-footer text-right">
					<a href="{{route('evaluadores.evaluador.edit', $evaluador->id)}}"  @click="mostrarModalLoading()"  class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
					<a href="javascript:void(0)"  data-toggle="modal"  data-target="#modal-delete-{{$evaluador->id}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>
				</div>
			</div>

			{{-- Evaluadores --}}
			<div id="evaluadores" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
					<p>Elija a los empleados que perteneceran a la Gerencia evaluadora <b>{{$evaluador->abreviatura}}</b>.</p>
				</div>

				{{-- Capa de Seleccion Empleado --}}
				<div class="col-xs-12 col-sm-12 col-md-7">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Seleccionar Empleado</p>
						</div>
						<div class="panel-body">
							@include('evaluadores/evaluador/empleados/tabla_empleados')
						</div>
					</div>
				</div>

				{{-- Capa de empleados Agregados --}}
				<div class="col-xs-12 col-sm-12 col-md-5">
						<p class="titulo-panel">Evaluadores </p><hr class="barraEvaluador">
					@include('evaluadores/evaluador/empleados/tabla_agregados')
				</div>
			</div>
			{{-- Fin Evaluadores --}}


			{{-- Indicadores --}}
			<div id="indicadores" class="tab-pane">
				@include('evaluadores/evaluador/indicadores/tabla_indicadores')
			</div>
			{{-- Fin Indicadores --}}

			{{-- Cargos --}}
			<div id="cargos" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
					<p>Elija los cargos se evaluaran por Gerencia  <b>{{$evaluador->abreviatura}}</b>.</p>
				</div>
				{{-- Capa de Seleccion cargos --}}
				<div class="col-xs-12 col-sm-12 col-md-7">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Cargo</p>
						</div>
						<div class="panel-body">
							@include('evaluadores/evaluador/cargos/tabla_cargos')
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-5">
		      		<p class="titulo-panel">Cargos Agregados </p><hr class="barraEvaluador">
					@include('evaluadores/evaluador/cargos/tabla_agregados')
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


