/**
 * Created by gildder on 15/06/2017.
 */
$(document).ready(function() {
    /* jshint esnext:true */

    // Variables Globales
    var Vue = require('vue');
    var Notificion = new Alert('#notificacion');
    var chart;
    var resourceWidget;
    var vm;


    var utils = require('./helper/utils.js');
    Vue.use(require('vue-resource'));


    // Componentes VueJS
     Vue.component('nuevo-modal',
        require('./components/nuevo_widget/ModalWidget.vue')
    );

    Vue.component('fila-widget',
        require('./components/nuevo_widget/Fila_Widget.vue')
    );

    Vue.component('selector-modal',
        require('./components/nuevo_widget/selector_modal.vue')
    );


    Vue.component('panel-widget',
        require('./components/widget/PanelWidget.vue')
    );

    Vue.component('chart-widget',
        require('./components/widget/grafica.vue')
    );

    Vue.component('loading-comp',
        require('./components/loading/loading.vue')
    );

    Vue.component('estado-tarea',
        require('./components/tareas/estados.vue')
    );

    Vue.component('tabla-indicador',
        require('./components/indicadores/TablaIndicador.vue')
    );

    // componente de busquedas de ticket  supervisores
    Vue.component('tarea-filtro-supervisores',
        require('./components/supervisores/tareas/filtro.vue')
    );

    Vue.component('tarea-tabla-supervisores',
        require('./components/supervisores/tareas/tabla.vue')
    );


    /* tareas programadas */
    Vue.component('tabla-tarea',
        require('./components/tareas/tabla/tabla.vue')
    );

    //noinspection JSAnnotator
    vm = new Vue({
        el: 'body',
        /***************************************** DATA ***********************************************************/
        data: {
            filtroVista: {},
            cumplimiento: 0,
            descripciones: '',
            tablaTotalDatos: {},
            chartTotalDatos: {},


            //Widget Panel
            textOpenWidget: 'Abrir Widget',
            seeOpenWidget: false,
            isChart: false,
            descripcionDasboardTipo: '',

            // Chart C3Js
            idChart: "#chart_Total",
            chart: {},
            chartData: {},
            chartCaterias: {},

            // Datos para Modal Widget
            panelWidgets: [],

            // Login
            type_pass: true,
            /***************************** datos de la semana actual ******************************/
            datoSemana: {
                id: 0,
                anio: 0,
                mes: '',
                semana: 0,
                fechaInicio: '',
                fechaFin: ''
            },

            //******* Tarea ********
            btnResultado: 0,
            btnEditar: 0,
            btnEliminar: 0,
            utilizarfechasestimadas: true,
            tareaNueva: {
                id: '',
                descripcion: '',
                fechaInicio: '',
                fechaFin: '',
                hora: 0,
                minuto: 0,
                agenda: 0,
            },

            tareasSupervisadas: [],
            /**************** Tareas de Calendario ********************/
            listaTareasCalendario: [],

            /**************** Tarea Comunes ****************/
            listaTareaComunes: {
                id: 0,
                titulo: '',
                color: '',
                textoColor: ''
            },
            tareaComun:{
                id: 0,
                titulo: '',
                color: '',
                textoColor: ''
            },
            tituloNuevoTareaComun: '',


            // Empelados
            isTecnico: 0,

            // Buscar Tareas
            tareaBuscar: {},
            id_usuario_buscar: 12,
            /******************* Busqueda de Usuarios ***************************/
            btnFiltroTareaSupervisor: true,


            /***Edita tareas agenda **/
            tipolistatarea: sessionStorage.getItem('tipoListado'),


            /**************** Aprobaciones **************/
            nombreAprobador: '',
            apellidoAprobador: '',
            usuariosPosibleAprobador: [],
            usuarioAprobador: '',
            usuarioAprobador_id: '',
            opcionAprobador_id: '',
            evaluadorAprobador_id: '',
            btnGuardarEnable: false,
            nuevoAprobacion: false,
        },

        ready: function () {
            resourceWidget = this.$resource('/evaluadores/evaluados/obtenerEvaluadorWidget{/id}');

            // corregir este filtro
            if (window.location.pathname === '/evaluadores/evaluados/dashboard' ){
                this.obtenerListaWidget();
            }

            // cargamos los fecha de inicio y fin de semana
            // this.obtenerSemanaActual();
        },
        /***************************************** COMPUTED ***********************************************************/
        computed: {
            validarCheckFechasEstimadas: function () {
                if (this.utilizarfechasestimadas){
                    if($('input[name=hora]') === ''){
                        $('input[name=hora]').val(0);
                    }

                    if($('input[name=minuto]') === ''){
                        $('input[name=minuto]').val(0);
                    }
                }
            },
            listaVacia: function() {
                if(this.listaTareaComunes.length == 0 ){
                    return true;
                }

                return false;
            },

            tituloTareaComunVacio: function() {
                if(this.tituloNuevoTareaComun.length > 0 ){
                    return true;
                }

                return false;
            },
            verificarValidarTareanueva: function () {
                if(
                    this.tareaNueva.descripcion !== '' &&
                    this.tareaNueva.fechaInicio !== '' &&
                    this.tareaNueva.fechaFin !== '' &&
                    this.tareaNueva.hora !== '' &&
                    this.tareaNueva.minuto !== ''
                ){
                    return false;
                }else{
                        return true;
                }
            }
        },
        /************************************************* EVENTS ******************************************************/
        events: {
            'agregarWidgetPanel': function (widget) {
                this.obtenerListaWidget();
            },
            'lista-widget': function (lista) {
                this.panelWidgets = lista;
            },
            'eliminar-widget': function (id) {
                resourceWidget = this.$resource('eliminarEvaluadorWidget/{id}');

                resourceWidget.delete({id: id}).then( function (response) {
                    this.panelWidgets.$remove(id);
                    // this.panelWidgets = response.data;

                    $('#capa-indicadores-'+id).css('display', 'none');

                    this.obtenerListaWidget();
                    Notificion.success('El Widget se elimino correctamente!');
                }, function (response) {
                    Notificion.warning('El Widget No elimino, por favor verificar con su administrador!');
                });
            },
            'buscar-tarea-supervidor': function (tareas) {
                this.tareasSupervisadas = tareas;
                $('#tareaBuscadasSupervisadas').DataTable( {
                    ajax: this.tareasSupervisadas
                } );
            }
        },
        /************************************************* METHODS *****************************************************/
        methods: {
            /************************************** Aprobacion ******************************************/
            buscarUsuariosAprobador: function ($event) {
                utils.mostrarCargando(true);

                $event.preventDefault();

                $.ajax({
                    url: '/procesos/aprobaciones/buscarUsuario',
                    method: 'POST',
                    data: { nombre: String(this.nombreAprobador), apellido: String(this.apellidoAprobador) },
                    dataType: 'json',
                    success: function (data) {
                        this.usuariosPosibleAprobador = data.usuarios;

                        utils.mostrarCargando(false);
                    }.bind(this), error: function (data)
                    {
                        console.log('Upps,  se encontraron problemas');

                        utils.mostrarCargando(false);
                    }.bind(this)
                })
            },

            guardarUsuarioAprobador: function ($event) {
                $event.preventDefault();

                if(this.validarNuevoAprobador()) {
                    utils.mostrarCargando(true);

                    let objeto = {evaluador_id: this.evaluadorAprobador_id, opcion_id: this.opcionAprobador_id, user_id: this.usuarioAprobador_id};
                    $.ajax({
                        url: '/procesos/aprobaciones/guardarAprobador',
                        method: 'POST',
                        data: objeto,
                        dataType: 'json',
                        success: function (data) {

                            if(data.success) {
                                this.limpiarFormularioAprobacion();

                                utils.mostrarCargando(false);

                                Notificion.success('Se guardo el nuevo aprobador correctamente');
                            }else{
                                Notificion.warning('Se encontraron problemas al guardar');
                            }
                        }.bind(this), error: function (data) {
                            Notificion.warning('Upps, No se guardo por favor consulte con el administrador');
                            utils.mostrarCargando(false);
                        }.bind(this)
                    })
                }
            },
            quitarUsuarioAprobador: function ($event) {
                $event.preventDefault();

                this.usuarioAprobador = '';
                this.usuarioAprobador_id = '';
            },
            cargarUsuarioAprovador: function($event, usuario){
                $event.preventDefault();

                this.usuarioAprobador = usuario.nombres + ' '+ usuario.apellidos;
                this.usuarioAprobador_id = usuario.id;
            },
            validarNuevoAprobador: function () {
                if(this.usuarioAprobador_id === '' ){
                  Notificion.error('Agrege un usuario');
                  return false;
                }

                if(this.opcionAprobador_id === '' ){
                    Notificion.error('Por favor, selecione una aprobacion');
                    return false;
                }

                if(this.evaluadorAprobador_id === '' ){
                    Notificion.error('Por favor, selecione un evaluador');
                    return false;
                }

                return true;

            },
            mostrarNuevaAprobacion: function ($event) {
                $event.preventDefault();

               this.nuevoAprobacion = true;
            },
            ocultarNuevaAprobacion: function ($event) {
                $event.preventDefault();

                this.limpiarFormularioAprobacion();

            },

            limpiarUsuarioBuscados: function ($event) {
                $event.preventDefault();

                this.usuariosPosibleAprobador = [];

            },
            limpiarFormularioAprobacion: function () {
                this.nuevoAprobacion = false;

                this.usuarioAprobador_id = '';
                this.opcionAprobador_id = '';
                this.usuarioAprobador = '';
                this.usuariosPosibleAprobador = [];
            },
            /******************************* Obtener la semana ****************************************/
            obtenerSemanaActual: function obtenerSemanaActual() {
                let tipo = sessionStorage.getItem('agendas');

                $.ajax({
                    url: '/tareas/tareaProgramadas/getSemanaAnioFecha',
                    methos: 'GET',
                    data: { agenda: tipo },
                    dataType: 'json',
                    success: function (data) {
                        this.datoSemana.id = data.tarea.id;
                        this.datoSemana.anio = data.tarea.anio;
                        this.datoSemana.mes = data.tarea.mes;
                        this.datoSemana.semana = data.tarea.semana;
                        this.datoSemana.fechaInicio = data.tarea.fechaInicio;
                        this.datoSemana.fechaFin = data.tarea.fechaFin;
                    }.bind(this),
                    error: function (data) {
                        console.log('Upps, no se ontemer los datos de la semana actual');
                    }.bind(this)
                });
            },
            obtenerFechasEstimadasTareas: function () {
                if(localStorage.getItem('fechas-checked') != undefined){
                    return localStorage.getItem('fechas-checked');
                }else{
                    return false;
                }
            },
            obtenerListaWidget: function () {
                resourceWidget.get().then( function (response) {
                    this.panelWidgets = response.data;


                }, function (reponse){

                });
            },
            importarLdap: function () {
                this.$http.get('/administrador/importarldap').then(function (response) {
                    var success = JSON.parse(response.bodyText).success;

                    if(success){
                        Notificion.success('Se realizo la importacion de correctamente!');

                    }else{
                        Notificion.warning('No se realizo la importacion correctamente!');
                    }
                }, function (response) {
                    Notificion.error('No se conecto al servidor correctamente!');
                });
            },
            cambiarVista: function (param) {
                this.filtroVista = JSON.parse(localStorage.getItem('filtroDashboard'));
                this.filtroVista.tipo = param;
                this.guardarLocalStore('filtroDashboard', this.filtroVista);

                this.obtenerDatosSemana();
            },

            obtenerDatosSemana: function () {
                this.$http.post('obtenerTablaTotal/' + this.filtroVista.tipo + '/' + this.filtroVista.mesBuscado).then(function (response) {
                    this.tablaTotalDatos = JSON.parse(response.data.indicadores);
                    this.cumplimiento = response.data.cumplimiento;
                    this.descripciones = JSON.parse(response.data.descripciones);
                });

                // obtener los datos de la grafica segun filtro
                this.$http.post('obtenerChartTotal/' + this.filtroVista.tipo + '/' + this.filtroVista.mesBuscado).then(function (response) {
                    this.chartData = JSON.parse(response.data.indicadores);
                    this.chartCaterias = JSON.parse(response.data.categorias);
                    // cargarDato();
                });
            },
            obtenerFiltroMes: function () {
                var opcionMes = $('#selectOpcion option:selected').val();

                this.$http.post('filtroMes/' + opcionMes).then(function (response) {
                    // this.primerMes = response.data.primerMes;
                    // alert(response.data.primerMes);
                });
            },
            abrirWidget: function () {
                if (this.seeOpenWidget) {
                    this.textOpenWidget = 'Abrir Widget';
                    this.seeOpenWidget = false;
                    $('#btnOpenWidget').addClass('btn-bitbucket');
                    $('#btnOpenWidget').removeClass('btn-danger');
                } else {
                    this.textOpenWidget = 'Cerrar Widget';
                    this.seeOpenWidget = true;

                    $('#btnOpenWidget').removeClass('btn-bitbucket');
                    $('#btnOpenWidget').addClass('btn-danger');
                }

                $('#nuevoWidget').toggle(500);
            },

            // login
            mostrarContrasenia: function ($event) {
                $event.preventDefault();
                if (this.type_pass){
                    this.type_pass=  false;
                }else {
                    this.type_pass=  true;
                }
            },
            mostrarModalLoading: function () {
                utils.mostrarCargando(true);
            },

            mostrarDesabilitar: function ($this) {
                alert($this);
            },

            /* Supervisados*/
            verTareasSupervisados:  function () {
                alert('hoal');
            },

            /* buscar tareas de supervisores */
            buscarTareasSupervisores: function () {
                alert('Hola Mundo');
            },
            /******************** Metodos del modulo de Tareas *******************/
            mostrarNuevaTarea: function ($event) {
                $event.preventDefault();

                // mostrar la ventana de modal de nueva tarea
                $('#modal-nueva-tarea').modal('toggle');

                this.limpiarTareaNueva();
            },
            cancelarNuevaTarea: function ($event) {
                $event.preventDefault();

                $('#modal-nueva-tarea').modal('toggle');

                this.limpiarTareaNueva();
            },
            limpiarTareaNueva: function () {
                this.tareaNueva.id= 0;
                this.tareaNueva.descripcion= '';
                this.tareaNueva.fechaInicio = '';
                this.tareaNueva.fechaFin= '';
                this.tareaNueva.hora= 0;
                this.tareaNueva.minuto= 0;
                this.tareaNueva.agenda= sessionStorage.getItem('agendas');
            },

            guardarTareaNueva: function ($event) {
                $event.preventDefault();

                utils.mostrarCargando(true);

                let token = $('input[name=_token]').val();

                // actualizar el tipo de agenda
                let agenda = sessionStorage.getItem('agendas');
                if(agenda !== undefined){
                    this.tareaNueva.agenda = sessionStorage.getItem('agendas');
                }

                $.ajax({
                    url: '/calendario/empleado/guardarTarea',
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': token },
                    data: this.tareaNueva,
                    dataType: 'json',
                    success: function (data) {
                        if(data.success === true){
                            if(sessionStorage.getItem('calendario') == 1){
                                $('#calendarTareaUsuario').fullCalendar( 'refetchEventSources', { url: 'cargarTareas'} );
                            }else{
                               this.$broadcast('actuliza-tareas');
                            }

                            Notificion.success('Se guardo correctamente', 10000);
                            $('#modal-nueva-tarea').modal('hide');


                            this.limpiarTareaNueva();


                        }else{
                            Notificion.error(data.message, 10000);
                        }
                        utils.mostrarCargando(false);
                    }.bind(this),
                    error: function (data){
                        utils.mostrarCargando(false);
                        $('#modal-nueva-tarea').modal('show');

                        var errors = data.responseJSON;
                        $.each(errors, function (key, value) {
                            Notificion.error(value, 10000);

                        });
                    }.bind(this)
                })

            },

            /********************************** Full Calendario  *****************************************/
            cargarTareasCalendario: function () {

                $.ajax({
                    url: 'cargarTareas',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        this.listaTareasCalendario = data;
                    }.bind(this), error: function (data) {
                        console.log('Uppps, Existen problemas en cargar tareas en servidor consulte al Administrador');
                    }.bind(this)
                })
            },
            cargarFullCalendarioTareas: function () {
                this.cargarTareasCalendario();

                var tooltip = '';
                var modal = '';

                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var date = new Date();
                var d = date.getDate(),
                    m = date.getMonth(),
                    y = date.getFullYear();


                $('#calendarTareaUsuario').fullCalendar({
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
                    events: {
                        url: 'cargarTareas',
                        cache: true
                    },

                    eventMouseover: function (data, event, view) {
                        try {
                            var start = data.start.format('DD/MM/YYYY');
                            var back = data.backgroundColor;
                            var hora = data.hora;
                            var end = data.end.format('DD/MM/YYYY');

                            tooltip =
                                "<div id='tooltip' class=\'tooltipevent\' style=\'width:300px; box-shadow: 2px 2px 2px gray; border: 2px solid gray; border-color:" + data.backgroundColor + "; height:180px;background: white;position:absolute; z-index:10001;border-radius:15px; padding: 10px;\'><center style=\'border-bottom: 1px solid aliceblue; display: inline-block; text-shadow: 1px 1px 1px gray; font-weight: bold;margin-bottom: 10px;\'>" + data.descrip + "<label class='badge' style='display: inline-block; float: left; margin-right: 5px;'><span>" + data.nro + "</span></label></center>" +
                                "<br><b style='text-shadow: 1px 1px 1px gray; display: inline-block; width: 100px;'>Fecha Inicio:</b>" + start + "<br>" +
                                "<b style='text-shadow: 1px 1px 1px gray; display: inline-block; width: 100px;'>Fecha Fin:</b>" + end + "<br>" +
                                "<b style='text-shadow: 1px 1px 1px gray; display: inline-block; width: 100px;'>Duracion:</b>" + hora + "</div>";
                        }catch (Exception){
                            tooltip =
                                "<div id='tooltip' class=\'tooltipevent\' style=\'width:300px; box-shadow: 2px 2px 2px gray; border: 2px solid gray; border-color:" + data.backgroundColor + "; height:180px;background: white;position:absolute; z-index:10001;border-radius:15px; padding: 10px;\'><center style=\'border-bottom: 1px solid aliceblue; display: inline-block; text-shadow: 1px 1px 1px gray; font-weight: bold;margin-bottom: 10px;\'>" + data.descrip + "<label class='badge' style='display: inline-block; float: left; margin-right: 5px;'><span>" + data.nro + "</span></label></center>" +
                                "<br><b style='text-shadow: 1px 1px 1px gray; display: inline-block; width: 100px;'>Fecha Inicio:</b>Fecha Invalida<br>" +
                                "<b style='text-shadow: 1px 1px 1px gray; display: inline-block; width: 100px;'>Fecha Fin:</b>Fecha Invalida<br>" +
                                "<b style='text-shadow: 1px 1px 1px gray; display: inline-block; width: 100px;'>Duracion:</b>" + hora + "<br><b class='label label-danger'>ERROR: Llame al Administrado, Por favor</b></div>";
                        }

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
                        $('#tooltip').hide();
                    },

                    eventClick: function(data, jsEvent, view) {
                        try {
                            var start = data.start.format('DD/MM/YYYY');
                            var back = data.backgroundColor;
                            var hora = data.hora;
                            var end = data.end.format('DD/MM/YYYY');
                        }catch(Exception){
                            var start = 'Fecha Invalida';
                            var back = data.backgroundColor;
                            var hora = data.hora;
                            var end = 'Fecha Invalida';
                        }

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
                        $('#modalTareaObs').html(data.observaciones );

                        var pathname = window.location.host+'/tareas/tareaProgramadas/' + data.id;
                        $('#verDetalleTarea').attr('action','');
                        $('#verDetalleTarea').attr('action',pathname);

                        /// verificamos si puede eliminar
                        if(data.can_delete === 0){
                            $('#borrarCalendar').css('display', 'none');
                        } else {
                            $('#borrarCalendar').css('display', 'inline-block');
                        }

                        if(data.can_change === 0){
                            $('#finalizarCalendar').css('display', 'none');
                            $('#editarCalendar').css('display', 'none');
                        } else {
                            $('#finalizarCalendar').css('display', 'inline-block');
                            $('#editarCalendar').css('display', 'inline-block');
                        }


                        let hrefFinalizar = '/tareas/tareaProgramadas/resolver/'+ data.id;
                        let hrefEditar = '/tareas/tareaProgramadas/'+data.id+'/edit';
                        let href = '/tareas/tareaProgramadas/' + data.id;
                        $('a[name=ver]').attr('href', href );
                        $('#modalidTaraeEliminar').val(data.id);

                        if(data.can_change === 0){
                            $('#finalizarCalendar').css('display', 'none');
                            $('#editarCalendar').css('display', 'none');
                        } else {
                            $('#finalizarCalendar').css('display', 'inline-block');
                            $('#editarCalendar').css('display', 'inline-block');

                            $('#finalizarCalendar').attr('href', hrefFinalizar );
                            $('#editarCalendar').attr('href', hrefEditar );
                        }

                    }

                });



            },
            mostrarEliminarTareaCalendario: function ($event) {
                $event.preventDefault();

                $('#modal-delete-tarea-calendario').modal('show');
                $('#idTaraeEliminar').val($('#idTarea').html());
                $('#idTareaDato').html($('#idTarea').html());

            },
            cancelarElimnarTarea: function () {
                $('#modal-delete-tarea-calendario').modal('hide');
                $('#idTaraeEliminar').val('');

            },
            eliminarTarea: function ($event) {
                $event.preventDefault();
                let tarea_id = $('#idTaraeEliminar').val();

                $.ajax({
                    url: '/tareas/tareaProgramadas/eliminarTareaAjax',
                    method: 'GET',
                    data: { id: $('#idTaraeEliminar').val() },
                    dataType: 'json',
                    success: function (data) {
                        if(data.success) {
                            $('#modal-delete-tarea-calendario').modal('hide');
                            $('#modal-tarea-Calendario').modal('hide');
                            $('#calendarTareaUsuario').fullCalendar('refetchEventSources', {url: 'cargarTareas'});
                            Notificion.success(data.message);
                        }
                    }.bind(this),
                    error: function (data) {
                        $('#modal-delete-tarea-calendario').modal('hide');
                        Notificion.warning('No se elimino la tarea, Por favor consulte al administrador')
                    }.bind(this)
                });



            },
            borrarTareaNueva: function borrarTareaNueva($event, tarea_id) {
                $.ajax({
                    url: '/tareas/tareaProgramadas/' + tarea_id,
                    method: 'DELETE',
                    data: { id: tarea_id },
                    dataType: 'json',
                    success: function (data) {}.bind(this),
                    error: function (data) {}.bind(this)
                });
            },
            cambiarColorBtnAgregar: function($event) {
                $event.preventDefault();

                //Cambiamos el color del boton Agregar
                var currColor = $("#color-chooser-btn").css("color");

                //Colocamos el color al button
                $('#btnAddTarea').css({"background-color": currColor, "border-color": currColor});
            },
            /************************************************* Tarea Comunes *****************************************/
            guardarTareaComunes: function(){
                var color = $('#btnAddTarea').css("backgroundColor");
                $.ajax({
                    url: 'guardarTareaComun',
                    method: 'POST',
                    data: { titulo: this.tituloNuevoTareaComun, color: color },
                    dataType: 'json',
                    success: function (data) {
                        Notificion.success('Se guardo correctamente', 10000);

                        this.listaTareaComunes = data.tareas;
                        this.tituloNuevoTareaComun = '';
                    }.bind(this), error: function (data) {
                        Notificion.error('Uppps, Existen problemas en servidor consulte al Administrador', 10000);
                    }.bind(this)
                })
            },
            getTareasComunes: function(){
                $.ajax({
                    url: 'getTareaComunes',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        this.listaTareaComunes = data.tareas;
                    }.bind(this), error: function (data) {
                        Notificion.success('Uppps, Existen problemas en servidor consulte al Administrador', 10000);
                    }.bind(this)
                })
            },
            eliminarTareasComunes: function($event){
                $event.preventDefault();

                $.ajax({
                    url: 'eliminarTareaComun',
                    method: 'POST',
                    data: { id: this.tareaComun.id },
                    dataType: 'json',
                    success: function (data) {
                        this.listaTareaComunes = data.tareas;

                        // quitamos div de la vista
                        $('tarea-'+this.tareaComun.id).remove();

                        this.limpiarTareaComun();

                        $('#modal-delete-tarea-comun').modal('toggle');

                        Notificion.success('Se elimino correcntamente', 10000);

                    }.bind(this), error: function (data) {
                        Notificion.success('Uppps, Existen problemas en servidor consulte al Administrador', 10000);

                    }.bind(this)
                })
            },
            mostrarModalElimnarTareaComun: function($event, id, titulo){

                $event.preventDefault();

                this.tareaComun.id = id;
                this.tareaComun.titulo = titulo;

                $('#modal-delete-tarea-comun').modal('toggle');
            },
            cancelarElimnarTareaComun: function ($event) {
                $event.preventDefault();

                this.limpiarTareaComun();

                $('#modal-delete-tarea-comun').modal('toggle');

            },
            limpiarTareaComun: function () {
                this.tareaComun.id = 0;
                this.tareaComun.titulo = '';
                this.tareaComun.color = '';
                this.tareaComun.textoColor = '';
            },
            agregarTareaComun: function ($event, tarea) {

                this.tareaComun = tarea;

                $('#modal-nueva-tarea').modal('toggle');

                this.tareaNueva.descripcion = this.tareaComun.titulo;
            },
            /************************************** TArea de Supervisores ******************************************/
            mostrarFiltrosTareasSupervisores: function () {
                // console.log($event);
                // $event.preventDefault();
                if(this.textoFiltro === 'Mostrar'){
                    this.textoFiltro = 'Ocultar';
                    this.btnFiltroTareaSupervisor = false;
                }else{
                    this.textoFiltro = 'Mostrar';
                    this.btnFiltroTareaSupervisor = true;
                }

            }


        },


    });
    /* fin de vm de Vuejs */


});
