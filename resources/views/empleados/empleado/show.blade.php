@extends('layouts.app')

@section('titulo')
	Empleado
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	  <strong>{{$empleados->codigo}} - {{$empleados->nombres}}</strong>
	</div>

	<div class="panel-body">
		<div class="col-lg-12 breadcrumb">
			<a href="{{route('empleados.empleado.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
		</div>

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
		  <li><a data-toggle="tab" href="#indicador">Indicadores</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="col-sm-6">
					<div class="content">
						@include('empleados/empleado/ver')		
					</div>
				</div>
				
			</div>


			<div id="indicador" class="tab-pane fade">
				<div class="content">
				<p>Lista de todos los indicadores asignados al empleado</p>
				<br>
					@include('empleados/empleado/tabla_indicadores')
				</div>
			</div>
		<!-- Fin Panel Tab -->

		@include('empleados/empleado/ver_indicador')
	</div>

	</div>
	 <div class="panel-footer text-right">
	  	<a href="{{route('empleados.empleado.edit', $empleados->codigo)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
	  	<a href="{{route('empleados.empleado.index')}}" class="btn btn-danger btn-sm"><span class="fa fa-delete"></span><b> Borrar</b> </a>
		
	 </div>
</div>

@endsection


@section('script')
	
@endsection

