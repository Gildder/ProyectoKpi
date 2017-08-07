@extends('layouts.app')

@section('titulo')
	{!! $indicador->nombre !!}
@endsection

@section('content')


<div class="panel panel-default">
	{{-- Header --}}
	<div class="panel-heading">
	  <a href="{{route('evaluadores.evaluador.show', $evaluador->id)}}" @click="mostrarModalLoading()" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">{!! $indicador->id !!} - {!! $indicador->nombre !!}</p>
	</div>

	{{-- Body --}}
	<div class="panel-body">

		{{-- Mensajes --}}
			@include('partials/alert/error')

			{{-- Formulacion de Boton Nuevo --}}
			{{-- Botones --}}
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb agregar">
				<a id="btnnuevocargoindicador" href="javascript:void(0)"  class="btn btn-success btn-sm  @if($evaluador->isCargosAgregados($evaluador->id)) disabled @endif"  title="Agregar Indicador"><span class="fa fa-plus"></span>   <b>Agregar</b></a>
			</div>

			{{-- Comentario --}}
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 agregar">
				<p>Lista de cargos asignados al indicador <b>{!! $indicador->nombre !!}</b></p><br>
			</div>

			{{-- Formualrio para nuevo Cargo --}}
			<div id="nuevoCargoIndicador" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb" hidden>
				@include('evaluadores/evaluador/indicadores/cargosasignados/datos_create')
			</div>

			{{-- Formualrio para Editar Cargo --}}
			<div id="editarCargoIndicador" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb" hidden>
				@include('evaluadores/evaluador/indicadores/cargosasignados/datos_edit')
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				@include('evaluadores/evaluador/indicadores/cargosasignados/tabla_agregados')
			</div>

	</div>

	{{-- Footer --}}
	<div class="panel-footer">
	</div>
</div>

<script type="text/javascript">+
    $(document).ready(function () {

	$('#btnnuevocargoindicador').on( "click", function() {
		$('.agregar').hide();
		$('#nuevoCargoIndicador').show();
		$('#editarCargoIndicador').hide();
	});

	$('#btncancelarnuevoindicador').on('click', function() {
		$('.agregar').show();
		$('#nuevoCargoIndicador').hide();
		$('#editarCargoIndicador').hide();

	});

	$('#btncancelareditarindicador').on('click', function() {
		$('.agregar').show();
		$('#nuevoCargoIndicador').hide();
		$('#editarCargoIndicador').hide();

	});

	$('#btnEditarCargoIndicador').on('click', function() {
		$('.agregar').hide();
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
		condicion.val(obtenerCondicion($(celdas[4]).html()).trim());
		aclaraciones.val(obtenerCondicion($(celdas[5]).html()).trim());
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

    });

</script>
@endsection

