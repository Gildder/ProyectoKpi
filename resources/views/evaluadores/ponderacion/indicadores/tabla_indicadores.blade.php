<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro.</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($indicadoresDisponibles as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>
					<a href="#"  data-toggle="modal" data-target="#modal-indicador-{{$item->id}}" class="btn btn-success btn-sm"><span class="fa fa-plus"></span><b></b> </a>
				</td>
			</tr>
			@include("evaluadores/ponderacion/indicadores/ponderacion")

		@endforeach
		</tbody>

	</table>
</div>