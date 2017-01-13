<table class="table">
   <tbody>
      <tr>
         <td class="text-right"><b>Nro.:</b></td>
         <td>{{$indicador->id}}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Objetivo:</b></td>
         <td>{{$indicador->descripcion_objetivo}} {{$indicador->objetivo}}%</td>
      </tr>

      <tr>
         <td class="text-right"><b>Condicion:</b></td>
         <td>{{$indicador->condicion}}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Orden:</b></td>
         <td>{{$indicador->orden}}</td>
      </tr>

       <tr>
         <td class="text-right"><b>Tipo Indicador:</b></td>
         <td>{{$indicador->tipo}}</td>
      </tr>

      <tr>
         <td class="text-right"><b>Frecuencia:</b></td>
         <td>{{$indicador->frecuencia}}</td>
      </tr>
   </tbody>
</table>

  <p><b>Formula de Indicador: </b></p>
<div style="background: #dff0d8; padding: 10px;">
        @include('partials/formulas/formula_'.$indicador->id)
  
</div>

