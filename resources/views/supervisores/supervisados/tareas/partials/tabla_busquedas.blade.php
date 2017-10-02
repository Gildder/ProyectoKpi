<table id="tareaBuscadasSupervisadas" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
    <tr>
        <th hidden></th>
        <th>Id</th>
        <th>Nro</th>
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
    @if(isset($tareas) || sizeof($tareas)> 0)
        @foreach($tareas as $tarea)
            <tr>
                <td hidden>{{ $tarea->tarea_id }}</td>
                <td><b class="btn btn-warning btn-xs">
                        {{ $tarea->tarea_id }}
                    </b>
                </td>
                <td>
                    {{ $tarea->nro }}
                </td>
               
                <td> {{ $tarea->descripcion }}</td>
                <td>{{ $tarea->fechaInicio }}</td>
                <td>{{ $tarea->fechaFin }}</td>
                <td>{{ $tarea->tiempo }}</td>
                <td>
                    <label
                        style="background: {{$tarea->colorUser}}; color:{{$tarea->textoUser}}; "
                        data-toggle="modal" data-target="#modal-usuarioTarea-{{$tarea->user_id}}"
                        class="labelUser"
                    >
                        {{ $tarea->usuario }}  {{ $tarea->activo }}
                        {{ $tarea->vacacion }} {{ $tarea->bloqueado }}
                    </label>
                </td>
                <td>
                    <label  style="background: {{$tarea->colorEstado}}; color:{{$tarea->textoEstado}};"
                    class="estado"> {{$tarea->estado }} </label>
                </td>
                <td>{{$tarea->observaciones }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
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
    $(document).ready(function () {
        var table = $('#tareaBuscadasSupervisadas').DataTable({
            dom: 'Blfrtip',
            // guarmos los filtro de la tabla
            stateSave: true,
            destroy: true,
        });


        $('#tareaBuscadasSupervisadas tbody').on('dblclick', 'tr', function () {
            var data = table.row( this ).data();
            console.log(data[0]);

            //            alert( 'You clicked on '+data[0] );
        } );

        table.destroy();


    });
</script>
