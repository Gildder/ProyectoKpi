@extends('layouts.app')

@section('titulo')
	{{$evaluador->id}} - {{$evaluador->abreviatura}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel">{{$evaluador->id}} - {{$evaluador->abreviatura}} {{$evaluador->descripcion}}</p>
	</div>

	<div class="panel-body">

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
		  <li><a data-toggle="tab" href="#empleados">Evaluadores</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="{{route('empleados.evaluador.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
				</div>
				<div class="content col-sm-6">
  					@include('partials/alert/error')

					@include('empleados/evaluador/partials/datos_evaluador')	

					@include("empleados/evaluador/delete")
				</div>
				<div class="col-sm-12 panel-footer text-right">
					<a href="{{route('empleados.evaluador.edit', $evaluador->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
					<a href="#"  data-toggle="modal" data-target="#modal-delete-{{$evaluador->id}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>
				</div>
			</div>

			<div id="empleados" class="tab-pane fade">
				<div class="col-lg-12 breadcrumb">
					<a href="{{route('empleados.evaluador.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
				</div>

				<div class="content">
					@include('empleados/evaluador/partials/seleccionar_empleado') 
				</div>
			</div>
		</div>
		<!-- Fin Panel Tab -->

	</div>
	<div class="panel-footer">
	</div>
		
</div>

@endsection


