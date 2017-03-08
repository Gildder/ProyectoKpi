<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
		<?php foreach($cargosDisponibles as $item): ?>
			<tr>
				<td><?php echo e($item->id); ?></td>
				<td><?php echo e($item->nombre); ?> </td>
				<td>
					<a href="<?php echo e(route('indicadores.indicadorcargos.agregarcargo', array($item->id, $indicador->id))); ?>"  class="btn btn-success btn-sm"> <span class="fa fa-plus" title="Agregar Cargo"></span>  <b></b> </a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>