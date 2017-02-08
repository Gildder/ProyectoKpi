<table class="table">
   <tbody>
      <tr>
         <td class="text-right"><b>Nro.:</b></td>
         <td>{{$tarea->id}}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Descripcion:</b></td>
         <td>{{$tarea->descripcion}}</td>
      </tr> 

      <tr>
         <td class="text-right"><b>Fecha Inicio Solucion:</b></td>
          <td>@if($tarea->fechaInicioSolucion == '') 0000-00-00 @else  {{$tarea->fechaInicioSolucion}}  @endif</td>
      </tr>
      
       <tr>
         <td class="text-right"><b>Fecha Final Solucion:</b></td>
          <td>@if($tarea->fechaFinSolucion == '') 0000-00-00 @else  {{$tarea->fechaFinSolucion}}  @endif</td>
      </tr>
      
       <tr>
         <td class="text-right"><b>Tiempo Solucion:</b></td>
          <td>@if($tarea->tiempoSolucion == '') 00:00 @else  {{$tarea->tiempoSolucion}}  @endif</td>
      </tr>

      <tr>
         <td class="text-right"><b>Estado:</b></td>
         <td>{{$tarea->getEstado($tarea->id)}}</td>
      </tr>

       <tr>
         <td class="text-right"><b>Observaciones:</b></td>
          <td>@if($tarea->observaciones == '') Ninguna @else  {{$tarea->observaciones}}  @endif</td>

      </tr>
   </tbody>
</table>
