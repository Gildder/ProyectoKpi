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
          <p >
              Tarea  del
              <b class="fechaTareas">{{ $semanas->fechaInicio }}</b>
              hasta
              <b class="fechaTareas">{{ $semanas->fechaFin }}</b>

          </p>
          <div class="col-xs-12">
              <b > Los campos con (*) son obligatorios </b>
          </div>
      </div>


      <div class="col-xs-12">
          <label>Descripcion:</label>
          <p>{{ $tarea->descripcion }}</p>
          <hr>
      </div>


      @include('partials/alert/error')
{!!Form::model($tarea, ['route'=>['tareas.tareaProgramadas.storeResolver', $tarea->id], 'method'=>'PUT'])!!}
      <input type="text" name="agenda" hidden value="{{ $agendar }}">
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

      <label>Fecha Inicio *: </label>

        <input-date tipo="text" nombre="fechaInicioSolucion" v-if="utilizarfechasestimadas == false"

                valor="{{ old('fechaInicio') }}"
            placeholder="Fecha de inicio"    agendar="{{ $agendar }}"
            fechainicio="{{  $semanas->fechaInicio }}"
            fechafin='{{  $semanas->fechaFin }}' >
        </input-date>

        <input-date tipo="text" nombre="fechaInicioSolucion"  v-if="utilizarfechasestimadas == true" readonly="true"
                    agendar="{{ $agendar }}"
                    valor="{{  $tarea->fechaInicio}}" placeholder="Fecha Inicio"
                    fechainicio="{{   $semanas->fechaInicio }}"
                    fechafin='{{  $semanas->fechaFin }}' >
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

        <label>Fecha Fin *:</label>
            <input-date tipo="text" nombre="fechaFinSolucion" v-if="utilizarfechasestimadas == false"

                    valor="{{ old('fechaFin') }}"
                placeholder="Fecha finalizacion"    agendar="{{ $agendar }}"
                fechainicio="{{   $semanas->fechaInicio }}"
                fechafin='{{  $semanas->fechaFin }}' >
            </input-date>

            <input-date tipo="text" nombre="fechaFinSolucion" v-if="utilizarfechasestimadas == true" readonly="true"
                        agendar="{{ $agendar }}"
                        valor="{{$tarea->fechaFin }}" placeholder="Fecha Fin"
                        fechainicio="{{   $semanas->fechaInicio }}"
                        fechafin='{{  $semanas->fechaFin }}' >
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
        <label class="form-group col-sm-12 col-xs-12" style="margin-top: 10px;">Duracion *:</label>
          {{-- Horas --}}
          <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4
            @if ($errors->has('hora'))
                  has-error
            @endif ">
            <p>Horas:<p>
             <input type="number" name="hora" min="0" max="150" placeholder="Horas" class="form-control"   required  v-if="utilizarfechasestimadas == false"

                   valor="{{ old('minuto') }}">

              <input type="number" name="hora" min="0" max="150" v-if="utilizarfechasestimadas == true" readonly="true"
                     value="{{ \Calcana::sacarHoras($tarea->tiempo)}}"
                     placeholder="Horas"
                     class="form-control" value="0"  required >

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
                    valor="{{ old('minuto') }}"
                   >

              <input type="number" name="minuto" min="0" v-if="utilizarfechasestimadas == true" readonly="true"
                     value="{{ \Calcana::sacarMinutos($tarea->tiempo)}}"
                     placeholder="Minutos"
                     max="999" class="form-control" value="0"   required>

            @if ($errors->has('minuto')) <p class="help-block">{{ $errors->first('minuto') }}</p> @endif
          </div>
      </div>



      {{-- Observaciones --}}
      <div class="row col-sm-12">
        <div class="form-group @if ($errors->has('observaciones')) has-error @endif  col-sm-12 col-md-10 col-lg-10">
            <label for="observaciones">Observaciones</label>
            <textarea type="textArea" id="observacion" name="observaciones"  maxlength="120" placeholder="Ingrese Observaciones" class="form-control" rows="5" cols="9">@if($tarea->observaciones != 'Ninguna'){{ $tarea->observaciones  }} @endif</textarea>
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
          @foreach($ubicaciones as $item)
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
        <button type="submit"  class="btn btn-success"><span class="fa fa-save"></span> Guardar</button>

    </div>
        {!! Form::close()!!}
</div>

<!-- Fin Nuevo -->
<script>
   // function recorrerLocalizaciones(){
    $("input[type=checkbox]").each(function (index) { 
          var id = $(this).val();
        @foreach($tarea->ubicaciones as $ubicacion)
          if(id == {{$ubicacion->id}}){
            $(this).prop('checked', true); 
          }
        @endforeach
    });
    // }
$(document).ready(function(){

    $.trim($("#observacion").val());

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
