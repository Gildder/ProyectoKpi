<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Minimo %</th>	
			<th>Maximo %</th>	
			<th></th>	
		</thead>

		<tbody>
			<?php foreach($escalasAgregados as $item): ?>
			<tr>
				<td><?php echo e($item->id); ?></td>
				<td><?php echo e($item->nombre); ?></td>
				<td><?php echo e($item->minimo); ?></td>
				<td><?php echo e($item->maximo); ?></td>
				<td>
					<a href="<?php echo e(route('evaluadores.ponderacion.quitarescala', array($item->id, $ponderacion->id))); ?>" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"  title="Quitar Indicador"></span></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

