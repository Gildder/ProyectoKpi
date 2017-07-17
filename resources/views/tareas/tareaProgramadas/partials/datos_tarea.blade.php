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
         <td class="text-right"><b>Fecha Inicio Estimado:</b></td>
         <td>{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)}}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Fecha Fin Estimado:</b></td>
         <td>{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)}}</td>
      </tr>

       <tr>
         <td class="text-right"><b>Tiempo Estimado:</b></td>
         <td>{{$tarea->tiempoEstimado}}</td>
      </tr>

       <tr>
         <td class="text-right"><b>Fecha Inicio Ejecucion:</b></td>
          <td>@if($tarea->fechaInicioSolucion == '') _/_/_ @else  {{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)}}  @endif</td>
      </tr>
      
       <tr>
         <td class="text-right"><b>Fecha Final Ejecucion:</b></td>
          <td>@if($tarea->fechaFinSolucion == '') _/_/_ @else  {{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)}}  @endif</td>
      </tr>
      
       <tr>
         <td class="text-right"><b>Tiempo Ejecucion:</b></td>
          <td>@if($tarea->tiempoSolucion == '') 00:00 @else  {{$tarea->tiempoSolucion}}  @endif</td>
      </tr>

      <tr>
          <td class="text-right"><b>Estado:</b></td>
          <td>
          <span class="badge bg-{{ $tarea->getEstadoColor() }}">
            {{$tarea->getEstado()}}
          </span>
          </td>
      </tr>



      <tr>
         <td class="text-right"><b>Observaciones:</b></td>
          <td>@if($tarea->observaciones == '') Ninguna @else  {{$tarea->observaciones}}  @endif</td>

      </tr>
   </tbody>
</table>
<script>

$(document).ready(function(){
    $(".1").addClass("badge bg-red");
    $(".2").addClass("badge bg-yellow");
    $(".3").addClass("badge bg-green");

});



</script>
