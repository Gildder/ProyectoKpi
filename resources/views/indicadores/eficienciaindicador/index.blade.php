@extends('layouts.app')

@section('titulo')
  Primer Indicador
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
  		<p class="titulo-panel">Primer Indicadores</p>

	</div>
	<div class="panel-body">
		
		@include('partials/alert/error')

		<div class="row">
			<div class="col-lg-12">
	        	@include('indicadores/primerindicador/partials/tabla_datos')
			</div>
		</div>

	</div>
	<div class="panel-footer">
	</div>
</div>
@endsection