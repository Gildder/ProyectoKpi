<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Tipo</th>	
			<th>Orden</th>	
			<th>Objetivo</th>	
			<th>Cargo</th>	
		</thead>

		<tbody>
		<?php foreach($indicadores as $indicador): ?>
			<tr>
				<td><a href="<?php echo e(route('indicadores.indicador.show', $indicador->id)); ?>" class="btn btn-warning btn-xs" ><span ><?php echo e($indicador->id); ?></span></a></td>
				<td><?php echo e($indicador->nombre); ?></td>
				<td><?php echo e($indicador->tipo); ?></td>
				<td><?php echo e($indicador->orden); ?></td>
				<td><?php echo e($indicador->descripcion_objetivo); ?></td>
				<td><a href="<?php echo e(route('indicadores.indicadorcargos.show', $indicador->id)); ?>" class="btn btn-info btn-sm" ><span >Cargos</span></a></td>

			</tr>
    		<?php echo $__env->make('indicadores/indicador/delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>