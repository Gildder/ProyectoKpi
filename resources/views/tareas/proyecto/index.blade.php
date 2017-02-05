@extends('layouts.app')


@section('titulo')
  Proyectos
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Proyectos</p>

  </div>
  <div class="panel-body">

    @include('partials/alert/error')

    <div class="text-left col-lg-12 breadcrumb">
      <a  href="{{route('tareas.proyecto.create')}}" class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span><b>Nuevo</b></a>
    </div>
    <div class="row">
      <div class="col-lg-12">
        @include('tareas/proyecto/partials/tabla_proyecto')
      </div>
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection