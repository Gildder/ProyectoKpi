<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
        <th>Nro.</th>
        <th>Nombre</th>
        <th></th>
    </thead>

    <tbody>
    @foreach($ubicacionesDis as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->nombre}}</td>
            <td>
                <a href="{{route('tareas.tareaProgramadas.agregarubicacion', array( $tarea->id, $item->id )) }}" class="btn btn-primary btn-sm"><span class="fa fa-plus" title="Agregar" ></span></a>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>
