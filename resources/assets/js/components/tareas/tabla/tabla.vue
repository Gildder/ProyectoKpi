<template>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 10px;">
        <a href="#"
           :class="{btn:true, 'btn-success': cmpFiltroHide, 'btn-danger': cmpFiltroHide == false , 'btn-sm': true}"
           @click="mostrarFiltro($event)">
            {{ textoFiltro }}  <i class="fa fa-filter"></i>
        </a>

        <a href="#" id="btnLimpiar"
           @click="limpiarFiltro($event)"
           :style="{'display':  cmpFiltroHide?'none':'inline-block'}"
           class="btn btn-info btn-sm">
            Limpiar  <i class="fa fa-paint-brush"></i>
        </a>
    </div>
    <div class="table table-responsive" >
    <table id="tablaTareasNormal"
        class="table table-responsive table-striped table-bordered table-condensed table-hover display"
        cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Nro</th>
            <th>Descripcion</th>
            <th>Fecha Inicio </th>
            <th>Fecha Fin</th>
            <th>Duracion (hrs:min)</th>
            <th>Estado</th>
            <th>Observacion</th>
            <th>Actualizado</th>
        </tr>
        </thead>

        <tfoot :style="{'display':  cmpFiltroHide?'none':'table-header-group'}">
        <tr>
            <th>Nro</th>
            <th>Descripcion</th>
            <th>Fecha Inicio </th>
            <th>Fecha Fin</th>
            <th>Duracion</th>
            <th>Estado</th>
            <th>Observacion</th>
            <th>Actualizado</th>
        </tr>
        </tfoot>
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
    var table;

    export default {
        props: {
            url: ''
        },
        data: function(){
            return {
                textoFiltro: 'Mostrar',
            }
        },
        events:
        {
            'actuliza-tareas': function () {
                cargarTabla(this.url);

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
            cargarTabla(this.url);
        },
        methods: {
            mostrarFiltro: function ($event) {
                $event.preventDefault();

                if(this.textoFiltro === 'Mostrar'){
                    this.textoFiltro = 'Ocultar';
                }else{
                    this.textoFiltro = 'Mostrar';

                    table.search( '' )
                        .columns().search( '' )
                        .draw();
                }
            },
            verDetalle: function ($event, id) {
                $event.preventDefault();


//                window.location.assign('/tareas/tareaProgramadas/'+ id+'/edit');
                $.get('/tareas/tareaProgramadas/'+ id);

            },
            limpiarFiltro: function ($event) {
                $event.preventDefault();

                table.search( '' )
                    .columns().search( '' )
                    .draw();


                $('#tablaTareasNormal tfoot input').val('');
            }

        }

    }

    // funcion para cargar la tabla
    function cargarTabla(urlString) {

         table = $('#tablaTareasNormal').DataTable({
            dom: 'Blfrtip',
            // guarmos los filtro de la tabla
            stateSave: true,
            destroy: true,
            searching: true,

             ajax:  {
                url: urlString,
                 dataSrc: ''
             },

             columns: [
                 {
                     sortable: false,
                     render: function ( data, type, full, meta ) {
                         var numero = full.numero;
                         var id = full.id;
                         return '<a href="/tareas/tareaProgramadas/'+id+'" data-num="5" class="btn btn-warning btn-xs" title="Ver"><span id="nro" >'+numero+'</span>';
                     }
                 },
                 { data: 'descripcion' },
                 { data: 'fechaInicio' },
                 { data: 'fechaFin' },
                 { data: 'tiempo' },
                 {
                     sortable: false,
                     render: function ( data, type, full, meta ) {
                         var estado = full.estado;
                         var colorEstado = full.colorEstado;
                         var textoEstado = full.textoColor;
                         return '<label style="background-color: '+colorEstado+'; color:'+textoEstado+';" class="estiloEstado" >'+estado+'</label>';
                     }
                 },
                 { data: 'observaciones' },
                 { data: 'updated_at' },
             ]
        });


        table.search( '' )
            .columns().search( '' )
            .draw();

//        $.fn.dataTable.ext.errMode = 'throw';

        $('#tablaTareasNormal tbody').on('dblclick', 'tr', function () {
            var data = table.row( this ).data();
            window.location.href = "/tareas/tareaProgramadas/"+data.id;
            mostraModaLading();
        } );


        // agregamos texto al input de busqueda
        $('#tablaTareasNormal tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="'+title+'" />' );
        } );


        // Aplicamos la Busquedas
        table.columns().every( function () {
            var that = this;

            $('input', this.footer() ).on( 'keyup change', function () {
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
