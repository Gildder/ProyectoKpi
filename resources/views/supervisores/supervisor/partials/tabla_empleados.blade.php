<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th>Cargo</th>	
			<th>Departamentos</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($empleadosdis as $item)
			<tr>
				<td>{{$item->codigo}}</td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>{{$item->cargo}}</td>
				<td>{{$item->departamento}}</td>
				<td>
					<a href="{{route('supervisores.supervisor.agregardepartamento', array($item->codigo, $departamento->id)) }}" class="btn btn-primary btn-sm"><span class="fa fa-plus" title="Agregar Empleado" ></span></a>
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>