<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
		<?php foreach($cargos as $cargo): ?>
			<tr>
				<td><?php echo e($cargo->id); ?></td>
				<td><?php echo e($cargo->nombre); ?></td>
				<td><a  href="#"  data-toggle="modal" data-target="#modal-restaurar-<?php echo e($cargo->id); ?>"  class="btn btn-success btn-xs" ><span class="fa fa-check"  title="Restaurar"></span><span >  Restaurar</span></a></td>
			</tr>
			<?php echo $__env->make("empleados/cargo/restaurar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php endforeach; ?>
		</tbody>

	</table>
</div>