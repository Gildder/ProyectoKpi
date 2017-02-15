@extends('layouts.app')

@section('titulo')
  Tareas Eliminadas
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Tareas Eliminadas</p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')

    <div class="col-lg-12 breadcrumb">
      <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
    </div>
    <div class="row">
      <div class="col-lg-12">
        @include('tareas/tareaProgramadas/partials/tabla_tareaEliminadas')
      </div>
    
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection

