{{-- ColorPicker --}}
<link rel="stylesheet" href="{{URL::asset('plugins/colorpicker/bootstrap-colorpicker.css')}}">
<script src="{{URL::asset('plugins/colorpicker/bootstrap-colorpicker.js')}}"></script>


<div class="form-group col-xs-12 col-sm-10 col-md-8">

	<div class="row">
		<div class="form-group  @if ($errors->has('nombres')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="nombres">Nombres *</label>
	      {!! form::text('nombres',null, ['id'=>'nombres', 'class'=>'form-control', 'placeholder'=>'Nombre Completo', 'maxlength'=>'50', 'type'=>'text']) !!}
	      @if ($errors->has('nombres')) <p class="help-block">{{ $errors->first('nombres') }}</p> @endif

		</div>
		<div class="form-group @if ($errors->has('apellidos')) has-error @endif col-xs-12 col-sm-6 col-md-5">
			<label for="apellidos">Apellidos *</label>
	      {!! form::text('apellidos',null, ['id'=>'apellidos', 'class'=>'form-control', 'placeholder'=>'Apellidos Completo', 'maxlength'=>'50', 'type'=>'text']) !!}
	      @if ($errors->has('apellidos')) <p class="help-block">{{ $errors->first('apellidos') }}</p> @endif
		</div>
	</div>

	<div class="row">

	  	<div class="form-group  @if ($errors->has('codigo')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="codigo">Codigo *</label>
	      {!! form::text('codigo',null, ['id'=>'codigo', 'class'=>'form-control', 'placeholder'=>'Codigo Empleado', 'maxlength'=>'10', 'type'=>'text']) !!}
	       @if ($errors->has('codigo')) <p class="help-block">{{ $errors->first('codigo') }}</p> @endif
		</div>

		<div class="form-group  @if ($errors->has('cargo_id')) has-error @endif   col-xs-12 col-sm-6 col-md-5">
			<label for="cargo_id">Cargo *</label>
			<select class="form-control" name="cargo_id">
	                <option value="" >Seleccionar...</option>
	              @foreach($cargos as $item)
	                <option value="{{$item->id}}">{{$item->nombre}}</option>
	              @endforeach
	          </select>
	          @if ($errors->has('cargo_id')) <p class="help-block">{{ $errors->first('cargo_id') }}</p> @endif
		</div>
	</div>

	<div class=" row col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb"><b><i>Datos de Usuarios</i></b></div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <label>
            <input type="checkbox" checked name="active" value="1">
            Activar Cuenta
        </label>
        <br><br>
    </div>

	<div class="row">
		<div class="form-group  @if ($errors->has('usuario')) has-error @endif   col-xs-12 col-sm-6 col-md-5">
			<label for="usuario">Nombre Usuario *</label>
	      	{!! form::text('usuario',null, ['id'=>'usuario', 'class'=>'form-control', 'placeholder'=>'Nombre Usuario', 'maxlength'=>'20', 'type'=>'text']) !!}
			@if ($errors->has('usuario')) <p class="help-block">{{ $errors->first('usuario') }}</p> @endif
		</div>
	</div>

	<div class="row">
		<div class="form-group  @if ($errors->has('email')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="email">Correo</label>
	        {!! form::text('email',null, ['id'=>'email', 'class'=>'form-control', 'placeholder'=>'Correo Electronico', 'maxlength'=>'30', 'type'=>'email']) !!}
			@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
		</div>

		<div class="form-group  @if ($errors->has('type_id')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="type_id">Tipo Usuario *</label>
			<select class="form-control" name="type_id">
			    <option value="" >Seleccionar...</option>
			    <option value="1">Administrador</option>
			    <option value="2">Empleado</option>
			</select>
			@if ($errors->has('type_id')) <p class="help-block">{{ $errors->first('type_id') }}</p> @endif
		</div>
	</div>

	<div class="row">
		<div class="form-group  @if ($errors->has('password')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="password">Contraseña *</label>
	        {!! form::password('password', ['id'=>'password', 'class'=>'form-control', 'placeholder'=>'Ingrese Contraseña', 'maxlength'=>'30', 'type'=>'password']) !!}
			@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
		</div>


		<div class="form-group  @if ($errors->has('password_confirmation')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="password_confirmation">Repetir Contraseña *</label>
	      {!! form::password('password_confirmation', ['id'=>'repassword', 'class'=>'form-control', 'placeholder'=>'Repita Contraseña', 'maxlength'=>'30', 'type'=>'password']) !!}
	      @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
		</div>
	</div>

    {{-- Verificar si es tecnico --}}
    <div class="row" style="padding: 10px; margin-bottom: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label>Tecnico ID</label>   <small><i>Opcional</i></small>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4"  @if ($errors->has('tecnico_id')) has-error @endif >
            <input type="number" name="tecnico_id" value="@if(isset($empleado->tecnico_id)) {{ $empleado->tecnico_id }} @endif" min="1" max="999" placeholder="ID de Tecnico" class="form-control">
            @if ($errors->has('tecnico_id')) <p class="help-block">{{ $errors->first('tecnico_id') }}</p> @endif
        </div>
    </div>

    {{-- Color --}}
    <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <label>Color: <input type="text" id="color" class="input-xs" value="#FFFFFF" name="color" style="background-color: #FFFFFF; color: #FFFFFF" readonly="true"></label>
        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
            <ul class="fc-color-picker" id="color-chooser">
                <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                <a class="fa fa-square btn btn-default btn-sn"  id="color-chooser-btn">  Seleccionar Color</a>
            </ul>

        </div>
    </div>

    <div class=" row col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb"><b><i>Datos de Localizaciones</i></b></div>

	<div class="row">
		<div class="form-group  @if ($errors->has('grlocalizacion_id')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="grlocalizacion_id">Grupo Localizacion *</label>
			<select id="grlocalizacion" class="form-control" name="grlocalizacion_id">
			    <option value="0" >Seleccionar...</option>
			     @foreach($grlocalizacion as $item)
	                <option value="{{$item->id}}">{{$item->nombre}}</option>
	              @endforeach
			</select>
			@if ($errors->has('grlocalizacion_id')) <p class="help-block">{{ $errors->first('grlocalizacion_id') }}</p> @endif
		</div>

		<div class="form-group  @if ($errors->has('localizacion_id')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="localizacion_id">Localizacion *</label>
			<select id="localizacion" class="form-control" name="localizacion_id">
			    <option value="0" >Selecciona un grupo</option>
			  {{--   @foreach($localizacion as $item)
	               <option value="{{$item->id}}">{{$item->nombre}}</option>
	             @endforeach --}}
			</select>
			@if ($errors->has('localizacion_id')) <p class="help-block">{{ $errors->first('localizacion_id') }}</p> @endif
		</div>
	</div>



	<div class="row">
		<div class="form-group  @if ($errors->has('grdepartamento_id')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="grdepartamento_id">Grupo Departamento *</label>
			<select id="grdepartamento" class="form-control" name="grdepartamento_id">
			    <option value="0" >Seleccionar...</option>
			    @foreach($grdepartamento as $item)
	                <option value="{{$item->id}}">{{$item->nombre}}</option>
	              @endforeach
			</select>
			@if ($errors->has('grdepartamento_id')) <p class="help-block">{{ $errors->first('grdepartamento_id') }}</p> @endif
		</div>

		<div class="form-group  @if ($errors->has('departamento_id')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="departamento_id">Departamento *</label>
			<select id="departamento" class="form-control" name="departamento_id">
			    <option value="0" >Selecciona un grupo</option>
			  {{--   @foreach($departamento as $item)
	               <option value="{{$item->id}}">{{$item->nombre}}</option>
	             @endforeach --}}
			</select>
			@if ($errors->has('departamento_id')) <p class="help-block">{{ $errors->first('departamento_id') }}</p> @endif
		</div>
	</div>

	{{-- Opciones --}}
	<div class=" row col-lg-12 breadcrumb"><b><i>Opciones</i></b></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<label>
			<input type="checkbox" name="vacacion" value="1" >
			Activar Vacaciones
		</label>
	</div>

</div>

<script>
	$(document).ready(function(){
        $('#color').val('#FFFFFF')
		verificarGrupoDepartamento($('#grdepartamento').val());
		verificarGrupoLocalizacion($('#grlocalizacion').val());
		
		
		/* Evento en los item de select Grupo Departamento*/
		$('#grdepartamento').change(function(){
			verificarGrupoDepartamento($(this).val());
		});

		/* Evento en los item de select Grupo Departamento*/
		$('#grlocalizacion').change(function(){
			verificarGrupoLocalizacion($(this).val());
		});

		function verificarGrupoLocalizacion(argument) {
			if ( argument == '0') {
				limpiarSelectLocalizacion(argument);
			}else{
				obtenerLocalizacion(argument);
			}
		}

		function verificarGrupoDepartamento(argument) {
			if ( argument == '0') {
				limpiarSelectDepartamento(argument);
			}else{
				obtenerDepartamento(argument);
			}
		}

		function obtenerDepartamento(argument) {
			$.get("{{ url('empleados/listaDepartamento')}}" +'/'+ argument, function(data) {
				limpiarSelectDepartamento(argument);

				$.each(data, function(key, element) {
					$('#departamento').append("<option value='" + element['id'] + "'>" + element['nombre'] + "</option>");
				});
			});
		}

		function obtenerLocalizacion(argument) {
			$.get("{{ url('empleados/listaLocalizacion')}}" +'/'+ argument, function(data) {
				limpiarSelectLocalizacion(argument);

				$.each(data, function(key, element) {
					$('#localizacion').append("<option value='" + element['id'] + "'>" + element['nombre'] + "</option>");
				});
			});
		}


		function limpiarSelectLocalizacion(argument) {	
			var msj = 'Seleccionar...';
			if (argument == '0') {
				msj = 'Selecciona un grupo';
			}		
			$('#localizacion').empty();
			$('#localizacion').append("<option value='0'>"+msj+"</option>");
		}

		function limpiarSelectDepartamento(argument) {	
			var msj = 'Seleccionar...';
			if (argument== '0') {
				msj = 'Selecciona un grupo';
			}		
			$('#departamento').empty();
			$('#departamento').append("<option value='0'>"+msj+"</option>");
		}

        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
            e.preventDefault();
            //Save color
            currColor = rgb2hex($(this).css("color"));

            //Add color effect to button
            $('#color').val(currColor)
            $('#color').css({"background-color": currColor, "color": currColor,"border-color": currColor});
        });

        $('#color-chooser-btn').colorpicker().on('changeColor', function(e) {
            currColor = e.color.toString('hex');

            //Add color effect to button
            $('#color').val(currColor)
            $('#color').css({"background-color": currColor, "color": currColor, "border-color": currColor});
            $('#color-chooser-btn').css({"background-color": currColor,  "color": currColor, "border-color": currColor, "color": "#fff"});

        });

        function rgb2hex(rgb){
            rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
            return (rgb && rgb.length === 4) ? "#" +
                ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
                ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
                ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
        }
	});		
</script>
