<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Descripcion</th>	
			<th>Fecha Inicio </th>	
			<th>Fecha Fin  </th>	
			<th>Tiempo Estimado</th>	
			<th>Fecha Inicio Ejecucion </th>	
			<th>Fecha Fin Ejecucion </th>	
			<th>Tiempo Ejecucion</th>	
			<th>Estado</th>	
			<th>Observacion</th>	
			<th>Ubicaciones</th>	
		</thead>
	<?php /* 	<tfoot style="display: table-header-group;" >
			<th>Nro</th>
			<th>Descripcion</th>	
			<th>Fecha Inicio</th>	
			<th>Fecha Fin </th>	
			<th>Tiempo Ejecucion</th>	
			<th>Estado</th>	
			<th>Ubicacion</th>	
		</tfoot>
 */ ?>
		<tbody>
<?php foreach($tareas as $tarea): ?>
<tr>
	<td><a href="<?php echo e(route('tareas.tareaProgramadas.show', $tarea->id )); ?>" class="btn btn-warning btn-xs" title="Ver"><span ><?php echo e($tarea->id); ?></span></a></td>
	<td><?php echo e($tarea->descripcion); ?></td>
	<td><?php if($tarea->fechaInicioEstimado == ''): ?> _/_/_ <?php else: ?>  <?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)); ?>  <?php endif; ?></td>
	<td><?php if($tarea->fechaFinEstimado == ''): ?> _/_/_ <?php else: ?>  <?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)); ?>  <?php endif; ?></td>
	<td><?php if($tarea->tiempoEstimado == ''): ?> 00:00 <?php else: ?>  <?php echo e($tarea->tiempoEstimado); ?>  <?php endif; ?></td>
	<td><?php if($tarea->fechaInicioSolucion == ''): ?> _/_/_ <?php else: ?>  <?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)); ?>  <?php endif; ?></td>
	<td><?php if($tarea->fechaFinSolucion == ''): ?> _/_/_ <?php else: ?>  <?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaFinSolucion)); ?>  <?php endif; ?></td>
	<td><?php if($tarea->tiempoSolucion == ''): ?> 00:00 <?php else: ?>  <?php echo e($tarea->tiempoSolucion); ?>  <?php endif; ?></td>
	<td><?php echo e($tarea->getEstado($tarea->id)); ?></td>
	<td><?php if($tarea->observaciones == ''): ?> ninguna <?php else: ?>  <?php echo e($tarea->observaciones); ?>  <?php endif; ?></td>
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