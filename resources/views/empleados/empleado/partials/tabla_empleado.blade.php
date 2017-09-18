<div class="table-responsive">
	<table id="myTable" class="table table-striped table-responsive table-bordered table-condensed table-hover">
		<thead>
			<th>id</th>
			<th>Usuario</th>	
			<th>Correo</th>	
			<th>Codigo</th>
			<th>Nombre Completo</th>
			<th>Cargo</th>	
			<th>Localizaciones</th>	
			<th>Departamentos</th>	
		</thead>

		{{--<tfoot>--}}
			{{--<tr>--}}
				{{--<th>id</th>--}}
				{{--<th>Usuario</th>--}}
				{{--<th>Correo</th>--}}
				{{--<th>Codigo</th>--}}
				{{--<th>Nombre Completo</th>--}}
				{{--<th>Cargo</th>--}}
				{{--<th>Localizaciones</th>--}}
				{{--<th>Departamentos</th>--}}
			{{--</tr>--}}
		{{--</tfoot>--}}

		<tbody>
		@foreach($empleados as $empleado)
			<tr>
				<td><a href="{{route('empleados.empleado.show', $empleado->id)}}" 
					class="btn btn-warning btn-xs" title="Ver">{{$empleado->id }}</a>
				</td>
				<td>{{ $empleado->usuario }}</td>
				<td>{{ $empleado->correo }}</td>
				<td>{{ $empleado->codigo }}</td>
				<td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
				<td>@if(isset($empleado->cargo_id)) {{ $empleado->cargo  }} @else  {{ $empleado->get('cargo_id') }} @endif</td>
				<td>@if(isset($empleado->localizacion_id)) {{  $empleado->localizacion  }} @else   @endif</td>
				<td>@if(isset($empleado->departamento_id)) {{ $empleado->departamento }} @else   @endif</td>
			</tr>

		@endforeach
		</tbody>

	</table>
</div>
