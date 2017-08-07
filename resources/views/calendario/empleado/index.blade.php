@extends('layouts.app')

@section('titulo')
  Mi Calendario
@endsection

@section('content')

    {{-- ColorPicker --}}
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

    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">Lista de Tareas</h4>
                </div>
                <div class="box-body">
                    <!-- the events -->
                    <div id="external-events">
                        <div class="external-event bg-green">Lunch</div>
                        <div class="external-event bg-yellow">Go home</div>
                        <div class="external-event bg-aqua">Do homework</div>
                        <div class="external-event bg-blue">Work on UI design</div>
                        <div class="external-event bg-red">Sleep tight</div>
                        <div class="checkbox">
                            <label for="drop-remove">
                                <input type="checkbox" id="drop-remove">
                                Eliminar al Desplazar
                            </label>
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
                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                        <button type="button" id="color-chooser-btn" class="btn btn-default btn-block">Seleccionar Color</button>
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
                        <input id="new-event" type="text" class="form-control" placeholder="Titulo de Tarea">

                        <div class="input-group-btn">
                            <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Agregar</button>
                        </div>
                        <!-- /btn-group -->
                    </div>
                    <!-- /input-group -->
                </div>
            </div>
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
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>



                    {{--Formularios de Tarea--}}
                    {{-- Crear tareas --}}
                    {!! Form::open(['route'=>'calendario.empleado.guardarTarea', 'method'=>'POST']) !!}
                    {!! Form::close() !!}
                    {{-- Crear tareas --}}
                    {!! Form::open(['route'=>'calendario.empleado.guardarTarea', 'method'=>'POST']) !!}
                    {!! Form::close() !!}
                    {{--Fin de Formularios--}}



    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{URL::asset('plugins/fullcalendar/fullcalendar.min.js')}}"></script>


    <script>
        $(document).ready(function() {
//            var utils = import('/utils.js');
            var Notificion = new Alert('#notificacion');

        $(function () {

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

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    });

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
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay',
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Dia'
                },

                /* traduccion de los textos */
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],

                allDaySlot: false,
                displayEventTime : false,
                firstDay: 1,
                businessHours: true, // display business hours
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                droppable: true, // this allows things to be dropped onto the calendar !!!

                //Obteniendo las tareas
                events: { url: 'cargarTareas'},

                drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    allDay = true;

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.backgroundColor = $(this).css("background-color");
                    copiedEventObject.borderColor = $(this).css("border-color");

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }

                    /* guardamos el evento creado en la Base de datos */
                    /* objeto Tarea */
                    var tarea = new Object();

                    console.log(copiedEventObject);

                    tarea.titulo = copiedEventObject.title;
                    tarea.fechaInicio = copiedEventObject.start.format('YYYY-MM-DD HH:mm');
                    tarea.color = copiedEventObject.backgroundColor;
                    tarea.todoeldia = allDay;

                    if(allDay){
                        tarea.fechaFin = copiedEventObject.start.format('YYYY-MM-DD HH:mm');
                    }


                    /* Guardamos Tarea Comunes */
                    $.ajax({
                        url: 'guardarTarea',
                        method: 'POST',
                        data: tarea,
                        dataType: 'json',
                        success: function (data) {
                            /* relanzar todas las tareas de Full Calendario */
                            copiedEventObject.re
                            $('#calendar').fullCalendar('rerenderEvents');
                            $('#calendar').fullCalendar('refetchEvents');

                            Notificion.success('La Tarea se guardo correctamente...')
                        }.bind(this), error: function (data) {
                            Notificion.warning('La Tarea NO se guardó correntamente')
                        }.bind(this)
                    });
                },
                eventReceive: function(event){
                    var title = event.title;
                    var start = event.start.format("YYYY-MM-DD[T]HH:MM:SS");
                    $.ajax({
                        url: 'process.php',
                        data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response){
                            event.id = response.eventid;
                            $('#calendar').fullCalendar('updateEvent',event);
                        },
                        error: function(e){
                            console.log(e.responseText);
                        }
                    });
                    $('#calendar').fullCalendar('updateEvent',event);
                },
                /* evento para tomar las rango de horas */
                eventResize: function(event) {
                    var tarea = new Object();

                    tarea.id = event.id;
                    tarea.titulo = event.title;
                    tarea.fechaInicio = event.start.format('YYYY-MM-DD HH:mm');
                    tarea.color = event.backgroundColor;
                    tarea.allDay = event.allDay;

                    if(event.end){
                        tarea.fechaFin = event.end.format('YYYY-MM-DD HH:mm');
                    }else {
                        tarea.fechaFin = 'NULL';
                    }

                    console.log(tarea);

                    /* Metodos para actualizar fecha de finalizacion de una tarea */
                    $.ajax({
                        url: 'actualizarTareaHora',
                        method: 'POST',
                        data: tarea,
                        dataType: 'json',
                        success: function (data) {
                            Notificion.success('La Tarea se actualizo correctamente...')
                        }.bind(this), error: function (data) {
                            console.log(data.err);
                            Notificion.warning('La Tarea NO se guardó correntamente')
                        }.bind(this)
                    });
                },
                eventDrop: function (event, delta) {
                    var tarea = new Object();

                    tarea.id = event.id;
                    tarea.titulo = event.title;
                    tarea.fechaInicio = event.start.format('YYYY-MM-DD HH:mm');
                    tarea.color = event.backgroundColor;
                    tarea.allDay = event.allDay;

                    if(event.end){
                        tarea.fechaFin = event.end.format('YYYY-MM-DD HH:mm');
                    }else {
                        tarea.fechaFin = 'NULL';
                    }

                    console.log(tarea);

                    /* Metodos para actualizar fecha de finalizacion de una tarea */
                    $.ajax({
                        url: 'actualizarTareaHora',
                        method: 'POST',
                        data: tarea,
                        dataType: 'json',
                        success: function (data) {
                            Notificion.success('La Tarea se actualizo correctamente...')
                        }.bind(this), error: function (data) {
                            console.log(data.err);
                            Notificion.warning('La Tarea NO se guardó correntamente')
                        }.bind(this)
                    });
                },

            });

            /* ADDING EVENTS */
            var currColor = "#3c8dbc"; //Red by default
            //Color chooser button
            var colorChooser = $("#color-chooser-btn");
            $("#color-chooser > li > a").click(function (e) {
                e.preventDefault();
                //Save color
                currColor = $(this).css("color");
                //Add color effect to button
                $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
            });

            $('#color-chooser-btn').colorpicker().on('changeColor', function(e) {
                currColor = e.color.toString('rgba');
                //Add color effect to button
                $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
                $('#color-chooser-btn').css({"background-color": currColor, "border-color": currColor, "color": "#fff"});

            });


            $("#add-new-event").click(function (e) {
                e.preventDefault();
                //Get value and make sure it is not null
                var val = $("#new-event").val();
                if (val.length == 0) {
                    return;
                }

                //Create events
                var event = $("<div />");
                event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"})
                    .addClass("external-event");
                event.html(val);
                $('#external-events').prepend(event);

                //Add draggable funtionality
                ini_events(event);

                //Remove event from text input
                $("#new-event").val("");
            });



        });



    });

    </script>
    <style>
        a{
            color: #1c2529;
        }
    </style>
@endsection

