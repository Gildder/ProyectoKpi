<div class="table-response">
	<table id="myTableCargos" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>
		<tbody>
		@foreach($cargosDisponibles as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}} </td>
				<td>
					<a href="{{route('evaluadores.evaluador.agregarcargo', array($item->id, $evaluador->id)) }}"  class="btn btn-success btn-xs" title="Agregar Cargo"> <span class="fa fa-plus"></span>  <b></b> </a>
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>