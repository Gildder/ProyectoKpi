@extends('layouts.app')

@section('titulo')
	Gerencia Evaluadora Cargos
@endsection

@section('content')


<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">Lista de Indicadores</p>

  </div>
  <div class="panel-body">
  	
	@include('partials/alert/error')

	<div class="row">
		<div class="col-lg-12">
			@include('indicadores/indicadorCargos/partials/tabla_indicadorcargos')
		</div>
	</div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection