<table class="table">
   <tbody>
      <tr>
         <td class="text-right"><b>Nro.:</b></td>
         <td>{{$estado->id}}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Nombre:</b></td>
         <td>{{$estado->nombre}}</td>
      </tr>
      <tr>
         <td class="text-right"><b>Descripcion:</b></td>
         <td>{{$estado->descripcion}}</td>
      </tr>

      <tr>
          <td class="text-right"><b>Estilo:</b></td>
          <td><input class="estiloEstado" style="background-color: {!! $estado->color !!}; color: {!! $estado->texto !!};" value="{!! $estado->nombre !!}" readonly="true">
          </td>
      </tr>

      <tr>
          <td class="text-right"><b>Visible en Calendario:</b></td>
          <td>@if($estado->visibleCalendario == 1)Si @else No @endif </td>
      </tr>
      <tr>
          <td class="text-right"><b>Visible por Empleado:</b></td>
          <td>@if($estado->visibleEmpleado == 1)Si @else No @endif </td>
      </tr>
   </tbody>
</table>

<style>
    .estiloEstado{
        border-radius: 10px;
        text-align: center;
    }
</style>
