@extends('layouts.app')


@section('titulo')
      Nuevo Grupo Departamento
@endsection

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">Nuevo Grupo Departamento</p>
  </div>
  <div class="panel-body">


      <div class="col-lg-12 breadcrumb">
            <a  href="{{route('localizaciones.grupodepartamento.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
      </div>

      {!!Form::open(['route'=>'localizaciones.grupodepartamento.store', 'method'=>'POST'])!!}
      <div class="form-group @if ($errors->has('nombre')) has-error @endif col-sm-4">
            <label for="nombre" class="hidden-xs">Nombre</label>
            {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']) !!}
            @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
      </div>
                
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('localizaciones.grupodepartamento.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>
  

@endsection


