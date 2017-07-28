@extends('layouts.app')

@section('titulo')
   Tarea Programada
@endsection

@section('content')

<!-- Nuevo -->


<div class="panel panel-default">
  <div class="panel-heading">
      <a  href="{{route('tareas.tareaProgramadas.index')}}" @click="mostrarModalLoading()" class="btn btn-primary btn-xs  pull-left btn-back"><span class="fa fa-reply"></span></a>
      <strong>Finalizar - Tarea Nro. {{$tarea->numero}}</strong>
  </div>


  <div class="panel-body">
      <div class="col-sm-12 breadcrumb">
          <p><b>Cierre de Tarea:</b> Para finalizar una tarea es obligatorio llenar todos campos con (*). </p>
      </div>

      @include('partials/alert/error')
{!!Form::model($tarea, ['route'=>['tareas.tareaProgramadas.storeResolver', $tarea->id], 'method'=>'PUT'])!!}

    <div class="row col-xs-12 col-sm-6 col-md-6 col-lg-6">

    {{-- Fecha de Inicio --}}
    <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5
        @if ($errors->has('fechaInicioSolucion'))
            has-error
        @endif">
      <label>Fecha de Comienzo *: </label>
        <input-date tipo="text" nombre="fechaInicioSolucion"
            @if($tarea->fechaInicioSolucion != '0000-00-00')
                valor="{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)}}"
            @else
                valor="{{ old('fechaInicioSolucion') }}"
            @endif
            placeholder="Fecha de inicio"
            fechainicio="{{  \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}"
            fechafin='{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}' >
        </input-date>


        @if ($errors->has('fechaInicioSolucion'))
            <p class="help-block">{{ $errors->first('fechaInicioSolucion') }}</p>
        @endif
     </div>

        {{-- Fecha Fin --}}
        <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5
        @if ($errors->has('fechaFinSolucion'))
             has-error
        @endif">
        <label>Fecha de Finalizacion *:</label>
            <input-date tipo="text" nombre="fechaFinSolucion"
                {{--valor="{{ old('fechaInicioEstimado') }}"--}}
                @if($tarea->fechaFinSolucion != '0000-00-00')
                   valor="{{ \Calcana::cambiarFormatoEuropeo($tarea->fechaFinSolucion)}}"
                @else
                    valor="{{ old('fechaFinSolucion') }}"
                @endif
                placeholder="Fecha finalizacion"
                fechainicio="{{  \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}"
                fechafin='{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}' >
            </input-date>

        @if ($errors->has('fechaFinSolucion')) <p class="help-block">{{ $errors->first('fechaFinSolucion') }}</p> @endif
        </div>

      {{-- Tiempo estimado --}}
      <div class="row col-sm-12">
        <label class="form-group col-sm-12 col-xs-12" style="margin-top: 10px;">Tiempo de Duracion *:</label>
          {{-- Horas --}}
          <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4
            @if ($errors->has('hora'))
                  has-error
            @endif ">
            <p>Horas:<p>
            <input type="number" name="hora" min="0" max="999" placeholder="Horas" class="form-control"   required
                   @if($tarea->tiempoSolucion == "00:00:00")
                    value="" @else value="{{$tarea->sacarHoras($tarea->tiempoSolucion)}}"  @endif >
            @if ($errors->has('hora')) <p class="help-block">{{ $errors->first('hora') }}</p> @endif

          </div>

            {{-- Minutos --}}
          <div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-4
                @if ($errors->has('minuto'))
                  has-error
                @endif">

            <p>Minutos:</p>
            <input type="number" name="minuto" min="0"  max="999"   placeholder="Horas"  class="form-control"    required
                   @if($tarea->tiempoSolucion == "00:00:00") value=""  @else value="{{$tarea->sacarMinutos($tarea->tiempoSolucion)}}" @endif>
            @if ($errors->has('minuto')) <p class="help-block">{{ $errors->first('minuto') }}</p> @endif
          </div>
      </div>



      {{-- Observaciones --}}
      <div class="row col-sm-12">
        <div class="form-group @if ($errors->has('observaciones')) has-error @endif  col-sm-12 col-md-10 col-lg-10">
            <label for="observaciones">Observaciones</label>
            <textarea type="textArea" name="observaciones" value="{{ $tarea->observaciones }}"   maxlength="120" placeholder="Observaciones" class="form-control" rows="5" cols="9"></textarea>
            @if ($errors->has('observaciones')) <p class="help-block">{{ $errors->first('observaciones') }}</p> @endif
        </div>
      </div>
  </div>

  {{-- Panel de Localizaciones --}}
  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <b>Localizacion</b><hr class="col-sm-12" style="margin-top: 5px;">
      <div class="col-sm-12 @if ($errors->has('prov')) has-error @endif "></div>
      <p>Seleccione las localizaciones donde se realizaró la tarea.</p>
      <div class="col-sm-6">
          @foreach($ubicacionesDis as $item)
              <label>{{ Form::checkbox('prov[]', $item->id, null, ['class'=>'micheckbox']) }} {{ $item->nombre }}</label><br>
          @endforeach
          @if ($errors->has('prov')) <p class="help-block" style="color: #9c3328">{{ $errors->first('prov') }}</p> @endif
      </div>
  </div>
</div>



    <div class="panel-footer text-right">
        <a  id="cancelar" href="{{route('tareas.tareaProgramadas.show', $tarea->id)}}" @click="mostrarModalLoading()"
            class="btn btn-danger" >
            <span class="fa fa-times"></span> Cancelar
        </a>
        <button type="submit" name="guardar" class="btn btn-success"><span class="fa fa-save"></span> Guardar</button>

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
    //defaultDate: "+1w",
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
