<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th>Cargo</th>	
			<th>Departamentos</th>	
		</thead>

		<tbody>
		<?php foreach($empleadosDisponibles as $item): ?>
			<tr>
				<td><a href="<?php echo e(route('supervisores.supervisados.show', $item->codigo)); ?>" onclick="<?php echo e(Cache::forever('emp_sado', $item->codigo.': '. $item->nombres .' '. $item->apellidos )); ?>" class="btn btn-warning btn-xs" ><span class=""  title="Ver"></span><span ><?php echo e($item->codigo); ?></span></a></td>
				<td><?php echo e($item->nombres); ?> <?php echo e($item->apellidos); ?></td>
				<td><?php echo e($item->cargo); ?></td>
				<td><?php echo e($item->departamento); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>