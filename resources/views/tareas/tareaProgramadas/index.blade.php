@extends('layouts.app')

@section('titulo')
  Tareas Programadas
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Tareas Programadas</p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')

    {{-- Opciones de Menu --}}
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <a  href="{{route('tareas.tareaProgramadas.create')}}" class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span>   <b>Nuevo</b></a>
        
      </div>
      <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6" tabindex="2" >
        {{-- Finalizado --}}
        <a  href="{{route('tareas.tareaProgramadas.archivados')}}" class="btn btn-success btn-sm" title="Archivados"><span class="fa  fa-archive"></span><b></b></a>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="col-sm-12" ><small>Semana {{ $semanas->get('semana') }} del mes de {{ $semanas->get('mes') }}, del <b>{{$semanas->get('fechaInicio') }}</b> al <b>{{$semanas->get('fechaFin')  }}</b></small>
          </div><br>
          <hr/>

          @include('tareas/tareaProgramadas/partials/tabla_tareaProgramadas')

      </div>
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection

