@extends('layouts.app')

@section('titulo')
  Tareas Proramadas
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Tareas Programadas</p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')

    <div class="text-left col-lg-12 breadcrumb">
      <a  href="#" data-target="#modal-nuevo" data-toggle="modal" onclick="refresCampos();" class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span>   <b>Nuevo</b></a>
    </div>
    <div class="row">
      <div class="col-lg-12">
        @include('tareas/tareaProgramadas/partials/tabla_tareaProgramadas')
        @include('tareas/tareaProgramadas/create')
      </div>
    
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection

