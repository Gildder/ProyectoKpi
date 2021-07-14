@extends('layouts.app')

@section('titulo')
  Mi Calendario
@endsection

@section('content')

    <script>
        $(document).ready(function () {
            sessionStorage.setItem('inicioSemana', convertDateFormatDB('{!! $semanas->fechaInicio !!}'));
            sessionStorage.setItem('finSemana', convertDateFormatDB('{!! $semanas->fechaFin !!}'));

            sessionStorage.setItem('tipoListado', {{ $agenda }});
            sessionStorage.setItem('inicioSemanaFija', '{!! $semanas->fechaInicio !!}');
            sessionStorage.setItem('finSemanaFija', '{!! $semanas->fechaFin !!}');
            sessionStorage.setItem('calendario', 1);
        });
    </script>


    <link rel="stylesheet" href="{{URL::asset('plugins/colorpicker/bootstrap-colorpicker.css')}}">
    <script src="{{URL::asset('plugins/colorpicker/bootstrap-colorpicker.js')}}"></script>

    {{--    <link rel="stylesheet" href="{{URL::asset('plugins/fullcalendar/fullcalendar.print.css')}}">--}}

    {{-- fullCalendar 2.2.5--}}
    <link rel="stylesheet" href="{{URL::asset('plugins/fullcalendar/fullcalendar.min.css')}}">

    {{-- Jquery --}}
    <link rel="stylesheet" href="{{URL::asset('plugins/cupertino/jquery-ui.min.css')}}">
    <script src="{{URL::asset('plugins/jQueryUI/jquery-ui.min.js')}}"></script>

    {{-- Moment --}}
    <script src="{{URL::asset('plugins/moment/moment.min.js')}}"></script>


    @include('Calendario/empleado/tareaComun/delete')

    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">Estados de Tareas</h4>
                </div>
                <div class="box-body">
                    <!-- the events -->
                    <div id="external row" >
                        @foreach($estados as $estado)
                            <div class="external-state col-xs-4 col-sm-2 col-md-5 col-lg-5"
                                 style="background-color: {{ $estado->color }};
                                         color: {{ $estado->texto }}; margin: 1px;">{{ $estado->nombre }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.box-body -->
            </div>


            {{-- Modal para Nueva Tarea--}}
            @include('tareas/tareaProgramadas/modal/create')

        @verbatim

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">Tareas</h4>
                </div>

                <div class="box-body">
                    <!-- the events -->
                    <div hidden>
                        {{ getTareasComunes() }}
                        {{ cargarFullCalendarioTareas() }}
                    </div>


                    <div id="external-events">
                        <div class="external-event" id="tarea-{{tarea.id }}"
                             :style="{ 'background': tarea.color, color: tarea.textoColor }"
                                v-for="tarea in listaTareaComunes">
                            {{ tarea.titulo }}
                            <div class="btn-group" style="float: right; margin-right: -10px; margin-top: -5px;" id="pnTareaComun">
                                <a href="#" class="btn btn-default btn-sm" @click="agregarTareaComun($event, tarea)"
                                   title="Agregar">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <a href="#" class="btn btn-default btn-sm"
                                   @click="mostrarModalElimnarTareaComun($event, tarea.id, tarea.titulo)"
                                   title="Eliminar">
                                    <i class="fa fa-trash" ></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear Tarea</h3>
                </div>
                <div class="box-body">
                    <form>
                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                        <ul class="fc-color-picker" id="color-chooser">
                            <li><a class="text-aqua" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-blue" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-light-blue" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-teal" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-yellow" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-orange" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-green" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-lime" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-red" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-purple" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-fuchsia" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-muted" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-navy" href="#" @click="cambiarColorBtnAgregar($event)"><i class="fa fa-square"></i></a></li>
                        </ul>
                    </div>
                    <!-- /btn-group -->
                    <div class="input-group">

                        <input id="nuevaTarea"
                               v-model="tituloNuevoTareaComun"
                               maxlength="30"
                               type="text" class="form-control" placeholder="Descripcion Tarea">

                        <div class="input-group-btn">
                            <button id="btnAddTarea" :disabled="tituloTareaComunVacio == false"
                                    type="button" @click.prevent="guardarTareaComunes()"
                                    class="btn btn-primary btn-flat">Agregar</button>
                        </div>
                        <!-- /btn-group -->
                    </div>
                    </form>
                    <!-- /input-group -->
                </div>
            </div>
        @endverbatim
        </div>

        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id="calendarTareaUsuario"></div>
                </div>
                <!-- /.box-body -->
            </div>
            @include('calendario/empleado/tarea_modal')
            <!-- /. box -->
        </div>
        <!-- /.col -->

        @verbatim
        <div hidden>
            {{ cargarFullCalendarioTareas() }}
        </div>
        @endverbatim
    </div>

    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{URL::asset('plugins/fullcalendar/fullcalendar.min.js')}}"></script>




@endsection

