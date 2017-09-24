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

    Vue.component('input-date',
        require('./components/date/inputDate.vue')
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

    /* tareas programadas */
    Vue.component('tabla-tarea',
        require('./components/tareas/tabla/tabla.vue')
    );

    //noinspection JSAnnotator
    vm = new Vue({
        el: 'body',
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

        },
        ready: function () {
            resourceWidget = this.$resource('/evaluadores/evaluados/obtenerEvaluadorWidget{/id}');

            // corregir este filtro
            if (window.location.pathname === '/evaluadores/evaluados/dashboard' ){
                this.obtenerListaWidget();
            }
        },
        computed: {
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
            }
        },
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
                    alert(JSON.stringify(response));
                });
            },

            // 'editar-widget': function (widget) {
            //     this.$dispatch('cargar-widget', widget);
            // },
        },
        methods: {
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
            cargarDatosNuevaTarea: function () {
                this.tareaNueva.agenda = $('input[name=agenda]').val();
            },
            mostrarNuevaTarea: function ($event) {
                $event.preventDefault();

                // mostrar la ventana de modal de nueva tarea
                $('#modal-nueva-tarea').modal('toggle');

                this.limpiarTareaNueva();

                sessionStorage.setItem('sntu', true);
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
                this.tareaNueva.agenda= 0;
            },

            /********************************** Tarea Comunes *****************************************/
            guardarTareaComunes: function(){
                var color = $('#btnAddTarea').css("backgroundColor");
                $.ajax({
                    url: 'guardarTareaComun',
                    method: 'POST',
                    data: { titulo: this.tituloNuevoTareaComun, color: color },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data.tareas);

                        Notificion.success('Se guardo correctamente.', 1000);

                        this.listaTareaComunes = data.tareas;
                        this.tituloNuevoTareaComun = '';
                    }.bind(this), error: function (data) {
                        alert('Uppps, Existen problemas en servidor consulte al Administrador');
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
                        Notificion.success('Uppps, Existen problemas en servidor consulte al Administrador', 1000);
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

                        Notificion.success('Se elimino correcntamente', 1000);

                    }.bind(this), error: function (data) {
                        Notificion.success('Uppps, Existen problemas en servidor consulte al Administrador', 1000);

                    }.bind(this)
                })
            },
            mostrarModalElimnarTareaComun: function($event, tarea){

                $event.preventDefault();

                this.tareaComun = tarea;

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
            }



        }
    });
    /* fin de vm de Vuejs */


});
