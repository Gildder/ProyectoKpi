<table class="table">
   <tbody>
      {{--<tr>--}}
         {{--<td class="text-right"><b>Codigo:</b></td>--}}
         {{--<td>@if(! is_null(\Usuario::get('codigo'))) {{ \Usuario::get('codigo')  }} @endif</td>--}}
      {{--</tr>--}}

      <tr>
         <td class="text-right"><b>Nombre:</b></td>
{{--         <td>{{  \Usuario::get('nombre')}}</td>--}}
         <td>@if(! is_null(\Usuario::get('nombre'))) {{ \Usuario::get('nombre')  }} @endif</td>
      </tr>

      <tr>
         <td class="text-right"><b>Apellidos:</b></td>
{{--         <td>{{ \Usuario::get('apellido') }}</td>--}}
         <td>@if(! is_null(\Usuario::get('apellido'))) {{ \Usuario::get('apellido')  }}  @endif</td>

      </tr>

      <tr>
         <td class="text-right"><b>Nombre Usuario:</b></td>
         <td>{{ \Usuario::get('usuario') }}</td>
      </tr>
     
      <tr>
         <td class="text-right"><b>Cargo:</b></td>
{{--         <td>{{ \Usuario::get('cargo')->nombre }}</td>--}}
         <td>@if(! is_null( \Usuario::get('cargo'))) {{  \Usuario::get('cargo')->nombre  }}  @endif</td>

      </tr>

      <tr>
         <td class="text-right"><b>Correo Electronico:</b></td>
{{--         <td>{{ \Usuario::get('correo') }}</td>--}}
         <td>@if(! is_null( \Usuario::get('correo')))  {{\Usuario::get('correo')}}  @endif</td>

      </tr>

      <tr>
         <td class="text-right"><b>Localizacion:</b></td>
         {{--<td>{{ \Usuario::get('localizacion')->nombre }}</td>--}}
         <td>@if(! is_null( \Usuario::get('localizacion')))  {{ \Usuario::get('localizacion')->nombre  }}  @endif</td>
      </tr>

      <tr>
         <td class="text-right"><b>Departamento:</b></td>
         {{--<td>{{ \Usuario::get('departamento')->nombre }}</td>--}}
         <td>@if(! is_null( \Usuario::get('departamento'))) {{ \Usuario::get('departamento')->nombre }}  @endif</td>
      </tr>

   </tbody>
</table>


