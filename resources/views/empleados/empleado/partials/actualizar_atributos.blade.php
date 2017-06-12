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
			    @if($cargo->id == $empleado->cargo)
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
	      {!! form::text('name',null, ['id'=>'usuario', 'class'=>'form-control', 'placeholder'=>'Nombre Usuario', 'maxlength'=>'20', 'type'=>'text']) !!}
			@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif

		</div>
	</div>

	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('email')) has-error @endif ">
			<label for="email">Correo</label>
	      {!! form::text('email',null, ['id'=>'email', 'class'=>'form-control', 'placeholder'=>'Correo Electronico', 'maxlength'=>'30', 'type'=>'email']) !!}
			@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('type')) has-error @endif ">
			<label for="type">Tipo Usuario</label>
			<select class="form-control" name="type">
				@if(isset($empleado->type))
			    	<option value="{{$empleado->type }}" >{{$empleado->tipo->nombre}}</option>
			    @else 
			    	<option value="" >Seleccionar..</option>
			    @endif
			     @foreach($tipoUsuario as $tipo)
				          <option value="{{$tipo->id}}" >{{$tipo->nombre}}</option>
			  	@endforeach
			</select>
			@if ($errors->has('type')) <p class="help-block">{{ $errors->first('type') }}</p> @endif
		</div>
	</div>


	<div class=" row col-lg-12 breadcrumb"><b><i>Datos de Localizaciones</i></b></div>

	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('grlocalizacion_id')) has-error @endif ">
			<label for="grlocalizacion_id">Grupo Localizacion</label>
			<select id="grlocalizacion" class="form-control" name="grlocalizacion_id">
				@if($empleado->localizacion_id != null)
			    	<option value="" >{{$empleado->localizacion->grupoLocalizacion->nombre}}</option>
			    @else 
			    	<option value="" >Seleccionar..</option>
			    @endif
	            @foreach($grlocalizacion as $item)
				          <option value="{{$item->id}}" >{{$item->nombre}}</option>
			  	@endforeach
			</select>
			@if ($errors->has('grlocalizacion_id')) <p class="help-block">{{ $errors->first('grlocalizacion_id') }}</p> @endif

		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('localizacion_id')) has-error @endif ">
			<label for="localizacion_id">Localizacion</label>
			<select id="localizacion" class="form-control" name="localizacion_id">
				@if($empleado->localizacion_id != null)
			    	<option value="" >{{$empleado->localizacion->nombre}}</option>
			    @else 
			    	<option value="" >Seleccionar..</option>

			    @endif
	            {{--@foreach($localizacion as $item)--}}
				    {{--@if($item->id == $empleado->localizacion)--}}
				          {{--<option value="{{$item->id}}" selected="selected" >{{$item->nombre}}</option>--}}
				    {{--@else--}}
				          {{--<option value="{{$item->id}}" >{{$item->nombre}}</option>--}}
				    {{--@endif--}}
			  	{{--@endforeach--}}
			</select>
			@if ($errors->has('localizacion_id')) <p class="help-block">{{ $errors->first('localizacion_id') }}</p> @endif

		</div>
	</div>


	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('grdepartamento_id')) has-error @endif ">
			<label for="grdepartamento_id">Grupo Departamento</label>
			<select  id="grdepartamento" class="form-control"  name="grdepartamento_id">
			    @if($empleado->departamento_id != null)
			    	<option value="" >{{$empleado->departamento->grupoDepartamento->nombre}}</option>
			    @else 
			    	<option value="" >Seleccionar..</option>
			    @endif
			    @foreach($grdepartamento as $item)
				          <option value="{{$item->id}}" >{{$item->nombre}}</option>
			  	@endforeach

			</select>
			@if ($errors->has('grdepartamento_id')) <p class="help-block">{{ $errors->first('grdepartamento_id') }}</p> @endif

		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-5   @if ($errors->has('departamento_id')) has-error @endif ">
			<label for="departamento_id">Departamento</label>
			<select  id="departamento" class="form-control" name="departamento_id">
			    @if($empleado->departamento_id != null)
			    	<option value="" >{{$empleado->departamento->nombre}}</option>
			    @else 
			    	<option value="" >Seleccionar..</option>
			    @endif
	            {{--@foreach($departamento as $item)--}}
				    {{--@if($item->id == $empleado->departamento)--}}
				          {{--<option value="{{$item->id}}" selected="selected" >{{$item->nombre}}</option>--}}
				    {{--@else--}}
				          {{--<option value="{{$item->id}}" >{{$item->nombre}}</option>--}}
				    {{--@endif--}}
			  	{{--@endforeach--}}
			</select>
			@if ($errors->has('departamento_id')) <p class="help-block">{{ $errors->first('departamento_id') }}</p> @endif

		</div>
	</div>

</div>

<script>
    $(document).ready(function(){

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
    });
</script>