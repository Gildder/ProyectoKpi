<template>
    <div class="modal fade" aria-hidden="true" tabindex="-1" data-backdrop="true" data-keyboard="true"
            role="dialog" id="modal-nuevo-widget-{{ tipo_id }}">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content modal-delete-content">
                <!-- Modal Header -->
                <div class="modal-header modal-delete-header">
                    <button type="button" class="close" data-dismiss="modal" :disabled="guardando">
                        <span class="sr-only">Cerrar</span>
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong class="model-title">Nuevo Widget - {{ titulo }}</strong>
                </div>
                <form class="form-horizontal" role="form" @submit.prevent="guardarWidget">

                    <div class="modal-body modal-delete-body" :disabled="guardando">

                        <!-- Tipos de Indicadores-->
                        <div class="col-sm-12 form-group">
                            <div class="col-sm-12">
                                <strong>Tipos Indicadores:</strong>
                                <selector-modal :disabled="guardando"
                                        :id.sync="nuevo_widget.tipoIndicador_id"
                                        :items="tipos_indicadores">
                                </selector-modal>
                            </div>
                        </div>

                        <!-- Indicadores -->
                        <div class="col-sm-12  form-group" v-if="tipo_id !== 1">
                            <div class="col-sm-12">
                                <strong>Indicadores:</strong>
                                <selector-modal :disabled="guardando"
                                        :id.sync="nuevo_widget.indicador_id"
                                        :items="indicadores">
                                </selector-modal>
                            </div>
                        </div>

                        <!-- tipos de vista para empleado tipo empleado -->
                        <div class="col-sm-12  form-group" style="margin: 0;" v-if="tipo_id !== 3">
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <hr>
                                    <strong>Tipos de Vista:</strong>
                                </div>
                                <div class="col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-10 ">
                                    <div class="radio" >
                                        <label class="radio-inline">
                                            <input type="radio" value="0" v-model="nuevo_widget.isSemanal" :disabled="guardando"> Semanal
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" value="1" v-model="nuevo_widget.isSemanal" :disabled="guardando"> Mensual
                                        </label>
                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-12" style="margin-top: 20px;" v-if="nuevo_widget.isSemanal == 0">
                                <div class="col-sm-6">
                                    <p>Seleccionar el mes para ver:</p>
                                </div>
                                <div class="col-sm-4">
                                    <select v-model="nuevo_widget.mesBuscado" :disabled="guardando" class="form-control" required>
                                        <option value="">Seleccionar..</option>
                                        <option v-for="n in nuevo_widget.ultimoMes" value="{{ numeroDeMes(n) }}">
                                            {{ numeroDeMes(n) | nombreMes }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12" style="margin-top: 20px;" v-if="nuevo_widget.isSemanal == 1">
                                <div class="col-sm-6">
                                    <p>Seleccionar el mes de inicio: </p>
                                </div>
                                <div class="col-sm-4">
                                    <select v-model="nuevo_widget.mesInicio" class="form-control" :disabled="guardando" required>
                                        <option value="">Seleccionar..</option>
                                        <option v-for="n in nuevo_widget.ultimoMes" value="{{ numeroDeMes(n) }}">
                                            {{ numeroDeMes(n) | nombreMes }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!--Vista para las tareas -->
                        <!--meses-->
                        <div class="col-sm-12" v-if="tipo_id === 3">
                            <br>
                            <div class="col-sm-12">
                                <hr>
                                <p>Selecciona el mes que desea ver el indicadores:</p>
                            </div>
                            <div class="col-sm-4">
                                <select v-model="nuevo_widget.mesTarea" :disabled="guardando" @change="obtenerCantidadSemana"
                                        class="form-control" required>
                                    <option value="">Seleccionar..</option>
                                    <option v-for="n in nuevo_widget.ultimoMes" value="{{ numeroDeMes(n) }}">
                                        {{ numeroDeMes(n) | nombreMes }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!--semanas-->
                        <div class="col-sm-12" v-if="tipo_id === 3"><br>
                            <div class="col-sm-12">
                                <p>Selecciona la semana que desea ver el indicadores:</p>
                            </div>
                            <div class="col-sm-4">
                                <select v-model="nuevo_widget.semanaTarea" :disabled="guardando"
                                        class="form-control" required>
                                    <option value="">Seleccionar..</option>
                                    <option value="1">Semana 1</option>
                                    <option value="2">Semana 2</option>
                                    <option value="3">Semana 3</option>
                                    <option v-if="semanas >3" value="4">Semana 4</option>
                                    <option v-if="semanas >4" value="5">Semana 5</option>
                                    <option v-if="semanas >5" value="6">Semana 6</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <!--footer de modal-->
                    <div class="modal-footer modal-delete-footer">
                        <div class="form-group" style="margin-bottom: 0px; margin-right: 10px;" >
                            <div class="col-sm-12">
                                <hr>
                            </div>
                            <!--<a  @click="guardarWidget($event)"  class="btn btn-success" >Guardar</a>-->
                            <button class="btn btn-success" type="submit" :disabled="guardando">Guardar
                            </button>
                            <button  data-dismiss="modal" class="btn btn-danger" :disabled="guardando"> Cancelar</button>
                        </div>

                        <div id="loading" v-if="guardando" >
                            <loading-comp opcion="Gen"></loading-comp>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
    /* jshint esnext:true */

    var utils = require('./../../utils.js');

    var Notificion = new Alert('#notificacion');
    var Vue = require('vue');
    Vue.use(require('vue-resource'));

    export default {
        props: ['tipo_id', 'titulo'],
        data: function () {
            return {
                tipos_indicadores: [],
                indicadores: [],
                semanas:'',
                nuevo_widget: {},

                guardando: false,
            };
        },
        ready: function () {
            this.cargarFormulario();
            this.instacionWidget();
        },
        filters: {
            nombreMes: function (mes) {
                return utils.nombreMes(mes);
            },
        },
        methods: {
            cargarWidget: function (widget) {
                alert('Hola Modal   ');
            },
            numeroDeMes: function (nro) {
                return nro + 1;
            },

            cargarFormulario: function (opcion) {
                $.ajax({
                    url: 'obtenerTiposIndicadores/',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        this.tipos_indicadores = data.tipos;
                        this.indicadores = data.indicadores;
                    }.bind(this), error: function (data) {
//                        Console.log('Error: ObtenerUltimoMes' + response.err);

                    }.bind(this)
                });
            },
            instacionWidget: function () {
                this.nuevo_widget = {
                    tipo_id: this.tipo_id,
                    titulo: '',
                    isSemanal: 0,
                    tipoIndicador_id: '',
                    indicador_id: '',
                    ultimoMes: this.obtenerUltimoMes(),
                    mesBuscado: '',
                    mesInicio: '',
                    mesTarea: '',
                    semanaTarea: '',
                }
            },
            obtenerUltimoMes: function () {

                $.ajax({
                    url: 'obtenerMesActual/',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        this.nuevo_widget.ultimoMes = data;
                    }.bind(this), error: function (data) {
//                        Console.log('Error: ObtenerUltimoMes' + response.err);

                    }.bind(this)
                });
            },
            guardarWidget: function ($event) {
                $event.preventDefault();


                this.guardando = true;
                this.agregarAtributoModal(true);

                var tipoIndicador = jQuery.grep(this.tipos_indicadores, function (value, index) {
                    if (value.id === this.nuevo_widget.tipoIndicador_id) {
                        return value;
                    }
                }.bind(this));

                var indicador = jQuery.grep(this.indicadores, function (value, index) {
                    if (value.id === this.nuevo_widget.indicador_id) {
                        return value;
                    }
                }.bind(this));

                var nombreIndicador = '' ;
                if(indicador[0] === undefined)
                {
                    nombreIndicador = '';
                }else {
                    nombreIndicador = indicador[0].nombre;
                }

                this.nuevo_widget.tipo_id = this.tipo_id;
                this.nuevo_widget.titulo = this.getTitulo(tipoIndicador[0].nombre, nombreIndicador);

                $.ajax({
                    url: 'guardarWidget',
                    method: 'POST',
                    data: this.nuevo_widget,
                    dataType: 'json',
                    success: function (data) {


                        this.instacionWidget();


                        // pasamos el nuevo widget a la lista de PanelWidget de vm
                        this.$dispatch('agregarWidgetPanel', data);


                        Notificion.success('Se guardo correctamente!');



                    }.bind(this), error: function (data) {
                        Notificion.warning('No se guardo correctamente!');

                    }.bind(this)
                });

                this.guardando = false;
                this.agregarAtributoModal(false);
                $('#modal-nuevo-widget-' + this.nuevo_widget.tipo_id).modal('hide');
            },
            getTitulo: function (tipo, indicador) {
                if (this.tipo_id === 1) {
                    return  tipo;
                }
                else if (this.tipo_id === 2) {
                    return  indicador + ' por Usuarios';
                }
                else if (this.tipo_id === 3) {
                    return  indicador + ' por Semanas';
                } else {
                    return 'Sin Nombre';
                }
            },
            agregarAtributoModal: function (agregar) {
                let modelo =  $('#modal-nuevo-widget-' + this.nuevo_widget.tipo_id);
                if (agregar) {
                    modelo.attr('data-backdrop', 'static');
                    modelo.attr('data-keyboard', 'false');
                } else {
                    modelo.prop('data-backdrop', 'true');
                    modelo.prop('data-keyboard', 'true');
                }
            },
            obtenerCantidadSemana: function () {
                let mes = this.nuevo_widget.mesTarea;
                if(mes == "")
                {
                    return;
                }
                $.ajax({
                    url: 'obtenerCantidadSemanasMes/'+mes,
                    method: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        this.semanas = data.semanas;
                    }.bind(this), error: function (data) {
                        console.log('Error: No se obtuvo las cantidad de semanas');

                    }.bind(this)
                })
            },
            obtenerFechasSemanas: function () {
                // imcompleto en el repsositorio
                let semana = this.nuevo_widget.semanaTarea;
                if(semana == "")
                {
                    return;
                }
                $.ajax({
                    url: 'obtenerFechasSemanas/'+semana,
                    method: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        this.fechaInicio = data.fechaInicio;
                        this.fechaFin = data.fechaFin;
                    }.bind(this), error: function (data) {
                        console.log('Error: No se obtuvo las cantidad de semanas');

                    }.bind(this)
                })
            },
            mostrarModalNuevo: function() {


                alert('Hola desde componente Modal');
            },
        },
    }
</script>
