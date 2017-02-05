@extends('layouts.app')

@section('titulo')
  Nuevo Tarea
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">Nuevo Tarea</p>
      
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>
      <div class="col-sm-12"><p>Los campos con (*) son obligatorios</p><br></div>
      
      {!!Form::open(['route'=>'tareas.tareaProgramadas.store', 'method'=>'POST'])!!}

        {{-- Descripcion --}}
        <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-5">
            <label for="descripcion">Descripcion *</label>
            <input type="text" minlength="5" maxlength="60" name="descripcion" placeholder="Descripcion" class="form-control" required>
            @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
        </div>

        <div class="row col-sm-12">
          <div class="col-sm-12"> <label>Fechas Estimadas *</label></div>

          {{-- Fecha de Inicio --}}
          <div class="form-group @if ($errors->has('fechaInicioEstimado')) has-error @endif  col-sm-3">
            De *: 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" id="fechaInicioEstimado" class="form-control fechaInicio" name="fechaInicioEstimado" required>

            </div>
              @if ($errors->has('fechaInicio')) <p class="help-block">{{ $errors->first('fechaInicio') }}</p> @endif
           </div>
            
          {{-- Fecha Fin --}}
           <div class="form-group @if ($errors->has('fechaFinEstimado')) has-error @endif  col-sm-3">
            Hasta *:
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" id="fechaFinEstimado"  class="form-control fechaFin" name="fechaFinEstimado" required>

            </div>
              @if ($errors->has('fechaFinEstimado')) <p class="help-block">{{ $errors->first('fechaFinEstimado') }}</p> @endif
           </div>
        </div>

        {{-- Tiempo estimado --}}
        <div class="row col-sm-12">
           <div class="form-group @if ($errors->has('tiempoEstimado')) has-error @endif  col-sm-3">
              <label>Tiempo Estimado *</label>
              <div class="input-group">
                  <input type="time" name="tiempoEstimado" class="form-control"  placeholder="Minutos" required>
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
              </div>
            @if ($errors->has('tiempoEstimado')) <p class="help-block">{{ $errors->first('tiempoEstimado') }}</p> @endif
          </div>
        </div>

      {{-- Ubicacion --}}
       <div class="form-group @if ($errors->has('localizacion_id')) has-error @endif  col-sm-5 ">
          <label for="localizacion_id">Ubicaciones *</label>
              <div class="form-group">
              @if ($errors->has('localizacion_id')) <p class="help-block">{{ $errors->first('localizacion_id') }}</p> @endif

                <div class="radio">
                  @foreach($localizaciones as $item)
                    {{ Form::checkbox('prov[]', $item->id) }} {{ $item->nombre }} <br>
                  @endforeach
                </div>
              </div>
        </div>
    
        {{-- Observaciones --}}
        <div class="row col-sm-12">
          <div class="form-group @if ($errors->has('observaciones')) has-error @endif  col-sm-5">
              <label for="observaciones">Observaciones</label>
              <textarea type="textArea" name="observaciones" maxlength="120" placeholder="Observaciones" class="form-control" rows="5" cols="9"></textarea>
              @if ($errors->has('observaciones')) <p class="help-block">{{ $errors->first('observaciones') }}</p> @endif
          </div>
        </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>
<!-- Fin Nuevo -->

@endsection

