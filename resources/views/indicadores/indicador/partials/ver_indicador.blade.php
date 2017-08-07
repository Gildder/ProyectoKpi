<table class="table">
   <tbody>
      <tr>
         <td class="text-right"><b>Nro.:</b></td>
         <td>{{$indicador->id}}</td>
      </tr>
      <tr>
         <td class="text-right"><b>Nombre:</b></td>
         <td>
          <p class="row col-xs-12 col-sm-8">{{$indicador->nombre}}</p>
          </td>
      </tr>
      <tr>
         <td class="text-right"><b>Descripción:</b></td>
         <td>
          <p class="row col-xs-12 col-sm-8">{{$indicador->descripcion}}</p>
          </td>
      </tr>
       <tr>
         <td class="text-right"><b>Tipo Indicador:</b></td>
         <td>{{$indicador->tipo}}</td>
      </tr>
      <tr>
         <td class="text-right"><b>Orden:</b></td>
         <td>{{$indicador->orden}}</td>
      </tr>
   </tbody>
</table>

  <p><b>Formula de Indicador: </b></p>
<div style="background: #dff0d8; padding: 10px;">
{{--        @include('partials/formulas/formula_'.$indicador->id)--}}
  
</div>

