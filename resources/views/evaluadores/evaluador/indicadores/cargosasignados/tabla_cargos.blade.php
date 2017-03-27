<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($cargosEvaluadores as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}} </td>
				<td>
					<a href="{{route('evaluadores.evaluador.agregarcargoasignado', array($indicador->id, $evaluador->id, $item->id)) }}"  class="btn btn-success btn-sm"> <span class="fa fa-plus" title="Agregar Cargo"></span>  <b></b> </a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>