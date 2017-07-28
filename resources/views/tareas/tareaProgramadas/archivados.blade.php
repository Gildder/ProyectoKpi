@extends('layouts.app')

@section('titulo')
  Tareas Archivadas
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-xs pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">Tareas Archivadas</p>
  </div>

  <div class="panel-body">


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="col-sm-12 breadcrumb" >Tareas anteriores a la Semana {{ \Cache::get('semanas')->semana }} del del mes de <b>{{ \Calcana::getNombreMes(\Cache::get('semanas')->mes) }}</b>, del <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}</b> al <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}</b>
          </div><br>
    </div><br><hr>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-responsive">
      @include('tareas/tareaProgramadas/partials/tabla_tareaArchivados')
    </div>
  </div>
  <div class="panel-footer">
  </div>
</div>



@endsection


