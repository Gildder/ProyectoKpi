<div class="table-response">
	<table id="myTableEvaluador" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Abreviatura</th>	
			<th>Descripcion</th>	
			<th>Ponderacion</th>	
			<th></th>
		</thead>

		<tbody>
		@foreach($evaluadores as $item)
			<tr>
				<td><a href="{{route('evaluadores.evaluador.show', $item->id)}}" class="btn btn-warning btn-xs" title="Ver">{{$item->id}}</a></td>
				<td>{{$item->abreviatura}}</td>
				<td>{{$item->descripcion}}</td>
				<td>{{$item->ponderaciones->nombre}}</td>
				<td><a href="{{route('evaluadores.evaluador.indicadorcargos.index')}}" class="btn btn-info btn-xs" title="Indicador por Cargo"><span class="fa fa-pie-chart"></span></a></td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>