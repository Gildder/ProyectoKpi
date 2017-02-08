@extends('layouts.app')


@section('titulo')
  Tareas Diarias
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Tareas Diarias</p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')

    <div class="text-left col-lg-12 breadcrumb">
      <a  href="#"  data-toggle="modal" data-target="#modal-nuevo" class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span>   <b>Nuevo</b></a>
    </div>
    <div class="row">
      <div class="col-lg-12">
        @include('tareas/tareaDiaria/partials/tabla_tareaDiarias')
      </div>
    </div>
            @include("tareas/tareaDiaria/nuevo")
    
  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection