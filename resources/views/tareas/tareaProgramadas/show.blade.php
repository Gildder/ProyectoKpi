@extends('layouts.app')

@section('titulo')
	Tarea Nro. {{$tarea->numero}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
		<a href="{{route('tareas.tareaProgramadas.index')}}" v-if="{{ \Cache::get('botones') }} == 0" @click="mostrarModalLoading()"  class="btn btn-primary btn-xs pull-left btn-back"  title="Volver"><span class="fa fa-reply"></span></a>
		<a href="{{route('tareas.tareaProgramadas.archivados')}}" v-if="{{ \Cache::get('botones') }} == 1" @click="mostrarModalLoading()"  class="btn btn-primary btn-xs pull-left btn-back"  title="Volver"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">Detalle - Tarea Nro. {{$tarea->numero}}</p>
	</div>

	<div class="panel-body">

    @include('partials/alert/error')
		
			<div class="content col-sm-6">

				@include('tareas/tareaProgramadas/partials/datos_tarea')

				@include("tareas/tareaProgramadas/delete")
				@include("tareas/tareaProgramadas/cancelar")

				{{-- @include("tareas/tareaProgramadas/partials/datos_solucion") --}}
			</div>
	</div>
	<div class="panel-footer text-right">
		@if($tarea->estadoTarea_id != 3)
			{{-- <a href="{{route('tareas.tareaProgramadas.edit', $tarea->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-ok text-left"></span><b> Solucion</b> </a> --}}
			<a  href="{{route('tareas.tareaProgramadas.resolver', $tarea->id)}}"
				class="btn btn-success btn-sm" @click="mostrarModalLoading()"
				v-if="btnResultado === 1"
				style="margin-right: 10px;"
			><span class="fa fa-thumbs-up text-left" ></span><b> Finalizar</b> </a>

			<a   href="{{route('tareas.tareaProgramadas.edit', $tarea->id)}}"
				 v-if="btnEditar === 1" @click="mostrarModalLoading()"
				 class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>

			<a href="#" v-if="btnEliminar === 1"  data-toggle="modal"
			   data-target="#modal-delete-{{$tarea->id}}" @click="mostrarModalLoading()"
			   class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>

		@else
			<a href="#"  data-toggle="modal" v-if="{{ \Cache::get('botones') }} == 0" @click="mostrarModalLoading()"  data-target="#modal-cancelar-{{$tarea->id}}" title="Cancelar Solucion"
			class="btn btn-danger btn-sm"><span class="fa fa-times"></span><b>  Cancelar Solución</b> </a>
		@endif
	</div>
	<estado-tarea modelo="{{ \Cache::get('botones') }}"></estado-tarea>


</div>

@endsection


