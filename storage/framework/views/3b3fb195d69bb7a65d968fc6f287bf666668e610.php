<table class="table">
   <tbody>
      <tr>
         <td class="text-right"><b>Nro.:</b></td>
         <td><?php echo e($indicador->id); ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Objetivo:</b></td>
         <td><?php echo e($indicador->descripcion_objetivo); ?></td>
      </tr>
      <tr>
         <td class="text-right"><b>Orden:</b></td>
         <td><?php echo e($indicador->orden); ?></td>
      </tr>

       <tr>
         <td class="text-right"><b>Tipo Indicador:</b></td>
         <td><?php echo e($indicador->tipo); ?></td>
      </tr>
   </tbody>
</table>

  <p><b>Formula de Indicador: </b></p>
<div style="background: #dff0d8; padding: 10px;">
        <?php echo $__env->make('partials/formulas/formula_'.$indicador->id, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
</div>

