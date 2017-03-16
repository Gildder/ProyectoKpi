@extends('layouts.app')

@section('titulo')
  {{ $ponderacion->id}} - {{ $ponderacion->nombre}}
@endsection

@section('content')

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('evaluadores.ponderacion.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>

      <p class="titulo-panel">{{ $ponderacion->id}} - {{ $ponderacion->nombre}} </p>


  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
  </div>

      {!!Form::model($ponderacion, ['route'=>['evaluadores.ponderacion.update', $ponderacion->id], 'method'=>'PUT'])!!}
        {!! Form::hidden('id', $ponderacion->id) !!}
       <div class="form-group @if ($errors->has('nombre')) has-error @endif  col-sm-3">
            <label for="nombre" >Nombre</label>
    <input  type="text" minlength="5" maxlength="50" name="nombre" value="{{$ponderacion->nombre}}" placeholder="Ingresa el Nombre" class="form-control" required>
            @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
        </div>

        <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-6">
            <label for="descripcion" >Descripcion</label>
        <textarea name="descripcion"   maxlength="120" placeholder="Ingresa la Descripcion" class="form-control" rows="5" cols="9" required> {{$ponderacion->descripcion}}</textarea>
            @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
        </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('evaluadores.ponderacion.show', $ponderacion->id)}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>

<!-- Fin Nuevo -->


@endsection