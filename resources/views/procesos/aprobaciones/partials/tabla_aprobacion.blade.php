<div class="table-responsive">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Evaluadores</th>
			<th>Opciones</th>	
		</thead>

		<tbody>
		@foreach($evaluadores as $evaluador)
			<tr>
				<td>
					<a href="{{ route('procesos.aprobaciones.show', $evaluador->id) }}"
					   class="btn btn-link" >{{$evaluador->descripcion}}
					</a>
				</td>
				<td>{{$evaluador->nombre}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>
