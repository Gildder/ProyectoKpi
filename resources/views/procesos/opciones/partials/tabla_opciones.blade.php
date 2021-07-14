<div class="table-responsive">
	<table class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Descripcion</th>	
			<th>Habilitado</th>	
		</thead>

		<tbody>
		@foreach($opciones as $opcion)
			<tr>
				<td>{{$opcion->descripcion}}</td>
				<td>@if($opcion->habilitado == 01) Si  @else No @endif</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>