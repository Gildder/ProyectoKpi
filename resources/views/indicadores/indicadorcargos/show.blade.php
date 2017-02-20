@extends('layouts.app')

@section('titulo')
	{{$indicador->nombre}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel">{{$indicador->id}} - {{$indicador->nombre}}</p>
	</div>

	<div class="panel-body">

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#cargos">Cargos Asignados</a></li>
		</ul>

		<div class="tab-content">
			<div id="cargos" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="{{route('indicadores.indicador.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
				</div>

				<div class="col-lg-12">
					@include('partials/alert/error')
				</div>

				<div class="row content">
					@include('indicadores/indicadorcargos/partials/seleccionar_cargo') 
				</div>
			</div>
		</div>
		<!-- Fin Panel Tab -->


	</div>
	<div class="panel-footer">
	</div>
		
</div>

@endsection


