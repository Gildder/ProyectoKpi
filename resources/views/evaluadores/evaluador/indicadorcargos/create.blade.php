@extends('layouts.app')

@section('titulo')
  Asiganacion de Cargos
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('evaluadores.evaluador.indicadorcargos.show', $indicador->id)}}" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">{{$indicador->nombre}}</p>
  </div>
  <div class="panel-body">

      <div class="col-sm-12">
        <p>Por favor seleccione las caracteristica del indicador {{$indicador->nombre}} para  <b>{{$cargo->nombre}}</b>.</p>
      </div>  
      
      {!!Form::open(['route'=>'evaluadores.evaluador.indicadorcargos.store', 'method'=>'POST'])!!}
        {!! Form::hidden('indicador_id', $indicador->id) !!}
        {!! Form::hidden('cargo_id', $cargo->id) !!}

<div class="row col-sm-12">
        <div class="form-group @if ($errors->has('objetivo')) has-error @endif  col-sm-2">
            <label for="objetivo" class="hidden-xs">Objetivo *</label>
            <input  type="number" max="100" min="1" name="objetivo" placeholder="El valor del objetivo en %" class="form-control" required> 
            @if ($errors->has('objetivo')) <p class="help-block">{{ $errors->first('objetivo') }}</p> @endif
        </div>
</div>
      
  <div class="row col-sm-12">
      <div class="form-group @if ($errors->has('frecuencia_id')) has-error @endif  col-sm-2">
          <label for="frecuencia_id" class="hidden-xs">Frecuencia *</label>
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

<div class="row col-sm-12">
        <div class="form-group @if ($errors->has('condicion')) has-error @endif  col-sm-4">
            <label for="condicion" class="hidden-xs">Condicion *</label>
          <textarea type="textArea" name="condicion" maxlength="120" placeholder="Ingresar la condicion" class="form-control" rows="3" cols="9"></textarea>

            @if ($errors->has('condicion')) <p class="help-block">{{ $errors->first('condicion') }}</p> @endif
        </div>
</div>

<div class="row col-sm-12">
        <div class="form-group @if ($errors->has('aclaraciones')) has-error @endif  col-sm-4">
            <label for="aclaraciones" class="hidden-xs">Aclaraciones *</label>
          <textarea type="textArea" name="aclaraciones" maxlength="120" placeholder="Coloca algunas aclaraciones" class="form-control" rows="3" cols="9"></textarea>
            @if ($errors->has('aclaraciones')) <p class="help-block">{{ $errors->first('aclaraciones') }}</p> @endif
        </div>
</div>        


  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('evaluadores.evaluador.indicadorcargos.show', $indicador->id)}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>
<!-- Fin Nuevo -->

@endsection