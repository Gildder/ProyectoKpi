<div class="table-responsive">
	<table id="myTableEmpleado" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Id</th>
			<th>Usuario</th>
			<th>Codigo</th>
			<th>Nombre</th>
			<th>Cargo</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($empleadosDisponibles as $item)
			<tr>
				<td>
                    <a href="#"
                       data-toggle="modal" data-target="#modal-usuarioTarea-{{ $item->id }}"
                       class="btn btn-warning btn-xs">
                        {{$item->id}}
                    </a>
                </td>
				<td>{{$item->usuario}} @if($item->is_evaluador == 1) [e] @endif
                </td>
				<td>{{$item->codigo}}</td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>{{$item->cargo}}</td>
				<td>
					<a href="{{route('evaluadores.evaluador.agregarempleado', array($item->id, $evaluador->id)) }}"  @click="mostrarModalLoading()"  class="btn btn-success btn-xs" title="Agregar Empleado"> <span class="fa fa-plus"></span>  <b></b> </a>
				</td>
			</tr>

            @include('evaluadores/evaluador/empleados/modal/empleado')
		@endforeach
		</tbody>

	</table>
</div>
