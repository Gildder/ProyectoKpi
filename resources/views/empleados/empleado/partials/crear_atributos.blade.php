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

	<div class=" row col-lg-12 breadcrumb"><b><i>Datos de Usuarios</i></b></div>


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
			    <option value="2">Normal</option>
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



	<div class=" row col-lg-12 breadcrumb"><b><i>Datos de Localizaciones</i></b></div>

	<div class="row">
		<div class="form-group  @if ($errors->has('grlocalizacion_id')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="grlocalizacion_id">Grupo Localizacion *</label>
			<select id="grlocalizacion" class="form-control" name="grlocalizacion_id">
			    <option value="" >Seleccionar...</option>
			     @foreach($grlocalizacion as $item)
	                <option value="{{$item->id}}">{{$item->nombre}}</option>
	              @endforeach
			</select>
			@if ($errors->has('grlocalizacion_id')) <p class="help-block">{{ $errors->first('grlocalizacion_id') }}</p> @endif
		</div>

		<div class="form-group  @if ($errors->has('localizacion_id')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="localizacion_id">Localizacion *</label>
			<select id="localizacion" class="form-control" name="localizacion_id">
			    <option value="" >Seleccionar...</option>
			    @foreach($localizacion as $item)
	               <option value="{{$item->id}}">{{$item->nombre}}</option>
	             @endforeach
			</select>
			@if ($errors->has('localizacion_id')) <p class="help-block">{{ $errors->first('localizacion_id') }}</p> @endif
		</div>
	</div>


	<div class="row">
		<div class="form-group  @if ($errors->has('grdepartamento_id')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="grdepartamento_id">Grupo Departamento *</label>
			<select id="grdepartamento" class="form-control" name="grdepartamento_id">
			    <option value="" >Seleccionar...</option>
			    @foreach($grdepartamento as $item)
	                <option value="{{$item->id}}">{{$item->nombre}}</option>
	              @endforeach
			</select>
			@if ($errors->has('grdepartamento_id')) <p class="help-block">{{ $errors->first('grdepartamento_id') }}</p> @endif
		</div>

		<div class="form-group  @if ($errors->has('departamento_id')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="departamento_id">Departamento *</label>
			<select id="departamento" class="form-control" name="departamento_id">
			    <option value="" >Seleccionar...</option>
			    @foreach($departamento as $item)
	               <option value="{{$item->id}}">{{$item->nombre}}</option>
	             @endforeach
			</select>
			@if ($errors->has('departamento_id')) <p class="help-block">{{ $errors->first('departamento_id') }}</p> @endif
		</div>
	</div>

</div>