@extends('layouts.app')

@section('titulo')
  Tareas Archivadas
@endsection

@section('content')
	
<div class="panel panel-default" id="tareaNormales">
  <div class="panel-heading">
    <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-xs pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">Tareas Archivadas</p>
  </div>
    @include('partials/alert/error')

  <div class="panel-body">

    <tabla-tarea :tareas="{{ json_encode($tareas) }}"></tabla-tarea>

  </div>
  <div class="panel-footer">
  </div>
</div>



@endsection


