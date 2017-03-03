<table class="table">
   <tbody>
      <tr>
         <td class="text-right"><b>Nro.:</b></td>
         <td><?php echo e($tarea->id); ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Descripcion:</b></td>
         <td><?php echo e($tarea->descripcion); ?></td>
      </tr> 

      <tr>
         <td class="text-right"><b>Fecha Inicio Estimado:</b></td>
         <td><?php echo e($tarea->fechaInicioEstimado); ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Fecha Fin Estimado:</b></td>
         <td><?php echo e($tarea->fechaFinEstimado); ?></td>
      </tr>

       <tr>
         <td class="text-right"><b>Tiempo Estimado:</b></td>
         <td><?php echo e($tarea->tiempoEstimado); ?></td>
      </tr>

       <tr>
         <td class="text-right"><b>Fecha Inicio Solucion:</b></td>
          <td><?php if($tarea->fechaInicioSolucion == ''): ?> 0000-00-00 <?php else: ?>  <?php echo e($tarea->fechaInicioSolucion); ?>  <?php endif; ?></td>
      </tr>
      
       <tr>
         <td class="text-right"><b>Fecha Final Solucion:</b></td>
          <td><?php if($tarea->fechaFinSolucion == ''): ?> 0000-00-00 <?php else: ?>  <?php echo e($tarea->fechaFinSolucion); ?>  <?php endif; ?></td>
      </tr>
      
       <tr>
         <td class="text-right"><b>Tiempo Solucion:</b></td>
          <td><?php if($tarea->tiempoSolucion == ''): ?> 00:00 <?php else: ?>  <?php echo e($tarea->tiempoSolucion); ?>  <?php endif; ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Estado:</b></td>
         <td><?php echo e($tarea->getEstado($tarea->id)); ?></td>
      </tr>

       <tr>
         <td class="text-right"><b>Observaciones:</b></td>
          <td><?php if($tarea->observaciones == ''): ?> Ninguna <?php else: ?>  <?php echo e($tarea->observaciones); ?>  <?php endif; ?></td>

      </tr>
   </tbody>
</table>
