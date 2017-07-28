@extends('layouts.app')

@section('titulo')
	Supervisiones
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
      		<p class="titulo-panel">Lista de Supervisados</p>
		</div>
		<div class="panel-body">
			<div id="datos" class="tab-pane fade in active">
				@include('partials/alert/error')

				<div class="breadcrumb col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p style="display: inline-block">Todos los empleados que se te asignaron para supervisar sus indicadores.</p>
                    <div class="text-right" style="float: right; display: inline-block">
                        {{-- Finalizado --}}
                        <a  href="{{route('supervisores.supervisados.verTareasSupervisados')}}" @click="mostrarModalLoading()"   class="btn btn-success btn-sm" title="Ver Tareas"><span class="fa  fa-tasks"></span>  <b class="hidden-xs"> Ver Tareas</b></a>
                    </div>
				</div>
				<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
					@include("supervisores/supervisados/partials/tabla_empleados")
				</div>
			</div>
		</div>
		<div class="panel-footer">
		</div>
	</div>
@endsection
