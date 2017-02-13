<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Descripcion</th>	
			<th>Fecha Inicio Ejecucion</th>	
			<th>Fecha Fin Ejecucion </th>	
			<th>Tiempo Ejecucion</th>	
			<th>Estado</th>	
			<th>Ubicacion</th>	
		</thead>

		<tbody>
		<?php foreach($tareas as $tarea): ?>
			<tr>
				<td><a href="<?php echo e(route('tareas.tareaProgramadas.show', $tarea->id )); ?>" class="btn btn-warning btn-xs" ><span class=""  title="Eliminar"></span><span ><?php echo e($tarea->id); ?></span></a></td>
				<td><?php echo e($tarea->descripcion); ?></td>
				<td><?php if($tarea->fechaInicioSolucion == ''): ?> 0000-00-00 <?php else: ?>  <?php echo e($tarea->fechaInicioSolucion); ?>  <?php endif; ?></td>
				<td><?php if($tarea->fechaFinSolucion == ''): ?> 0000-00-00 <?php else: ?>  <?php echo e($tarea->fechaFinSolucion); ?>  <?php endif; ?></td>
				<td><?php if($tarea->tiempoSolucion == ''): ?> 00:00 <?php else: ?>  <?php echo e($tarea->tiempoSolucion); ?>  <?php endif; ?></td>
				<td><?php echo e($tarea->getEstado($tarea->id)); ?></td>
				<td>
					<?php foreach($tarea->ubicacionesOcupadas($tarea->id) as $ubicacion): ?>
						<?php echo e($ubicacion->nombre); ?>  <br>
					<?php endforeach; ?>
				</td>
			</tr>

			
		<?php endforeach; ?>
		</tbody>

	</table>
</div>