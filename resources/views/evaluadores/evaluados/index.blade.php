@extends('layouts.app')

@section('titulo')
	Mis Evaluados 
@endsection

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">Mis evaluados</p>
  </div>
  <div class="panel-body">
  	
	@include('partials/alert/error')

	<div class="row">
		<div class="col-lg-12">
			@include('evaluadores/evaluados/partials/tabla_evaluados')
		</div>
	</div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection