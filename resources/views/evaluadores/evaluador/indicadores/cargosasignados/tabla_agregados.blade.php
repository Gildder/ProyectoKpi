<div class="table-responsive">
	<table id="myTableCargos" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<tr>
				<th>Nro</th>
				<th>Nombres</th>	
				<th>Objetivos %</th>	
				<th>Frecuencias</th>	
				<th>Condiciones</th>	
				<th>Aclaraciones</th>	
				<th></th>	
			</tr>
		</thead>

		<tbody>
			@foreach($indicadorCargos as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->objetivo}}</td>
				<td>{{$item->frecuencia}}</td>
				<td> @if(isset($item->condicion)) {{ 'Ninguna' }} @else {{$item->condicion}} @endif </td>
				<td>@if(isset($item->aclaraciones)) {{ 'Ninguna' }} @else {{$item->aclaraciones}} @endif</td>
				<td>
					{{-- Editar cargo  --}}
					<a href="javascript:void(0)"  id="btnEditarCargoIndicador"  class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-edit" ></span></a>

					{{-- Quitar Cargo --}}
					<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-deleteCargos-{{$item->id}}" class="btn btn-danger btn-sm"  title="Quitar"><span class="fa fa-trash" ></span></a>
				</td>
				@include('evaluadores/evaluador/indicadores/cargosasignados/delete')
			</tr>
			@endforeach
		</tbody>
	</table>
</div>


