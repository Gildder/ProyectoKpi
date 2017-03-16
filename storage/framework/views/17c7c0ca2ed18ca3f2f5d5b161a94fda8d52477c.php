<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre Completo</th>	
			<th></th>	
		</thead>

		<tbody>
			<?php foreach($empleadosup as $item): ?>
			<tr>
				<td><?php echo e($item->codigo); ?></td>
				<td><?php echo e($item->nombres); ?> <?php echo e($item->apellidos); ?></td>
				<td>
					<a href="<?php echo e(route('evaluadores.evaluador.quitarempleado', array($item->codigo, $evaluador->id))); ?>" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"  title="Quitar Empleado"></span></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
