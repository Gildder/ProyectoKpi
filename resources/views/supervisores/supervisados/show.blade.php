@extends('layouts.app')

@section('titulo')
      Supervisiones Empleados
@endsection

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
    <a href="{{route('supervisores.supervisados.index')}}" @click="mostrarModalLoading()" class="btn btn-primary btn-sm  pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">{!! $usuario->id !!} - {!! $usuario->nombres !!} {!! $usuario->apellidos !!}</p>

  </div>

  <div id="emplados-supervisados"  class="panel-body">
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
                <button type="button" class="btn btn-primary btn-xs" data-toggle="popover"  data-content="{{$indicador->descripcion}}" title="Informacion" data-placement="auto" animation="true">
                    <i class="fa fa-info"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
                </div>
              </div>
              <div class="box-body" style="display: block; "><div class="row">
                
              {{-- Inicio de Datos de los Indicadores --}}
              <?php
                      $listaTablas   = $indicador::getTablaIndicador($usuario->id, $indicador->id);
                      $listaGraficas = $indicador::getGraficoIndicador($usuario->id, $indicador->id);
                      dd($listaTablas, $listaGraficas)
              ?>


              @if($indicador->id == '1')
                 {{--Capa Tabla --}}
                <div class="col-xs-12 col-md-6 col-md-6 col-lg-6">
                    @include('/partials/indicadores/eficacia_indicador/tabla_EficaciaIndicador')
                </div>
                {{--Capa Grafica--}}
                <div class="col-xs-12 col-md-6 col-md-6 col-lg-6">
                  @include('/partials/indicadores/eficacia_indicador/grafico_EficaciaIndicador')
                </div>
              @elseif($indicador->id == '2')
                 {{--Capa Tabla --}}
                <div class="col-xs-12 col-md-6 col-md-6 col-lg-6">
                  @include('/partials/indicadores/eficiencia_indicador/tabla_EficienciaIndicador')
                </div>

                 {{--Capa Grafica --}}
                 <div class="col-xs-12 col-md-6 col-md-6 col-lg-6">
                  @include('/partials/indicadores/eficiencia_indicador/grafico_EficienciaIndicador')
                 </div>
              @endif
               {{--Fin Datos de los Indicadores --}}
              </div></div>
            </div> 

        @endforeach
    </div>
</div>


@endsection

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
});

</script>
