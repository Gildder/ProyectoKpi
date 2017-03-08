<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Abreviatura</th>	
			<th>Descripcion</th>	
		</thead>

		<tbody>
		<?php foreach($evaluadores as $item): ?>
			<tr>
				<td><a href="<?php echo e(route('empleados.evaluador.show', $item->id)); ?>" class="btn btn-warning btn-xs" ><?php echo e($item->id); ?></a></td>
				<td><?php echo e($item->abreviatura); ?></td>
				<td><?php echo e($item->descripcion); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>