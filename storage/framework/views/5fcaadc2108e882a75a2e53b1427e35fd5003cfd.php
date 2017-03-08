<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th>Cargo</th>	
			<th>Departamentos</th>	
			<th></th>	
		</thead>

		<tbody>
		<?php foreach($empleadosdis as $item): ?>
			<tr>
				<td><?php echo e($item->codigo); ?></td>
				<td><?php echo e($item->nombres); ?> <?php echo e($item->apellidos); ?></td>
				<td><?php echo e($item->cargo); ?></td>
				<td><?php echo e($item->departamento); ?></td>
				<td>
					<a href="<?php echo e(route('supervisores.supervisor.agregardepartamento', array($item->codigo, $departamento->id))); ?>" class="btn btn-primary btn-sm"><span class="fa fa-plus" title="Agregar Empleado" ></span></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>