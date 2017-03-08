<table class="table">
   <tbody>
      <tr>
         <td class="text-right"><b>Codigo:</b></td>
         <td><?php echo e($empleados->codigo); ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Nombre Completo:</b></td>
         <td><?php echo e($empleados->nombres); ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Apellidos:</b></td>
         <td><?php echo e($empleados->apellidos); ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Nombre Usuario:</b></td>
         <td><?php echo e($empleados->usuario); ?></td>
      </tr>
     
      <tr>
         <td class="text-right"><b>Cargo:</b></td>
         <td><?php echo e($empleados->cargo); ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Correo Electronico:</b></td>
         <td><?php echo e($empleados->email); ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Localizacion:</b></td>
         <td><?php echo e($empleados->localizacion); ?></td>
      </tr>

      <tr>
         <td class="text-right"><b>Departamento:</b></td>
         <td><?php echo e($empleados->departamento); ?></td>
      </tr>

   </tbody>
</table>


