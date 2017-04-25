@extends('layouts.app')

@section('titulo')
      Agregar Errores
@endsection

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
     <a  href="{{route('supervisores.supervisados.show', $empleado_id )}}" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">Tareas Realizadas</p>
  </div>
  <div class="panel-body">
        
        <div class="col-sm-12">
      @include('partials/alert/error')
          <p>Haga clic en el boton <i><b>"Agregar Tarea"</b></i> <label class="badge bg-green"><span class=" fa  fa-save"></span></label> de la tabla para aumentar el Numero de Errores del Indicador de Eficiencia.</p>
        </div>
        
        @include('supervisores/numeroErrores/partials/tabla_tareasFinalizadas')
  </div>
  <div class="panel-footer text-right">
  </div>
</div>


@endsection