@extends('layouts.app')

@section('titulo')
  Editar Proyecto
@endsection

@section('content')

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
      <strong>{{ $tarea->id}} - {{ $tarea->descripcion}}</strong>
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
  </div>


      {!!Form::model($tarea, ['route'=>['tareas.tareaProgramadas.storeResolver', $tarea->id], 'method'=>'PUT'])!!}

              <div class="row col-sm-12">
                <div class="col-sm-12"> <label>Fechas de Solucion *</label></div>

                {{-- Fecha de Inicio --}}
                <div class="form-group @if ($errors->has('fechaInicioSolucion')) has-error @endif  col-sm-3">
                  De *: 
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="fechaInicioSolucion"  class="form-control fechaInicio" min="2017-2-7"  placeholder="dd/mm/aaaa" name="fechaInicioSolucion" value="{{ $tarea->fechaInicioSolucion }}" required>

                  </div>
                    @if ($errors->has('fechaInicioSolucion')) <p class="help-block">{{ $errors->first('fechaInicioSolucion') }}</p> @endif
                 </div>
                  
                {{-- Fecha Fin --}}
                 <div class="form-group @if ($errors->has('fechaFinSolucion')) has-error @endif  col-sm-3">
                  Hasta *:
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="fechaFinSolucion"  class="form-control fechaFin" name="fechaFinSolucion" placeholder="dd/mm/aaaa" value="{{ $tarea->fechaFinSolucion }}"  requvalue="{{ $tarea->fechaInicioSolucion }}" red>

                  </div>
                    @if ($errors->has('fechaFinSolucion')) <p class="help-block">{{ $errors->first('fechaFinSolucion') }}</p> @endif
                 </div>
            

                {{-- Dias Trabajados --}}
               {{--     <div class="form-group @if ($errors->has('tiempoEstimado')) has-error @endif  col-sm-5">
                      <label>Dias trabajados </label><br>
                          El total de días trabajados es: <label for="diasTrabajado">100</label>
                    @if ($errors->has('tiempoEstimado')) <p class="help-block">{{ $errors->first('tiempoEstimado') }}</p> @endif
                  </div> --}}
                </div>

              {{-- Tiempo estimado --}}
              <div class="row col-sm-12">
                 <div class="form-group @if ($errors->has('tiempoSolucion')) has-error @endif  col-sm-3">
                    <label>Tiempo Solucion *</label>
                    <div class="input-group">
                        <input type="time" name="tiempoSolucion"  value="{{ $tarea->tiempoSolucion }}" class="form-control"  placeholder="Hora:Minutos" required>
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                  @if ($errors->has('tiempoSolucion')) <p class="help-block">{{ $errors->first('tiempoSolucion') }}</p> @endif
                </div>

                  <div class="form-group  col-sm-3">
                      <label for="estado">Estado </label>
                      {!! Form::select('estado', ['1' => 'Abierto', '2' => 'En Progreso', '3' => 'Finalizado'], $tarea->estado, ['class' => 'form-control' ]) !!}
                  </div>
              </div> 

              {{-- Observaciones --}}
              <div class="row col-sm-12">
                <div class="form-group @if ($errors->has('observaciones')) has-error @endif  col-sm-6">
                    <label for="observaciones">Observaciones</label>
                    <textarea type="textArea" name="observaciones" value="{{ $tarea->observaciones }}"   maxlength="120" placeholder="Observaciones" class="form-control" rows="5" cols="9"></textarea>
                    @if ($errors->has('observaciones')) <p class="help-block">{{ $errors->first('observaciones') }}</p> @endif
                </div>
              </div>

            {{-- Ubicacion --}}
         {{--     <div class="form-group col-sm-5 ">
                <label for="localizacion_id">Ubicaciones *</label>
                    <div class="form-group">
                      <div class="radio">
                        @foreach($localizaciones as $item)
                          {{ Form::checkbox('localizacion_id[]', $item->id, false) }} {{ $item->nombre }} <br>
                        @endforeach
                      </div>
                    </div>
              </div> --}}
             

              <div class="col-lg-12 breadcrumb">
              <b>Ubicaciones</b>
            </div>

              <div class="row col-sm-12">
                <div class="col-sm-4">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <p class="titulo-panel">Seleccionar Ubicacion</p>
                    </div>
                    <div class="panel-body">
                      @include('tareas/tareaProgramadas/partials/tabla_localizaciones')
                    </div>
                  </div>
                </div>

                <div class="col-sm-3">
                      <p class="titulo-panel">Ubicaciones Agregadas</p><br>
                  @include('tareas/tareaProgramadas/partials/tabla_agregados')
                </div>
              </div>
          


            </div>
            <div class="modal-footer modal-delete-footer">
              <a  id="cancelar" href="{{route('tareas.tareaProgramadas.show', $tarea->id)}}"  class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
              {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
            </div>
            {!! Form::close()!!}
      </div>
<!-- Fin Nuevo -->


@endsection
