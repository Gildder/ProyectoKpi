@extends('layouts.app')

@section('titulo')
	Supervisiones
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			<p class="titulo-panel">Lista de Tareas</p>
		</div>
		<div class="panel-body">
			<div id="datos" class="tab-pane fade in active">
				@include('partials/alert/error')
                <div class="breadcrumb col-xs-12 col-sm-12 col-md-12 col-lg-12 estiloBreadcrumb" >
                    Tareas Programadas para la Semana {{ $semanas->semana }} del mes de <b>{{ $semanas->mes }}</b>, del <b class="fechaTareas">
                        {{ $semanas->fechaInicio }}</b> al <b class="fechaTareas">{{ $semanas->fechaFin }}</b>

					{{--boton buscador--}}
					<a href="{{ route('supervisores.supervisados.tareas.busquedas') }}" class="btn btn-primary btn-sm btnBusquedas">Busquedas   <i class="fa fa-search"></i></a>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-responsive">
                    @include("supervisores/supervisados/tareas/partials/tabla_tareas")
                </div>
			</div>
		</div>
		<div class="panel-footer">
		</div>
	</div>

    <style>
        .estiloBreadcrumb {
            margin-bottom: 10px;
        }
		.btnBusquedas
		{
			float: right;
			position: relative;
			right: 10px;
		}
    </style>
@endsection
