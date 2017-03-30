<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro.</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($tiposDisponibles as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>
					{{-- <a href="{{route('evaluadores.ponderacion.agregartipos', array($item->id, $ponderacion->id)) }}"  class="btn btn-success btn-xs" title="Agregar Tipo"> <span class="fa fa-plus"></span>  <b></b> </a> --}}

					<a href="#"  data-toggle="modal" data-target="#modal-tipo-{{$item->id}}" class="btn btn-success btn-sm"><span class="fa fa-plus"></span><b></b> </a>
				</td>
			</tr>
				@include("evaluadores/ponderacion/tipos/ponderacion")

		@endforeach
		</tbody>

	</table>
</div>