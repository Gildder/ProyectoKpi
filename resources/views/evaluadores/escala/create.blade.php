@extends('layouts.app')

@section('titulo')
  Nueva Escala
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('evaluadores.escala.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">Nueva Escala</p>
      
  </div>
  <div class="panel-body">

      {!!Form::open(['route'=>'evaluadores.escala.store', 'method'=>'POST'])!!}

        <div class="form-group @if ($errors->has('nombre')) has-error @endif  col-sm-3">
            <label for="nombre" >Nombre</label>
    <input  type="text" maxlength="50" name="nombre" placeholder="Ingresa el Nombre" class="form-control" required>
            @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
        </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('evaluadores.escala.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>
<!-- Fin Nuevo -->

@endsection