@extends('layouts.app')

@section('titulo')
	{{$tarea->id}} - {{$tarea->descripcion}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
		<a href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-xs pull-left btn-back"  title="Volver"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">{{$tarea->id}} - {{$tarea->descripcion}}</p>
	</div>

	<div class="panel-body">

    @include('partials/alert/error')
		
			<div class="content col-sm-6">

					{{-- @include('partials/alert/error') --}}

				@include('tareas/tareaProgramadas/partials/datos_tarea')	

				@include("tareas/tareaProgramadas/delete")

				{{-- @include("tareas/tareaProgramadas/partials/datos_solucion") --}}
			</div>
	</div>
	<div class="col-sm-12 panel-footer text-right">

		{{-- <a href="{{route('tareas.tareaProgramadas.edit', $tarea->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-ok text-left"></span><b> Solucion</b> </a> --}}
		<a href="{{route('tareas.tareaProgramadas.resolver', $tarea->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-thumbs-up text-left"></span><b> Resolver</b> </a>
		<a href="{{route('tareas.tareaProgramadas.edit', $tarea->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
		<a href="#"  data-toggle="modal" data-target="#modal-delete-{{$tarea->id}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>

	</div>
	
		
</div>

@endsection


