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
         <td><?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)); ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Fecha Fin Estimado:</b></td>
         <td><?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)); ?></td>
      </tr>

       <tr>
         <td class="text-right"><b>Tiempo Estimado:</b></td>
         <td><?php echo e($tarea->tiempoEstimado); ?></td>
      </tr>

       <tr>
         <td class="text-right"><b>Fecha Inicio Ejecucion:</b></td>
          <td><?php if($tarea->fechaInicioSolucion == ''): ?> _/_/_ <?php else: ?>  <?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)); ?>  <?php endif; ?></td>
      </tr>
      
       <tr>
         <td class="text-right"><b>Fecha Final Ejecucion:</b></td>
          <td><?php if($tarea->fechaFinSolucion == ''): ?> _/_/_ <?php else: ?>  <?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)); ?>  <?php endif; ?></td>
      </tr>
      
       <tr>
         <td class="text-right"><b>Tiempo Ejecucion:</b></td>
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
