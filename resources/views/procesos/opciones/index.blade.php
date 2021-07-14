@extends('layouts.app')

@section('titulo')
  @lang('labels.titlesPage.ttlOpicioens')
@endsection

@section('content')

<div class="panel panel-default" id="tareaNormales">
  <div class="panel-heading">
    <p class="titulo-panel">
      @lang('labels.panels.pnsOpciones')
    </p>
  </div>

  <div class="panel-body">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        @include('procesos/opciones/partials/tabla_opciones')
    </div>
  </div>
  <div class="panel-footer">
  </div>
</div>


@endsection

