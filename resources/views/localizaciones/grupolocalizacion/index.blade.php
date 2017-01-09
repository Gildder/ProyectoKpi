@extends('layouts.app')

@section('titulo')
      Grupo Localizacion
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
  		<p class="titulo-panel">Grupo Localizacion</p>

	</div>
	<div class="panel-body">
		
		@include('partials/alert/error')

		<div class="text-left col-lg-12 breadcrumb">
			<a  href="{{route('localizaciones.grupolocalizacion.create')}}" class="btn btn-primary btn-sm" ><b>Nuevo</b> </a>
		</div>
		<div class="row">
			<div class="col-lg-12">
	        	@include("localizaciones/grupolocalizacion/partials/tabla_grupolocalizacion")
			</div>
		</div>

	</div>
	<div class="panel-footer">
	</div>
</div>

@endsection