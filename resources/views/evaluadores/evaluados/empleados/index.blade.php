@extends('layouts.app')

@section('titulo')
	Lista de Empleados
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
    	<a href="{{route('evaluadores.evaluados.dashboard')}}" class="btn btn-primary btn-xs  pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>

  		<p class="titulo-panel">Evaluados de la Gerencia {!! $evaluador->descripcion !!}</p>

		</div>
		<div class="panel-body">
			<div id="datos" class="tab-pane fade in active">
				<p>Los empleados que tienen asignados el indicador <span class="fa fa-line-chart"></span> <b>{!! $indicador->nombre !!}</b>. Haga clic en el boton <span class="label label-pill label-info"><span class="fa fa-bar-chart" ></span></span> para ver la informacion de los indicadores.</p><br>
				<div class="row">
					<div class="col-lg-12">
	        	@include("evaluadores/evaluados/empleados/partials/tabla_empleados")
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
		</div>
	</div>
@endsection