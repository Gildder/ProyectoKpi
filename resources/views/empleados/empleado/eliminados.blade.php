@extends('layouts.app')

@section('titulo')
   Eliminados
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">Empleados Eliminados</p>
  </div>
  <div class="panel-body">

    @include('partials/alert/error')
  

  <div class="col-lg-12 breadcrumb">
    <a  href="{{route('empleados.empleado.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
  </div>


  <div class="row">
    <div class="col-lg-12">
      @include('empleados/empleado/partials/tabla_eliminados')
    </div>
  </div>
    </div>
    <div class="panel-footer">
    </div>
  </div>
@endsection
