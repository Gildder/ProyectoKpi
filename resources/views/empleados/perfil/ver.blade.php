<table class="table">
   <tbody>
      <tr>
         <td class="text-right"><b>Codigo:</b></td>
         <td>{{ \Usuario::get('codigo') }}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Nombre Completo:</b></td>
         <td>{{  \Usuario::get('nombre')}}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Apellidos:</b></td>
         <td>{{ \Usuario::get('apellido') }}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Nombre Usuario:</b></td>
         <td>{{ \Usuario::get('usuario') }}</td>
      </tr>
     
      <tr>
         <td class="text-right"><b>Cargo:</b></td>
         <td>{{ \Usuario::get('cargo') }}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Correo Electronico:</b></td>
         <td>{{ \Usuario::get('correo') }}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Localizacion:</b></td>
         <td>{{ \Usuario::get('localizacion') }}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Departamento:</b></td>
         <td>{{ \Usuario::get('departamento')}}</td>
      </tr>

   </tbody>
</table>


