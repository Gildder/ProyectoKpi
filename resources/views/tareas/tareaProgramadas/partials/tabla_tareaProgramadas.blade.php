	<table id="tablaTareas" class="table table-responsive table-striped table-bordered table-condensed table-hover display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Nro</th>
				<th>Descripcion</th>
				<th>Fecha Inicio </th>
				<th>Fecha Fin</th>
				<th>Tiempo</th>
				<th>Estado</th>
				<th>Ubicaciones</th>
				<th>Observacion</th>
                <th></th>
			</tr>
		</thead>
		<tbody>
@foreach($tareas as $tarea)
<tr>
	<td><a href="{{route('tareas.tareaProgramadas.show', $tarea->id )}}" @click="mostrarModalLoading()"  class="btn btn-warning btn-sm" title="Ver"><span >{{$tarea->numero}}</span></a></td>
	<td>{{$tarea->descripcion}}</td>
	<td> {{ $tarea->fechaInicio}} </td>
	<td>{{  $tarea->fechaFin}}</td>
	<td>{{$tarea->tiempo}}</td>
	<td> <label style="background: {{$tarea->colorEstado}};
                color:{{$tarea->textoColor}};
                font-size: 10px;
                padding: 1.5px 5px;
                border-radius: 15px;
                box-shadow: 1px 1px gray;" > {{$tarea->estado}} </label> </td>
	<td>
		<ul style="padding: 1px;">
		@foreach($tarea->ubicaciones as $ubicacion)
			<li style="padding: 0;">{{ $ubicacion->nombre }} </li>
		@endforeach
		</ul>
	</td>
	<td>{{$tarea->observaciones }}</td>
    <td>
        <div class="btn-group">
            <a  href="{{route('tareas.tareaProgramadas.resolver', $tarea->id)}}"
                v-show="{{ $tarea->estado_id <> 3 }}"
                title="Finalizar"
                class="btn btn-success btn-sm"
                @click="mostrarModalLoading()"
            ><span class="fa fa-thumbs-up text-left" ></span><b class="hidden-sm-down"> </b> </a>

            <a   href="#"  v-show="{{ $tarea->estado_id <> 3 }}"
                 title="Editar" @click="editarTarea($event)"
                 class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b class="hidden-sm-down"> </b> </a>

            <a href="#" data-toggle="modal" v-show="{{ $tarea->estado_id <> 3 }}" v-if="btnEliminar === 1"
               data-target="#modal-delete-{{$tarea->id}}"
               title="Borrar"
               class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b class="hidden-sm-down"> </b> </a>

            <a href="#"  data-toggle="modal"
               data-target="#modal-cancelar-{{$tarea->id}}" title="Reabrir" v-show="{{ $tarea->estado_id == 3 }}"
               class="btn btn-danger btn-sm"><span class="fa fa-times"></span><b class="hidden-sm-down">  </b> </a>
        </div>
    </td>
</tr>


@endforeach
		</tbody>

	</table>
