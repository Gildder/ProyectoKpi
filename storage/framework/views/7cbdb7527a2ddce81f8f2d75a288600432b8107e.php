<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Tipo</th>	
			<th>Orden</th>	

		<tbody>
		<?php foreach($indicadoresDisponibles as $item): ?>
			<tr>
				<td><?php echo e($item->id); ?></td>
				<td><?php echo e($item->nombre); ?></td>
				<td><?php echo e($item->tipo); ?></td>
				<td><?php echo e($item->orden); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>