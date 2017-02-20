@extends('layouts.app')

@section('titulo')
      {{$indicador->nombre}}
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
    </ul>

    <div class="tab-content">
      {{-- Datos del Indiador --}}
      <div id="datos" class="tab-pane fade in active">
          <div class="col-lg-12 breadcrumb">
            <a href="{{route('indicadores.indicador.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
          </div>
        <div class="col-sm-12">

          <div class="content col-lg-6">
            @include('indicadores/indicador/partials/ver_indicador')  
            @include('indicadores/indicador/delete')

          </div>
        </div>
      
        <div class="col-sm-12 panel-footer text-right">
          <a href="{{route('indicadores.indicador.edit', $indicador->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
          <a href="#" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-{{$indicador->id}}"><span class="fa fa-trash"  title="Eliminar"></span><b > Borrar</b></a>
        </div>
      </div>
    <!-- Fin Indicador -->

    </div>

  </div>
</div>
@endsection


