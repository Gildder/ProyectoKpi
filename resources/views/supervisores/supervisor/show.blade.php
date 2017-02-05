@extends('layouts.app')

@section('titulo')
      Seleccionar
@endsection

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">{{$departamento->nombre}}</p>
  </div>

  <div class="panel-body">

    <!--panelTab -->
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
    </ul>

    <div class="tab-content">
      <div id="datos" class="tab-pane fade in active">
          <div class="col-lg-12 breadcrumb">
            <a href="{{route('supervisores.supervisor.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
          </div>
        <div class="col-sm-12">

          <div class="content col-sm-12">

            @include('supervisores/supervisor/partials/seleccionar_empleado')  

          </div>
        </div>
      
      </div>

    <!-- Fin Panel Tab -->

  </div>

  </div>
    
</div>
@endsection


