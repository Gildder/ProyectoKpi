@extends('layouts.app')

@section('titulo')
	{{$ponderacion->nombre}}
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
	  <a href="{{route('evaluadores.ponderacion.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">{{$ponderacion->nombre}}</p>
	</div>

	<div class="panel-body">

  		@include('partials/alert/error')
		<!--panelTab -->
		<ul class="nav nav-tabs"  id="myTab">
		  <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
		  <li ><a data-toggle="tab" href="#tipos">Tipo Indicadores</a></li>
		  <li ><a data-toggle="tab" href="#indicadores">Indicadores</a></li>
		  <li ><a data-toggle="tab" href="#escalas">Escalas</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="content col-sm-6">

					@include('evaluadores/ponderacion/partials/datos_ponderacion')	

					@include("evaluadores/ponderacion/delete")
				</div>
				<div class="col-sm-12 panel-footer text-right">
					<a href="{{route('evaluadores.ponderacion.edit', $ponderacion->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-delete-{{$ponderacion->id}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>
				</div>
			</div>

			{{-- Tipos Indicadores --}}
			<div id="tipos" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px;">
					<p>Agregar las ponderacion para los Tipos de Indicadores de <b>{{$ponderacion->nombre}}</b>.</p><br>
				</div>

				{{-- Capa de Seleccion Empleado --}}
				<div class="col-sm-7">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Tipo de Indicador</p>
						</div>
						<div class="panel-body">
							@include('evaluadores/ponderacion/tipos/tabla_tiposindicadores')
						</div>
					</div>
				</div>

				{{-- Capa de empleados Agregados --}}
				<div class="col-sm-5">
						<p class="titulo-panel">Tipos Agregados </p><br>
					@include('evaluadores/ponderacion/tipos/tabla_agregados')
				</div>
			</div>
			{{-- Fin Tipos Indicadores --}}

			{{-- Indicadores --}}
			<div id="indicadores" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="margin-top: 10px;">
					<p>Agregar ponderacion a los Indicadores de  <b>{{$ponderacion->nombre}}</b>.</p><br>
				</div>
				{{-- Capa de Seleccion cargos --}}
				<div class="row col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Indicador</p>
						</div>
						<div class="panel-body">
							@include('evaluadores/ponderacion/indicadores/tabla_indicadores')
						</div>
					</div>
				</div>

				<div class="col-sm-6">
		      		<p class="titulo-panel">Indicadores ponderados </p><br>
					@include('evaluadores/ponderacion/indicadores/tabla_agregados')
				</div>
			</div>
			{{-- Fin Indicadores --}}

			{{-- Escalas --}}
			<div id="escalas" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="margin-top: 10px;">
					<p>Agregar escala a los Indicadores de  <b>{{$ponderacion->nombre}}</b>.</p><br>
				</div>
				{{-- Capa de Seleccion cargos --}}
				<div class="row col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Seleccionar Escala</p>
						</div>
						<div class="panel-body">
							@include('evaluadores/ponderacion/escalas/tabla_escalas')
						</div>
					</div>
				</div>

				<div class="col-sm-6">
		      		<p class="titulo-panel">Escalas Agregadas</p><br>
					@include('evaluadores/ponderacion/escalas/tabla_agregados')
				</div>
			</div>
			{{-- Fin Escalas --}}
		</div>
		<!-- Fin Panel Tab -->

	</div>
	<div class="panel-footer">
	</div>
		
</div>

@endsection


