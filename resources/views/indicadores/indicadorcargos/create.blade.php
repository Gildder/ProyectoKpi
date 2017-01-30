@extends('layouts.app')

@section('titulo')
  Asiganacion de Cargos
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">{{$indicador->nombre}}</p>
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="{{route('indicadores.indicadorcargos.show', $indicador->id)}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>
      <div class="col-sm-12">
        <p class="titulo-panel">{{$cargo->nombre}}</p><p></p>
        <p>Por favor seleccione las caracteristica del indicador {{$indicador->nombre}} para el cargo o puesto elegido.</p><br>
      </div>  
      
      {!!Form::open(['route'=>'indicadores.indicadorcargos.store', 'method'=>'POST'])!!}
        {!! Form::hidden('indicador_id', $indicador->id) !!}
        {!! Form::hidden('cargo_id', $cargo->id) !!}

<div class="row col-sm-12">
  
        <div class="form-group @if ($errors->has('condicion')) has-error @endif  col-sm-6">
            <label for="condicion" class="hidden-xs">Condicion</label>
            {!! form::text('condicion',null, ['id'=>'condicion', 'class'=>'form-control', 'placeholder'=>'La condicion que se aplicara']) !!}
            @if ($errors->has('condicion')) <p class="help-block">{{ $errors->first('condicion') }}</p> @endif
        </div>
</div>

<div class="row col-sm-12">
        <div class="form-group @if ($errors->has('aclaraciones')) has-error @endif  col-sm-6">
            <label for="aclaraciones" class="hidden-xs">Aclaraciones</label>
            {!! form::text('aclaraciones',null, ['id'=>'aclaraciones', 'class'=>'form-control', 'placeholder'=>'Coloca algunas aclaraciones']) !!}
            @if ($errors->has('aclaraciones')) <p class="help-block">{{ $errors->first('aclaraciones') }}</p> @endif
        </div>
</div>        

<div class="row col-sm-12">
  <div class="col-sm-12">
    
            <label for="objetivo" class="hidden-xs">Objetivo (*)</label>
            <p>{{$indicador->descripcion_objetivo}} a un:</p>
  </div>
        <div class="form-group @if ($errors->has('objetivo')) has-error @endif  col-sm-4">
            {!! form::text('objetivo',null, ['id'=>'objetivo', 'class'=>'form-control col-sm-2', 'placeholder'=>'El valor del objetivo en %']) !!}
            @if ($errors->has('objetivo')) <p class="help-block">{{ $errors->first('objetivo') }}</p> @endif
        </div>
</div>
      
      <div class="form-group @if ($errors->has('frecuencia_id')) has-error @endif  col-sm-4">
          <label for="frecuencia_id" class="hidden-xs">Frecuencia (*)</label>
              <!--
              {!! form::select('nombregrupo',$frecuencia, null, ['id'=>'frecuencia_id', 'class'=>'form-control', 'placeholder'=>'Seleccionar..']) !!}
              -->
              <select class="form-control" name="frecuencia_id">
                  <option value="" >Seleccionar...</option>
                  @foreach($frecuencia as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                  @endforeach
              </select>
              @if ($errors->has('frecuencia_id')) <p class="help-block">{{ $errors->first('frecuencia_id') }}</p> @endif

        </div>


  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('indicadores.indicadorcargos.show', $indicador->id)}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>
<!-- Fin Nuevo -->

@endsection