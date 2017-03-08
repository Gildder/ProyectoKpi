<div class="table-response">
	<table  id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Departamentos</th>	
			<th>Supervisores</th>	
		</thead>

		<tbody>
		<?php foreach($departamentos as $item): ?>
			<tr>
				<td><a href="<?php echo e(route('supervisores.supervisor.show', $item->id)); ?>" class="btn btn-warning btn-xs" class="btn btn-primary btn-xs" ><span ><?php echo e($item->id); ?></span></a></td>
				<td><?php echo e($item->nombre); ?></td>
				<td> 
					<?php foreach($item->getsupervisores($item->id) as $empleado): ?>
						<?php echo e($empleado->codigo); ?> - <?php echo e($empleado->nombres); ?> <?php echo e($empleado->apellidos); ?>  <br>
					<?php endforeach; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>