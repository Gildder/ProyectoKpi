<template>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <div v-show="mostrar_bar_botones" class="breadcrumb col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <a @click="mostrar_bar_botones = !mostrar_bar_botones" style="float: right" class="btn btn-instagram btn-sm" title="Tareas Archivadas">Filtrar <span class="fa fa-filter"></span></a>
    </div>

    <div v-show="mostrar_bar_botones == false"
         transition="fade-filtro"
         class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form @submit.prevent="buscarTarea()">

        <div class="col-xs-12" style="border: 1px solid gray; border-radius: 20px; padding: 10px; border-shadow: 1px 1px 1px gray;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
                <label style="color: gray; font-style: italic;">Usuario</label>
                <hr style="margin: 0px; margin-bottom: 10px;">
            </div>

            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-2">
                <label>Usuarios</label>
                <select class="form-control" name="cargo_id" v-model="param_filtro.usuario_id">
                    <option value="">Seleccionar</option>
                    <option v-for="usuario in usuarios" value="{{ usuario.id }}">{{ usuario.usuario }} {{ usuario.activo }} {{ usuario.vacacion }} {{ usuario.bloqueado }}  </option>
                </select>
            </div>

            <div class="form-group  col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <label>Apellidos</label>
                <input type="text" v-model="param_filtro.apellido"  name="apellido" placeholder="Apellidos" maxlength="40" class="form-control">
            </div>

            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-2">
                <label>Cargos</label>
                <select class="form-control" name="cargo_id" v-model="param_filtro.cargo_id">
                    <option value="">Seleccionar</option>
                    <option v-for="cargo in cargos" value="{{ cargo.id }}">{{ cargo.nombre }}</option>
                </select>
            </div>

            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-2">
                <label>Departamentos</label>
                <select class="form-control" name="departamento_id" v-model="param_filtro.departamento_id">
                    <option value="" >Seleccionar...</option>
                    <option v-for="departamento in departamentos" value="{{ departamento.id }}">{{ departamento.nombre }}</option>
                </select>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
                <label style="color: gray; font-style: italic;">Tareas</label>
                <hr style="margin: 0px; margin-bottom: 10px;">
            </div>

            <div class="form-group  col-xs-12 col-sm-2 col-md-2 col-lg-1">
                <label>Nro. </label>
                <input type="number" v-model="param_filtro.tarea_nro" name="tarea_nro" placeholder="Nro. #" min="1" class="form-control">
            </div>
            <div class="form-group col-xs-12 col-sm-3 col-md-3 col-lg-2">
                <label>Ubicaciones</label>
                <select class="form-control" name="ubicacion_id" v-model="param_filtro.ubicacion_id">
                    <option value="" >Seleccionar</option>
                    <option v-for="ubicacion in ubicaciones" value="{{ ubicacion.id }}">{{ ubicacion.nombre }}</option>
                </select>
            </div>

            <div class="row col-xs-12 col-sm-6 col-md-5 col-lg-4" >
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin: 0px;">
                    <label>Fecha Inicio</label>
                    <div class="input-group row" style="margin: 0px;">
                        <input type="text" v-model="fechaInicio" placeholder="Fecha Inicio"  class="form-control fechas" name="fechaInicio" >
                        <div class="input-group-addon row">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin: 0;">
                    <label>Fecha Fin</label>
                    <div class="input-group row" style="margin: 0px;">
                        <input type="text" v-model="param_filtro.fechaFin" placeholder="Fecha Fin" class="form-control fechas" name="fechaFin" >
                        <div class="input-group-addon row">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: center; margin:  2px 0 0 0;">
                    <label class="radio-inline"><input type="radio" checked v-model="param_filtro.fechaSeleccionada" value="1">Fechas Estimadas</label>
                    <label class="radio-inline"><input type="radio" v-model="param_filtro.fechaSeleccionada" value="0">Fechas Soluciones</label>
                </div>
            </div>

            <div class="form-group  col-xs-12 col-sm-3 col-md-3 col-lg-2">
                <label>Estados</label>
                <select class="form-control" name="estado_id" v-model="param_filtro.estado_id">
                    <option value="" >Seleccionar</option>
                    <option v-for="estado in estados" value="{{ estado.id }}">{{ estado.nombre }}</option>
                </select>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                <hr style="margin: 10px;">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
                <button type="reset" @click="mostrar_bar_botones = !mostrar_bar_botones" class="btn btn-danger   btn-sm">Ocultar  <span class="fa  fa-filter"></span> </button>
                <button type="reset" class="btn btn-primary btn-sm">Limpiar  <span class="fa  fa-times"></span> </button>
                <button type="submit" class="btn btn-success btn-sm" >Buscar  <span class="fa  fa-search"></span> </button>
            </div>
        </div>
        </form>
    </div>

    <style>
        .fade-filtro-transition {
            transition: all 1.5s ease;
            opacity: 100;
        }
        .fade-filtro-enter, .fade-filtro-leave {
            opacity: 0;
            transition: all .2s ease;
        }
    </style>
</template>

<script>
    $(document).ready(function () {
        /*Calendarios */
        $( ".fechas" ).datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
            changeMonth: true
        });
    });

    export default {
        props: {
            supervisorid: {
                type: Number,
                default: 0
            },
            cargos: {
                type: Array,
                default: function () { return [] }
            },
            departamentos: {
                type: Array,
                default: function () { return [] }
            },
            estados: {
                type: Array,
                default: function () { return [] }
            },
            ubicaciones: {
                type: Array,
                default: function () { return [] }
            },
            usuarios: {
                type: Array,
                default: function () { return [] }
            },
        },
        data: function(){
            return {
//                //Tarea
                param_filtro: {
                    usuario_id: '',
                    apellido: '',
                    cargo_id: '',
                    departamento_id: '',
                    tarea_nro: '',
                    fechaInicio: '',
                    fechaFin: '',
                    fechaSeleccionada: 1,
                    ubicacion_id: '',
                    estado_id:'',
                },
                mostrar_bar_botones: true,
            }
        },
        ready: function () {
//            alert(this.cargos);
        },
        methods: {
            buscarTarea: function() {
                this.param_filtro.supervisorid = this.supervisorid,
//                    alert(JSON.stringify(this.param_filtro));
                $.ajax({
                    url: 'buscarTareasSupervisadas',
                    method: 'POST',
                    data: this.param_filtro,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        localStorage.setItem('tarea_'+this.supervisorid, data)
                    }.bind(this), error: function (data) {
                        console.log('Error: No puede obtener las tareas');

                    }.bind(this)
                })
            },
            ocultarFiltro: function () {
                this.mostrar_bar_botones = true;
                this.form_buscar_tareas = false;
            },

        }

    }
</script>
