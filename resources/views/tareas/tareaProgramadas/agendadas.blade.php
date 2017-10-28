@extends('layouts.app')

@section('titulo')
  Tareas Agendadas
@endsection

@section('content')


<script>
    $(document).ready(function () {
        sessionStorage.setItem('tipoListado', {{ $agenda }});
        sessionStorage.setItem('inicioSemanaFija', '{!! $semanas->fechaInicio !!}');
        sessionStorage.setItem('finSemanaFija', '{!! $semanas->fechaFin !!}');
    });
</script>

<div class="panel panel-default" id="tareaNormales">
  <div class="panel-heading">
    <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-xs pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">Agenda Tarea</p>
  </div>

  <div class="panel-body">
    <div id="submenuagenda"  :style="{ 'display': cmpShowTarea?'none':'block' }" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <a  href="#"  @click="mostrarNuevaTarea($event)"
            class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span>
          <b>Nuevo</b>
        </a>

          {{-- Modal para Nueva Tarea --}}
          @include('tareas/tareaProgramadas/modal/create_agenda')
      </div>
    </div>

    <div class="col-sm-12" >
        <p>
            Tarea programadas de la siguiente semana en adelante.
        </p>
    </div>

      @include('partials/alert/error')

      <tabla-tarea url="/tareas/tareaProgramadas/getAgendadasJson" ></tabla-tarea>

  </div>
  <div class="panel-footer">
  </div>
</div>

@endsection


