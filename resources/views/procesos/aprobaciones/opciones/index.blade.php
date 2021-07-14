@extends('layouts.app')

@section('titulo')
  @lang('labels.titlesPage.ttlAprobacionOpciones')
@endsection

@section('content')

<div class="panel panel-default" id="tareaNormales">
    <div class="panel-heading">
        <p class="titulo-panel">
          @lang('labels.panels.pnsAprobacionOpciones')
        </p>
    </div>

    <div class="panel-body">

        @include('partials/alert/error')

        <input type="text" hidden  value="{{ $evaluador->id }}"  id="evalaudor_aprovador">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb" :style="{ 'display': nuevoAprobacion == false?'inline-block':'none' }">
            <a href="#" class="@lang('labels.stylbtns.btnNuevo')" @click="mostrarNuevaAprobacion($event)" >
                <i class="@lang('labels.icons.icoBtnNuevo')"></i>
                @lang('labels.buttons.btnNuevo')
            </a>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" :style="{ 'display': nuevoAprobacion == true?'inline-block':'none' }">
            @include('procesos/aprobaciones/opciones/create')
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('procesos/aprobaciones/opciones/partials/tabla_opciones')
        </div>
    </div>
    <div class="panel-footer">
    </div>
</div>


@endsection

