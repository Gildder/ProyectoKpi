<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombres</th>	
			<th>Objetivos</th>	
			<th>Frecuencias</th>	
			<th>Condiciones</th>	
			<th>Aclaraciones</th>	
			<th></th>	
		</thead>

		<tbody>
			@foreach($cargosEvaluadores as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->objetivo}} %</td>
				<td>{{$item->frecuencia}}</td>
				<td> @if(!is_null($item->condicion)) {{ 'Ninguna' }} @else {{$item->condicion}} @endif </td>
				<td>@if(!is_null($item->condicion)) {{ 'Ninguna' }} @else {{$item->aclraciones}} @endif</td>
				<td>
					<a href="{{ route('evaluadores.evaluador.indicadorcargos.editar', array($item->id, $indicador->id)) }}" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-edit" ></span></a>
					<a href="#" data-toggle="modal" data-target="#modal-delete-{{$item->id}}" class="btn btn-danger btn-sm" ><span class="fa fa-trash"  title="Quitar Cargo"></span></a>
				</td>
			</tr>
				@include('evaluadores/evaluador/indicadorcargos/delete')
			@endforeach
		</tbody>
	</table>
</div>

