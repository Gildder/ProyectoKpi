
<script>
  $(document).ready(function() {
  	var contador = 0;

  	$( '#agregar' ).on( 'click', function() {
		$("input:checkbox").prop('checked',false);

	});

	$( 'input:checkbox' ).on( 'click', function() {
	    if( $(this).is(':checked') ){
	        // Hacer algo si el checkbox ha sido seleccionado
	        contador++;
	    } else {
	        // Hacer algo si el checkbox ha sido deseleccionado
	        contador--;
	    }
	    if(contador > 0){
	    	$('button[name=aceptar]').removeAttr("disabled");
	    }else{
	    	$('button[name=aceptar]').attr('disabled', 'disabled');
	    }
	});

  });
</script>


<div class="table-response">
	<table id="myTableIndicadorEvalaudor" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th></th>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Ponderacion</th>
			<th>Tipos</th>
		</thead>
		<tbody>
		@foreach($indicadoresDisponibles as $item)
			<tr>
				<td>{{ Form::checkbox('prov[]', $item->id, null, ['class'=>'micheckbox']) }} </td>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->ponderacion}}<b>%</b></td>
				<td>{{$item->tipoIndicador}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>


