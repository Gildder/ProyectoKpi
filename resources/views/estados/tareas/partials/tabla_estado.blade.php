<div class="table-responsive">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Descripción</th>
            <th>Visto Calendario</th>
            <th>Visto Empleado</th>
		</thead>

		<tbody>
		@foreach($estados as $estado)
			<tr>
				<td>
                    <a href="{{route('estados.tareas.show', $estado->id )}}"
                       class="btn btn-warning btn-xs" ><span class=""  title="Eliminar"></span><span >{{$estado->id}}</span>
                    </a>
                </td>
				<td>
                    <input class="estiloEstado" style="background-color: {!! $estado->color !!}; color: {!! $estado->texto !!};" value="{!! $estado->nombre !!}" readonly="true">
                </td>
				<td>{{$estado->descripcion}}</td>
				<td>
                    @if($estado->visibleCalendario == 1) Si @else No @endif
                </td>
                <td>
                    @if($estado->visibleEmpleado == 1) Si @else No @endif
                </td>
            </tr>
		@endforeach
		</tbody>

	</table>
</div>

