<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre Completo</th>	
			<th>Usuario</th>	
			<th>Correo</th>	
			<th>Cargo</th>	
			<th>Localizaciones</th>	
			<th>Departamentos</th>	
		</thead>

		<tbody>
		<?php foreach($empleados as $item): ?>
			<tr>
				<td><a href="<?php echo e(route('empleados.empleado.show', $item->codigo)); ?>" class="btn btn-warning btn-xs" title="Ver"><?php echo e($item->codigo); ?></a></td>
				<td><?php echo e($item->nombres); ?> <?php echo e($item->apellidos); ?></td>
				<td><?php echo e($item->usuario); ?></td>
				<td><?php echo e($item->correo); ?></td>
				<td><?php echo e($item->cargo); ?></td>
				<td><?php echo e($item->localizacion); ?></td>
				<td><?php echo e($item->departamento); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>