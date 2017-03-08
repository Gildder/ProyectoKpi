<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
			<?php foreach($empleadosup as $item): ?>
			<tr>
				<td><?php echo e($item->id); ?></td>
				<td><?php echo e($item->nombre); ?></td>
				<td>
					<a href="<?php echo e(route('empleados.evaluadorcargos.quitarcargo', array($item->id, $evaluador->id))); ?>" class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar Cargo"></span></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

