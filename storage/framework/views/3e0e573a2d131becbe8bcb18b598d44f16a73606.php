<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
		</thead>

		<tbody>
		<?php foreach($escalas as $escala): ?>
			<tr>
				<td><a href="<?php echo e(route('evaluadores.escala.show', $escala->id )); ?>" class="btn btn-warning btn-xs" ><span class=""  title="Eliminar"></span><span ><?php echo e($escala->id); ?></span></a></td>
				<td><?php echo e($escala->nombre); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>