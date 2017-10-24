@extends('layouts.app')


@section('titulo')
  @lang('labels.titlesPage.ttlEstadoTarea')
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">@lang('labels.panels.pnsEstadoTarea')</p>
  </div>
  <div class="panel-body">

    @include('partials/alert/error')

    {{-- Opciones de Menu --}}
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <a  href="{{route('estados.tareas.create')}}" class="@lang('labels.stylbtns.btnNuevo')" title="Nuevo"><span class="@lang('labels.icons.icoBtnNuevo')">  </span>   <b>@lang('labels.buttons.btnNuevo')</b></a>
      </div>
      <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6" tabindex="2" >

        <a  href="{{route('estados.tareas.eliminados')}}"
            class="@lang('labels.stylbtns.btnEliminar')"
            title="Reciclados"><span class="@lang('labels.icons.icoBtnEliminar')"></span>  <b>@lang('labels.buttons.btnReciclados')</b></a>
      </div>
    </div>
    {{-- Fin Opciones Menu --}}
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        @include('estados/tareas/partials/tabla_estado')
      </div>
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection
