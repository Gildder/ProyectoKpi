
<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Descripcion</th>	
		</thead>

		<tbody>
		<?php foreach($ponderaciones as $item): ?>
			<tr>
				<td><a href="<?php echo e(route('evaluadores.ponderacion.show', $item->id)); ?>" class="btn btn-warning btn-xs" title="Ver"><?php echo e($item->id); ?></a></td>
				<td><?php echo e($item->nombre); ?></td>
				<td><?php echo e($item->descripcion); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>