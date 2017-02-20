@extends('layouts.app')

@section('titulo')
  Departamentos Eliminados
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Departamentos Eliminados</p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')

    <div class="col-lg-12 breadcrumb">
      <a  href="{{route('localizaciones.departamento.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
    </div>
    <div class="row">
      <div class="col-lg-12">
        @include('localizaciones/departamento/partials/tabla_eliminados')
      </div>
    
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection

