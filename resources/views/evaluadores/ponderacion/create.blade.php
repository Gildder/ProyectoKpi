@extends('layouts.app')

@section('titulo')
  Nueva ponderacion
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('evaluadores.ponderacion.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">Nueva Ponderacion</p>
  </div>
  <div class="panel-body">

      {!!Form::open(['route'=>'evaluadores.ponderacion.store', 'method'=>'POST'])!!}
      <div class="col-md-12">
        
        <div class="form-group @if ($errors->has('nombre')) has-error @endif  col-sm-6">
            <label for="nombre" >Nombre</label>
    <input  type="text" minlength="5" maxlength="50" name="nombre" placeholder="Ingresa el Nombre" class="form-control" required>
            @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
        </div>
      </div>
      
      <div class="col-md-12">
        
        <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-6">
            <label for="descripcion" >Descripcion</label>
        <textarea type="textArea" name="descripcion"  maxlength="120" placeholder="Ingresa la Descripcion" class="form-control" rows="5" cols="9" required></textarea>

            @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
        </div>
      </div>
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('evaluadores.ponderacion.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>
<!-- Fin Nuevo -->

@endsection