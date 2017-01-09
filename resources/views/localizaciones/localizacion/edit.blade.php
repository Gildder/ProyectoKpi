@extends('layouts.app')

@section('content')
<div class="panel panel-default">
   <div class="panel-heading">
      <p class="titulo-panel">{{$localizacion->id}} - {{$localizacion->nombre}}</p>
   </div>
   <div class="panel-body">


      <div class="col-lg-12 breadcrumb">
            <a  href="{{route('localizaciones.localizacion.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
      </div>
      
       <div class="col-lg-12">
            @include('partials/alert/error')
      </div>

      {!!Form::model($localizacion, ['route'=>['localizaciones.localizacion.update', $localizacion->id], 'method'=>'PUT'])!!}
         <div class="form-group  @if ($errors->has('nombre')) has-error @endif col-sm-5 ">
               <label for="nombre" class="hidden-xs">Nombre</label>
               {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']) !!}
               @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif

         </div>
         <div class="form-group @if ($errors->has('grupoloc_id')) has-error @endif col-sm-5 ">
               <label for="grupoloc_id" class="hidden-xs">Grupo Localizacion</label>
               <select class="form-control" name="grupoloc_id">
                     @foreach($grupo as $item)
                           @if($item->idgrupo==$localizacion->grupoloc_id)
                                 <option value="{{$item->idgrupo}}" selected="selected" >{{$item->nombregrupo}}</option>
                           @else
                                 <option value="{{$item->idgrupo}}" >{{$item->nombregrupo}}</option>
                           @endif
                     @endforeach
               </select>
               @if ($errors->has('grupoloc_id')) <p class="help-block">{{ $errors->first('grupoloc_id') }}</p> @endif

         </div>
                
   </div>
   <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('localizaciones.localizacion.index')}}" class="btn btn-danger" type="reset">Cancelar</a>
      {!! form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success' ]) !!}
   </div>
      {!! Form::close()!!}
</div>  

@endsection