@extends('layouts.app')

@section('titulo')
      Supervisiones Empleados
@endsection

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
          <a href="{{route('supervisores.supervisados.index')}}" class="btn btn-primary btn-xs  pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>
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
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Indicador {{ $indicador->id }}: {{ $indicador->nombre}}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"  data-target="#modal-informacion-{{$indicador->id}}"  title="Informacion"><i class="fa fa-info"></i>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
                </div>
              </div>
              <div class="box-body" style="display: block; "><div class="row">
                
              {{-- Inicio de DAtos de los Indicadores --}}
                <?php  
                  $listaTablas = $indicador::getTablaIndicador($empleado->codigo, $indicador->id);  
                  $listaGraficas = $indicador::getGraficoIndicador($empleado->codigo, $indicador->id);

                ?>
              @if($indicador->id == '1')


                {{-- Capa Grafica --}}
                <div class="col-md-6">
                  @include('/partials/indicadores/eficacia_indicador/grafico_EficaciaIndicador')
                </div>

                {{-- Capa Tabla --}}
                <div class="col-md-6">
                  @include('/partials/indicadores/eficacia_indicador/tabla_EficaciaIndicador')
                </div>
              @elseif($indicador->id == '2')
                 {{-- Capa Grafica --}}
                <div class="col-md-6">
                  @include('/partials/indicadores/eficiencia_indicador/grafico_EficienciaIndicador')
                </div>

                {{-- Capa Tabla --}}
                <div class="col-md-6">
                  @include('/partials/indicadores/eficiencia_indicador/tabla_EficienciaIndicador')
                </div>
              @endif

              {{-- Fin Datos de los Indicadores --}}

              </div></div>
            </div> 

            @include('supervisores/supervisados/partials/indicador/informacion')
        @endforeach
    </div>
</div>
@endsection
