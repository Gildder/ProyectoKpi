@extends('layouts.app')

@section('titulo')
      Editar Departamento
@endsection

@section('content')

<div class="panel panel-default">
   <div class="panel-heading">
     <a  href="{{route('localizaciones.departamento.index')}}" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">{{$departamento->id}} - {{$departamento->nombre}}</p>
   </div>
   <div class="panel-body">

      {!!Form::model($departamento, ['route'=>['localizaciones.departamento.update', $departamento->id], 'method'=>'PUT'])!!}
        {!! Form::hidden('id', $departamento->id) !!}
      
         <div class="form-group  @if ($errors->has('nombre')) has-error @endif col-sm-5 ">
               <label for="nombre" class="hidden-xs">Nombre</label>
               {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingrese el Nombre']) !!}
               @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif

         </div>
         <div class="form-group @if ($errors->has('grupodep_id')) has-error @endif col-sm-5 ">
            <label for="grupodep_id" class="hidden-xs">Grupo Departamento</label>
            <select class="form-control" name="grupodep_id">
                  @foreach($grupo as $item)
                     @if($item->id==$departamento->grupodep_id)
                           <option value="{{$item->id}}" selected="selected" >{{$item->nombre}}</option>
                     @else
                           <option value="{{$item->id}}" >{{$item->nombre}}</option>
                     @endif
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