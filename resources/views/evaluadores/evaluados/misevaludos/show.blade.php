@extends('layouts.app')

@section('titulo')
      Indcadores de {!! $empleado->codigo !!} - {!! $empleado->nombres !!}
@endsection

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <a href="{{route('supervisores.supervisados.misevaluados.index')}}" class="btn btn-primary btn-xs  pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">{!! $empleado->codigo !!} - {!! $empleado->nombres !!} {!! $empleado->apellidos !!}</p>
  </div>

  <div class="panel-body">
        @if($indicadores->count()<= 0)
          <p>Este empleado, No tiene asignado ningun indicador KPI.</p>
        @endif

        <p>Lista de Indicadores asignados al empleado Actual.</p>
        <?php $contador = 1; ?>
  </div>
            
    <div class="row col-md-12"  style="margin-right: 0px; padding-right: 0px; padding-left: 0px; margin-left: 0px; margin-top: 15px;">
        @foreach($indicadores as $indicador)
          
        @endforeach
    </div>
</div>
@endsection
