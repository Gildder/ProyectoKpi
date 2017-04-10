@extends('layouts.app')

@section('titulo')
	Supervisiones
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
      		<p class="titulo-panel">Lista de Empleados</p>

		</div>
		<div class="panel-body">
			<div id="datos" class="tab-pane fade in active">
				@include('partials/alert/error')
				
				<p>Todos los empleados que se te asignaron para supervisar sus indicadores.</p><br>
				<div class="row">
					<div class="col-lg-12">
			        	@include("supervisores/supervisados/partials/tabla_empleados")
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
		</div>
	</div>

@endsection