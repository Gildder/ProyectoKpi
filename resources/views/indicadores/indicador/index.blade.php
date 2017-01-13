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

		<div class="row">
			<div class="col-lg-12">
	        	@include('indicadores/indicador/partials/tabla_indicador')
			</div>
		</div>

	</div>
	<div class="panel-footer">
	</div>
</div>
@endsection