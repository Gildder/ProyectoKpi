<div class="table-responsive">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
		<th>id</th>
		<th>Usuario</th>
		<th>Correo</th>
		<th>Codigo</th>
		<th>Nombre Completo</th>
		<th>Cargo</th>
		<th>Localizaciones</th>
		<th>Departamentos</th>
		<th></th>
		</thead>

		<tbody>
		@foreach($empleados as $empleado)
			<tr>
				<td><a href="{{route('empleados.empleado.show', $empleado->id)}}"
					   class="btn btn-warning btn-xs" title="Ver">{{$empleado->id }}</a>
				</td>
				<td>{{ $empleado->name }}</td>
				<td>{{ $empleado->email }}</td>
				<td>{{ $empleado->codigo }}</td>
				<td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
				<td>@if(isset($empleado->cargo_id)) {{ $empleado->cargo->nombre  }} @else  {{ $empleado->get('cargo_id') }} @endif</td>
				<td>@if(isset($empleado->localizacion_id)) {{  $empleado->localizacion->nombre  }} @else   @endif</td>
				<td>@if(isset($empleado->departamento_id)) {{ $empleado->departamento->nombre }} @else   @endif</td>
				<td><a  href="#"  data-toggle="modal" data-target="#modal-restaurar-{{$empleado->id}}"  class="btn btn-success btn-xs" ><span class="fa fa-check"  title="Restaurar"></span><span >  Restaurar</span></a></td>
			</tr>
			@include("empleados/empleado/restaurar")

		@endforeach
		</tbody>

	</table>
</div>
