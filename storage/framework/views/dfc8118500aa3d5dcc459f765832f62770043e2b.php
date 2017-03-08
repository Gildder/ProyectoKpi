<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Abreviatura</th>	
			<th>Evaludores</th>	
		</thead>

		<tbody>
		<?php foreach($evaluadores as $item): ?>
			<tr>
				<td><a href="<?php echo e(route('empleados.evaluadorempleados.show', $item->id)); ?>" class="btn btn-warning btn-xs" title="Ver"><?php echo e($item->id); ?></a></td>
				<td><?php echo e($item->abreviatura); ?></td>
				<td>
					<?php foreach($item->getEmpleados($item->id) as $empleado): ?>
						<?php echo e($empleado->codigo); ?>: <?php echo e($empleado->nombres); ?> <?php echo e($empleado->apellidos); ?> <br>
					<?php endforeach; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>