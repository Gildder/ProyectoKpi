@extends('layouts.app')

@section('titulo')
   Tarea Programada
@endsection

@section('content')

<!-- Nuevo -->


<div class="panel panel-default">
  <div class="panel-heading">
      <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-xs  pull-left btn-back"><span class="fa fa-reply"></span></a>
      <strong>{{ $tarea->id}} - {{ $tarea->descripcion}}</strong>
  </div>
  <div class="panel-body">


<div class="col-sm-12">
  
    <div class="col-sm-6">
          {!!Form::model($tarea, ['route'=>['tareas.tareaProgramadas.storeResolver', $tarea->id], 'method'=>'PUT'])!!}

              <div class="row col-sm-12">
                <div class="col-sm-12"> 
                  <label>Fechas de Ejecucion *</label><br>
                  <small><p>Se toma en cuenta las fecha estimadas progamadas.</p></small>
                </div>
                
                {{-- Fecha de Inicio --}}
                <div class="form-group @if ($errors->has('fechaInicioSolucion')) has-error @endif  col-sm-4">
                  <p>De *: </p>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="fechaInicioSolucion"  class="form-control InicioEjecucion" placeholder="dd/mm/aaaa" name="fechaInicioSolucion" value="{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)}} " required>

                  </div>
                    @if ($errors->has('fechaInicioSolucion')) <p class="help-block">{{ $errors->first('fechaInicioSolucion') }}</p> @endif
                 </div>
                  
                {{-- Fecha Fin --}}
                 <div class="form-group @if ($errors->has('fechaFinSolucion')) has-error @endif  col-sm-4">
                  <p>Hasta *:</p>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="fechaFinSolucion"  class="form-control FinEjecucion" name="fechaFinSolucion" placeholder="dd/mm/aaaa" value="{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinSolucion)}}"  required>

                  </div>
                    @if ($errors->has('fechaFinSolucion')) <p class="help-block">{{ $errors->first('fechaFinSolucion') }}</p> @endif
                 </div>
            

           
                </div>

              {{-- Tiempo estimado --}}
              <div class="row col-sm-12">
                <label class="form-group col-sm-12 col-xs-12">Tiempo Ejecucion *</label>
                  <div class="form-group  @if ($errors->has('hora')) has-error @endif col-xs-6 col-sm-3 col-md-2">
                    <p>Horas:<p>
                    <input type="number" name="hora" min="0" max="999"  value="{{$tarea->sacarHoras($tarea->tiempoSolucion)}}"  class="form-control"   required >
                    @if ($errors->has('hora')) <p class="help-block">{{ $errors->first('hora') }}</p> @endif

                  </div> 
                  <div class="form-group  @if ($errors->has('minuto')) has-error @endif col-xs-6 col-sm-4 col-md-2 ">
                    <p>Minutos:</p>
                    <input type="number" name="minuto" min="0"  max="999" value="{{$tarea->sacarMinutos($tarea->tiempoSolucion)}}"  class="form-control"    required>
                    @if ($errors->has('minuto')) <p class="help-block">{{ $errors->first('minuto') }}</p> @endif
                  </div>
              </div>

              {{-- estado --}}
              <div class="row col-sm-12">
                  <div class="form-group  col-sm-4">
                      <label >Estado </label>
                      {!! Form::select('estado', [ '1' => 'Programado', '2' => 'En Progreso', '3' => 'Finalizado'], $tarea->estado, ['class' => 'form-control' ]) !!}
                  </div>
              </div> 

              {{-- Observaciones --}}
              <div class="row col-sm-12">
                <div class="form-group @if ($errors->has('observaciones')) has-error @endif  col-sm-10">
                    <label for="observaciones">Observaciones</label>
                    <textarea type="textArea" name="observaciones" value="{{ $tarea->observaciones }}"   maxlength="120" placeholder="Observaciones" class="form-control" rows="5" cols="9"></textarea>
                    @if ($errors->has('observaciones')) <p class="help-block">{{ $errors->first('observaciones') }}</p> @endif
                </div>
              </div>


        </div>

          <div class="col-sm-6">
  
              <b>Localizacion</b><hr class="col-sm-12">
              <div class="col-sm-12"></div>
              <p><small>Seleccione las localizaciones donde se realizaró la tarea.</small></p>
                <div class="col-sm-6">
                  @foreach($ubicacionesDis as $item)
                      {{-- <input type="checkbox" name="localizacion" value="{{$item->id}}">    {{$item->nombre}}<br> --}}
                      <label>{{ Form::checkbox('prov[]', $item->id, null, ['class'=>'micheckbox']) }} {{ $item->nombre }}</label><br>
                  @endforeach
                </div>
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
<script>
   // function recorrerLocalizaciones(){
    $("input[type=checkbox]").each(function (index) { 
          var id = $(this).val();
        @foreach($ubicacionesOcu as $ubicacion)
          if(id == {{$ubicacion->id}}){
            $(this).prop('checked', true); 
          }
        @endforeach
          });
    // }
$(document).ready(function(){


  $(".InicioEjecucion").datepicker({
    format: 'dd/mm/yyyy',
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 1,
    minDate: '{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)}}',
    onSelect: function(selectedDate) {
      $(".FinEjecucion").datepicker("option", "minDate", selectedDate);
    }
  });

  
  $(".FinEjecucion").datepicker({
    format: 'dd/mm/yyyy',
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 1,
    maxDate: '{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)}}',

    onSelect: function(selectedDate) {
      $(".InicioEjecucion").datepicker( "option", "maxDate", selectedDate);
    }
  });
});
</script>

@endsection
