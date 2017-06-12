$(document).ready(function(){
    

    // Variables Globales
    var chart;

    /**
     * Creacion de VueJS
     */
    var vm;
    vm = new Vue({
        el: '#contentDashboard',
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
        },
        computed: {
            isSemanal: function () {
                return this.filtroVista.tipo == 0 ? true : false;
            },
            bloquearSiguienteMes: function () {
                return this.filtroVista.mesBuscado >= this.filtroVista.ultimosMes ? true : false;
            },
            bloquearAnteriorMes: function () {
                return this.filtroVista.mesBuscado <= this.filtroVista.inicio ? true : false;
            },

        },

        ready: function () {
            this.$http.get('obtenerVista').then(function (response) {
                var dato = localStorage.getItem('filtroDashboard');

                if (dato === null) {
                    this.filtroVista = response.data;
                    this.guardarLocalStore('filtroDashboard', response.data);
                } else {
                    this.filtroVista = JSON.parse(localStorage.getItem('filtroDashboard'));
                }

                this.cambiarVista(this.filtroVista.tipo);
            });
        },
        methods: {
            cambiarVista: function (param) {
                this.filtroVista = JSON.parse(localStorage.getItem('filtroDashboard'));
                this.filtroVista.tipo = param;
                this.guardarLocalStore('filtroDashboard', this.filtroVista);

                this.obtenerDatosSemana();
            },

            obtenerDatosSemana: function () {
                this.$http.post('obtenerTablaTotal/' + this.filtroVista.tipo +'/'+  this.filtroVista.mesBuscado).then(function (response) {
                    this.tablaTotalDatos = JSON.parse(response.data.indicadores);
                    this.cumplimiento = response.data.cumplimiento;
                    this.descripciones = JSON.parse(response.data.descripciones);
                });

                // obtener los datos de la grafica segun filtro
                this.$http.post('obtenerChartTotal/' + this.filtroVista.tipo+'/'+  this.filtroVista.mesBuscado).then(function (response) {
                    this.chartData = JSON.parse(response.data.indicadores);
                    this.chartCaterias = JSON.parse(response.data.categorias);
                    cargarDato();
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
            anteriorMes: function () {
                if(this.filtroVista.mesBuscado > 1){
                    this.filtroVista.mesBuscado--;
                    this.guardarLocalStore('filtroDashboard', this.filtroVista);
                }


                this.obtenerDatosSemana();
            },
            siguienteMes: function () {
                if(this.filtroVista.mesBuscado < this.filtroVista.ultimosMes){
                    this.filtroVista.mesBuscado++;
                    this.guardarLocalStore('filtroDashboard', this.filtroVista);
                }
                this.obtenerDatosSemana();
            },
            guardarLocalStore: function (nombre, valor) {
                localStorage.removeItem(nombre);
                localStorage.setItem(nombre, JSON.stringify(valor));
            },
            obtenerNombreMes: function (mes) {
                switch (mes) {
                    case 1:
                        return 'Enero';
                        break;
                    case 2:
                        return 'Febrero';
                        break;
                    case 3:
                        return 'Marzo';
                        break;
                    case 4:
                        return 'Abril';
                        break;
                    case 5:
                        return 'Mayo';
                        break;
                    case 6:
                        return 'Junio';
                        break;
                    case 7:
                        return 'Julio';
                        break;
                    case 8:
                        return 'Agosto';
                        break;
                    case 9:
                        return 'Septiembre';
                        break;
                    case 10:
                        return 'Octubre';
                        break;
                    case 11:
                        return 'Noviembre';
                        break;
                    case 12:
                        return 'Diciembre';
                        break;
                }
            },
        },
    });

    cargarDato = function () {
        chart = c3.generate({
            bindto: "#chart_Total",
            data:  vm.chartData,
            bar: {
                width: {
                    ratio: 0.5
                }
            },
            axis: {
                x: {
                    type: 'category',
                    // Cargamos las categorias dela sigte forma categories:['Enero', 'Febrero',...]
                    categories: vm.chartCaterias

                }
            },
            legend: {
                position: 'bottom'
            }
        });

    };




    // alert(JSON.stringify(this.chartCaterias));




});