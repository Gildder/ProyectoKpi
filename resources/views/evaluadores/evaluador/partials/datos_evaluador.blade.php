<table class="table">
      <tr>
         <td class="text-right"><b>Nro.:</b></td>
         <td>{{$evaluador->id}}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Abreviatura:</b></td>
         <td>{{$evaluador->abreviatura}}</td>
      </tr>

       <tr>
         <td class="text-right"><b>Descripcion:</b></td>
         <td>{{$evaluador->descripcion}}</td>
      </tr>

       <tr>
         <td class="text-right"><b>Ponderacion:</b></td>
         <td>{{$evaluador->ponderacion->nombre}}</td>
      </tr>
</table>
