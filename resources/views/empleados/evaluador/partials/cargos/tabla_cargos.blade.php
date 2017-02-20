<div class="table-response">
	<table id="myTable3" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($cargosdis as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}} </td>
				<td>
					<a href="{{route('empleados.evaluador.agregarcargo', array($item->id, $evaluador->id)) }}"  class="btn btn-success btn-xs" title="Agregar Cargo"> <span class="fa fa-plus"></span>  <b></b> </a>
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>