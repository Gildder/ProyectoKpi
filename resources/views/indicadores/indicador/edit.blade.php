@extends('layouts.app')

@section('content-header')
	<h1>{{$indicador->nombre}}</h1>
@endsection

@section('content')
	

<!-- Detalle de Indicador-->
<div class="col-sm-6">
	<div class="panel panel-default">
	  <div class="panel-heading">
	  	<a href="{{route('indicadores.indicador.index')}}" class="btn btn-primary"><span class="fa fa-reply"></span></a>
	  </div>
	  <div class="panel-body">
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
	</div>
</div>		

<!-- Lista de Cargos-->
<div class="col-sm-6">
	<div class="panel panel-default">
	  <div class="panel-heading">
	  	<a href="{{route('indicadores.indicador.index')}}" class="btn btn-primary"><span class="fa fa-reply"></span></a>
	  </div>
	  <div class="panel-body">

			
			<div class="col-lg-12">
	         <h3>Lista de Puestos</h3>
	         <p>Los puestos de trabajo a los cuales se aplicara el indicador.</p>

	        @if(count($cargos_libres) > 0)
	          <div class="col-sm-12" style="background: white; padding: 10px;">
	            {!!Form::open(['route'=>['indicadores.indicador.update', $indicador->id], 'method'=>'PUT'])!!}
	               <label for="cargos">Seleccionar Puestos:</label><br>
	                   @foreach($cargos_libres as $item)
	                     <!--<option value="{{$item->id}}">{{$item->nombre}}</option>-->
	                     <label>{{ Form::checkbox('prov[]', $item->id) }} {{ $item->nombre }}</label><br>
	                   @endforeach
	               <div class="col-sm-12">
	                   {!! form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'<span class="glyphicon glyphicon-ok">Guardar</span>', 'class'=>'btn btn-success col-sm' ]) !!}
	               </div>
	            {!! Form::close()!!}
	          </div>

	        @else
	          <div class='alert alert-success' role="alert">
	            <button type="button" class="close" data-dismiss="alert" style="top: 0px  position: relative; float: right;">&times;</button>
	            <strong>No hay Puestos disponibles para agregar a este indicador</strong>
	          </div>

	        @endif

	         <div class="table-response">
	            <table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
	               <thead>
	                  <th>Nro</th>
	                  <th>Nombre</th>   
	                  <th  class="hidden-xs">Estado</th>   
	                  <th  class="hidden-xs">Fecha Modificacion</th>   
	                  <th >Opciones</th>
	               </thead>

	               <tbody>
	               @foreach($cargos_indicardor as $cargo)
	                  <tr>
	                     <td>{{$cargo->id}}</td>
	                     <td>{{$cargo->nombre}}</td>
	                     <td  class="hidden-xs">@if($cargo->estado == '1') <span class="btn-success  btn-xs">Habilitado</span> @else <span class="btn-danger btn-xs">Desabilitado</span> @endif </td>
	                     <td  class="hidden-xs">{{$cargo->updated_at}}</td>
	                     <td>
	                        <a href="{{route('indicadores.indicador.quitar', [$indicador->id, $cargo->id])}}" class="btn btn-primary btn-sm"><span class=""  title="Baja"></span><span >Quitar</span></a>
	                     </td>
	                  </tr>
	               @endforeach
	               </tbody>
	         
	            </table>
	         </div>
	      </div>
	  </div>
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
@endsection