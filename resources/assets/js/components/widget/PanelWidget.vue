<template>
    <div class="row" id="capa-indicadores-{{ widget.id  }}">
        <div class="col-md-12">
            <div class="box box-warning" id="panelWidget">
                <!--minimizar colocar la clase = box box-warning collapsed-box , mazminazar colcoar = box box-warning -->
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <b>{{ widget.id }}. {{ widget.titulo }}</b><br>
                        <strong class="pull-left" style="color:gray; font-size:14px; padding-top:5px;">Por {{ vistaParaTitulo }}</strong>
                    </h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-wrench"></i></button>
                            <!-- Cambie este codigo  -->
                            <ul class="dropdown-menu" role="menu">
                                <li><a @click="eliminarWidget()">Eliminar</a></li>
                                <!--<li><a @click="opcionWidget($event)">Opciones</a></li>-->
                                <!--<li><a href="#">Graficas</a></li>-->
                                <li class="divider"></li>
                                <li><a @click="cambiarVista($event, 0)">Vista Semanas</a></li>
                                <li><a @click="cambiarVista($event, 1)">Vista Meses</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
                            <p>{{ actualizarDescripcionWidget }}</p>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong>{{ tituloChart }}</strong>
                            </p>
                            <!-- Grafica -->
                            <div class="chart">
                                <div id="chart-{{ widget.id  }}"></div>
                            </div>
                            <hr>
                        </div>
                        <!-- /.col -->
                        <!--Tabla y Grafico del indicador -->
                        <div class="col-md-12">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <p class="text-center">
                                    <strong>{{ tituloTabla }}</strong>
                                </p>
                            </div>
                                <!--Filtro Mes -->
                                <div class="pull-right" data-toggle="buttons-checkbox">
                                    <label style="border-right: 20px;" class="hidden-xs">{{ textoMesBuscado }}</label>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-sm left" title="Anterior"
                                           @click="bloquearAnteriorMes == false?anteriorMes($event):''"
                                           :class="{'btn-danger': bloquearAnteriorMes }"
                                           :disabled="bloquearAnteriorMes">&lsaquo; </a>

                                        <a class="btn btn-default btn-sm "><b>{{ mesActual }}</b></a>

                                        <a class="btn btn-default btn-sm  right"
                                           title="Siguiente" @click="bloquearSiguienteMes == false?siguienteMes($event):''"
                                           :class="{'btn-danger': bloquearSiguienteMes }"
                                           :disabled="bloquearSiguienteMes">&rsaquo; </a>
                                    </div>
                                </div>

                                <!--Filtro Semana -->
                                <div v-if="widget.tipo_id == 3 && widget.isSemanal == 0" class="pull-right" data-toggle="buttons-checkbox" >
                                    <label style="border-right: 20px;" class="hidden-xs">{{ textoSemanaBuscada }}</label>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-sm left" title="Anterior"
                                           @click="bloquearAnteriorSemana == false?anteriorSemana($event):''"
                                           :class="{btn:true, 'btn-danger': bloquearAnteriorSemana }"
                                           :disabled="bloquearAnteriorSemana">&lsaquo; </a>

                                        <a class="btn btn-default btn-sm "><b>Semana {{ semanaActual }}</b></a>

                                        <a class="btn btn-default btn-sm  right" style=" margin-right:15px;"
                                           title="Siguiente" @click="bloquearSiguienteSemana == false? siguienteSemana($event):''"
                                           :class="{btn:true, 'btn-danger': bloquearSiguienteSemana }"
                                           :style="bloquearSiguienteSemana? {color: white }:''"
                                           :disabled="bloquearSiguienteSemana">&rsaquo; </a>
                                    </div>
                                </div>


                            <div class="table table-responsive">
                                <!-- Tabla -->
                                <table v-if="this.widget.tipo_id!=3" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                                    <thead class="headerTable" style="background-color: #0f74a8;  color: white;"  >
                                    <tr style="font-weight: bold;" >
                                        <th>Nro</th>
                                        <th>{{ NombreCampoTipoWidget }}</th>
                                        <!--<th title="Ponderacion" v-if="this.widget.tipo_id==1">Ponderacion</th>-->
                                        <th v-for="descripcion in nombreTabla">{{ descripcion.desc }}</th>
                                        <th>Promedio</th>
                                    </tr>
                                    </thead>
                                    <tfoot v-if="this.widget.tipo_id !=2" >
                                    <tr style="border-top: 2px solid gray;">
                                        <td colspan="2" align="right">El % de Cumplimiento de los Indicadores</td>
                                        <td><b>{{ cumplimiento }} %</b></td>
                                        <th v-for="descripcion in nombreTabla"></th>
                                        <td v-if="this.widget.tipo_id==1"></td>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr v-for="item in tabla">
                                            <td><a href="#" class="btn btn-warning btn-xs"> {{ item.id }} </a></td>
                                            <td>{{ item.nombre }}</td>
                                            <!--<td v-if="this.widget.tipo_id==1">{{ item.ponderacion }} %</td>-->
                                            <template v-for="dato in item.datos">
                                                <td>{{ dato.valor }} %</td>
                                            </template>
                                            <td class="colProm" >{{ item.promedio }} %</td>

                                        </tr>
                                    </tbody>
                                </table>
                                <!-- Fin de Tabla -->

                                <!-- Tabla Tareas -->
                                <table class="table table-bordered table-hover table-responsive" v-if="this.widget.tipo_id==3"  cellspacing="0" width="100%">
                                    <thead class="headerTable" style="background-color: #0f74a8;  color: white;"  >
                                    <tr style="font-weight: bold;" >
                                        <th>Nro</th>
                                        <th>{{ NombreCampoTipoWidget }}</th>
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
                                        <td class="colTarea">{{ item.eficacia_tarea }} %</td>
                                        <td>{{ item.ticket_abierto }} </td>
                                        <td>{{ item.ticket_cerrado }} </td>
                                        <td class="colTicket">{{ item.eficacia_ticket }} %</td>
                                        <td class="colProm">{{ item.eficacia_total }} %</td>
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

<style>
    .colProm {background-color: #ddffdd; font-weight: bold;}
    .colTarea {background-color: lightskyblue; font-weight: bold;}
    .colTicket {background-color: bisque; font-weight: bold;}
</style>
<script>
    /* jshint esnext:true */

    var utils = require('../../helper/utils.js');
    var Notificion = new Alert('#notificacion');
    var Vue = require('vue');
    Vue.use(require('vue-resource'));
    var cambiar = false;

     export default{
        props: {
            widget:{},
        },
        data: function () {
            return {
                ultimoMes: this.calcularUltimosMes(),
                mesActual: '',
                semanaActual: '',
                tituloChart: '',
                tituloTabla: '',
                NombreCampoTipoWidget:'',
                tabla:[],
                dataChart: [],
                categoriaChart: [],
                nombreTabla: [],
                cumplimiento: 0,
                category: '',
                datos:'',
                textoMesBuscado: '',
                textoSemanaBuscada: '',
                descripcionWidget: '',
                minimizado: 0,
                semanas:0,
            }
        },

        computed: {
            bloquearSiguienteMes: function () {
                var resultado = false;
                if(this.widget.isSemanal == 0){
                    if(this.widget.tipo_id == 3)
                    {
                        resultado = this.widget.mesTarea >= this.ultimoMes;
                    }else
                    {
                        resultado = this.widget.mesBuscado >= this.ultimoMes;
                    }
                }else{
                    if(this.widget.tipo_id == 3)
                    {
                        resultado = this.widget.mesTarea >= this.ultimoMes;
                    }
                    else{
                        resultado = this.widget.mesInicio >= this.ultimoMes;
                    }
                }

                return resultado;
            },
            bloquearAnteriorMes: function () {
                var resultado = false;
                if(this.widget.isSemanal == 0){
                    if(this.widget.tipo_id == 3)
                    {
                        resultado = this.widget.mesTarea <= 1;
                    }else
                    {
                        resultado = this.widget.mesBuscado <= 1;
                    }
                }else{
                    if(this.widget.tipo_id == 3)
                    {
                        resultado = this.widget.mesTarea <= 1;
                    }else
                    {
                        resultado = this.widget.mesInicio <= 1;
                    }
                }

                return resultado;
            },
            bloquearSiguienteSemana: function () {
                return (this.widget.semanaTarea >= this.semanas);
            },
            bloquearAnteriorSemana: function () {
                return (this.widget.semanaTarea <= 1);
            },
            vistaParaTitulo: function () {
                if(this.widget.isSemanal == 1){
                    return 'Mes';
                }else{
                    return 'Semana';
                }
            },
        },
         filters: {

         },
         ready: function () {
             this.inicializarDatos(false);

         },
         methods: {
            inicializarDatos: function(opcion) {
                // Actualizamos Widget
                this.obtenerTablaWidget(opcion);

                this.cambiarMenuVistaWidget();
                this.obtenerNombreTablaChart();
            },
            eliminarWidget: function () {
                // lanzamos el evento al metos de elimanr del js app-vue
                this.$dispatch('eliminar-widget', this.widget.id);
            },
            anteriorMes: function ($event) {
                $event.preventDefault();
                cambiar = true;

                this.sincronizarAnteriorMes();
                this.inicializarDatos(true);
            },
            siguienteMes: function ($event) {
                $event.preventDefault();

                cambiar = true;

                this.sincronizarSiguienteMes();
                this.inicializarDatos(true);
            },
             anteriorSemana: function ($event) {
                 $event.preventDefault();

                 cambiar = true;

                 this.sincronizarAnteriorSemana();
                 this.inicializarDatos(true);
             },
             siguienteSemana: function ($event) {
                 $event.preventDefault();

                 cambiar = true;

                 this.sincronizarSiguienteSemana();
                 this.inicializarDatos(true);
             },
            sincronizarSiguienteMes: function () {
                /* Si widget esta vista semana */
                if (this.widget.isSemanal == 0) {
                    if (this.widget.tipo_id == 3){
                        if (this.widget.mesTarea < this.ultimoMes) {
                            this.widget.mesTarea++;
                            this.widget.semanaTarea = 1;
                        }
                    }else {
                        if (this.widget.mesBuscado < this.ultimoMes) {
                            this.widget.mesBuscado++;
                        }
                    }

                }else{ /* Vista Mes*/
                    if(this.widget.tipo_id == 3){
                        if (this.widget.mesTarea < this.ultimoMes) {
                            this.widget.mesTarea++;
                            this.widget.semanaTarea = 1;
                        }
                    }else{
                        if (this.widget.mesInicio < this.ultimoMes) {
                            this.widget.mesInicio++;
                        }
                    }
                }
            },
            sincronizarAnteriorMes: function () {
                /* Si widget esta vista semana */
                if (this.widget.isSemanal == 0) {
                    if (this.widget.tipo_id == 3){
                        if (this.widget.mesTarea > 1) {
                            this.widget.mesTarea--;
                            this.widget.semanaTarea = 1;
                        }
                    }else{
                        if (this.widget.mesBuscado > 1) {
                            this.widget.mesBuscado--;
                        }
                    }

                }else{ /* Vista Mes*/
                    if(this.widget.tipo_id == 3){
                        if (this.widget.mesTarea > 1) {
                            this.widget.mesTarea--;
                            this.widget.semanaTarea = 1;
                        }
                    }else{
                        if (this.widget.mesInicio > 1) {
                            this.widget.mesInicio--;
                        }
                    }
                }
            },
             sincronizarSiguienteSemana: function () {
                 /* Si widget esta vista semana */
                 if (this.widget.isSemanal == 0) {
                     if (this.widget.tipo_id == 3){
                         if (this.widget.semanaTarea < this.semanas) {
                             this.widget.semanaTarea++;
                         }
                     }
                 }else{ /* Vista Mes*/
                     if(this.widget.tipo_id == 3){
                         if (this.widget.semanaTarea < this.semanas) {
                             this.widget.semanaTarea++;
                         }
                     }
                 }
             },
             sincronizarAnteriorSemana: function () {
                 /* Si widget esta vista semana */
                 if (this.widget.isSemanal == 0) {
                     if (this.widget.tipo_id == 3){
                         if (this.widget.semanaTarea > 1) {
                             this.widget.semanaTarea--;
                         }
                     }

                 }else{ /* Vista Mes*/
                     if(this.widget.tipo_id == 3){
                         if (this.widget.semanaTarea > 1) {
                             this.widget.semanaTarea--;
                         }
                     }
                 }
             },

            calcularUltimosMes: function () {
                let mes = new Date().getMonth() +1;
                if(mes === 1){
                    return 1;
                }else{
                    return mes - 1;
                }
            },
            obtenerNombreTablaChart: function () {
//                this.validarMesSemanas();
                if (this.widget.tipo_id  == 1) {
                    if (this.widget.isSemanal == 0) {
                        // Actualizamos el mesActual
                        this.mesActual = utils.nombreMes(parseInt(this.widget.mesBuscado));

                        // Actualizamos los titulo de graficas y la tabla
                        this.tituloChart = 'Grafica de Indicadores de ' + this.mesActual;
                        this.tituloTabla = 'Tabla de Indicadores de ' + this.mesActual;
                    } else {
                        // Actualizamos el mesActual
                        this.mesActual = utils.nombreMes(parseInt(this.widget.mesInicio));

                        // Actualizamos los titulo de graficas y la tabla
                        this.tituloChart = 'Grafica de Usuarios - ' + utils.nombreMes(this.widget.mesInicio) + ' a ' + utils.nombreMes(parseInt(this.calcularUltimosMes()));
                        this.tituloTabla = 'Tabla de Usuarios - ' + utils.nombreMes(this.widget.mesInicio) + ' a ' + utils.nombreMes(parseInt(this.calcularUltimosMes()));
                    }
                    this.NombreCampoTipoWidget = 'Indicadores';

                }else if(this.widget.tipo_id  == 2){
                    if(this.widget.isSemanal == 0)
                    {
                        // Actualizamos el mesActual
                        this.mesActual = utils.nombreMes(parseInt(this.widget.mesBuscado));

                        // Actualizamos los titulo de graficas y la tabla
                        this.tituloChart =  'Grafica de Indicadores de ' + this.mesActual;
                        this.tituloTabla =  'Tabla de Indicadores de ' + this.mesActual;
                    }else{
                        // Actualizamos el mesActual
                        this.mesActual = utils.nombreMes(parseInt(this.widget.mesInicio));

                        // Actualizamos los titulo de graficas y la tabla
                        this.tituloChart = 'Grafica de Usuarios - '+  utils.nombreMes(this.widget.mesInicio) + ' a '+ utils.nombreMes(parseInt(this.calcularUltimosMes()));
                        this.tituloTabla = 'Tabla de Usuarios - '+  utils.nombreMes(this.widget.mesInicio) + ' a '+ utils.nombreMes(parseInt(this.calcularUltimosMes()));
                    }

                    this.NombreCampoTipoWidget = 'Usuarios';

                }else{
                    let semana = '';
                    if(this.widget.isSemanal == 0){
                        semana = 'la Semana '+ this.widget.semanaTarea + ' de ';
                    }

                    // Actualizar el mes Actual
                    this.mesActual = utils.nombreMes(parseInt(this.widget.mesTarea));
                    this.semanaActual = this.widget.semanaTarea;

                    this.tituloChart =  'Grafica de Eficacia de Usuarios de '+ semana + utils.nombreMes(parseInt(this.widget.mesTarea));
                    this.tituloTabla =  'Tabla de Eficacia de Usuarios de ' + semana + utils.nombreMes(parseInt(this.widget.mesTarea));
                    this.NombreCampoTipoWidget = 'Usuarios';

                }
            },
            cambiarVista: function ($event, vista) {
                $event.preventDefault();
                cambiar = true;

                this.validarMesSemanas()

                this.widget.isSemanal = vista;
                this.inicializarDatos(true);
                this.obtenerNombreTablaChart();

            },
            validarMesSemanas: function()
            {
                if(this.widget.isSemanal == 1){
                    if(this.widget.mesBuscado == 0){
                        this.widget.mesInicio = this.ultimoMes;
                    }else{
                        this.widget.mesInicio = this.widget.mesBuscado;
                    }
                }else{
                    if(this.widget.mesInicio == 0){
                        this.widget.mesInicio = this.ultimoMes;
                    }else{
                        this.widget.mesBuscado = this.widget.mesInicio;
                    }
                }
            },
            cambiarMenuVistaWidget: function () {
                if(this.widget.tipo_id == 1) {
                    this.textoMesBuscado = 'Mes Actual:';
                }else if(this.widget.tipo_id == 1)
                {
                    this.textoMesBuscado = 'Mes Inicio:';
                }else{
                    this.obtenerCantidadSemana();
                    this.textoMesBuscado = 'Mes Actual:';
                    this.textoSemanaBuscada = 'Semana Actual: ';
                }
            },
            obtenerCantidadSemana: function () {
                if(this.widget.mesTarea != "")
                {
                    // utils.mostrarCargando(true);

                    $.ajax({
                        url: 'obtenerCantidadSemanasMes',
                        method: 'POST',
                        data: this.widget,
                        dataType: 'json',
                        success: function (data) {
                            this.semanas = data;

                           // utils.mostrarCargando(false);
                        }.bind(this), error: function (data) {
                            console.log('Error: No se obtuvo las cantidad de semanas');

                           // utils.mostrarCargando(false);
                        }.bind(this)
                    })
                }
            },
            obtenerTablaWidget: function (opcion) {
//                var store = localStorage.getItem('wg'+ this.widget.id);
//
//                if(store != undefined && cambiar == false){
//
//                    store = JSON.parse(store);
//
//                    this.widget = store[0];
//                    var chart = store[1];
//                    var table = store[2];
//
//                    // Mostrar chart c3
//                    MostrarChart(this.widget.id ,JSON.stringify(chart[0]), JSON.stringify(chart[1]));
//
//                    //  cargar la tabla
//                    if(this.widget.tipo_id != 3) {
//                        this.cumplimiento = table.pop();
//                        this.nombreTabla = table.pop();
//                    }
//                    this.tabla = table;
//
//                    return;
//                }


                utils.mostrarCargando(true);
                if(opcion == true){
                    $.ajax({
                        url: 'actualizarWidget',
                        method: 'POST',
                        data: this.widget,
                        dataType: 'json',
                        success: function (data) {
                            this.widget = data;
                        }.bind(this), error: function (data) {
                            console.log('NO se actualizò el Widget '+this.widget.id +' correctamente...')
                        }.bind(this)
                    });
                }

                $.ajax({
                    url: 'obtenerDatosTablaWidget',
                    method: 'POST',
                    data: this.widget,
                    dataType: 'json',
                    success: function (data) {
                        // sacamos el chart del Widget
//                        console.log(JSON.stringify(data));
                        var grafica = data.pop();
                        var tablaResponse = data.pop();

                        if(this.widget.tipo_id == 2){
                            console.log(JSON.stringify(tablaResponse));
                        }
                        // Mostrar chart c3
                        MostrarChart(this.widget.id ,JSON.stringify(grafica[0]), JSON.stringify(grafica[1]));

                        //  cargar la tabla
                        if(this.widget.tipo_id != 3) {
                            this.cumplimiento = tablaResponse.pop();
                            this.nombreTabla = tablaResponse.pop();
                        }
                        this.tabla = tablaResponse;

                        // guardamos en el localstore
//                        localStorage.setItem('wg'+this.widget.id, JSON.stringify([this.widget, grafica, tablaResponse]));
                        cambiar = false;

                        utils.mostrarCargando(false);
                        Notificion.success('Se actualizò el Widget '+ this.widget.id +' correctamente...')
                    }.bind(this), error: function (data) {
                        utils.mostrarCargando(false);
                        Notificion.warning('NO se actualizò el Widget '+this.widget.id +' correctamente...')
                    }.bind(this)
                });


            },
        }
    }



    var chart;

    function MostrarChart(widget_id, datosChart, categoriachart) {
         let dato = JSON.parse(datosChart);
         let categoria = JSON.parse(categoriachart);

        chart = c3.generate({
            bindto: "#chart-"+widget_id,
            data: {
                type: 'bar',
                // labels: true,
                columns:  dato,
                labels: {
                    format: function (v, id, i, j) { return v +" %" ; },
                },
                selection: {
                    enabled: false
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
