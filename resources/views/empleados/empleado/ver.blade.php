<table class="table">
   <tbody>
      <tr>
         <td class="text-right"><b>Nombre Usuario:</b></td>
         <td>{{$empleado->usuario }}</td>
      </tr>
     
      <tr>
         <td class="text-right"><b>Correo Electronico:</b></td>
         <td>{{$empleado->correo }}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Codigo:</b></td>
         <td>{{$empleado->codigo }}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Nombre Completo:</b></td>
         <td>{{$empleado->nombres }} {{$empleado->apellidos }}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Cargo:</b></td>
         <td>{{$empleado->cargo }}</td>
      </tr>


      <tr>
         <td class="text-right"><b>Localizacion:</b></td>
         <td>{{$empleado->localizacion }}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Departamento:</b></td>
         <td>{{$empleado->departamento }}</td>
      </tr>

   </tbody>
</table>


