

<template>
    <div class="table-responsive">
        <table id="tareaBuscadasSupervisadas" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
            <tr>
                <th hidden></th>
                <th>Id</th>
                <th>Tareas</th>
                <th>Fechas Inicio</th>
                <th>Fechas Fin</th>
                <th>Tiempo</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Observaciones</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="tarea in $parent.tareasSupervisadas">
                <td hidden>{{ tarea.tarea_id }}</td>
                <td>
                    <b class="btn btn-warning btn-xs"> {{ tarea.tarea_id }}</b>
                </td>
                <td> {{ tarea.descripcion }}</td>
                <td>{{ tarea.fechaInicio }}</td>
                <td>{{ tarea.fechaFin }}</td>
                <td>{{ tarea.tiempo }}</td>
                <td>
                    <label  :style="redondear(tarea.colorUser, tarea.textoUser)" class="labelUser"
                            data-toggle="modal" data-target="#modal-usuarioTarea-{{ tarea.user_id }}"
                    >
                    {{ tarea.usuario }}  {{ tarea.activo }}
                    {{ tarea.vacacion }} {{ tarea.bloqueado }}
                    </label>
                </td>
                <td>
                    <label  :style="{'background': tarea.colorEstado, 'color': tarea.textoEstado }"
                            class="estado"> {{tarea.estado }} </label>
                </td>
                <td>{{tarea.observaciones }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<style>
    .estado {
        font-size: 10px; padding: 1.5px 5px; border-radius: 15px; box-shadow: 1px 1px gray;
    }
    .labelUser {
        font-size: 12px;
        padding: 1.5px 5px;
        border-radius: 15px;
        box-shadow: 1px 1px gray;
        cursor: pointer;
    }
</style>
<script>
    export default {
        props: {
            supervisorid: {
                type: Number,
                default: 0
            },
        },
        data: function(){
            return {
            }
        },
        ready: function () {
        },
        methods: {
            redondear: function (color, texto) {
                if(color === '' || color === undefined){
                    return '';
                }

                return {'background': color, 'color': texto}
            },
        }

    }
    /* Fin componentes*/
    $(document).ready(function () {
        var table = $('#tareaBuscadasSupervisadas').DataTable({
            dom: 'Blfrtip',
            // guarmos los filtro de la tabla
            stateSave: true,
        });

        $('#tareaBuscadasSupervisadas tbody').on('dblclick', 'tr', function () {
            var data = table.row( this ).data();
            console.log(data[0]);

            //            alert( 'You clicked on '+data[0] );
        } );




    });
</script>

