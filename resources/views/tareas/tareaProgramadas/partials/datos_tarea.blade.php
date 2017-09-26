<table class="table">
   <tbody>
      <tr>
         <td class="text-right"><b>Nro.:</b></td>
         <td>{{$tarea->numero}}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Descripcion:</b></td>
         <td>{{$tarea->descripcion}}</td>
      </tr> 

      <tr>
         <td class="text-right"><b>Fecha Inicio:</b></td>
         <td>{{$tarea->fechaInicio}}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Fecha Fin:</b></td>
         <td>{{$tarea->fechaFin}}</td>
      </tr>

       <tr>
         <td class="text-right"><b>Tiempo:</b></td>
         <td>{{$tarea->tiempo}}</td>
      </tr>

      <tr>
          <td class="text-right"><b>Estado:</b></td>
          <td>
              <label  class="estiloEstado" > {{$tarea->estado }} </label>
          </span>
          </td>
      </tr>

      <tr>
         <td class="text-right"><b>Observaciones:</b></td>
          <td>{{ $tarea->observaciones}}</td>

      </tr>
   </tbody>
</table>

<style type="text/css">
.estiloEstado {
    background: {{$tarea->colorEstado}};
    color:{{$tarea->textoColor}};
    font-size: 10px;
    padding: 1.5px 5px;
    border-radius: 15px;
    box-shadow: 1px 1px gray;
}
</style>




