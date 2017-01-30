<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro	</th>
			<th>Abreviatura</th>	
			<th>Descripcion</th>	
			<th>Opciones</th>	
		</thead>

		<tbody>
		@foreach($empleadosdis as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->abreviatura}}</td>
				<td>{{$item->descripcion}}</td>
				<td>
					<a href="{{route('indicadores.indicador.agregarvariable', array($item->id, $evaluador->id)) }}"  class="btn btn-success btn-sm"> <span class="fa fa-plus"></span>  <b>Agregar</b> </a>
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>