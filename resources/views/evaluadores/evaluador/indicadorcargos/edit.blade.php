@extends('layouts.app')

@section('titulo')
  {{ $indicador->nombre}} - {{ $cargo->nombre}} 
@endsection

@section('content')

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('indicadores.indicadorcargos.show', $indicador->id)}}" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">{{ $indicador->id}} - {{ $indicador->nombre}}</p>
  </div>
  <div class="panel-body">

      <div class="col-sm-12">
        <p class="titulo-panel"></p><p></p>
        <p>Por favor seleccione las caracteristica del indicador {{$indicador->nombre}} para <b>{{$cargo->nombre}}</b>.</p><br>
      </div>  

      {!!Form::model($indicadorcargo, ['route'=>['indicadores.indicadorcargos.update',  $cargo->id, $indicador->id], 'method'=>'PUT'])!!}
  
    <div class="row col-sm-12">
        <div class="form-group @if ($errors->has('objetivo')) has-error @endif  col-sm-2">
        <label for="objetivo" class="hidden-xs">Objetivo *</label>
            <input  type="number" max="100" min="1" name="objetivo" value="{{ $indicadorcargo->objetivo }}"  placeholder="El valor del objetivo en %" class="form-control" required> 
            @if ($errors->has('objetivo')) <p class="help-block">{{ $errors->first('objetivo') }}</p> @endif
        </div>
    </div>
      
    <div class="row col-sm-12">
      <div class="form-group @if ($errors->has('frecuencia_id')) has-error @endif  col-sm-2">
          <label for="frecuencia_id" class="hidden-xs">Frecuencia *</label>
             
              <select class="form-control" name="frecuencia_id">
                  <option value="" >Seleccionar...</option>
                  @foreach($frecuencia as $item)
                     @if($item->id == $indicadorcargo->frecuencia_id)
                           <option value="{{$item->id}}" selected="selected" >{{$item->nombre}}</option>
                     @else
                           <option value="{{$item->id}}" >{{$item->nombre}}</option>
                     @endif
                  @endforeach
              </select>
              @if ($errors->has('frecuencia_id')) <p class="help-block">{{ $errors->first('frecuencia_id') }}</p> @endif
        </div>
    </div>

    <div class="row col-sm-12">
      <div class="form-group @if ($errors->has('condicion')) has-error @endif  col-sm-4">
          <label for="condicion" class="hidden-xs">Condicion</label>
          <textarea type="textArea" name="condicion" maxlength="120" placeholder="Ingresar una condicion" class="form-control" rows="3" cols="9">{{ $indicador->condicion }}</textarea>
          @if ($errors->has('condicion')) <p class="help-block">{{ $errors->first('condicion') }}</p> @endif
      </div>
    </div>

    <div class="row col-sm-12">
      <div class="form-group @if ($errors->has('aclaraciones')) has-error @endif  col-sm-4">
          <label for="aclaraciones" class="hidden-xs">Aclaraciones</label>
          <textarea type="textArea" name="aclaraciones" maxlength="120" placeholder="Ingresa una aclaracion" class="form-control" rows="3" cols="9">{{ $indicador->aclaraciones }}</textarea>
          @if ($errors->has('aclaraciones')) <p class="help-block">{{ $errors->first('aclaraciones') }}</p> @endif
      </div>
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