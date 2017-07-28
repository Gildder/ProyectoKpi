@extends('layouts.app')

@section('titulo')
	Supervisiones
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="{{route('supervisores.supervisados.index')}}" @click="mostrarModalLoading()" class="btn btn-primary btn-xs  pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>

			<p class="titulo-panel">Lista de Tareas de Supervisados</p>
		</div>
		<div class="panel-body">
			<div id="datos" class="tab-pane fade in active">
				@include('partials/alert/error')

				<div class="breadcrumb col-xs-12 col-sm-12 col-md-12 col-lg-12" >Tareas Programadas para la Semana {{ $semanas->semana }} del mes de <b>{{ \Calcana::getNombreMes($semanas->mes) }}</b>, del <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo($semanas->fechaInicio) }}</b> al <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo($semanas->fechaFin) }}</b>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        	@include("supervisores/supervisados/tareas/partials/tabla_tareas")
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
		</div>
	</div>
@endsection
