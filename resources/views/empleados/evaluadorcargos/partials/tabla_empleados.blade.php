<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre Completo</th>	
			<th>Cargo</th>	
			<th>Departamentos</th>	
			<th>Opciones</th>	
		</thead>

		<tbody>
		@foreach($empleadosdis as $item)
			<tr>
				<td>{{$item->codigo}}</td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>{{$item->cargo}}</td>
				<td>{{$item->departamento}}</td>
				<td>
					<a href="{{route('empleados.evaluador.agregarempleado', array($item->codigo, $evaluador->id)) }}"  class="btn btn-success btn-sm"> <span class="fa fa-plus"></span>  <b>Agregar</b> </a>
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>