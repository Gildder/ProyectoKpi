<table class="table">
   <tbody>
      <tr>
         <td class="text-right"><b>Nro.:</b></td>
         <td><?php echo e($evaluador->id); ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Abreviatura:</b></td>
         <td><?php echo e($evaluador->abreviatura); ?></td>
      </tr>

       <tr>
         <td class="text-right"><b>Descripcion:</b></td>
         <td><?php echo e($evaluador->descripcion); ?></td>
      </tr>

       <tr>
         <td class="text-right"><b>Ponderacion:</b></td>
         <td><?php echo e($evaluador->ponderaciones->nombre); ?></td>
      </tr>
   </tbody>
</table>
