
{!!Form::open(['route'=>'tareas.tareaProgramadas.buscarArchivadas', 'method'=>'POST'])!!}

<div id="form-buscar-tareas" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 busquedasTareas" >
		{{-- Tareas --}}
		<div class="form-group  col-xs-12 col-sm-2 col-md-2 col-lg-1">
			<label for="tarea_nro">Nro. </label>
			{!! form::text('tarea_nro',null, ['id'=>'tarea_nro', 'class'=>'form-control', 'placeholder'=>'Tarea', 'maxlength'=>'10', 'type'=>'number', 'min' => '1']) !!}
			@if ($errors->has('tarea_nro')) <p class="help-block">{{ $errors->first('tarea_nro') }}</p> @endif
		</div>

        <div class="row col-xs-12 col-sm-6 col-md-5 col-lg-4" >
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin: 0px;">
                <label for="fechaInicio">Fecha Inicio</label>
                <div class="input-group row" style="margin: 0px;">
                    <div class="input-group-addon row">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="fechaInicioBuscado" value="{{ old('fechaInicio') }}" placeholder="Fecha Inicio"  class="form-control fechas" name="fechaInicio" >
				</div>
            </div>

            <div id="container" class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin: 0;">
                <label for="fechaFin">Fecha Fin</label>
                <div class="input-group row" style="margin: 0px;">
                    <div class="input-group-addon row">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="fechaFinBuscado" value="{{ old('fechaFin') }}" placeholder="Fecha Fin" class="form-control fechas" name="fechaFin" >
				</div>
            </div>
        </div>

		<div class="form-group  col-xs-12 col-sm-3 col-md-3 col-lg-2">
			<label for="estado_id">Estado</label>
			<select class="form-control" name="estado_id">
				<option value="" >Seleccionar...</option>
				@foreach($estados as $estado)
					<option value="{{$estado->id}}">{{$estado->nombre}}</option>
				@endforeach
			</select>
    		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			<hr style="margin: 10px;">
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0; text-align: right;">
			<a type="reset" id="resetBuscar" class="@lang('labels.stylbtns.btnLimpiar')">@lang('labels.buttons.btnLimpiar')  <span class="@lang('labels.icons.icoBtnLimpiar')"></span> </a>

			<button type="submit" class="@lang('labels.stylbtns.btnBuscar')" >@lang('labels.buttons.btnBuscar')  <span class="@lang('labels.icons.icoBtnBuscar')" ></span> </button>
		</div>
	</div>

</div>
{!! Form::close()!!}



<script>
    $(document).ready(function () {
		/*Calendarios */
        $( ".fechas" ).datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
            changeMonth: true
        });
    });


    $('#resetBuscar').click(function () {
        $('input[name="tarea_nro"]').val('');
        $('input[name="estado_id"]').val('');
        $('input[name="fechaInicio"]').val('');
        $('input[name="fechaFin"]').val('');

    });
</script>
