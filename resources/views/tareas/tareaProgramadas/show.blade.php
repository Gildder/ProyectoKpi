@extends('layouts.app')

@section('titulo')
	Tarea Nro. {{$tarea->numero}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
		<a
            @if( \Cache::get('botones') == 0) href="{{route('tareas.tareaProgramadas.index')}}" @else href="{{route('tareas.tareaProgramadas.archivadas')}}"  @endif
            @click="mostrarModalLoading()"  class="btn btn-primary btn-xs pull-left btn-back"  title="Volver">
            <span class="fa fa-reply"></span></a>

	  <p class="titulo-panel">Detalle - Tarea Nro. {{$tarea->numero}}</p>
	</div>

	<div class="panel-body">

        @include('partials/alert/error')

        <div class="content col-sm-6">

            @include('tareas/tareaProgramadas/partials/datos_tarea')
            @include("tareas/tareaProgramadas/delete")
            @include("tareas/tareaProgramadas/cancelar")
        </div>
	</div>
	<div class="panel-footer text-right">
		@if($tarea->estado_id != 3)
			<a  href="{{route('tareas.tareaProgramadas.resolver', $tarea->id)}}"
				class="btn btn-success btn-sm" @click="mostrarModalLoading()"
				style="margin-right: 10px;"
			><span class="fa fa-thumbs-up text-left" ></span><b> Finalizar</b> </a>

			<a   href="{{route('tareas.tareaProgramadas.edit', $tarea->id)}}"
				 @click="mostrarModalLoading()"
				 class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>

            @if($tarea->can_delete == 1)
			<a href="#" style="margin-left: 10px; float:left;" data-toggle="modal"
			   data-target="#modal-delete-{{$tarea->id}}"
			   class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>
            @endif
		@else
			<a href="#"  data-toggle="modal" data-target="#modal-cancelar-{{$tarea->id}}"
               title="Reabrir"  v-if="{{ \Cache::get('botones') }} == 0"
               class="btn btn-danger btn-sm">
                <span class="fa fa-open"></span>
                <b> Reabrir</b>
            </a>
		@endif
	</div>
	<estado-tarea modelo="{{ \Cache::get('botones') }}"></estado-tarea>


</div>

@endsection


