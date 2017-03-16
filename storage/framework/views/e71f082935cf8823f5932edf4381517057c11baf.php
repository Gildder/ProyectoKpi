<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombres</th>	
			<th>Apellidos</th>	
			<th>Departamento</th>	
			<th>Usuario</th>	
			<th>Correo</th>	
			<th>Cargo</th>	
			<th></th>	
		</thead>
		<tfoot style="display: table-header-group;" >
			<th>Nro</th>
			<th>Nombres</th>	
			<th>Apellidos</th>	
			<th>Departamento</th>	
			<th>Usuario</th>	
			<th>Correo</th>	
			<th>Cargo</th>	
		</tfoot>

		<tbody>
		<?php foreach($evaluados as $item): ?>
			<tr>
				<td><?php echo e($item->codigo); ?></td>
				<td><?php echo e($item->nombres); ?></td>
				<td><?php echo e($item->apellidos); ?></td>
				<td><?php echo e($item->departamento); ?></td>
				<td><?php echo e($item->usuario); ?></td>
				<td><?php echo e($item->correo); ?></td>
				<td><?php echo e($item->cargo); ?></td>
				<td><a href="#" class="btn btn-info btn-xs" title="Ver Indicador"><span class="fa fa-bar-chart"></span></a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>

	</table>
</div>