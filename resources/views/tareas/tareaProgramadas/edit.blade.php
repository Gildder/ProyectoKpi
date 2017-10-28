@extends('layouts.app')

@section('titulo')
    Tarea Nro. {{$tarea->numero}}
@endsection

@section('content')

    <!-- Nuevo -->
    <div class="panel panel-default"  id="formEditarTarea">
        <div class="panel-heading">
            <a
                href="{{route('tareas.tareaProgramadas.show', $tarea->id)}}"
                @click="mostrarModalLoading()"  class="btn btn-primary btn-xs pull-left btn-back"  title="Volver">
                <span class="fa fa-reply"></span></a>


            <p class="titulo-panel">@lang('labels.panels.pnsEditar')</p>
        </div>

        <div class="panel-body">

            {!!Form::model($tarea, ['route'=>['tareas.tareaProgramadas.update', $tarea->id], 'method'=>'PUT'])!!}

            <div class="col-sm-12">
                <p v-show="tipolistatarea == 2">Tareas Programadas de <b class="fechaTareas" id="limFechaInicio"></b> al
                    <b class="fechaTareas" id="limFechaFin"></b></p>
                <p>@lang('labels.comments.obligatorioAttr')</p>
            </div>

            @include('partials/alert/error')
            {{-- Descripcion --}}
            <div class="">
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
            </div>

            {{-- Fechas de Inicio y Fin --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row"
                 style="display:{{ (\Usuario::get('verFechaEstimadas')== true || $agenda === '1')?'block':'none'}}">
                {{-- Fecha Inicio de Tarea --}}
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                    <div class="form-group
                        @if ($errors->has('fechaInicio'))
                            has-error
                        @endif" id="divFechaInicio">
                        <label for="fechaInicio">@lang('labels.labels.lbsFechaInicio')</label>
                        <div class="input-group row margenFecha">
                            <div class="input-group-addon row">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="fechaInicioTarea"  style="z-index: 3000"
                                   name="fechaInicio"
                                   value="{{ $tarea->fechaInicio }}"
                                   placeholder="@lang('labels.pladers.phsFechaInicio')"
                                   class="form-control"  required>
                        </div>
                        <span></span>
                        @if ($errors->has('fechaInicio'))
                            <p class="help-block">{{ $errors->first('fechaInicio') }}</p>
                        @endif
                    </div>
                </div>

                {{-- Fecha Fin de Tarea --}}
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                    <div class="form-group
                        @if ($errors->has('fechaFin'))
                            has-error
                        @endif" id="divFechaFin">
                        <label for="fechaFin">@lang('labels.labels.lbsFechaFin')</label>
                        <div class="input-group row margenFecha">
                            <div class="input-group-addon row">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="fechaFinTarea"  style="z-index: 3000"
                                   name="fechaFin"
                                   value="{{ $tarea->fechaFin }}"
                                   placeholder="@lang('labels.pladers.phsFechaFin')"
                                   class="form-control"  required>
                        </div>
                        <span></span>
                        @if ($errors->has('fechaFin'))
                            <p class="help-block">{{ $errors->first('fechaFin') }}</p>
                        @endif
                    </div>
                </div>
                <a href="#" class="btn btn-primary btn-sm btnRefreshDate"
                   v-show="tipolistatarea == 2"
                   id="refreshEditDateAgenda"
                   title="Limpiar Fechas" ><i class="fa fa-repeat"></i></a>
            </div>


            {{-- estado --}}
            <div class="row col-sm-12">
                <div class="form-group  col-xs-12 col-sm-3 col-md-3 col-lg-2">
                    <label >@lang('labels.labels.lbsEstado') </label>
                    <select class="form-control" name="estado">
                        <option value="" >Seleccionar...</option>
                        @foreach($estados as  $estado)
                            @if($estado->id == $tarea->estado_id)
                                <option value="{{ $estado->id }}" selected>{{ $estado->nombre }}</option>
                            @endif
                            <option value="{{ $estado->id }}" >{{ $estado->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Hora --}}
            <div class="row col-sm-12">
                <div class= "form-group   col-xs-12 col-sm-3 col-md-3 col-lg-1
                    @if ($errors->has('hora'))
                        has-error
                    @endif">
                    <label for="hora">@lang('labels.labels.lbsHora')</label>
                        <input type="number" name="hora"
                           min="0"
                           max="150"
                           value="{{ \Calcana::sacarHoras($tarea->tiempo) }}"
                           placeholder="@lang('labels.pladers.phsHora')"
                           class="form-control" value="0"  required >
                        <span></span>
                    @if ($errors->has('hora'))
                        <p class="help-block">{{ $errors->first('hora') }}</p>
                    @endif
                </div>

            {{--Minuto--}}
            <div class="form-group   col-xs-12 col-sm-3 col-md-3 col-lg-1
                @if ($errors->has('minuto'))
                    has-error
                @endif">
                    <label for="minuto">@lang('labels.labels.lbsMinuto')</label>
                    <input type="number" name="minuto"
                           placeholder="@lang('labels.pladers.phsMinuto')"
                           min="0"
                           max="9999"
                           class="form-control" value="{{ \Calcana::sacarMinutos($tarea->tiempo) }}"
                           required>
                        <span></span>
                    @if ($errors->has('minuto'))
                        <p class="help-block">{{ $errors->first('minuto') }}</p>
                    @endif
                </div>
            </div>

            {{-- Observaciones --}}
            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px;">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-5">
                    <label>@lang('labels.labels.lbsObservaciones')</label>
                    <textarea type="textArea"
                        id="observacionEdit"
                        name="observaciones"  maxlength="120"
                        placeholder="@lang('labels.pladers.phsObservaciones')"
                        class="form-control" rows="5" cols="9">

                        @if($tarea->observaciones != 'Ninguna')
                        {{trim($tarea->observaciones)}} @else @endif
                    </textarea>
                </div>
            </div>

            {{-- Fin Body Panel --}}
        </div>

        {{-- Footer de Panel --}}
        <div class="panel-footer text-right">
            <a  id="cancelar" href="{{route('tareas.tareaProgramadas.show', $tarea->id)}}"
                class="btn btn-danger"
                type="reset"><span class="fa fa-times">
          </span> @lang('labels.buttons.btnCancelar')</a>

            <button  href="#" type="submit"   class="btn btn-success"><span class="fa fa-save"></span> @lang('labels.buttons.btnGuardar')</button>
        </div>
        {!! Form::hidden('id' ) !!}
    </div>

    <!-- Fin Nuevo -->

    <style>
        .btnRefreshDate {
            position: absolute;
            float: right;
            top: 35px;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#observacionEdit').val($.trim($('#observacionEdit').val()));



            if(sessionStorage.getItem('tipoListado') != 2) {
                cargarFechasDataPicker("fechaFinTarea");
                cargarFechasDataPicker("fechaInicioTarea");
            }else{
//                if( $('.alert').is(":visible") ) {
//                    mostrarCargando(false);
//                }

                getFechasSemanaAnio($('input[name="fechaInicio"]'));

                cargarFechasDataPickerRefresh("fechaInicioTarea", 0);
                cargarFechasDataPickerRefresh("fechaFinTarea", 1);
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

        $('input[name="fechaInicio"]')
            .change(function(){
                validarFechaTarea($(this), 0);

            }).blur(function(){
            validarFechaTarea($(this), 0);
        });

        $('input[name="fechaFin"]').change(function(){
            validarFechaTarea($(this), 1);
        }).blur(function(){
            validarFechaTarea($(this), 1);
        });


        $('#refreshEditDateAgenda').click(function () {
            mostrarCargando(true);
            RefrescarDatePicker();

            mostrarCargando(false);

        });

        function RefrescarDatePicker() {
            let fechaInicio = sessionStorage.getItem('inicioSemanaFija');
            let fechaFin = '31/12/'+new Date().getFullYear();
            // todo:este valor tiene que ser configurable desde el servidor, por la gerencia evaluadore
            sessionStorage.setItem('inicioSemana', fechaInicio);
            sessionStorage.setItem('finSemana', fechaFin);

            actualizarFechasCalendario('fechaInicioTarea');
            actualizarFechasCalendario('fechaFinTarea');

            // Limpiamos los input de las fechas
            $("input[name='fechaInicio']").val('');
            $("input[name='fechaFin']").val('');

            $("#divFechaInicio").removeClass('has-error');
            $("#divFechaFin").removeClass('has-error');

            $("#divFechaFin").children('span')
                .removeClass('help-block')
                .html('')
                .hide();

            $("#divFechaInicio").children('span')
                .removeClass('help-block')
                .html('')
                .hide();
        }

    </script>

@endsection





