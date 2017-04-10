@extends('layouts.app')

@section('titulo')
	{!! $indicador->nombre !!}
@endsection

@section('content')


<div class="panel panel-default">
	{{-- Header --}}
	<div class="panel-heading">
	  <a href="{{route('evaluadores.evaluador.show', $evaluador->id)}}" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">{!! $indicador->id !!} - {!! $indicador->nombre !!}</p>
	</div>

	{{-- Body --}}
	<div class="panel-body">

		{{-- Mensajes --}}
		<div class="row col-lg-12">
			@include('partials/alert/error')
		</div>

		<div class="col-sm-12">
			{{-- Formulacion de Boton Nuevo --}}
			<div id="form" class="row col-sm-12">
				{{-- Botones --}}
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
					<a id="btnnuevocargoindicador" href="javascript:void(0)"  class="btn btn-success btn-sm  @if($evaluador->isCargosAgregados($evaluador->id)) disabled @endif"  title="Agregar Indicador"><span class="fa fa-plus"></span>   <b>Agregar</b></a>
				</div>

				{{-- Comentario --}}
				<div class="col-sm-12" style="margin-bottom: 10px;">
					<p>Lista de cargos asignados al indicador <b>{!! $indicador->nombre !!}</b></p>
				</div>
			</div>
			
			{{-- Formualrio para nuevo Cargo --}}
			<div id="nuevoCargoIndicador" class="col-sm-12 breadcrumb" hidden>
				@include('evaluadores/evaluador/indicadores/cargosasignados/datos_create')
			</div>

			{{-- Formualrio para Editar Cargo --}}
			<div id="editarCargoIndicador" class="col-sm-12 breadcrumb" hidden>
				@include('evaluadores/evaluador/indicadores/cargosasignados/datos_edit')
				<div style="background: red; height: 50px;"></div>
			</div>

			@include('evaluadores/evaluador/indicadores/cargosasignados/tabla_agregados')
		</div>
	</div>

	{{-- Footer --}}
	<div class="panel-footer">
	</div>
</div>

<script>
	$('#btnnuevocargoindicador').on( "click", function() {
		$('#form').hide();
		$('#nuevoCargoIndicador').show();
		$('#editarCargoIndicador').hide();
	});

	$('#btncancelarnuevoindicador').on('click', function() {
		$('#form').show();
		$('#nuevoCargoIndicador').hide();
		$('#editarCargoIndicador').hide();
	});

	$('#btnEditarCargoIndicador').on('click', function() {
		$('#form').hide();
		$('#nuevoCargoIndicador').hide();
		$('#editarCargoIndicador').show();
		
		var row = $(this).parent().parent();
		test(row);

	});

	function test(row){
		var cargo_id = $('input[name="cargo_id"]');
		var objetivo = $('input[name="objetivo"]');
		var frecuencia_id = $('input[name="frecuencia_id"]');
		var condicion = $('textarea[name="condicion"]');
		var aclaraciones = $('textarea[name="aclaraciones"]');

		var celdas= row.children();

	  //Obtenemos la celda 1 y la colocamos en el div con id resultado_2
		cargo_id.val(agragarCargo($(celdas[1]).html())); 
		objetivo.val($(celdas[2]).html()); 
		frecuencia_id.val(obtenerFrecuencia($(celdas[3]).html())); 
		condicion.val(trim(obtenerCondicion($(celdas[4]).html()))); 
		aclaraciones.val(trim(obtenerCondicion($(celdas[5]).html()))); 
	}

	function agragarCargo(param)
	{
		var existe = false;

		@foreach($cargos as $element)
			if(param == "{{ $element->nombre }}"){

				$("select[name=cargo_id]  option").each(function(){
				   var id = $(this).attr('value');

				   if (id == {{ $element->id }}) {
	                	$("select[name=cargo_id] > option[value="+ {{ $element->id }} +"]").attr("selected",true);
	                	existe = true;
	                }
				});

				if(!existe){
					$('select[name=cargo_id]').append('<option value="{{ $element->id }}" selected="selected">{{ $element->nombre }}</option>');
				}

				$('input[name=cargo_idOld]').attr('value', {{ $element->id }});
			}
		@endforeach
	}

	function obtenerFrecuencia(param)
	{
		@foreach($frecuencia as $element)
			if(param == "{{ $element->nombre }}"){
				$("select[name=frecuencia_id] > option[value="+ {{ $element->id }} +"]").attr("selected",true);
			}
		@endforeach
	}

	function obtenerCondicion(param)
	{
		if (param =='Ninguno') {
			return '';
		}

		return param;
	}

	function obtenerAclaraciones(param)
	{
		if (param =='Ninguno') {
			return '';
		}

		return param;
	}
</script>
@endsection

 