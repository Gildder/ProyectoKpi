<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre Completo</th>	
			<th>Usuario</th>	
			<th>Correo</th>	
			<th>Cargo</th>	
			<th>Localizaciones</th>	
			<th>Departamentos</th>	
		</thead>

		<tbody>
		@foreach($empleados as $empleado)
			<tr>
				<td><a href="{{route('empleados.empleado.show', $empleado->codigo)}}" class="btn btn-primary btn-xs" >{{$empleado->codigo}}</a></td>
				<!--<td><a href="javascript:void(0);" class="btn btn-primary btn-xs" onclick="editarEmpleado({{$empleado->id}}, 1)" ><span class=""  title="Baja"></span><span >{{$empleado->id}}</span></a></td>-->
				<td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
				<td>{{$empleado->usuario}}</td>
				<td>{{$empleado->correo}}</td>
				<td>{{$empleado->cargo}}</td>
				<td>{{$empleado->localizacion}}</td>
				<td>{{$empleado->departamento}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>