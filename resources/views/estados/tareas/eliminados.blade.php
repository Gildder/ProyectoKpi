@extends('layouts.app')

@section('titulo')
   @lang('labels.panels.pnsReciclados')
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">@lang('labels.panels.pnsReciclados')</p>
  </div>
  <div class="panel-body">

    @include('partials/alert/error')
  

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
    <a  href="{{route('estados.tareas.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>


  <div class="row">
    <div class="col-lg-12">
      @include('estados/tareas/partials/tabla_eliminados')
    </div>
  </div>
    </div>
    <div class="panel-footer">
    </div>
  </div>
@endsection
