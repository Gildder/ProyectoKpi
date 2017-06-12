@extends('layouts.app')

@section('titulo')
	Mis Evaluados 
@endsection

@section('content')

    <div class="panel panel-default">
      <div class="panel-heading">
        <p class="titulo-panel">Mis evaluados</p>
      </div>
      <div class="panel-body">

        @include('partials/alert/error')
        {{-- Agregar Graficos --}}
        {{--<div class="text-right col-lg-12 breadcrumb">--}}
          {{--<a  href="#" class="btn btn-success btn-sm" title="Vista Grafica"><span class="fa fa-bar-chart"> <b>Grafica</b> </span><b></b></a>--}}
          {{--<a  href="#" class="btn btn-warning btn-sm" title="Vista Tabla"><span class="fa fa-table">  </span> <b>Tabla</b></a>--}}
        {{--</div>--}}
        <div class="col-lg-12">
          {{--<div id="contenedor">--}}
            {{--<label for="">Grafica</label>--}}
          {{--</div>--}}

          {{--<div id="contenedor">--}}
            {{--<label for="">Tabla</label>--}}
          {{--</div>--}}
          {{-- fin Agragar graficos --}}

          <p>Lista de empleado asignados para su evaluados de Indicadores <span class="fa fa-chart" style="color: black"></span>.</p>
          <hr>
        </div>
        <div class="col-lg-12">
            @include('evaluadores/evaluados/misevaluados/partials/tabla_evaluados')
        </div>

      </div>
      <div class="panel-footer">
      </div>
    </div>
@endsection