@extends('layouts.app')

@section('titulo')
  Localizaciones Eliminadas
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Localizaciones Eliminadas</p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')

    <div class="col-lg-12 breadcrumb">
      <a  href="{{route('localizaciones.localizacion.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
    </div>
    <div class="row">
      <div class="col-lg-12">
        @include('localizaciones/localizacion/partials/tabla_eliminados')
      </div>
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection

