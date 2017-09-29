<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 10px;">
    <a href="#" class="btn btn-success btn-sm"
       :class="{btn:true, 'btn-success': btnFiltroTareaSupervisor, 'btn-danger': btnFiltroTareaSupervisor == false , 'btn-sm': true}"
       @click="mostrarFiltrosTareasSupervisores()"><b id="labelBusqTarea">Mostrar</b>  <i class="fa fa-filter"></i>
    </a>
</div>
<table id="tablaTareasSupervisadas" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
        <tr>
            <th hidden></th>
            <th>Nro</th>
            <th>Usuario</th>
            <th>Tareas</th>
            <th>Fechas Inicio</th>
            <th>Fechas Fin</th>
            <th>Tiempo</th>
            <th>Estados</th>
            <th>Observaciones</th>
            <th></th>
        </tr>
    </thead>

    <tfoot :style="{'display':  btnFiltroTareaSupervisor?'none':'table-header-group'}">
    <tr>
        <th hidden></th>
        <th></th>
        <th>Usuario</th>
        <th>Tareas</th>
        <th>Fechas Inicio</th>
        <th>Fechas Fin</th>
        <th>Tiempo</th>
        <th>Estados</th>
        <th>Observaciones</th>
        <th></th>
    </tr>
    </tfoot>


    <tbody>
        @if(isset($tareas))
            <?php $index = 1; ?>
            @foreach($tareas as $tarea)

                <tr>
                    <td hidden>{{$tarea->tarea_id }}</td>
                    <td>
                        <b class="label label-default label-xs"> {{ $index++ }}</b>
                    </td>
                    <td>
                        <label  style="background: {{$tarea->color}}; " class="labelUser"
                                data-toggle="modal" data-target="#modal-usuarioTarea-{{$tarea->user_id}}"
                        > {{ $tarea->usuario }} </label>
                    </td>
                    <td> {{ $tarea->descripcion }}</td>
                    <td>{{ $tarea->fechaInicio }}</td>
                    <td>{{ $tarea->fechaFin }}</td>
                    <td>{{ $tarea->tiempo }}</td>
                    <td>
                        <label  style="background: {{$tarea->colorEstado}}; color:{{$tarea->textoColor}}; font-size: 10px; padding: 1.5px 5px; border-radius: 15px; box-shadow: 1px 1px gray "> {{$tarea->estado}} </label>
                    </td>
                    <td>{{$tarea->observaciones }}</td>
                    <td>
                        <a class="btn btn-dropbox btn-xs"
                           href="#"  data-toggle="modal" data-target="#modal-tareaDetalle-{{$tarea->tarea_id}}" title="Ver Tarea"> <span class=" fa fa-eye"></span></a>
                    </td>
                </tr>
                <div class="col-xs-12">
                    @include('supervisores/supervisados/tareas/partials/tarea')
                    @include('supervisores/supervisados/tareas/partials/empleado')
                </div>
            @endforeach
        @endif
    </tbody>
</table>

<style>
    .labelUser {
        font-size: 12px;
        padding: 1.5px 5px;
        border-radius: 15px;
        box-shadow: 1px 1px gray;
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function () {
        var table = $('#tablaTareasSupervisadas').DataTable({
            dom: 'Blfrtip',
            // guarmos los filtro de la tabla
            stateSave: true,
        });

        $('#tablaTareasSupervisadas tbody').on('dblclick', 'tr', function () {
            var data = table.row( this ).data();
            console.log(data[0]);

            $('#modal-tareaDetalle-' + data[0] ).modal('show');
//            alert( 'You clicked on '+data[0] );
        } );

        // agregamos texto al input de busqueda
        $('#tablaTareasSupervisadas tfoot th').each( function (th) {
            console.log();
            if($(this).html() !== ''){
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="'+title+'" style="width: 100px;"/>' );
            }

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

    })
</script>
