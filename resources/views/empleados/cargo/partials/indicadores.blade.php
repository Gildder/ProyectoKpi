@extends('layouts.app')

@section('content')

<div class="panel panel-default">
      <div class="panel-heading">
          <a  href="{{route('empleados.cargo.edit', $cargo->id)}}" class="btn btn-default"><span class="fa fa-reply"></span></a>
          <h3 class="box-title">Todos los Indicadores</h3>
      </div>
      <div class="panel-body">

        <p>Selecciones los indicadores que desea agregar a <b>{{$cargo->nombre}}</b>.</p>

        @if(count($indicadores_libres) > 0)
          <div class="col-sm-12" style="background: white; padding: 10px;">
            {!!Form::open(['route'=>['empleados.cargo.agregar', $cargo->id], 'method'=>'PUT'])!!}
                @foreach($indicadores_libres as $item)
                <label>{{ Form::checkbox('ind[]', $item->id) }} {{ $item->nombre }}</label><br>
                @endforeach
                <div class="text-right">
                  {!! form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success' ]) !!}
                </div>
            {!! Form::close()!!}
          </div>
        @else
          <div class='alert alert-success' role="alert">
            <button type="button" class="close" data-dismiss="alert" style="top: 0px;  position: relative; float: right;">&times;</button>
            <strong>No hay Indicadores disponibles para agregar a este indicador</strong>
          </div>  
        @endif
      </div>

      <div class="panel-footer">
      </div>
</div>

@endsection