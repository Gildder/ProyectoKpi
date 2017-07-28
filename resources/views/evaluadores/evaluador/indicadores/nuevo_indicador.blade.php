@extends('layouts.app')

@section('titulo')
	{{$evaluador->id}} - {{$evaluador->abreviatura}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	  <a href="{{route('evaluadores.evaluador.show', array($evaluador->id))}}" @click="mostrarModalLoading()" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">{{$evaluador->abreviatura}} - {{$evaluador->descripcion}}</p>
	</div>

	<div class="panel-body">
		<div class="row col-lg-12">
			@include('partials/alert/error')
		</div>

			
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br>
			<p>Elija a los indicadores que perteneceran a la Gerencia evaluadora <b>{{$evaluador->abreviatura}}</b></p><br>
		</div>

		{{-- Capa de Seleccion Empleado --}}
		<div class="col-sm-7">
			<div class="panel panel-default">
				<div class="panel-heading">
				  <p class="titulo-panel">Seleccionar Indicador</p>
				</div>
				<div class="panel-body">
					@include('evaluadores/evaluador/indicadores/nuevosindicadores/tabla_disponibles')
				</div>
			</div>
		</div>

		{{-- Capa de empleados Agregados --}}
		<div class="col-sm-5">
			<p class="titulo-panel">Indicadores </p><br>
			@include('evaluadores/evaluador/indicadores/nuevosindicadores/tabla_agregados')
		</div>

		<div class="col-sm-12 panel-footer text-right">
			<a href="{{route('evaluadores.evaluador.show', array($evaluador->id))}}" @click="mostrarModalLoading()" class="btn btn-primary btn-sm"><span class="fa fa-check text-left"></span><b> Listo</b> </a>
		</div>

	</div>
	<div class="panel-footer">
	</div>
		
</div>

@endsection
