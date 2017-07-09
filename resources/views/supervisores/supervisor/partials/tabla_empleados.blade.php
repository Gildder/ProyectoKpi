<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Id</th>
			<th>Usuario</th>
			<th>Codigo</th>
			<th>Nombre</th>
			<th>Cargo</th>
			<th></th>	
		</thead>

		<tbody>
		@foreach($empleadosdis as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->usuario}}</td>
				<td>{{$item->codigo}}</td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>{{$item->cargo}}</td>
				<td>
					@if($tipo == 1)
					<a href="{{route('supervisores.supervisor.agregardepartamento', array($item->id, $lista->id)) }}" class="btn btn-success btn-xs" title="Agregar Empleado"><span class="fa fa-plus" title="Agregar Empleado" ></span></a>
					@else
					<a href="{{route('supervisores.supervisor.agregarcargo', array($item->id, $lista->id)) }}" class="btn btn-success btn-xs" title="Agregar Empleado"><span class="fa fa-plus" title="Agregar Empleado" ></span></a>
					@endif
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>
