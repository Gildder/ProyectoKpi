<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Minimo %</th>	
			<th>Maximo %</th>	
			<th></th>	
		</thead>

		<tbody>
			@foreach($escalasAgregados as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->minimo}}</td>
				<td>{{$item->maximo}}</td>
				<td>
					<a href="{{route('evaluadores.ponderacion.quitarescala', array($item->id, $ponderacion->id)) }}" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"  title="Quitar Indicador"></span></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

