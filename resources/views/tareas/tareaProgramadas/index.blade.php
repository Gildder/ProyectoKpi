@extends('layouts.app')

@section('titulo')
  Tareas Programadas
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Tareas Programadas</p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')

    {{-- Opciones de Menu --}}
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <a  href="{{route('tareas.tareaProgramadas.create')}}" @click="mostrarModalLoading()"  class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span>   <b>Nuevo</b></a>
        
      </div>
      <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6" >
        {{-- Finalizado --}}
        <a  href="{{route('tareas.tareaProgramadas.archivados')}}" @click="mostrarModalLoading()"   class="btn btn-success btn-sm" title="Archivados"><span class="fa  fa-archive"></span>  <b class="hidden-xs"> Archivados</b></a>
        <a  href="{{route('tareas.tareaProgramadas.create_next')}}" @click="mostrarModalLoading()"   class="btn btn-info btn-sm" title="Siguiente Semana"><span class="fa  fa-arrow-right"></span>   <b class="hidden-xs">Prox. Semana</b></a>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="col-sm-12" >Tareas Programadas para la Semana {{ $semanas->semana }} del mes de <b>{{ \Calcana::getNombreMes($semanas->mes) }}</b>, del <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo($semanas->fechaInicio) }}</b> al <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo($semanas->fechaFin) }}</b>
          </div><br>
          <hr/>
          <div class="table-responsive" style="padding: 8px 5px 8px 5px;">
            @include('tareas/tareaProgramadas/partials/tabla_tareaProgramadas')
          </div>
      </div>
    </div>
  </div>
  <div class="panel-footer">
  </div>

</div>
@endsection

