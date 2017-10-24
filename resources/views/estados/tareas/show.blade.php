@extends('layouts.app')

@section('titulo')
    @lang('labels.panels.pnsDetalle')
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	 <a href="{{route('estados.tareas.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">@lang('labels.panels.pnsDetalle')</p>
	</div>

	<div class="panel-body">
		<div id="datos" class="tab-pane fade in active">
			<div class="content col-sm-6">
				@include('partials/alert/error')

				@include('estados/tareas/partials/datos_estado')

				@include("estados/tareas/delete")
			</div>
		</div>

	</div>
	<div class="panel-footer text-right">

		<a href="{{route('estados.tareas.edit', $estado->id)}}"
           class="@lang('labels.stylbtns.btnEditar')">
            <span class="@lang('labels.icons.icoBtnEditar')"></span><b> @lang('labels.buttons.btnEditar')</b> </a>

        @if($estado->isDeleted == 1)
		<a href="#"  data-toggle="modal" data-target="#modal-delete-{{$estado->id}}" class="@lang('labels.stylbtns.btnEliminar')"><span class="@lang('labels.icons.icoBtnEliminar')"></span><b> @lang('labels.buttons.btnEliminar')</b> </a>
            @endif
	</div>
		
</div>

@endsection


