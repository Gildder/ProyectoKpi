<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
		</thead>

		<tbody>
		<?php foreach($cargos as $cargo): ?>
			<tr>
				<td><a href="<?php echo e(route('empleados.cargo.show', $cargo->id )); ?>" class="btn btn-warning btn-xs" ><span class=""  title="Eliminar"></span><span ><?php echo e($cargo->id); ?></span></a></td>
				<td><?php echo e($cargo->nombre); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>