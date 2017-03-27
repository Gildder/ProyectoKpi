@extends('layouts.app')

@section('titulo')
  Nuevo Cargo
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('empleados.cargo.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">Nuevo Cargo</p>
      
  </div>
  <div class="panel-body">

      {!!Form::open(['route'=>'empleados.cargo.store', 'method'=>'POST'])!!}

        <div class="form-group @if ($errors->has('nombre')) has-error @endif  col-sm-3">
            <label for="nombre" >Nombre</label>
            {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']) !!}
            @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
        </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('empleados.cargo.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>
<!-- Fin Nuevo -->

@endsection