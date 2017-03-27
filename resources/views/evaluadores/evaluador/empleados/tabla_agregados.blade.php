<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre Completo</th>	
			<th></th>	
		</thead>

		<tbody>
			@foreach($empleadosAgregados as $item)
			<tr>
				<td>{{$item->codigo}}</td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>
					<a href="{{route('evaluadores.evaluador.quitarempleado', array($item->codigo, $evaluador->id)) }}" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"  title="Quitar Empleado"></span></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

