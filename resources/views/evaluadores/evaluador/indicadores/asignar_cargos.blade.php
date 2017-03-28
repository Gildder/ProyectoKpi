@extends('layouts.app')

@section('titulo')
	{!! $indicador->nombre !!}
@endsection

@section('content')

<div class="panel panel-default">
	{{-- Header --}}
	<div class="panel-heading">
	  <a href="{{route('evaluadores.evaluador.show', array($evaluador->id))}}" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">{!! $indicador->id !!} - {!! $indicador->nombre !!}</p>
	</div>

	{{-- Body --}}
	<div class="panel-body">

		{{-- Mensajes --}}
		<div class="row col-lg-12">
			@include('partials/alert/error')
		</div>

		<div class="col-sm-12">
			{{-- Botones --}}
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
				<a  href="javascript:void(0)" data-toggle="modal" data-target="#agregarcargo"  class="btn btn-success btn-sm  @if(empty( $cargosEvaluadores)) disabled @endif"  title="Agregar Indicador"><span class="fa fa-plus"></span>   <b>Agregar</b></a>
			</div>

			{{-- Comentario --}}
			<div class="col-sm-12" style="margin-bottom: 10px;">
				<p>Lista de cargos asignados al indicador <b>{!! $indicador->nombre !!}</b></p>
			</div>

			{{-- tabla de los cargos ya relacionados con los indicadores --}}
			@include('evaluadores/evaluador/indicadores/cargosasignados/tabla_agregados')
			

			{{-- Modal para agregar un nuevo cargo --}}
			@include('evaluadores/evaluador/indicadores/cargosasignados/agregar')
		</div>
	</div>

	{{-- Footer --}}
	<div class="panel-footer">
	</div>
		@if($errors->has())
<script>
  alert($('#agregarcargo').modal('show'));
    $('#agregarcargo').modal('toggle');
    $('#agregarcargo').modal('show');
</script>
@endif
</div>

@endsection

