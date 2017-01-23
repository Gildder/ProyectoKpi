@extends('layouts.app')

@section('titulo')
      Nuevo Departamento
@endsection

@section('content')



<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">Nuevo Departamento</p>
  </div>
  <div class="panel-body">


      <div class="col-lg-12 breadcrumb">
        <a  href="{{route('localizaciones.departamento.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
      </div>

      {!!Form::open(['route'=>'localizaciones.departamento.store', 'method'=>'POST'])!!}
        <div class="form-group @if ($errors->has('nombre')) has-error @endif col-sm-5 ">
              <label for="nombre" class="hidden-xs">Nombre</label>
              {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']) !!}
              @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('grupodep_id')) has-error @endif  col-sm-5 ">
          <label for="grupodep_id" class="hidden-xs">Grupo Departamento</label>
              <!--
              {!! form::select('nombregrupo',$grupo, null, ['id'=>'idgrupo', 'class'=>'form-control', 'placeholder'=>'Seleccionar..']) !!}
              -->
              <select class="form-control" name="grupodep_id">
                    <option value="" >Seleccionar...</option>
                  @foreach($grupo as $item)
                    <option value="{{$item->idgrupo}}">{{$item->nombregrupo}}</option>
                  @endforeach
              </select>
              @if ($errors->has('grupodep_id')) <p class="help-block">{{ $errors->first('grupodep_id') }}</p> @endif

        </div>
  </div>
  <div class="panel-footer text-right">
    <a  id="cancelar" href="{{route('localizaciones.departamento.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
    {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>


@endsection