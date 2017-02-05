@extends('layouts.app')

@section('titulo')
	Gerencia Evaluadora Cargos
@endsection

@section('content')


<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">Cargos Evaluados</p>

  </div>
  <div class="panel-body">
  	
	@include('partials/alert/error')
    @if($evaluadores->count()<= 0)
      <p>Por favor, Para usar esta opcion primero creae una <a href="{{route('empleados.evaluador.index')}}">Gerencia Evaluadora</a> .</p><br>
    
    @endif
	<div class="row">
		<div class="col-lg-12">
			@include('empleados/evaluadorcargos/partials/tabla_evaluadorcargos')
		</div>
	</div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection