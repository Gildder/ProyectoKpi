@extends('layouts.app')

@section('titulo')
  Tareas Programadas
@endsection

@section('content')

<div class="panel panel-default" id="tareaNormales">
  <div class="panel-heading">
    <p class="titulo-panel">Tareas</p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')

    {{-- Opciones de Menu --}}
    <div id="submenu"  :style="{ 'display': cmpShowTarea?'none':'block' }" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <a  href="#"  @click="showNuevaTarea($event)"
            class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span>
            <b>Nuevo</b>
        </a>

      </div>
      <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6" >
        {{-- Finalizado --}}
        <a  href="{{route('tareas.tareaProgramadas.archivadas')}}"
            @click="mostrarModalLoading()"   class="btn btn-bitbucket btn-sm"
            title="Tareas Archivadas"><span class="fa  fa-archive"></span>
            <b class="hidden-xs"> Archivadas</b>
        </a>

        <a  href="{{route('tareas.tareaProgramadas.agendadas')}}"
            @click="mostrarModalLoading()"   class="btn btn-yahoo btn-sm"
            title="Tareas Agendadas"><span class="fa fa-clipboard" aria-hidden="true"></span>
            <b class="hidden-xs">Agendadas</b>
        </a>
      </div>
    </div>


    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="col-sm-12">Tareas Programadas para la Semana {{ $semanas->semana }} del mes de <b>{{ $semanas->mes }}</b>, del <b class="fechaTareas">{{ $semanas->fechaInicio }}</b> al <b class="fechaTareas">{{ $semanas->fechaFin }}</b>
          </div>
          <hr>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              {{-- Nueva Tarea--}}
              <div class="row" :style="{ 'display': cmpShowTarea?'block':'none' }" id="nuevaTarea">
                  @include('tareas/tareaProgramadas/create')
              </div>

              {{-- Editar tarea --}}
              <div class="row" id="editarTarea" v-show="editarTarea">
{{--                  @include('tareas/tareaProgramadas/edit')--}}
              </div>
          </div>
          <hr>
          <div class="table-responsive" style="padding: 8px 5px 8px 5px;">
{{--            @include('tareas/tareaProgramadas/partials/tabla_tareaProgramadas')--}}
              <tabla-tarea :tareas="{{ json_encode($tareas) }}"></tabla-tarea>

          </div>
      </div>
    </div>
  </div>
  <div class="panel-footer">
  </div>

</div>

@endsection

