@extends('layouts.app')

@section('titulo')
  @lang('labels.titlesPage.ttlAprobaciones')
@endsection

@section('content')

<div class="panel panel-default" id="tareaNormales">
  <div class="panel-heading">
    <p class="titulo-panel">
      @lang('labels.panels.pnsAprobaciones')
    </p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')

    {{-- Opciones de Menu --}}
    <div id="submenu"  :style="{ 'display': cmpShowTarea?'none':'block' }" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
       
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        @include('procesos/aprobaciones/partials/tabla_aprobacion')
    </div>
  </div>
  <div class="panel-footer">
  </div>
</div>


@endsection

