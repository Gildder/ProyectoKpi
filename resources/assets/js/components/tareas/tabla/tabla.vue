<template>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 10px;">
        <a href="@"
           :class="{btn:true, 'btn-success': cmpFiltroHide, 'btn-danger': cmpFiltroHide == false , 'btn-sm': true}"
           @click="mostrarFiltro($event)">
            {{ textoFiltro }}  <i class="fa fa-filter"></i>
        </a>
    </div>
    <div class="table table-responsive">
    <table id="tablaTareasNormal"
        class="table table-responsive table-striped table-bordered table-condensed table-hover display"
        cellspacing="0" width="100%">
        <thead>
        <tr>
            <th style="display: none">Id</th>
            <th>Nro</th>
            <th>Descripcion</th>
            <th>Fecha Inicio </th>
            <th>Fecha Fin</th>
            <th>Duracion</th>
            <th>Estado</th>
            <th>Ubicaciones</th>
            <th>Observacion</th>
        </tr>
        </thead>

        <tfoot :style="{'display':  cmpFiltroHide?'none':'table-header-group'}">
        <tr>
            <th style="display: none">Id</th>
            <th>Nro</th>
            <th>Descripcion</th>
            <th>Fecha Inicio </th>
            <th>Fecha Fin</th>
            <th>Duracion</th>
            <th>Estado</th>
            <th>Ubicaciones</th>
            <th>Observacion</th>
        </tr>
        </tfoot>


        <tbody>

        <tr v-for="tarea in tareas">
            <td style="display: none" id="idtarea">{{ tarea.id }}</td>
            <td>
                <a href="/tareas/tareaProgramadas/{{ tarea.id }}" id="lnkShow" class="btn btn-warning btn-sm" title="click  Ver"
                    >
                    <span id="nro" >{{ tarea.numero }}</span>
                </a>
            </td>
            <td>{{ tarea.descripcion }}</td>
            <td> {{ tarea.fechaInicio }} </td>
            <td>{{ tarea.fechaFin }}</td>
            <td>{{ tarea.tiempo }}</td>
            <td> <label
                    :style="{ 'background': tarea.colorEstado, 'color':tarea.textoColor }"
                    class="estado">
                {{ tarea.estado }}
                </label>
            </td>
            <td>
                <ul style="padding: 1px;">
                    <li v-for="ubicacion in tarea.ubicaciones">
                        {{ ubicacion.nombre }}
                    </li>
                </ul>
            </td>
            <td>{{ tarea.observaciones }}</td>
        </tr>


        </tbody>

    </table>
    </div>
</template>

<style type="text/css">
    .estado {
        font-size: 10px;
        padding: 1.5px 5px;
        border-radius: 15px;
        box-shadow: 1px 1px gray;
    }
</style>
<script>
    var utils = require('../../../helper/utils.js');


    export default {
        props: {
            tareas: {
                type: Array,
                default: []
            }
        },
        data: function(){
            return {
                textoFiltro: 'Mostrar',
            }
        },
        events:
        {
            'actuliza-tareas': function (tareas) {
                this.tareas = tareas;
            },
        },
        computed: {
            cmpFiltroHide: function () {
                if(this.textoFiltro === 'Mostrar'){
                    return true;
                }else{
                    return false;
                }
            }
        },
        ready: function () {
            cargarTabla();
        },
        methods: {
            mostrarFiltro: function ($event) {
                $event.preventDefault();

                if(this.textoFiltro === 'Mostrar'){
                    this.textoFiltro = 'Ocultar';
                }else{
                    this.textoFiltro = 'Mostrar';
                }
            },
            verDetalle: function ($event, id) {
                $event.preventDefault();


//                window.location.assign('/tareas/tareaProgramadas/'+ id+'/edit');
                $.get('/tareas/tareaProgramadas/'+ id);

            }
        }

    }

    // funcion para cargar la tabla
    function cargarTabla() {

        var table = $('#tablaTareasNormal').DataTable({
            dom: 'Blfrtip',
            buttons: [
                'colvis',
                'excel',
                'print'
            ]
        });

        $('#tablaTareasNormal tbody').on('dblclick', 'tr', function () {
            var data = table.row( this ).data();
//            alert( 'You clicked on '+data[0] );
        } );

        // agregamos texto al input de busqueda
        $('#tablaTareasNormal tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="busq. '+title+'" />' );
        } );

        // Aplicamos la Busquedas
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );

        // Capturamos el evento de paginacion
        table
            .on( 'page.dt',   function () {
                mostraModaLading();
        });



    };


    function mostraModaLading() {
        utils.mostrarCargando(true);

        let duracion = false;
        let time = setTimeout(function () {
            duracion = true;
            utils.mostrarCargando(false);
        }, 300);

        if(duracion){
            clearTimeout(time);
        }
    }
    

</script>
