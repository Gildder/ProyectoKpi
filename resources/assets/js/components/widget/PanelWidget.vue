<template>
    <div class="row" id="capa-indicadores">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ widget.titulo  }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-wrench"></i></button>
                            <!-- Cambie este codigo  -->
                            <ul class="dropdown-menu" role="menu">
                                <li><a @click="eliminarWidget($event)">Eliminar</a></li>
                                <!--<li><a @click="opcionWidget($event)">Opciones</a></li>-->
                                <!--<li><a href="#">Graficas</a></li>-->
                                <li class="divider"></li>
                                <template  v-if="this.widget.tipo_id !=3">
                                    <li><a @click="cambiarVista($event, 0)">Vista Semanas</a></li>
                                    <li><a @click="cambiarVista($event, 1)">Vista Meses</a></li>
                                </template>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="">
                        <!-- /.col -->
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong>{{ tituloChart }}</strong>
                            </p>
                            <!-- Grafica -->
                            <div class="chart">
                                <div id="chart_tabla"></div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <!--Tabla y Grafico del indicador -->
                        <div class="col-md-12">
                            <div class="table">
                                 <!--Filtro guiente Mes -->
                                <div v-if="this.widget.tipo_id !==3" class="pull-right" data-toggle="buttons-checkbox" v-if=" widget.isSemanal == 0">
                                    <label style="border-right: 20px;">Seleccionar Mes:</label>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-sm left" title="Anterior"
                                           @click="anteriorMes($event)"
                                           :class="{btn:true, 'btn-danger': bloquearAnteriorMes }"
                                           :disabled="bloquearAnteriorMes">&lsaquo;</a>
                                        <a class="btn btn-default btn-sm "><b>{{ mesActual }}</b></a>
                                        <a class="btn btn-default btn-sm  right"
                                           title="Siguiente" @click="siguienteMes($event)"
                                           :class="{btn:true, 'btn-danger': bloquearSiguienteMes }"
                                           :style="bloquearSiguienteMes? {color: white }:''"
                                           :disabled="bloquearSiguienteMes">&rsaquo;</a>
                                    </div>
                                </div>

                                <!-- Tabla -->
                                <table v-if="this.widget.tipo_id!=3" class="table table-bordered table-hover table-responsive">
                                    <thead class="headerTable" >
                                    <tr style="font-weight: bold;" >
                                        <th>Nro</th>
                                        <th>{{ obtenerNombreTabla(widget.tipo_id) }}</th>
                                        <th title="Ponderacion" v-if="this.widget.tipo_id==1">Ponderacion</th>
                                        <th v-for="descripcion in nombreTabla">{{ descripcion.desc }}</th>
                                        <th>Promedio</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr style="border-top: 2px solid gray;">
                                        <td colspan="2" align="right">El % de Cumplimiento de los Indicadores</td>
                                        <td><b>{{ cumplimiento }} %</b></td>
                                        <th v-for="descripcion in nombreTabla"></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr v-for="item in tabla">
                                            <td><a href="#" class="btn btn-warning btn-xs"> {{ item.id }} </a></td>
                                            <td>{{ item.nombre }}</td>
                                            <td v-if="this.widget.tipo_id==1">{{ item.ponderacion }} %</td>
                                            <template v-for="dato in item.datos">
                                                <td>{{ dato.valor }}</td>
                                            </template>
                                            <td>{{ item.promedio }} %</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- Fin de Tabla -->

                                <!-- Tabla Tareas -->
                                <table class="table table-bordered table-hover table-responsive" v-if="this.widget.tipo_id==3">
                                    <thead class="headerTable" >
                                    <tr style="font-weight: bold;" >
                                        <th>Nro</th>
                                        <th>{{ obtenerNombreTabla(widget.tipo_id) }}</th>
                                        <th>Tareas Programadas</th>
                                        <th>Tareas Realizados</th>
                                        <th>Eficacia / Tareas</th>
                                        <th>Tickets Abiertos</th>
                                        <th>Tickets Cerrados</th>
                                        <th>Eficacia / Tickets</th>
                                        <th>Eficacia Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in tabla">
                                        <td><a href="#" class="btn btn-warning btn-xs"> {{ item.id }} </a></td>
                                        <td>{{ item.nombre }}</td>
                                        <td>{{ item.actividad_programada }} </td>
                                        <td>{{ item.actividad_realizada }} </td>
                                        <td>{{ item.eficacia_tarea }} %</td>
                                        <td>{{ item.ticket_abierto }} </td>
                                        <td>{{ item.ticket_cerrado }} </td>
                                        <td>{{ item.eficacia_ticket }} %</td>
                                        <td>{{ item.eficacia_total }} %</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!-- Fin de Tabla -->
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</template>

<script>
    /* jshint esnext:true */

    var utils = require('./../../utils.js');
    var Notificion = new Alert('#notificacion');
    var Vue = require('vue');
    Vue.use(require('vue-resource'));

     export default{
        props: {
            widget:{},
        },
        data: function () {
            return {
                ultimoMes: this.calcularUltimosMes(),
                mesActual:'',
                tituloChart: '',
                tabla:[],
                dataChart: [],
                categoriaChart: [],
                nombreTabla: [],
                cumplimiento: 0,
                category: '',
                datos:'',
            }
        },
        ready: function () {
            this.obtenerTablaWidget();

            this.obtenerChartWidget();
        },
        computed: {
            bloquearSiguienteMes: function () {
                return (this.widget.mesBuscado >= this.ultimoMes);
            },
            bloquearAnteriorMes: function () {
                return (this.widget.mesBuscado <= 1);
            },

        },
         filters: {

         },
        methods: {
            obtenerNombreTabla: function (tipo) {
                switch (tipo){
                    case 1:
                        return 'Indicadores';
                        break;
                    case 2:
                        return 'Usuarios';

                        break;
                    case 3:
                        return 'Usuarios';

                        break;
                }
            },
            obtenerTablaWidget: function () {
                this.obtenerMesActual();
                this.obtenerTituloChart();
                $.ajax({
                    url: 'obtenerDatosTablaWidget',
                    method: 'POST',
                    data: this.widget,
                    dataType: 'json',
                    success: function (data) {
                        if(this.widget.tipo_id !== 3) {
                            this.cumplimiento = data.pop();
                            this.nombreTabla = data.pop();
                        }
                        this.tabla = data;

                    }.bind(this), error: function (data) {
                        console.log('Error: No se puede cargar datos de la tabla del widget '+this.widget.id);
                    }.bind(this)
                })
            },
            opcionWidget: function ($event) {
                $event.preventDefault();
//                this.$dispatch('editar-widget', this.widget)

            },
            obtenerChartWidget: function () {
                $.ajax({
                    url: 'obtenerDatosChartWidget',
                    method: 'POST',
                    data: this.widget,
                    dataType: 'json',
                    success: function (data) {
                        MostrarChart(JSON.stringify(data[0]), JSON.stringify(data[1]));
                    }.bind(this), error: function (data) {
                        console.log('Error: No se puede cargar los datos a la grafica del widget '+this.widget.id);
                    }.bind(this)
                })
            },
            obtenerDatosWidget: function () {
                this.$http.get('/evaluadores/evaluados/obtenerVista').then(function (response) {
                }, function (response) {
                    // mensaje de Error
                });
            },
            eliminarWidget: function ($event) {
                $event.preventDefault();

                // lanzamos el evento al metos de elimanr del js app-vue
                this.$dispatch('eliminar-widget', this.id)
            },
            anteriorMes: function ($event) {
                $event.preventDefault();
                if (this.widget.mesBuscado > 1)
                {
                    this.widget.mesBuscado--;
                }else{
                    return;
                }
                this.obtenerDatosSgteAntSemana();
            },
            siguienteMes: function ($event) {
                $event.preventDefault();

                if (this.widget.mesBuscado <= this.ultimoMes) {
                    this.widget.mesBuscado++;
                }else{
                    return;
                }
                this.obtenerDatosSgteAntSemana();
            },
            obtenerDatosSgteAntSemana: function () {
                $.ajax({
                    url: 'actualizarWidget',
                    method: 'POST',
                    data: this.widget,
                    dataType: 'json',
                    success: function (data) {
                        this.widget = data;

                        this.obtenerTablaWidget();

                        this.obtenerChartWidget();

                        Notificion.success('Se realizo el actualizaciòn de los datos..')
                    }.bind(this), error: function (data) {
                        Notificion.warning('NO se realizo el actualizaciòn de los datos..')
                    }.bind(this)
                })
            },
            calcularUltimosMes: function () {
                let mes = new Date().getMonth() +1;
                if(mes === 1){
                    return 1;
                }else{
                    return mes - 1;
                }
            },
            obtenerTituloChart: function () {
                let tipografica = this.obtenerNombreTabla(this.widget.tipo_id);
                if(this.widget.isSemanal === 0) {
                    if(this.widget.tipo_id === 3){ // validamos los titulo de la grafica para tipo de widget por tarea
                        this.tituloChart =  'Grafica de '+ tipografica +' de ' + utils.nombreMes(this.widget.mesTarea);
                    }else{
                        this.tituloChart =  'Grafica de '+ tipografica +' de ' + this.mesActual;
                    }
                }else{
                    this.tituloChart = 'Grafica de '+ tipografica +'desde '+  utils.nombreMes(this.widget.mesInicio) + ' a '+ utils.nombreMes(this.calcularUltimosMes());
                }

                return 'mes';
            },
            obtenerMesActual: function () {
                this.mesActual  = utils.nombreMes(this.widget.mesBuscado);
            },
            cambiarVista: function ($event, vista) {
                $event.preventDefault();

                this.widget.isSemanal = vista;

                if(this.widget.mesInicio === 0)
                {
                    this.widget.mesInicio = this.widget.mesBuscado;
                }

                $.ajax({
                    url: 'actualizarWidget',
                    method: 'POST',
                    data: this.widget,
                    dataType: 'json',
                    success: function (data) {

                        this.obtenerTablaWidget();

                        this.obtenerChartWidget();

                        Notificion.success('Se realizo el actualizaciòn de los datos..')
                    }.bind(this), error: function (data) {
                        Notificion.warning('NO se realizo el actualizaciòn de los datos..')
                    }.bind(this)
                });
            },

        }
    }



    var chart;

    function MostrarChart(datosChart, categoriachart) {
         let dato = JSON.parse(datosChart);
         let categoria = JSON.parse(categoriachart);

        chart = c3.generate({
            bindto: "#chart_tabla",
            data: {
                type: 'bar',
                // labels: true,
                columns:  dato,
                labels: {
                    format: function (v, id, i, j) { return v +" %" ; },
                },
            },
            bar: {
                width: {
                    ratio: 0.5
                }
            },

            axis: {
                x: {
                    type: 'category',
                    // Cargamos las categorias dela sigte forma categories:['Enero', 'Febrero',...]
                    categories: categoria
                },
            },
            legend: {
                position: 'top'
            },
            grid: {
                y: {
                    lines: [
                        {value: 80, text: 'Limite de Porcentaje de los indicadores', position: 'middle'},
                        {value: 0},
                    ]
                }
            },

        });
    }

</script>
