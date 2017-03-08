<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Tipo</th>	
			<th>Objetivo</th>	
			<th>Cagos Asignados</th>	
		</thead>

		<tbody>
			<?php foreach($indicadores as $item): ?>
				<tr>
					<td><a href="<?php echo e(route('indicadores.indicadorcargos.show', $item->id)); ?>" class="btn btn-warning btn-xs" ><?php echo e($item->id); ?></a></td>
					<td><?php echo e($item->nombre); ?></td>
					<td><?php echo e($item->tipo); ?></td>
					<td><?php echo e($item->descripcion_objetivo); ?></td>
					<td> 
						<?php foreach($item->getCargos($item->id) as $cargo): ?>
							<?php echo e($cargo->nombre); ?> <br>
						<?php endforeach; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>