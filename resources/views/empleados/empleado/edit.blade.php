@extends('layouts.app')

@section('titulo')
	Nuevo Empleado
@endsection

@section('content')

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
      <strong>{{ $empleado->codigo}} - {{ $empleado->nombres}}</strong>
  </div>
  <div class="panel-body">


	<div class="col-lg-12 breadcrumb">
		<a  href="{{route('empleados.empleado.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
	</div>
      
      @include('partials/alert/error')

      {!!Form::model($empleado, ['route'=>['empleados.empleado.update', $empleado->codigo], 'method'=>'PUT'])!!}

      @include('empleados/empleado/partials/actualizar_atributos')
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('empleados.empleado.index')}}" class="btn btn-danger" type="reset">Cancelar</a>
      {!! form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success' ]) !!}
  </div>
      {!! Form::close()!!}
</div>

<!-- Fin Nuevo -->

@endsection