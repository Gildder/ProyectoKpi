@extends('layouts.app')

@section('titulo')
	Evaluadores
@endsection

@section('content')


<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">Gerencia Evaluadoras</p>
  </div>
  <div class="panel-body">
  	
	@include('partials/alert/error')
	
	<div class="text-left col-lg-12 breadcrumb">
		<a  href="{{route('evaluadores.evaluador.create')}}" @click="mostrarModalLoading()" class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span><b>   Nuevo</b> </a>
	</div>

	<div>

	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
			@include('evaluadores/evaluador/partials/tabla_evaluador')
		</div>
		</div>
	</div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection