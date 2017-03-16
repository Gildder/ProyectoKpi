@extends('layouts.app')

@section('titulo')
  Nuevo Evaluador
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('evaluadores.evaluador.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">Nueva Gerencia Evaluadora</p>
  </div>
  <div class="panel-body">

      {!!Form::open(['route'=>'evaluadores.evaluador.store', 'method'=>'POST'])!!}
      <div class="col-md-12">
        <p>Los campos con (*) son obligatorios.</p>
      </div>
  
      <div class="row col-md-12">
        <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-4">
            <label for="descripcion" >Nombre *</label>
    <input  type="text"  maxlength="40" name="descripcion" placeholder="Ingresa el nombre" class="form-control" required>
            @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
        </div>
      </div>

      <div class="row col-md-12">
        <div class="form-group @if ($errors->has('abreviatura')) has-error @endif  col-sm-1">
            <label for="abreviatura" >Abreviatura *</label>
            <input  type="text"  maxlength="10" name="abreviatura" placeholder="eg: GADM" class="form-control" required>
            @if ($errors->has('abreviatura')) <p class="help-block">{{ $errors->first('abreviatura') }}</p> @endif
        </div>

      </div>
      <div class="row col-md-12">  
        <div class="form-group @if ($errors->has('ponderacion_id')) has-error @endif  col-sm-3 ">
            <label for="ponderacion_id" >Selecciona Ponderacion *</label>
            <select class="form-control" name="ponderacion_id">
                <option value="" >Seleccionar...</option>
                @foreach($ponderaciones as $items)
                  <option value="{{$items->id}}">{{$items->nombre}}</option>
                @endforeach
            </select>
            @if ($errors->has('ponderacion_id')) <p class="help-block">{{ $errors->first('ponderacion_id') }}</p> @endif
        </div>
      </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('evaluadores.evaluador.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>
<!-- Fin Nuevo -->

@endsection