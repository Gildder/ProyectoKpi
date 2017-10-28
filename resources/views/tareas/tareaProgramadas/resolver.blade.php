@extends('layouts.app')

@section('titulo')
   @lang('labels.titlesPage.tareaFinalizar')
@endsection

@section('content')

<!-- Nuevo -->


<div class="panel panel-default">
  <div class="panel-heading">
      <a  href="{{route('tareas.tareaProgramadas.index')}}" @click="mostrarModalLoading()" class="btn btn-primary btn-xs  pull-left btn-back"><span class="fa fa-reply"></span></a>
      <strong>@lang('labels.panels.pnsTareaFinalizar'){{$tarea->numero}}</strong>
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
              <b > @lang('labels.comments.obligatorioAttr')</b>
          </div>
      </div>




      @include('partials/alert/error')
{!!Form::model($tarea, ['route'=>['tareas.tareaProgramadas.storeResolver', $tarea->id], 'method'=>'PUT'])!!}
      <input type="text" name="agenda" hidden value="{{ $agendar }}">

      {{-- Descripcion --}}
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-5
            @if ($errors->has('descripcion'))
                  has-error
            @endif">

              <label class="form-group">@lang('labels.labels.lbsDescripcion')</label>
              <input  type="text" minlength="5"
                      maxlength="120"
                      name="descripcion"
                      placeholder="@lang('labels.pladers.phsDescripcion')"
                      class="form-control" value="{{ $tarea->descripcion }}"
                      required>
              <span></span>
              @if ($errors->has('descripcion'))
                  <p class="help-block">{{ $errors->first('descripcion') }}</p>
              @endif
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <hr>
          </div>
      </div>



      <div class="row col-xs-12 col-sm-6 col-md-6 col-lg-6">
    {{-- Fecha de Inicio --}}
    <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-4
        @if ($errors->has('fechaInicio'))
            has-error
        @endif">

      <label>@lang('labels.labels.lbsFechaInicio') </label>


        <div class="input-group row margenFecha">
            <div class="input-group-addon row">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" id="fechaInicioTarea"  style="z-index: 3000"
                   name="fechaInicio"
                   @if(old('fechaInicio') == null)
                   value="{{ $tarea->fechaInicio }}"
                   @else
                   value="{{ old('fechaInicio') }}"
                   @endif
                   placeholder="@lang('labels.pladers.phsFechaInicio')"
                   class="form-control"  required>
        </div>

        @if ($errors->has('fechaInicio'))
            <p class="help-block">{{ $errors->first('fechaInicio') }}</p>
        @endif
     </div>

        {{-- Fecha Fin --}}
        <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-4
        @if ($errors->has('fechaFin'))
             has-error
        @endif">

        <label>@lang('labels.labels.lbsFechaFin')</label>
            <div class="input-group row margenFecha">
                <div class="input-group-addon row">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="fechaFinTarea"  style="z-index: 3000"
                       name="fechaFin"
                       @if(old('fechaFin') == null)
                            value="{{ $tarea->fechaFin }}"
                       @else
                       value="{{ old('fechaFin') }}"
                       @endif
                       placeholder="@lang('labels.pladers.phsFechaFin')"
                       class="form-control"  required>
            </div>

        @if ($errors->has('fechaFin')) <p class="help-block">{{ $errors->first('fechaFin') }}</p> @endif
        </div>

      {{-- Duracion --}}
      <div class="row col-sm-12">
          {{-- Horas --}}
          <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2
            @if ($errors->has('hora'))
              has-error
            @endif">

             <label for="hora">@lang('labels.labels.lbsHora')</label>


              <input type="number" name="hora"
                     min="0"
                     max="150"
                     @if(old('fechaFin') == null)
                     value="{{ \Calcana::sacarHoras($tarea->tiempo)}}"
                     @else
                     value="{{ old('hora') }}"
                     @endif
                     placeholder="@lang('labels.pladers.phsHora')"
                     class="form-control" required >
            <span></span>
            @if($errors->has('hora')) <p class="help-block">{{ $errors->first('hora') }}</p> @endif

          </div>

            {{-- Minutos --}}
          <div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2
            @if ($errors->has('minuto'))
              has-error
            @endif">

            <label for="minuto">@lang('labels.labels.lbsMinuto')</label>
              <input type="number" name="minuto"
                     min="0"
                     max="9999"
                     @if(old('fechaFin') == null)
                     value="{{ \Calcana::sacarMinutos($tarea->tiempo)}}"
                     @else
                     value="{{ old('minuto') }}"
                     @endif
                     placeholder="@lang('labels.pladers.phsMinuto')"
                     class="form-control" required>
            <span></span>
            @if($errors->has('minuto')) <p class="help-block">{{ $errors->first('minuto') }}</p> @endif
          </div>
      </div>



        {{-- Observaciones --}}
        <div class="row col-sm-12">
        <div class="form-group @if ($errors->has('observaciones')) has-error @endif  col-sm-12 col-md-10 col-lg-10">
            <label for="observaciones">@lang('labels.labels.lbsObservaciones')</label>
            <textarea type="textArea" id="observacion" name="observaciones"  maxlength="120"
                      placeholder="@lang('labels.pladers.phsObservaciones')"
                      class="form-control" rows="5" cols="9">@if($tarea->observaciones != 'Ninguna'){{ $tarea->observaciones  }} @endif</textarea>
            @if ($errors->has('observaciones')) <p class="help-block">{{ $errors->first('observaciones') }}</p> @endif
        </div>
        </div>
  </div>

  {{-- Panel de Localizaciones --}}
  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <p><b>@lang('labels.labels.lbsLocalizaciones')</b></p>
      <div class="col-sm-12 @if ($errors->has('prov')) has-error @endif "></div>
      <p>@lang('labels.comments.cmtSelecLocalizacion')</p>
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
            <span class="fa fa-times"></span> @lang('labels.buttons.btnCancelar')
        </a>
        <button type="submit"  class="btn btn-success"><span class="fa fa-save"></span> @lang('labels.buttons.btnGuardar')</button>

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

    if(localStorage.getItem('fechas-checked') != undefined){
        $('input [name="todasemana"]').attr('checked', true);
    }

    cargarFechasDataPicker("fechaFinTarea");
    cargarFechasDataPicker("fechaInicioTarea");


});

   $('input [name="todasemana"]').click(function () {
       // colocamos las hora y minutos a ceros
       if( $('input[name="hora"]').val() === ''){
           $('input[name="hora"]').val(0);
       }

       console.log($('input[name=minuto]').val());

       if($('input[name="minuto"]').val() === ''){
           $('input[name="minuto"]').val(0);
       }
   });


   $('input[name="descripcion"]').blur(function(){
       if(validarCampoVacio($(this).val())){
           validarLimitesString(5, 120, $(this));
       }else{
           mostrarErrorForm($(this), 'La descripcion es requerida');
       }
   });

   $('input[name="hora"]').blur(function(){
       if(validarCampoVacio($(this).val())){
           ocultarErrorForm($(this));
       }else{
           mostrarErrorForm($(this), 'La hora es requerida');
       }
   });

   $('input[name="minuto"]').blur(function(){
       if(validarCampoVacio($(this).val())){
           ocultarErrorForm($(this));
       }else{
           mostrarErrorForm($(this), 'El minuto es requerida');
       }
   });



</script>

@endsection
