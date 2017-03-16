<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th>Cargo</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($empleadosdis as $item)
			<tr>
				<td>{{$item->codigo}}</td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>{{$item->cargo}}</td>
				<td>
					<a href="{{route('evaluadores.evaluador.agregarempleado', array($item->codigo, $evaluador->id)) }}"  class="btn btn-success btn-xs" title="Agregar Empleado"> <span class="fa fa-plus"></span>  <b></b> </a>
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>