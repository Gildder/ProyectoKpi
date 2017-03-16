@extends('layouts.app')

@section('content')
<div class="panel panel-default">
   <div class="panel-heading">
      <a  href="{{route('localizaciones.localizacion.index')}}" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">{{$localizacion->id}} - {{$localizacion->nombre}}</p>
   </div>
   <div class="panel-body">
      {!!Form::model($localizacion, ['route'=>['localizaciones.localizacion.update', $localizacion->id], 'method'=>'PUT'])!!}
        {!! Form::hidden('id', $localizacion->id) !!}

        @include('localizaciones/localizacion/partials/actualizar_atributos')
                
   </div>
   <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('localizaciones.localizacion.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
    {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
   </div>
      {!! Form::close()!!}
</div>  

@endsection