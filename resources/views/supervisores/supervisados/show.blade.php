@extends('layouts.app')

@section('titulo')
      Seleccionar
@endsection

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">{{ Cache::get('emp_sado')}}</p>
  </div>

  <div class="panel-body">

    <!--panelTab -->
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#datos">Indicadores</a></li>
    </ul>

    <div class="tab-content">
      <div id="datos" class="tab-pane fade in active">
          <div class="col-lg-12 breadcrumb">
            <a href="{{route('supervisores.supervisados.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
          </div>
        <div class="col-sm-12">
            @if($indicadores->count()<= 0)
              <p>Este empleado, No tiene asignado ningun indicador KPI.</p>
            @endif

            @foreach($indicadores as $indicador)
              @include('supervisores/supervisados/partials/panel_indicador')  <hr>
            @endforeach
        </div>
      
      </div>

    <!-- Fin Panel Tab -->

  </div>

  </div>
    
</div>
@endsection


