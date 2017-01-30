@extends('layouts.app')

@section('titulo')
  Nuevo Indicador
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">Nuevo Indicador</p>
      
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="{{route('indicadores.indicador.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>

      {!!Form::open(['route'=>'indicadores.indicador.store', 'method'=>'POST'])!!}

        <div class="form-group @if ($errors->has('nombre')) has-error @endif  col-sm-6">
            <label for="nombre" class="hidden-xs">Nombre</label>
            {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']) !!}
            @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
        </div>

        <div class="form-group  @if ($errors->has('orden')) has-error @endif  col-xs-12 col-sm-3 col-md-3">
          <label for="orden">Orden</label>
          <select class="form-control" name="orden">
              <option value="" >Seleccionar...</option>
              @for($i = 1; $i<= 20; $i++)
                <option value="{{$i}}">{{$i}}</option>
              @endfor
          </select>
          @if ($errors->has('orden')) <p class="help-block">{{ $errors->first('orden') }}</p> @endif
        </div>


        <div class="form-group @if ($errors->has('descripcion_objetivo')) has-error @endif  col-sm-9">
            <label for="descripcion_objetivo" class="hidden-xs">Objetivo del Indicador</label>
            {!! form::text('descripcion_objetivo',null, ['id'=>'descripcion_objetivo', 'class'=>'form-control', 'placeholder'=>'Describe el descripcion_objetivo']) !!}
            @if ($errors->has('descripcion_objetivo')) <p class="help-block">{{ $errors->first('descripcion_objetivo') }}</p> @endif
        </div>

        <div class="form-group @if ($errors->has('tipo_indicador_id')) has-error @endif  col-sm-5 ">
          <label for="tipo_indicador_id" class="hidden-xs">Tipo Indicador</label>
              <!--
              {!! form::select('tipo',$tipo, null, ['id'=>'tipo', 'class'=>'form-control', 'placeholder'=>'Seleccionar..']) !!}
              -->
              <select class="form-control" name="tipo_indicador_id">
                    <option value="" >Seleccionar...</option>
                  @foreach($tipo as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                  @endforeach
              </select>
              @if ($errors->has('tipo_indicador_id')) <p class="help-block">{{ $errors->first('tipo_indicador_id') }}</p> @endif

        </div>

        {{-- @include('indicadores/indicador/partials/seleccionar_variables') --}}
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('indicadores.indicador.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>
<!-- Fin Nuevo -->

@endsection