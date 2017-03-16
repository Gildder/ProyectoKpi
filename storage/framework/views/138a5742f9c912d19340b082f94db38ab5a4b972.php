<div class="table-response">
	<table id="myTable3" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
		<?php foreach($cargosdis as $item): ?>
			<tr>
				<td><?php echo e($item->id); ?></td>
				<td><?php echo e($item->nombre); ?> </td>
				<td>
					<a href="<?php echo e(route('evaluadores.evaluador.agregarcargo', array($item->id, $evaluador->id))); ?>"  class="btn btn-success btn-xs" title="Agregar Cargo"> <span class="fa fa-plus"></span>  <b></b> </a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>