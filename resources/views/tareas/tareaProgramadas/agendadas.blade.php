@extends('layouts.app')

@section('titulo')
  Tareas Agendadas
@endsection

@section('content')
	
<div class="panel panel-default" id="tareaNormales">
  <div class="panel-heading">
    <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-xs pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">Tareas Agendadas</p>
  </div>

  <div class="panel-body">
    <div id="submenuagenda"  :style="{ 'display': cmpShowTarea?'none':'block' }" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <a  href="#"  @click="showNuevaTareaAgenda($event)"
            class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span>
          <b>Nuevo</b>
        </a>

      </div>
    </div>

    <div class="col-sm-12" style="margin-bottom: 20px;" >
        <p>
            Tarea Agendadas del
            <b class="fechaTareas">{{ $semanas->fechaInicio }}</b>
            hasta
            <b class="fechaTareas">{{ $semanas->fechaFin }}.</b>

        </p>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      {{-- Nueva Tarea--}}
      <div class="row" :style="{ 'display': cmpShowTarea?'block':'none' }" id="nuevaTareaAgenda">
        @include('tareas/tareaProgramadas/create_next')
      </div>
    </div>

      @include('partials/alert/error')


      <tabla-tarea :tareas="{{ json_encode($tareas) }}"></tabla-tarea>

  </div>
  <div class="panel-footer">
  </div>
</div>



@endsection


