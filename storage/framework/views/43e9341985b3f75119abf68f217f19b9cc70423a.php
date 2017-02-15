<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro.</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
		<?php foreach($ubicacionesDis as $item): ?>
			<tr>
				<td><?php echo e($item->id); ?></td>
				<td><?php echo e($item->nombre); ?></td>
				<td>
					<a href="<?php echo e(route('tareas.tareaProgramadas.agregarubicacion', array( $tarea->id, $item->id ))); ?>" class="btn btn-primary btn-sm"><span class="fa fa-plus" title="Agregar" ></span></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>