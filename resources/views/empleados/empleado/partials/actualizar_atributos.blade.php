<div class="form-group col-xs-12 col-sm-10 col-md-8">

	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5 @if ($errors->has('nombres')) has-error @endif ">
			<label for="nombres">Nombres </label>
	      {!! form::text('nombres',null, ['id'=>'nombres', 'class'=>'form-control', 'placeholder'=>'Nombre Completo', 'maxlength'=>'50', 'type'=>'text']) !!}
			@if ($errors->has('nombres')) <p class="help-block">{{ $errors->first('nombres') }}</p> @endif

		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-5  @if ($errors->has('apellidos')) has-error @endif ">
			<label for="apellidos">Apellidos </label>
	      {!! form::text('apellidos',null, ['id'=>'apellidos', 'class'=>'form-control', 'placeholder'=>'Apellidos Completo', 'maxlength'=>'50', 'type'=>'text']) !!}
			@if ($errors->has('apellidos')) <p class="help-block">{{ $errors->first('apellidos') }}</p> @endif

		</div>
	</div>

	<div class="row">

	  	<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('apellidos')) has-error @endif ">
			<label for="codigo">Codigo </label>
	      {!! form::text('codigo',null, ['id'=>'codigo', 'class'=>'form-control', 'placeholder'=>'Codigo Empleado', 'maxlength'=>'10', 'type'=>'text']) !!}
			@if ($errors->has('codigo')) <p class="help-block">{{ $errors->first('codigo') }}</p> @endif
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('apellidos')) has-error @endif ">
			<label for="cargo">Cargo</label>
			<select class="form-control" name="cargo_id">
			    <option value="" >Seleccionar...</option>
			  @foreach($cargos as $cargo)
			    @if(($cargo->id == $empleado->cargo_id)&& (isset($empleado->cargo_id)))
			          <option value="{{$cargo->id}}" selected="selected" >{{$cargo->nombre}}</option>
			    @else
			          <option value="{{$cargo->id}}" >{{$cargo->nombre}}</option>
			    @endif
			  @endforeach
			</select>
			@if ($errors->has('cargo_id')) <p class="help-block">{{ $errors->first('cargo_id') }}</p> @endif

		</div>
	</div>

	<div class=" row col-lg-12 breadcrumb"><b><i>Datos de Usuarios</i></b></div>


	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('name')) has-error @endif ">
			<label for="name">Nombre Usuario </label>
            <input type="text" id="usuario" name="name" value="{{ $empleado->usuario }}" maxlength="20" class="form-control" placeholder="Nombre de Usuario">
			@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif

		</div>
	</div>

	{{-- Tipo de Usuario--}}
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('email')) has-error @endif ">
			<label for="email">Correo</label>
            <input type="email" id="correo" name="email" value="{{ $empleado->correo }}" maxlength="30" class="form-control" placeholder="Correo Electronico">
        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('type')) has-error @endif ">
			<label for="type">Tipo Usuario</label>
			<select class="form-control" name="type">
                <option value="" >Seleccionar..</option>
			    @foreach($tipoUsuario as $tipo)
                    @if(isset($empleado->tipo) && ($empleado->tipo == $tipo->id ))
                        <option value="{{ $tipo->id }}" selected>{{ $tipo->nombre }}</option>
                    @else
                        <option value="{{ $tipo->id }}" >{{ $tipo->nombre }}</option>
                    @endif
			  	@endforeach
			</select>
			@if ($errors->has('type')) <p class="help-block">{{ $errors->first('type') }}</p> @endif
		</div>
	</div>


	<div class=" row col-lg-12 breadcrumb"><b><i>Datos de Localizaciones</i></b></div>

	{{-- Grupo Localizacion --}}
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('grlocalizacion_id')) has-error @endif ">
			<label for="grlocalizacion_id">Grupo Localizacion</label>
			<select id="grlocalizacion" class="form-control" name="grlocalizacion_id">
                <option value="">Seleccionar..</option>
                @foreach($grlocalizacion as $grupoloc)
					@if(isset($empleado->grlocalizacion) && ($empleado->grlocalizacion == $grupoloc->id ))
                        <option value="{{ $grupoloc->id }}" selected>{{ $grupoloc->nombre }}</option>
					@else
						<option value="{{ $grupoloc->id }}" >{{ $grupoloc->nombre }}</option>
					@endif
			  	@endforeach
			</select>
			@if ($errors->has('grlocalizacion_id')) <p class="help-block">{{ $errors->first('grlocalizacion_id') }}</p> @endif

		</div>

		{{-- Localizacion --}}
		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('localizacion_id')) has-error @endif ">
			<label for="localizacion_id">Localizacion</label>
			<select id="localizacion" class="form-control" name="localizacion_id">
                <option value="">Seleccionar..</option>
                @foreach($localizaciones as $localizacion)
					@if(isset($empleado->localizacion_id)&& ($empleado->localizacion_id == $localizacion->id ))
                        <option value="{{ $localizacion->id }}" selected>{{ $localizacion->nombre }}</option>
					@else
						<option value="{{ $localizacion->id }}" >{{ $localizacion->nombre }}</option>
					@endif
			  	@endforeach
			</select>
			@if ($errors->has('localizacion_id')) <p class="help-block">{{ $errors->first('localizacion_id') }}</p> @endif

		</div>
	</div>


	{{-- Grupo Departamento --}}
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('grdepartamento_id')) has-error @endif ">
			<label for="grdepartamento_id">Grupo Departamento</label>
			<select  id="grdepartamento" class="form-control"  name="grdepartamento_id">
                <option value="">Seleccionar..</option>
                @foreach($grdepartamento as $grdepar)
					@if(isset($empleado->grdepartamento) && ($empleado->grdepartamento == $grdepar->id ))
                        <option value="{{ $grdepar->id }}" selected>{{ $grdepar->nombre }}</option>
					@else
						<option value="{{ $grdepar->id }}" >{{ $grdepar->nombre }}</option>
					@endif
			  	@endforeach

			</select>
			@if ($errors->has('grdepartamento_id')) <p class="help-block">{{ $errors->first('grdepartamento_id') }}</p> @endif

		</div>

		{{-- Departamento --}}
		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('departamento_id')) has-error @endif ">
			<label for="departamento_id">Departamento</label>
			<select  id="departamento" class="form-control" name="departamento_id">
                <option value="" selected>Seleccionar..</option>
                @foreach($departamentos as $departamento)
                    @if(isset($empleado->departamento_id) && ($empleado->departamento_id == $departamento->id ))
                        <option value="{{ $departamento->id }}" selected>{{ $departamento->nombre }}</option>
					@else
						<option value="{{ $departamento->id }}" >{{ $departamento->nombre }}</option>
					@endif
			  	@endforeach
			</select>
			@if ($errors->has('departamento_id')) <p class="help-block">{{ $errors->first('departamento_id') }}</p> @endif

		</div>
	</div>

</div>

<script>
    $(document).ready(function(){



		/* Evento en los item de select Grupo Departamento*/
        $('#grdepartamento').change(function(){
            verificarGrupoDepartamento($(this).val());
        });

		/* Evento en los item de select Grupo Departamento*/
        $('#grlocalizacion').change(function(){
            verificarGrupoLocalizacion($(this).val());
        });

        /* Verificamos si los grupos de localizacion  */
        function verificarGrupoLocalizacion(argument) {
            if ( argument == '') {
                limpiarSelectLocalizacion(argument);
            }else{
                obtenerLocalizacion(argument);
            }
        }

        function verificarGrupoDepartamento(argument) {
            if ( argument == '') {
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
    });
</script>
