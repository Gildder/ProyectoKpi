<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
	<a  href="javascript:void(0)"  id="agregar"   data-toggle="modal" data-target="#modal-agregar" class="btn btn-success btn-sm"  title="Agregar Indicador"><span class="fa fa-plus"></span>   <b>Agregar</b></a>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0 0 10px 0">
	<p class="pull-left">Lista de indicadores asignadas a la Gerencia evaluadora  <b>{{$evaluador->abreviatura}}</b>.</p>
</div>

<div class="table-response">
	<table id="myTableMultiple" class="table table-striped table-bordered table-condensed table-hover display">
		<thead>
			<tr>
				<th rowspan="2">Nro</th>
				<th rowspan="3">Nombre</th>	
				<th rowspan="4">Tipos</th>
				<th rowspan="5">Cagos Asignados</th>
				<th></th>	
			</tr>
		</thead>
		<tbody>
		@foreach($indicadores as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->tipo}}</td>
				<td> 
					@foreach($item->getCargos($item->id) as $cargo)
						{{ $cargo->nombre }} <br>
					@endforeach
				</td>
				<td>
					<a href="{{route('evaluadores.evaluador.asignarcargo', array($item->id, $evaluador->id)) }}"  class="btn btn-warning btn-xs" title="Indicadores por Cargos"> <span class="fa fa-sitemap"></span>  <b></b> </a>
					
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-quitarindicador-{{$item->id}}" class="btn btn-danger btn-xs" title="Quitar Indicador"> <span class="fa fa-trash"></span>  <b></b> </a>
				</td>
			</tr>
     		@include('evaluadores/evaluador/indicadores/delete');
		@endforeach
		</tbody>
	</table>
</div>
@include('evaluadores/evaluador/indicadores/nuevosindicadores/agregar');

<script>
	$(document).ready(function(){
	    $('#myTableMultiple').DataTable( {
	    "columnDefs": [{
	        "visible": false,
	        "targets": 0
	    }]
    } );
	});
</script>
