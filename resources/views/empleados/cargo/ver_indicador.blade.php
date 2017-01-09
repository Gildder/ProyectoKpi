<div class="panel-body" >
  <table class="table">
     <tbody>
        <tr>
           <td class="text-right"><b>Nro.:</b></td>
           <td>{{$indicador->id}}</td>
        </tr>

        <tr>
           <td class="text-right"><b>Orden:</b></td>
           <td>{{$indicador->orden}}</td>
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
           <td class="text-right"><b>Frecuencia:</b></td>
           <td>{{$indicador->frecuencia}}</td>
        </tr>

         <tr>
           <td class="text-right"><b>Formula:</b></td>
           <td></td>
        </tr>
     </tbody>
  </table>

  <div class="text-center" style="background: #dff0d8;">
  	@if($indicador->id ===1)
  	    @include('partials/formulas/formula_primer_indicador')
  	@elseif($indicador->id ===2)
  	    @include('partials/formulas/formula_segundo_indicador')

  	@endif
  </div>



</div>

<style>
	.fraction {
		display: inline-block;
		vertical-align: middle; 
		margin: 0 0.2em 0.4ex;
		text-align: center;
		}
	.fraction > span {
	    display: block;
	    padding-top: 0.15em;
	}
	.fraction span.fdn {border-top: thin solid black;}
	.fraction span.bar {display: none;}
</style>