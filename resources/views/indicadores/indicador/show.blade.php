@extends('layouts.app')

@section('titulo')
      Editar Departamento
@endsection

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">{{$indicador->nombre}}</p>
  </div>

  <div class="panel-body">
   

    <!--panelTab -->
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
      <li><a data-toggle="tab" href="#cargo">Lista de Cargos</a></li>
    </ul>

    <div class="tab-content">
      <div id="datos" class="tab-pane fade in active">
          <div class="col-lg-12 breadcrumb">
            <a href="{{route('indicadores.indicador.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
          </div>
        <div class="col-sm-12">

          <div class="content col-lg-6">

            @include('indicadores/indicador/partials/ver_indicador')  

          </div>
        </div>
      
      </div>


      <div id="cargo" class="tab-pane fade">
          <div class="col-lg-12 breadcrumb">
            <a href="{{route('indicadores.indicador.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
            <a href="#"  data-toggle="modal" data-target="#modal-agregar"  class="btn btn-success btn-xs"><span class="fa fa-plus"></span> Agregar</a>
          </div>
        <div class="content">
          @include('indicadores/indicador/partials/tabla_cargos')
          @include('indicadores/indicador/agregar_cargo')

        </div>
      </div>
    <!-- Fin Panel Tab -->

  </div>

  </div>
    
</div>
@endsection

@section('script')
  
@endsection

