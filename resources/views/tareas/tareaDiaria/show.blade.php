@extends('layouts.app')

@section('titulo')
	{{$tarea->id}} - {{$tarea->descripcion}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel">{{$tarea->id}} - {{$tarea->descripcion}}</p>
	</div>

	<div class="panel-body">

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="{{route('tareas.tareaDiaria.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
				</div>
					<div class="content col-sm-6">

      					{{-- @include('partials/alert/error') --}}

						@include('tareas/tareaDiaria/partials/datos_tarea')	

						@include("tareas/tareaDiaria/editar")

						@include("tareas/tareaDiaria/delete")

						{{-- @include("tareas/tareaDiaria/partials/datos_solucion") --}}
					</div>
					<div class="col-sm-12 panel-footer text-right">
		
						{{-- <a href="{{route('tareas.tareaDiaria.edit', $tarea->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-ok text-left"></span><b> Solucion</b> </a> --}}
						<a href="{{route('tareas.tareaDiaria.resolver', $tarea->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-ok text-left"></span><b> Resolver</b> </a>
						<a  href="#"  data-toggle="modal" data-target="#modal-editar" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
						<a href="#"  data-toggle="modal" data-target="#modal-delete-{{$tarea->id}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>

					</div>
			</div>
			<!-- Fin Panel Tab -->
		</div>

	</div>
	<div class="panel-footer">
	</div>
		
</div>

@endsection


