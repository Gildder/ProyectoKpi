@extends('layouts.app')

@section('titulo')
  Tareas Programadas
@endsection

@section('content')


<script>
$(document).ready(function () {
    sessionStorage.setItem('inicioSemana', convertDateFormatDB('{!! $semanas->fechaInicio !!}'));
    sessionStorage.setItem('finSemana', convertDateFormatDB('{!! $semanas->fechaFin !!}'));

    sessionStorage.setItem('tipoListado', {{ $agenda }});
    sessionStorage.setItem('inicioSemanaFija', '{!! $semanas->fechaInicio !!}');
    sessionStorage.setItem('finSemanaFija', '{!! $semanas->fechaFin !!}');
    sessionStorage.setItem('calendario', 0);

});
</script>


<div class="panel panel-default" id="tareaNormales">
  <div class="panel-heading">
    <p class="titulo-panel">Tareas</p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')

    {{-- Opciones de Menu --}}
    <div id="submenu"  :style="{ 'display': cmpShowTarea?'none':'block' }" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <a  href="#" @click="mostrarNuevaTarea($event)"
                class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span>
                <b>Nuevo</b>
            </a>

            {{-- Modal para Nueva Tarea--}}
            @include('tareas/tareaProgramadas/modal/create')
        </div>

        <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6" >
            {{-- btn tareas archivadas  --}}
            <a  href="{{route('tareas.tareaProgramadas.archivadas')}}"
                @click="mostrarModalLoading()"   class="btn btn-bitbucket btn-sm"
                title="Tareas Archivadas"><span class="fa  fa-archive"></span>
                <b class="hidden-xs"> Archivadas</b>
            </a>

            {{-- btn agendas --}}
            <a  href="{{route('tareas.tareaProgramadas.agendadas')}}"
                @click="mostrarModalLoading()"   class="btn btn-yahoo btn-sm"
                title="Tareas Agendadas"><span class="fa fa-clipboard" aria-hidden="true"></span>
                <b class="hidden-xs">Agenda</b>
            </a>
        </div>
    </div>


    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="col-sm-12">Tareas Programadas para la Semana {{ $semanas->semana }} del mes de <b>{{ $semanas->mes }}</b>, del <b class="fechaTareas">{{ $semanas->fechaInicio }}</b> al <b class="fechaTareas">{{ $semanas->fechaFin }}</b>
          </div>
            @verbatim
              <tabla-tarea :url="/tareas/tareaProgramadas/tareaSemanaJson"></tabla-tarea>
                @endverbatim
      </div>
    </div>
  </div>
  <div class="panel-footer">
  </div>
</div>


@endsection

