@extends('layouts.app')

@section('titulo')
      Supervisiones Empleados
@endsection

@section('content')

<script>
$(document).ready(function () {
    $(".1").addClass("badge bg-light-blue");
    $(".2").addClass("badge bg-red");
    $(".3").addClass("badge bg-yellow");
    $(".4").addClass("badge bg-green");

    // Meses
    $(".m-1").html("Enero");
    $(".m-2").html("Febrero");
    $(".m-3").html("Marzo");
    $(".m-4").html("Abril");
    $(".m-5").html("Mayo");
    $(".m-6").html("Junio");
    $(".m-7").html("Julio");
    $(".m-8").html("Agosto");
    $(".m-9").html("Septiembre");
    $(".m-10").html("Octubre");
    $(".m-11").html("Noviembre");
    $(".m-12").html("Diciembre");

    $('[data-toggle="popover"]').popover();
});

</script>


<div class="panel panel-default">
  <div class="panel-heading">
    <a href="{{ route('evaluadores.evaluados.empleadosEvaluados', [$item->id, $evaluador->id ]) }}" class="btn btn-primary btn-xs  pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">{!! $empleado->codigo !!} - {!! $empleado->nombres !!} {!! $empleado->apellidos !!}</p>
  </div>

  <div class="panel-body">
    @if($indicadores->count()<= 0)
      <p>Este empleado, No tiene asignado ningun indicador KPI.</p>

    @else

    <p>Lista de Indicadores asignados al empleado Actual.</p>
    @endif
    <?php $contador = 1; ?>
  </div>
            
    <div class="row col-md-12"  style="margin-right: 0px; padding-right: 0px; padding-left: 0px; margin-left: 0px; margin-top: 15px;">
        @foreach($indicadores as $indicador)
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Indicador {{ $indicador->id }}: {{ $indicador->nombre}}</h3>
                <div class="box-tools pull-right">
    <button type="button" class="btn btn-primary btn-xs" data-toggle="popover"  data-content="{{$indicador->descripcion}}" title="Informacion" data-placement="auto" animation="true"><i class="fa fa-info"></i></button>
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body" style="display: block; "><div class="row">
                
              {{-- Inicio de DAtos de los Indicadores --}}
              <?php 
                $listaTablas = $indicador::getTablaIndicador($empleado->codigo, $indicador->id);
                $listaGraficas = $indicador::getGraficoIndicador($empleado->codigo, $indicador->id);
              ?>

              {{-- Capa Grafica --}}
              <div class="col-md-6">
                @include('/partials/indicadores/eficacia_indicador/grafico_EficaciaIndicador')
              </div>

              {{-- Capa Tabla --}}
              <div class="col-md-6">
                @include('/partials/indicadores/eficacia_indicador/tabla_EficaciaIndicador')
              </div>
          

              {{-- Fin Datos de los Indicadores --}}

              </div></div>
            </div> 

        @endforeach
    </div>
</div>


@endsection

