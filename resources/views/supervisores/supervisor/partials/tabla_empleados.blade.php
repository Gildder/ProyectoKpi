<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th>Departamento</th>	
			<th>Cargo</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($empleadosdis as $item)
			<tr>
				<td>{{$item->codigo}}</td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>{{$item->departamento}}</td>
				<td>{{$item->cargo}}</td>
				<td>
					@if($tipo == 1)
					<a href="{{route('supervisores.supervisor.agregardepartamento', array($item->codigo, $lista->id)) }}" class="btn btn-success btn-xs" title="Agregar Empleado"><span class="fa fa-plus" title="Agregar Empleado" ></span></a>
					@else
					<a href="{{route('supervisores.supervisor.agregarcargo', array($item->codigo, $lista->id)) }}" class="btn btn-success btn-xs" title="Agregar Empleado"><span class="fa fa-plus" title="Agregar Empleado" ></span></a>
					@endif
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>