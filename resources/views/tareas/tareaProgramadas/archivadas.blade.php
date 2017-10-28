@extends('layouts.app')

@section('titulo')
  @lang('labels.titlesPage.ttlTareasArchivadas')
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
    <p class="titulo-panel">@lang('labels.panels.pnsTareaArchivadas')</p>
  </div>
    @include('partials/alert/error')

    <div class="panel-body">
        @include('tareas.tareaProgramadas.busquedas.buscar_atributos')

        <tabla-tarea url="/tareas/tareaProgramadas/tareaArchivadasJson"></tabla-tarea>

    </div>
  <div class="panel-footer">
  </div>
</div>



@endsection


