@extends('layouts.app')

@section('titulo')
	Evaluadores
@endsection

@section('content')


<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">Evaluadores de Gerencia</p>
  </div>
  <div class="panel-body">
  	
	@include('partials/alert/error')
	
	 @if($evaluadores->count()<= 0)
	    <p>Por favor, Para usar esta opcion primero crear una <a href="{{route('empleados.evaluador.index')}}">Gerencia Evaluadora</a> .</p><br>
	   @endif
	<div class="row">
		<div class="col-lg-12">
			<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<p>Los empleados que podran </p><hr>
			</div>
			@include('empleados/evaluadorempleados/partials/tabla_evaluadorempleados')
		</div>
	</div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection