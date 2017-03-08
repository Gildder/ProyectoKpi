<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Objetivo</th>	
			<th>Frecuencia</th>	
			<th></th>	
		</thead>

		<tbody>
			<?php foreach($cargosEvaluadores as $item): ?>
			<tr>
				<td><?php echo e($item->id); ?></td>
				<td><?php echo e($item->nombre); ?></td>
				<td><?php echo e($item->objetivo); ?> %</td>
				<td><?php echo e($item->frecuencia); ?></td>
				<td>
					<a href="<?php echo e(route('indicadores.indicadorcargos.editar', array($item->id, $indicador->id))); ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-edit" ></span></a>
					<a href="#" data-toggle="modal" data-target="#modal-delete-<?php echo e($item->id); ?>" class="btn btn-danger btn-sm" ><span class="fa fa-trash"  title="Quitar Cargo"></span></a>
				</td>
			</tr>
				<?php echo $__env->make('indicadores/indicadorcargos/delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

