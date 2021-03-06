@extends('layouts.app')

@section('titulo')
  Indicadores
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
  		<p class="titulo-panel">Indicadores</p>

	</div>
	<div class="panel-body">
		
		@include('partials/alert/error')

		 <div class="text-left col-lg-12 breadcrumb">
			<a  href="{{route('indicadores.indicador.create')}}" class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span><b>   Nuevo</b></a>
		</div>
		<div class="col-lg-12">
			@include('indicadores/indicador/partials/tabla_indicador')
		</div>

	</div>
	<div class="panel-footer">
	</div>
</div>
@endsection