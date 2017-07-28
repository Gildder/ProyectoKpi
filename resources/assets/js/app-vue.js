/**
 * Created by gildder on 15/06/2017.
 */
$(document).ready(function() {
    /* jshint esnext:true */

    // Variables Globales
    var Vue = require('vue');
    var Notificion = new Alert('#notificacion');
    var chart;
    var vm;
    var resourceWidget;

    var utils = require('./utils.js');
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

    //noinspection JSAnnotator
    /**
     * Creacion de VueJS
     */
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

            //Tarea
            btnResultado: 0,
            btnEditar: 0,
            btnEliminar: 0,
        },
        ready: function () {
            resourceWidget = this.$resource('/evaluadores/evaluados/obtenerEvaluadorWidget{/id}');

            // corregir este filtro
            if (window.location.pathname === '/evaluadores/evaluados/dashboard' ){
                this.obtenerListaWidget();
            }


        },
        components: {

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
                    this.panelWidgets = response.data;

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
            saludar: function () {
                alert('Hola Mundo');
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

        }
    });

});
