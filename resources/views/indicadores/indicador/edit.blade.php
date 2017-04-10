@extends('layouts.app')

@section('titulo')
	{{$indicador->nombre}}
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('indicadores.indicador.index')}}" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">{{$indicador->id}} - {{$indicador->nombre}}</p>
  </div>
  <div class="panel-body">
      <div class="col-xs-12 col-sm-12  col-md-12  col-lg-12 ">
        <p>Los campos con (*) son campos obligatorios.</p>
      </div>

      
      {!!Form::model($indicador, ['route'=>['indicadores.indicador.update', $indicador->id], 'method'=>'PUT'])!!}
        {!! Form::hidden('id', $indicador->id) !!}

      <div class="row col-sm-12">
        <div class="form-group @if ($errors->has('nombre')) has-error @endif  col-sm-4">
            <label for="nombre" class="hidden-xs">Nombre *</label>
            <input  type="text" maxlength="50" name="nombre" value="{{ $indicador->nombre }}" placeholder="Ingresar el Nombre" class="form-control" required>
            @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
        </div>
      </div>

      <div class="row col-sm-12">
        <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-5">
            <label for="descripcion" class="hidden-xs">Descripcion *</label>
          <textarea type="textArea" name="descripcion"  maxlength="120" placeholder="Ingresar Descripcion" class="form-control" rows="5" cols="9">{{ $indicador->descripcion }}</textarea>
            @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
        </div>
      </div>

      <div class="row col-sm-12">
        <div class="form-group  @if ($errors->has('orden')) has-error @endif  col-xs-12 col-sm-2 col-md-2">
          <label for="orden">Orden *</label>
          <select class="form-control" name="orden">
              <option value="" >Seleccionar...</option>
              <option value="{{$indicador->orden}}" selected="selected" >{{$indicador->orden}}</option>
              @foreach($orden as $item)
                  <option value="{{$item}}" >{{$item}}</option>
              @endforeach
          </select>
          @if ($errors->has('orden')) <p class="help-block">{{ $errors->first('orden') }}</p> @endif
        </div>
      </div>

      <div class="row col-sm-12">
        <div class="form-group @if ($errors->has('tipo_indicador_id')) has-error @endif  col-sm-2 ">
          <label for="tipo_indicador_id" class="hidden-xs">Tipo Indicador *</label>
              <!--
              {!! form::select('tipo',$tipo, null, ['id'=>'tipo', 'class'=>'form-control', 'placeholder'=>'Seleccionar..']) !!}
              -->
              <select class="form-control" name="tipo_indicador_id">
                  @foreach($tipo as $item)
                     @if($item->id==$indicador->tipo_indicador_id)
                           <option value="{{$item->id}}" selected="selected" >{{$item->nombre}}</option>
                     @else
                           <option value="{{$item->id}}" >{{$item->nombre}}</option>
                     @endif
                  @endforeach
              </select>
              @if ($errors->has('tipo_indicador_id')) <p class="help-block">{{ $errors->first('tipo_indicador_id') }}</p> @endif

        </div>
      </div>
        {{-- @include('indicadores/indicador/partials/seleccionar_variables') --}}
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('indicadores.indicador.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>

@endsection