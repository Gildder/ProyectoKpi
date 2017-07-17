
<table class="table table-striped table-bordered table-condensed table-hover">
    <thead>
        <th>Nro</th>
        <th>Nombre</th>
        <th></th>
    </thead>

    <tbody>
        @foreach($ubicacionesOcu as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->nombre}}</td>
            <td>
                <a href="{{route('tareas.tareaProgramadas.quitarubicacion', array($tarea->id, $item->id)) }}" class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar"></span></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>




