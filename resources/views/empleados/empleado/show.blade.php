@extends('layouts.app')

@section('titulo')
	Empleado
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
    <a  href="{{route('empleados.empleado.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
		
	  <p class="titulo-panel">{{$empleado->id}} - {{$empleado->usuario}}</p>
	</div>

	<div class="panel-body">
		

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="col-sm-6">
					<div class="content">
						@include('empleados/empleado/ver')

						@include("empleados/empleado/delete")

					</div>
				</div>
				<div class="col-sm-12 panel-footer text-right">
					<a href="{{route('empleados.empleado.edit', $empleado->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-delete-{{$empleado->id}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>
				</div>
			</div>


		
		<!-- Fin Panel Tab -->

		</div>

	</div>
		
</div>

@endsection


