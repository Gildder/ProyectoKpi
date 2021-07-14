<div class="table-responsive">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead class="headerTable">
			<th>id</th>
			<th>Usuario</th>
			<th>Codigo</th>
			<th>Nombre Completo</th>
			<th></th>
		</thead>

		<tbody>
			@foreach($empleadosAgregados as $item)
			<tr>
                <td>
                    <a href="#"
                       data-toggle="modal" data-target="#modal-usuarioTarea-{{ $item->id }}"
                       class="btn btn-warning btn-xs">
                        {{$item->id}}
                    </a>
                </td>
				<td>{{$item->usuario}}</td>
				<td>{{$item->codigo}}</td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-deleteEmpleadoEvaluador-{{$item->id}}"  class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"  title="Quitar Empleado"></span></a>
				</td>
			</tr>
			@include('evaluadores/evaluador/empleados/delete')
            @include('evaluadores/evaluador/empleados/modal/empleado')
            @endforeach
		</tbody>
	</table>
</div>

