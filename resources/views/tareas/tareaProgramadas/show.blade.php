@extends('layouts.app')

@section('titulo')
	@lang('labels.panels.pnsDetalle') Tarea
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
		<a
            href="{{route(\Calcana::getHrefShow())}}"
            @click="mostrarModalLoading()"  class="btn btn-primary btn-xs pull-left btn-back"  title="Volver">
            <span class="fa fa-reply"></span></a>

	  <p class="titulo-panel">Detalle </p>
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
        {{-- Tareas archivadas == 1 --}}
		@if(\Cache::get('tipoAgenda') != 1)
            {{-- Tareas finalizadas Y tareas difernentes a archivas --}}
            @if($tarea->estado_id != 3 && \Cache::get('tipoAgenda') != 1)

                @if(\Cache::get('tipoAgenda') == 0)
                <a  href="{{route('tareas.tareaProgramadas.resolver', $tarea->id)}}"
                    class="@lang('labels.stylbtns.btnFinalizar')" @click="mostrarModalLoading()"
                    style="margin-right: 10px;">
                    <span class="@lang('labels.icons.icoBtnFinalizar')" ></span><b> @lang('labels.buttons.btnFinalizar')</b> </a>
                @endif

                <a   href="{{route('tareas.tareaProgramadas.edit', $tarea->id)}}"
                     @click="mostrarModalLoading()"
                     class="@lang('labels.stylbtns.btnEditar')">
                    <span class="@lang('labels.icons.icoBtnEditar')"></span><b> Editar</b> </a>

                @if($tarea->can_delete == 1 || \Cache::get('tipoAgenda') == 2)
                <a href="#" style="margin-left: 10px; float:left;" data-toggle="modal"
                   data-target="#modal-delete-{{$tarea->id}}"
                   class="@lang('labels.stylbtns.btnEliminar')">
                    <span class="@lang('labels.icons.icoBtnEliminar')"></span><b> @lang('labels.buttons.btnEliminar')</b> </a>
                @endif
            @else
                <a href="#"  data-toggle="modal" data-target="#modal-cancelar-{{$tarea->id}}"
                   title="Reabrir"
                   class="@lang('labels.stylbtns.btnReabrir')">
                    <span class="@lang('labels.icons.icoBtnReabrir')"></span>
                    <b> @lang('labels.buttons.btnAbrir')</b>
                </a>
            @endif
        @else
            @if($tarea->estado_id != 3)
                <a  href="{{route('tareas.tareaProgramadas.resolver', $tarea->id)}}"
                    class="@lang('labels.stylbtns.btnFinalizarArchivo')" @click="mostrarModalLoading()"
                    style="margin-right: 10px;"
                ><span class="@lang('labels.icons.icoBtnPermiso')" aria-hidden="true"></span><b>   @lang('labels.buttons.btnFinalizarArchivo')</b> </a>
            @endif
		@endif
	</div>
	<estado-tarea modelo="{{ \Cache::get('botones') }}"></estado-tarea>


</div>

@endsection


