
<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Descripcion</th>	
			<th>Fecha Inicio</th>	
			<th>Fecha Finalizado</th>	
			<th>Tiiempo Solucion</th>	
			<th>Observacioens</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($tareas as $item)
			<tr>
				<td>
					<a href="#" class="btn btn-warning btn-xs" title="Ver">{{$item->id}}</a>
				</td>
				<td>{{$item->descripcion}}</td>
				<td>{{$item->fechaInicioSolucion}}</td>
				<td>{{$item->fechaFinSolucion}}</td>
				<td>{{$item->tiempoSolucion}}</td>
				<td>@if(empty($item->observaciones)) Ninguna @else $item->observaciones @endif </td>
				<td>
					<a href="#" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#modal-nota-{{$item->id}}" title="Agregar Tarea"><span class=" fa  fa-save"></span> </a>
				</td>
			</tr>
        	@include('supervisores/numeroErrores/agregarNota')

		@endforeach
		</tbody>
	</table>
</div>