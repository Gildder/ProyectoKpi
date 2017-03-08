<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th>Cargo</th>	
			<th></th>	
		</thead>

		<tbody>
			<?php foreach($empleadosup as $item): ?>
			<tr>
				<td><?php echo e($item->codigo); ?></td>
				<td><?php echo e($item->nombres); ?> <?php echo e($item->apellidos); ?></td>
				<td><?php echo e($item->cargo); ?></td>
				<td>
					<a href="<?php echo e(route('supervisores.supervisor.quitardepartamento', array($item->codigo, $departamento->id))); ?>" class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar"></span></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>



