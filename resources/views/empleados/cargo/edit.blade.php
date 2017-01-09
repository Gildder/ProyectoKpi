@extends('layouts.app')

@section('content')

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Cargo</a></li>
  <li><a data-toggle="tab" href="#menu1">Indicadores</a></li>
  <li><a data-toggle="tab" href="#menu2">Empleados</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    @include('empleados/cargo/editar')
  </div>


  <div id="menu1" class="tab-pane fade">
    <!-- Lista de Indicadores-->
    <div class="panel panel-default">
      <div class="panel-heading">
          <a  href="{{route('empleados.cargo.index')}}" class="btn btn-default"><span class="fa fa-reply"></span></a>
          <h3 class="box-title">Lista de Indicadores</h3>
      </div>

      <div class="panel-body">
        @include('empleados/cargo/tabla_indicador')
      </div>

      <div class="panel-footer">
        <div class="text-right">
          <a  href="{{route('empleados.cargo.indicadores', $cargo->id)}}" class="btn btn-success">Agregar</a>
        </div>
      </div>
    </div>
    <!-- Fin de Indicadores-->
  </div>

  <div id="menu2" class="tab-pane fade">
    <!-- Lista de empleados-->
    <div class="panel panel-default">
      <div class="panel-heading">
          <a  href="{{route('empleados.cargo.index')}}" class="btn btn-default"><span class="fa fa-reply"></span></a>
          <h3 class="box-title">Lista de Empleados</h3>
      </div>
      <div class="panel-body">
        @include('empleados/cargo/tabla_empleado')
      </div>
    </div>


    <!-- Fin de Empleados-->
  </div>
  <!-- Content -->
</div>
@endsection