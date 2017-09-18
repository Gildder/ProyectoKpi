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
      <div class="breadcrumb col-sm-12">
          <p class="visible-xs">
              De
              <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}</b>
              hasta
              <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}</b>
          </p>
          <p class="hidden-xs">
              Tarea  del
              <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}</b>
              hasta
              <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}.</b>
              <b > Los campos con (*) son obligatorios </b>
          </p>
      </div>

      <div class="col-xs-12">
          <label>Descripcion:</label>
          <p>{{ $tarea->descripcion }}</p>
          <hr>
      </div>


      @include('partials/alert/error')
{!!Form::model($tarea, ['route'=>['tareas.tareaProgramadas.storeResolver', $tarea->id], 'method'=>'PUT'])!!}

    <div class="row col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;"  v-if="utilizarfechasestimadas == true" >
            <p>
            <span id="observacion" >Las fechas de inicio, finalizacion y el tiempo estimado son los estimados</span>
            </p>
        </div>
    {{-- Fecha de Inicio --}}
    <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5
        @if ($errors->has('fechaInicioSolucion'))
            has-error
        @endif">

      <label>Fecha de Comienzo *: </label>

        <input-date tipo="text" nombre="fechaInicioSolucion" v-if="utilizarfechasestimadas == false"
            @if($tarea->fechaInicioSolucion != '0000-00-00')
                valor="{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)}}"
            @else
                valor="{{ old('fechaInicioSolucion') }}"
            @endif
            placeholder="Fecha de inicio"   diaInicio="{{ \Cache::get('diainicio') }}"
            fechainicio="{{  \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}"
            fechafin='{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}' >
        </input-date>

        <input-date tipo="text" nombre="fechaInicioSolucion"  v-if="utilizarfechasestimadas == true" readonly="true"
                    {{--value="{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)}}"--}}
                    diaInicio="{{ \Cache::get('diainicio') }}"
                    valor="{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)}}" placeholder="Comienzo"
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
            <input-date tipo="text" nombre="fechaFinSolucion" v-if="utilizarfechasestimadas == false"
                {{--valor="{{ old('fechaInicioEstimado') }}"--}}
                @if($tarea->fechaFinSolucion != '0000-00-00')
                   valor="{{ \Calcana::cambiarFormatoEuropeo($tarea->fechaFinSolucion)}}"
                @else
                    valor="{{ old('fechaFinSolucion') }}"
                @endif
                placeholder="Fecha finalizacion"   diaInicio="{{ \Cache::get('diainicio') }}"
                fechainicio="{{  \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}"
                fechafin='{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}' >
            </input-date>

            <input-date tipo="text" nombre="fechaFinSolucion" v-if="utilizarfechasestimadas == true" readonly="true"
                        {{--value="{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)}}"--}}
                        diaInicio="{{ \Cache::get('diainicio') }}"
                        valor="{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)}}" placeholder="Comienzo"
                        fechainicio="{{  \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}"
                        fechafin='{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}' >
            </input-date>

        @if ($errors->has('fechaFinSolucion')) <p class="help-block">{{ $errors->first('fechaFinSolucion') }}</p> @endif
        </div>


        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="checkbox">
                <label>
                    <input  type="checkbox" name="todasemana" v-model="utilizarfechasestimadas" id="default-fechaEstimadas">
                    Utilizar fechas y tiempo estimados
                </label>
            </div>
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
             <input type="number" name="hora" min="0" max="999" placeholder="Horas" class="form-control"   required  v-if="utilizarfechasestimadas == false"
                    @if($tarea->tiempoSolucion != "00:00:00")
                    value="{{$tarea->sacarMinutos($tarea->tiempoSolucion)}}"
                    @else valor="{{ old('minuto') }}"  @endif >

              <input type="number" name="hora" min="0" max="999" v-if="utilizarfechasestimadas == true" readonly="true"
                     value="{{$tarea->sacarHoras($tarea->tiempoEstimado)}}"
                     placeholder="Horas"
                     class="form-control" value="00"  required >

            @if ($errors->has('hora')) <p class="help-block">{{ $errors->first('hora') }}</p> @endif

          </div>

            {{-- Minutos --}}
          <div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-4
                @if ($errors->has('minuto'))
                  has-error
                @endif">

            <p>Minutos:</p>
            <input type="number" name="minuto" min="0"  max="999"
                   placeholder="Minutos"  class="form-control"
                   required  v-if="utilizarfechasestimadas == false"
                   @if($tarea->tiempoSolucion != "00:00:00")
                        value="{{$tarea->sacarMinutos($tarea->tiempoSolucion)}}"
                   @else valor="{{ old('minuto') }}"
                   @endif>

              <input type="number" name="minuto" min="0" v-if="utilizarfechasestimadas == true" readonly="true"
                     value="{{$tarea->sacarMinutos($tarea->tiempoEstimado)}}"
                     placeholder="Minutos"
                     max="999" class="form-control" value="00"   required>

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

  var check = $('input [name="todasemana"]');
  var observacion = $('#observacion');

  if(localStorage.getItem('fechas-checked') != undefined){
      check.attr('checked', true);
  }

  check.click(function () {
      if(check.checked){
          localStorage.setItem('fechas-checked', this.checked);

          observacion.html('Las fechas de inicion, finalizacion y tiempo de duracion son las estimadas.')
      }else{
          localStorage.removeItem('fechas-checked');
          observacion.html('')

      }
  });

});
</script>

@endsection
