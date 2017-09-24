@extends('layouts.app')

@section('titulo')
  Mi Calendario
@endsection

@section('content')

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
                                   @click="mostrarModalElimnarTareaComun($event, tarea)"
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
                            <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
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
                    <div id="calendar"></div>
                </div>
                <!-- /.box-body -->
            </div>
            @include('calendario/empleado/tarea_modal')
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{URL::asset('plugins/fullcalendar/fullcalendar.min.js')}}"></script>


    <script>
        $(document).ready(function() {
            var Notificion = new Alert('#notificacion');

        $(function () {
            var tooltip = '';
            var modal = '';
            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function () {

                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject);

                });
            }

            ini_events($('#external-events div.external-event'));

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date();
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
            $('#calendar').fullCalendar({
                theme: true,
                // botones customer
                customButtons: {
                    btnNuevaTarea: {
                        text: 'Nueva Tarea +',
                        click: function() {
                            $('#modal-nueva-tarea').modal('toggle');
                        }
                    }
                },
                header: {
                    left: 'prev,next today,  listMonth, btnNuevaTarea',
                    center: 'title',
                    right: 'month, basicWeek, basicDay',
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day:  'Dia',
                    list: 'Lista'
                },

                    /* traduccion de los textos */
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],

                displayEventTime : false,
                firstDay: 1,
                businessHours: true, // display business hours
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                eventOverlap: false,
                //Obteniendo las tareas
                events: { url: 'cargarTareas'},

                eventMouseover: function (data, event, view) {
                    var start = data.start.format('DD/MM/YYYY');
                    var back = LightenDarkenColor(data.backgroundColor, 90);
                    var hora = data.hora;
//                    var end = convertDateFormat(data.end);
                    var end = data.end.format('DD/MM/YYYY');

                    tooltip =
                        "<div id='tooltip' class=\'tooltipevent\' style=\'width:300px; box-shadow: 2px 2px 2px gray; border: 2px solid gray; border-color:"+data.backgroundColor +"; height:17%;background: white;position:absolute; z-index:10001;border-radius:15px; padding: 10px;\'><center style=\'border-bottom: 1px solid aliceblue; display: inline-block; text-shadow: 1px 1px 1px gray; font-weight: bold;margin-bottom: 10px;\'>" + data.descrip + "<label class='badge' style='display: inline-block; float: left; margin-right: 5px;'><span>"+data.nro +"</span></label></center>" +
                        "<br><b style='text-shadow: 1px 1px 1px gray; display: inline-block; width: 100px;'>Fecha Inicio:</b>" + start + "<br>" +
                        "<b style='text-shadow: 1px 1px 1px gray; display: inline-block; width: 100px;'>Fecha Fin:</b>" + end + "<br>" +
                        "<b style='text-shadow: 1px 1px 1px gray; display: inline-block; width: 100px;'>Duracion:</b>" + hora + "</div>";

                    $('body').append(tooltip);
                    $(this).mouseover(function (e) {
                        $(this).css('z-index', 10000);
                        $('.tooltipevent').fadeIn('500');
                        $('.tooltipevent').fadeTo('10', 1.9);
                    }).mousemove(function (e) {
                        $('.tooltipevent').css('top', e.pageY + 10);
                        $('.tooltipevent').css('left', e.pageX + 20);
                    });
                },
                eventMouseout: function (data, event, view) {
                    $(this).css('z-index', 8);
                    $('.tooltipevent').remove();
                },
                dayClick: function (date, allDay, jsEvent, view) {
//                    tooltip.hide();
                    $('#tooltip').hide();
                },

                eventClick: function(data, jsEvent, view) {
                    var start = data.start.format('DD/MM/YYYY');
                    var back = LightenDarkenColor(data.backgroundColor, 90);
                    var hora = data.hora;
                    var end =  data.end.format('DD/MM/YYYY');

                    $('#modal-tarea-Calendario').modal("show");
                    $('#modalTareaTitle').html('Detalle de Tarea Nro.: ' + data.numero);
                    $('#modalTareaNro').html(data.numero);
                    $('#idTarea').html(data.id);
                    $('#modalTareaDesc').html(data.descrip);
                    $('#modalTareaFchIn').html(start);
                    $('#modalTareaFchFn').html(end);
                    $('#modalTareaTmp').html(data.hora);
                    $('#modalTareaStd').html(data.estado);
                    $('#modalTareaStd').css('background',data.backgroundColor );
                    $('#modalTareaStd').css('color',data.textColor );

                    var pathname = window.location.host+'/tareas/tareaProgramadas/' + data.id;
                    $('#verDetalleTarea').attr('action','');
                    $('#verDetalleTarea').attr('action',pathname);
                }

            });
        });

        function convertDateFormat(string) {
            var info = string.split('-');
            return info[2] + '/' + info[1] + '/' + info[0];
        }

        function LightenDarkenColor(col, amt) {

            var usePound = false;

            if (col[0] == "#") {
                col = col.slice(1);
                usePound = true;
            }

            var num = parseInt(col,16);

            var r = (num >> 16) + amt;

            if (r > 255) r = 255;
            else if  (r < 0) r = 0;

            var b = ((num >> 8) & 0x00FF) + amt;

            if (b > 255) b = 255;
            else if  (b < 0) b = 0;

            var g = (num & 0x0000FF) + amt;

            if (g > 255) g = 255;
            else if (g < 0) g = 0;

            return (usePound?"#":"") + (g | (b << 8) | (r << 16)).toString(16);

        }

        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
            e.preventDefault();
            //Save color
            currColor = $(this).css("color");
            //Add color effect to button
            $('#btnAddTarea').css({"background-color": currColor, "border-color": currColor});
        });

    });

//    // eliminar taera
//    $('#eliminarTareaComun').on('click',function () {
//        let divBtnGr = $(this).parents('div');
//        let divBtn = divBtnGr.parents('div');
//
//
//        let idTarea = divBtn.data('tareaComunId');
//        let tituloTarea = divBtn.data('tareaComunTitulo');
//
//        console.log('Hola '+ idTarea);
//    });

    </script>


@endsection

