<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Abreviatura</th>	
			<th>Descripcion</th>	
			<th>Ponderacion</th>	
		</thead>

		<tbody>
		<?php foreach($evaluadores as $item): ?>
			<tr>
				<td><a href="<?php echo e(route('evaluadores.evaluador.show', $item->id)); ?>" class="btn btn-warning btn-xs" title="Ver"><?php echo e($item->id); ?></a></td>
				<td><?php echo e($item->abreviatura); ?></td>
				<td><?php echo e($item->descripcion); ?></td>
				<td><?php echo e($item->ponderaciones->nombre); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>