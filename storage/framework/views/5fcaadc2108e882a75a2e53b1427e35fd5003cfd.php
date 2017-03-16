<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th>Departamento</th>	
			<th>Cargo</th>	
			<th></th>	
		</thead>

		<tbody>
		<?php foreach($empleadosdis as $item): ?>
			<tr>
				<td><?php echo e($item->codigo); ?></td>
				<td><?php echo e($item->nombres); ?> <?php echo e($item->apellidos); ?></td>
				<td><?php echo e($item->departamento); ?></td>
				<td><?php echo e($item->cargo); ?></td>
				<td>
					<?php if($tipo == 1): ?>
					<a href="<?php echo e(route('supervisores.supervisor.agregardepartamento', array($item->codigo, $lista->id))); ?>" class="btn btn-success btn-xs" title="Agregar Empleado"><span class="fa fa-plus" title="Agregar Empleado" ></span></a>
					<?php else: ?>
					<a href="<?php echo e(route('supervisores.supervisor.agregarcargo', array($item->codigo, $lista->id))); ?>" class="btn btn-success btn-xs" title="Agregar Empleado"><span class="fa fa-plus" title="Agregar Empleado" ></span></a>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>