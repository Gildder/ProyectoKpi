<div class="table-response">
				
	<table  id="myTableGrDepartamento" class="table table-striped table-bordered table-condensed table-hover">

		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Opciones</th>
		</thead>

		<tbody>
		<?php foreach($grupolocalizaciones as $item): ?>
			<tr>
				<td><?php echo e($item->id); ?></td>
				<td><?php echo e($item->nombre); ?></td>
				<td>
					<a  href="<?php echo e(route('localizaciones.grupolocalizacion.edit', $item->id)); ?>"  class="btn btn-warning btn-sm"><span class="fa fa-edit"   title="Editar"></span><b> Editar</b></a>
					<a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-<?php echo e($item->id); ?>"><span class="fa fa-trash"  title="Eliminar"></span><b> Borrar</b></a>
				</td>
			</tr>
			<?php echo $__env->make("localizaciones/grupolocalizacion/delete", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			
		<?php endforeach; ?>
		</tbody>

	</table>
</div>