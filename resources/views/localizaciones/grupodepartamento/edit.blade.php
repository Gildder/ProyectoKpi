@extends('layouts.app')

@section('titulo')
      Editar Grupo Departamento
@endsection

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">{{$grupodepartamento->id}} - {{$grupodepartamento->nombre}}</p>
  </div>
  <div class="panel-body">


      <div class="col-lg-12 breadcrumb">
            <a  href="{{route('localizaciones.grupodepartamento.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
      </div>

      {!!Form::model($grupodepartamento, ['route'=>['localizaciones.grupodepartamento.update', $grupodepartamento->id], 'method'=>'PUT'])!!}
        {!! Form::hidden('id', $grupodepartamento->id) !!}
      <div class="form-group @if ($errors->has('nombre')) has-error @endif col-sm-5">
            <label for="nombre" class="hidden-xs">Nombre</label>
            {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingrese el Nombre']) !!}
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