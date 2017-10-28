<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

{!!Form::open(['route'=>'supervisores.supervisados.tareas.buscarTareasSupervisadas', 'method'=>'POST'])!!}


<div id="form-buscar-tareas" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="col-xs-12" style="border: 1px solid gray; border-radius: 20px; padding: 10px; border-shadow: 1px 1px 1px gray;">
		{{-- Usuario --}}
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
			<label style="color: gray; font-style: italic;">Usuario</label>
			<hr style="margin: 0px; margin-bottom: 10px;">
		</div>
		<div class="form-group  col-xs-12 col-sm-2 col-md-2 col-lg-1">
			<label for="user_id">ID</label>
			{!! form::number('user_id',null, ['id'=>'user_id', 'class'=>'form-control', 'placeholder'=>'ID', 'maxlength'=>'6', 'type'=>'number', 'min'=> '1']) !!}
		</div>
        <div class="form-group col-xs-12 col-sm-2 col-md-2 col-lg-2">
            <label for="usuario">Usuario</label>
            {!! form::text('usuario',null, ['id'=>'usuario', 'class'=>'form-control', 'placeholder'=>'Nombre', 'maxlength'=>'20', 'type'=>'text']) !!}
        </div>
		<div class="form-group @if ($errors->has('cargo_id')) has-error @endif col-xs-12 col-sm-4 col-md-4 col-lg-2">
			<label for="cargo_id">Cargo</label>
			<select class="form-control" name="cargo_id">
				<option value="" >Seleccionar...</option>
				@foreach($cargos as $cargo)
					<option value="{{$cargo->id}}">{{$cargo->nombre}}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-2">
			<label for="cargo_id">Departamento</label>
			<select class="form-control" name="departamento_id">
				<option value="" >Seleccionar...</option>
				@foreach($departamentos as $departamento)
					<option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
				@endforeach
			</select>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
			<label style="color: gray; font-style: italic;">Tareas</label>
			<hr style="margin: 0px; margin-bottom: 10px;">
		</div>

		{{-- Tareas --}}
		<div class="form-group  col-xs-12 col-sm-2 col-md-2 col-lg-1">
			<label for="tarea_nro">Nro. </label>
			{!! form::text('tarea_nro',null, ['id'=>'tarea_nro', 'class'=>'form-control', 'placeholder'=>'Tarea', 'maxlength'=>'10', 'type'=>'text']) !!}
			@if ($errors->has('tarea_nro')) <p class="help-block">{{ $errors->first('tarea_nro') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('ubicacion_id')) has-error @endif col-xs-12 col-sm-3 col-md-3 col-lg-2">
			<label for="ubicacion_id">Ubicacion</label>
			<select class="form-control" name="ubicacion_id">
				<option value="" >Seleccionar...</option>
				@foreach($localizaciones as $localizacion)
					<option value="{{$localizacion->id}}">{{$localizacion->nombre}}</option>
				@endforeach
			</select>
		</div>

        <div class="row col-xs-12 col-sm-6 col-md-5 col-lg-4" >
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin: 0px;">
                <label for="cargo_id">Fecha Inicio</label>
                <div class="input-group row" style="margin: 0px;">
                    <input type="text" id="fechaInicioBuscado" placeholder="Fecha Inicio"  class="form-control fechas" name="fechaInicio" >
					<div class="input-group-addon row">
						<i class="fa fa-calendar"></i>
					</div>
				</div>
            </div>

            <div id="container" class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin: 0;">
                <label for="cargo_id">Fecha Fin</label>
                <div class="input-group row" style="margin: 0px;">
                    <input type="text" id="fechaFinBuscado"  placeholder="Fecha Fin" class="form-control fechas" name="fechaFin" >
					<div class="input-group-addon row">
						<i class="fa fa-calendar"></i>
					</div>
				</div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: center; margin:  2px 0 0 0;">
                <label class="radio-inline"><input type="radio" checked name="fechaSeleccionado" value="estimados">Fechas Estimadas</label>
                <label class="radio-inline"><input type="radio" name="fechaSeleccionado" value="soluciones">Fechas Soluciones</label>
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

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
			<button type="reset" onClick="ocultarFormularioBusqueda()" class="btn btn-default btn-sm">Ocultar  <span class="fa  fa-eye-slash"></span> </button>
			<button type="reset" class="btn btn-primary btn-sm">Limpiar  <span class="fa  fa-times-circle-o"></span> </button>
			<button type="submit" class="btn btn-success btn-sm" >Buscar  <span class="fa  fa-search"></span> </button>
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


</script>
