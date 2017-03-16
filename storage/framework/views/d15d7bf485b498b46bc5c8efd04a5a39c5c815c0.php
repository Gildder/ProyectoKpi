<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro.</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
		<?php foreach($escalasDisponibles as $item): ?>
			<tr>
				<td><?php echo e($item->id); ?></td>
				<td><?php echo e($item->nombre); ?></td>
				<td>
					<?php /* <a href="<?php echo e(route('evaluadores.ponderacion.agregartipos', array($item->id, $ponderacion->id))); ?>"  class="btn btn-success btn-xs" title="Agregar Tipo"> <span class="fa fa-plus"></span>  <b></b> </a> */ ?>

					<a href="#"  data-toggle="modal" data-target="#modal-escala-<?php echo e($item->id); ?>" class="btn btn-success btn-sm"><span class="fa fa-plus"></span><b></b> </a>
				</td>
			</tr>
			<?php echo $__env->make("evaluadores/ponderacion/escalas/ponderacion", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php endforeach; ?>
		</tbody>

	</table>
</div>