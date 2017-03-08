<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th>Cargo</th>	
			<th></th>	
		</thead>

		<tbody>
		<?php foreach($empleadosdis as $item): ?>
			<tr>
				<td><?php echo e($item->codigo); ?></td>
				<td><?php echo e($item->nombres); ?> <?php echo e($item->apellidos); ?></td>
				<td><?php echo e($item->cargo); ?></td>
				<td>
					<a href="<?php echo e(route('empleados.evaluadorempleados.agregarempleado', array($item->codigo, $evaluador->id))); ?>"  class="btn btn-success btn-xs" title="Agregar Empleado"> <span class="fa fa-plus"></span>  <b></b> </a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>