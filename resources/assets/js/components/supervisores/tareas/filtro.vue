
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
        },
        data: function(){
            return {
                token: $('input[name=_token]').val(),
                // tareas
                param_filtro: {
                    usuario_id: '',
                    apellido: '',
                    cargo_id: '',
                    departamento_id: '',
                    tarea_id: '',
                    fechaInicio: '',
                    fechaFin: '',
                    localizacion_id: '',
                    estado_id:'',
                },
                mostrar_bar_botones: true,
                usuarios: {},
                localizaciones: {},
                cargos: {},
                departamentos: {},
                estados: {},
            }
        },
        ready: function () {
            this.cargarUsuarios();
            this.cargarLocalizaciones();
            this.cargarCargos();
            this.cargarDepartamentos();
            this.cargarEstados();
        },
        methods: {
            buscarTarea: function() {
                $.ajax({
                    url: '/supervisores/supervisados/tareas/buscar',
                    method: 'GET',
                    data: this.param_filtro,
                    dataType: 'json',
                    success: function (data) {
                        if(data.success) {
                            this.$dispatch('buscar-tarea-supervidor', data.tareas);
                        }
                    }.bind(this),
                    error: function (data) {
                        console.log('Error');
                    }.bind(this)
                });

            },
            ocultarFiltro: function () {
                this.mostrar_bar_botones = true;
                this.form_buscar_tareas = false;
            },
            cargarUsuarios: function () {
                $.ajax({
                    url: '/supervisores/supervisados/getUsuarioSupervisados',
                    method: 'GET',
                    data: { id: this.supervisorid,csrf: this.token },
                    dataType: 'json',
                    success: function (data) {
                        this.usuarios = data.usuarios;
                    }.bind(this),
                    error: function (data) {

                    }.bind(this)


                })
            },
            cargarCargos: function () {
                $.ajax({
                    url: '/supervisores/supervisados/getCargosSupervisados',
                    method: 'GET',
                    data: { id: this.supervisorid,csrf: this.token },
                    dataType: 'json',
                    success: function (data) {
                        this.cargos = data.cargos;
                    }.bind(this),
                    error: function (data) {

                    }.bind(this)


                })
            },
            cargarDepartamentos: function () {
                $.ajax({
                    url: '/supervisores/supervisados/getDepartamentosSupervisados',
                    method: 'GET',
                    data: { id: this.supervisorid,csrf: this.token },
                    dataType: 'json',
                    success: function (data) {
                        this.departamentos = data.departamentos;
                    }.bind(this),
                    error: function (data) {

                    }.bind(this)


                })
            },
            cargarLocalizaciones: function () {
                $.ajax({
                    url: '/supervisores/supervisados/getLocalizaciones',
                    method: 'GET',
                    data: {csrf: this.token },
                    dataType: 'json',
                    success: function (data) {
                        this.localizaciones = data.localizaciones;
                    }.bind(this),
                    error: function (data) {

                    }.bind(this)


                })
            },
            cargarEstados: function () {
                $.ajax({
                    url: '/supervisores/supervisados/getEstados',
                    method: 'GET',
                    data: { csrf: this.token },
                    dataType: 'json',
                    success: function (data) {
                        this.estados = data.estados;
                    }.bind(this),
                    error: function (data) {

                    }.bind(this)


                })
            },

        }

    }
</script>


<template>

    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form @submit.prevent="buscarTarea()">

        <div class="col-xs-12" style="border: 1px solid gray; border-radius: 20px; padding: 10px; border-shadow: 1px 1px 1px gray;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
                <label style="color: gray; font-style: italic;">Usuario</label>
                <hr style="margin: 0px; margin-bottom: 10px;">
            </div>

            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-2">
                <label>Usuarios</label>
                <select class="form-control" name="usuario_id" v-model="param_filtro.usuario_id">
                    <option value="">Seleccionar</option>
                    <option v-for="usuario in usuarios" value="{{ usuario.id }}">
                        {{ usuario.usuario }} {{ usuario.activo }} {{ usuario.vacacion }} {{ usuario.bloqueado }}
                    </option>
                </select>
            </div>

            <div class="form-group  col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <label>Apellidos</label>
                <input type="text" v-model="param_filtro.apellido"
                       name="apellido" placeholder="Apellidos" maxlength="40" class="form-control">
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
                    <option v-for="departamento in departamentos"
                            value="{{ departamento.id }}">{{ departamento.nombre }}
                    </option>
                </select>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
                <label style="color: gray; font-style: italic;">Tareas</label>
                <hr style="margin: 0px; margin-bottom: 10px;">
            </div>

            <div class="form-group  col-xs-12 col-sm-2 col-md-2 col-lg-1">
                <label>Nro. </label>
                <input type="number" v-model="param_filtro.tarea_id" name="tarea_nro" placeholder="Nro. #" min="1" class="form-control">
            </div>
            <div class="form-group col-xs-12 col-sm-3 col-md-3 col-lg-2">
                <label>Localizaciones</label>
                <select class="form-control" name="ubicacion_id" v-model="param_filtro.ubicacion_id">
                    <option value="" selected>Seleccionar</option>
                    <option v-for="localizacion in localizaciones" value="{{ localizacion.id }}">
                        {{ localizacion.nombre }}
                    </option>
                </select>
            </div>

            <div class="row col-xs-12 col-sm-6 col-md-5 col-lg-4" >
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin: 0px;">
                    <label>Fecha Inicio</label>
                    <div class="input-group row" style="margin: 0px;">
                        <input type="text" v-model="param_filtro.fechaInicio" placeholder="dd/mm/aaaa"
                               pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                               class="form-control fechas" name="fechaInicio" >
                        <div class="input-group-addon row">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin: 0;">
                    <label>Fecha Fin</label>
                    <div class="input-group row" style="margin: 0px;">
                        <input type="text" v-model="param_filtro.fechaFin"
                               pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                               placeholder="dd/mm/aaaa" class="form-control fechas" name="fechaFin" >
                        <div class="input-group-addon row">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group  col-xs-12 col-sm-3 col-md-3 col-lg-2">
                <label>Estados</label>
                <select class="form-control" name="estado_id" v-model="param_filtro.estado_id">
                    <option value="" >Seleccionar</option>
                    <option v-for="estado in estados" value="{{ estado.id }}">
                        {{ estado.nombre }}
                    </option>
                </select>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                <hr style="margin: 10px;">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">


                <button type="submit" style="float: right; margin-left: 10px;"
                        class="btn btn-success btn-sm" >Buscar  <span class="fa  fa-search"></span>
                </button>

                <button type="reset" style="float: right;"
                        class="btn btn-danger btn-sm">Limpiar  <span class="fa  fa-times"></span>
                </button>
            </div>
        </div>
        </form>
    </div>

    <style>
        .fade-filtro-enter, .fade-filtro-leave {
            opacity: 0;
            transition: all .2s ease;
        }
    </style>
</template>
