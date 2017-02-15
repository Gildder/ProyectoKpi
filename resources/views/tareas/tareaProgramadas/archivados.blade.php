@extends('layouts.app')

@section('titulo')
  Tareas Archivadas
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Tareas Archivadas</p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')

     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-sm" ><span class="fa fa-reply"></span></a>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        @include('tareas/tareaProgramadas/partials/tabla_tareaArchivados')
      </div>
    
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection

