@extends('layouts.app')

@section('titulo')
	{{$indicador->nombre}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	  <a href="{{route('evaluadores.evaluador.indicadorcargos.index')}}" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">{{$indicador->id}} - {{$indicador->nombre}}</p>
	</div>

	<div class="panel-body">

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#cargos">Cargos Asignados</a></li>
		</ul>

		<div class="tab-content">
			<div id="cargos" class="tab-pane fade in active">

				<div class="row col-lg-12">
					@include('partials/alert/error')
				</div>

				<div class="row content">
					@include('evaluadores/evaluador/indicadorcargos/partials/seleccionar_cargo') 
				</div>
			</div>
		</div>
		<!-- Fin Panel Tab -->


	</div>
	<div class="panel-footer">
	</div>
		
</div>

@endsection


