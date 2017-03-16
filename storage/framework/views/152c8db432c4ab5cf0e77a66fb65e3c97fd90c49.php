<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Ponderacion %</th>	
			<th></th>	
		</thead>

		<tbody>
			<?php foreach($indicadoresAgregados as $item): ?>
			<tr>
				<td><?php echo e($item->id); ?></td>
				<td><?php echo e($item->nombres); ?></td>
				<td><?php echo e($item->ponderacion); ?></td>
				<td>
					<a href="<?php echo e(route('evaluadores.ponderacion.quitarindicador', array($item->id, $ponderacion->id))); ?>" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"  title="Quitar Indicador"></span></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
