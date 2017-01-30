@extends('layouts.app')

@section('titulo')
  {{ $variable->id}} - {{ $variable->abreviatura}} {{ $variable->descripcion}}
@endsection

@section('content')

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">{{ $variable->id}} - {{ $variable->abreviatura}} {{ $variable->descripcion}}</p>


  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="{{route('indicadores.variable.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>

      {!!Form::model($variable, ['route'=>['indicadores.variable.update', $variable->id], 'method'=>'PUT'])!!}
        {!! Form::hidden('id', $variable->id) !!}
       <div class="form-group @if ($errors->has('abreviatura')) has-error @endif  col-sm-3">
            <label for="abreviatura" class="hidden-xs">Abreviatura</label>
            {!! form::text('abreviatura',null, ['id'=>'abreviatura', 'class'=>'form-control', 'placeholder'=>'Ingresa la abreviatura']) !!}
            @if ($errors->has('abreviatura')) <p class="help-block">{{ $errors->first('abreviatura') }}</p> @endif
        </div>

        <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-6">
            <label for="descripcion" class="hidden-xs">Descripcion</label>
            {!! form::text('descripcion',null, ['id'=>'descripcion', 'class'=>'form-control', 'placeholder'=>'Ingresa la descripcion']) !!}
            @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
        </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('indicadores.variable.show', $variable->id)}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>

<!-- Fin Nuevo -->


@endsection