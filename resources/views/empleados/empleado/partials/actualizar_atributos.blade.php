<div class="form-group col-xs-12 col-sm-10 col-md-8">

	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5">
			<label for="nombres">Nombres </label>
	      {!! form::text('nombres',null, ['id'=>'nombres', 'class'=>'form-control', 'placeholder'=>'Nombre Completo', 'maxlength'=>'50', 'type'=>'text']) !!}

		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-5">
			<label for="apellidos">Apellidos </label>
	      {!! form::text('apellidos',null, ['id'=>'apellidos', 'class'=>'form-control', 'placeholder'=>'Apellidos Completo', 'maxlength'=>'50', 'type'=>'text']) !!}

		</div>
	</div>

	<div class="row">

	  	<div class="form-group col-xs-12 col-sm-6 col-md-5">
			<label for="codigo">Codigo </label>
	      {!! form::text('codigo',null, ['id'=>'codigo', 'class'=>'form-control', 'placeholder'=>'Codigo Empleado', 'maxlength'=>'10', 'type'=>'text']) !!}
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-5">
			<label for="cargo">Cargo</label>
			<select class="form-control" name="cargo_id">
			    <option value="" >Seleccionar...</option>
			  @foreach($cargos as $item)
			    @if($item->id == $empleado->cargo_id)
			          <option value="{{$item->id}}" selected="selected" >{{$item->nombre}}</option>
			    @else
			          <option value="{{$item->id}}" >{{$item->nombre}}</option>
			    @endif
			  @endforeach
			</select>
		</div>
	</div>

	<div class=" row col-lg-12 breadcrumb"><b><i>Datos de Usuarios</i></b></div>


	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5">
			<label for="usuario">Nombre Usuario </label>
	      {!! form::text('usuario',null, ['id'=>'usuario', 'class'=>'form-control', 'placeholder'=>'Nombre Usuario', 'maxlength'=>'20', 'type'=>'text']) !!}

		</div>
	</div>

	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5">
			<label for="email">Correo</label>
	      {!! form::text('email',null, ['id'=>'email', 'class'=>'form-control', 'placeholder'=>'Correo Electronico', 'maxlength'=>'30', 'type'=>'email']) !!}

		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-5">
			<label for="type_id">Tipo Usuario</label>
			<select class="form-control" name="type_id">
			    <option value="" >Seleccionar...</option>
			    @if($empleado->tipo == 1)
			    	<option value="1" selected="selected">Administrador</option>
			    	<option value="2">Normal</option>
			    @else
			    	<option value="1" >Administrador</option>
			    	<option value="2" selected="selected">Normal</option>
			    @endif
			</select>
		</div>
	</div>


	<div class=" row col-lg-12 breadcrumb"><b><i>Datos de Localizaciones</i></b></div>

	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5">
			<label for="grlocalizacion_id">Grupo Localizacion</label>
			<select class="form-control" name="grlocalizacion_id">
			    <option value="" >{{$empleado->grupolocalizacion}}</option>
	            @foreach($grlocalizacion as $item)
				    @if($item->id == $empleado->grlocalizacion)
				          <option value="{{$item->id}}" selected="selected" >{{$item->nombre}}</option>
				    @else
				          <option value="{{$item->id}}" >{{$item->nombre}}</option>
				    @endif
			  	@endforeach
			</select>
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-5">
			<label for="localizacion_id">Localizacion</label>
			<select class="form-control" name="localizacion_id">
			    <option value="" >{{$empleado->departamento}}</option>
	            @foreach($localizacion as $item)
				    @if($item->id == $empleado->localizacion_id)
				          <option value="{{$item->id}}" selected="selected" >{{$item->nombre}}</option>
				    @else
				          <option value="{{$item->id}}" >{{$item->nombre}}</option>
				    @endif
			  	@endforeach
			</select>
		</div>
	</div>


	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-5">
			<label for="grdepartamento_id">Grupo Departamento</label>
			<select class="form-control"  name="grdepartamento_id">
			    <option value="" >{{$empleado->grupodepartamento}}</option>
			    @foreach($grdepartamento as $item)
				    @if($item->id == $empleado->grdepartamento)
				          <option value="{{$item->id}}" selected="selected" >{{$item->nombre}}</option>
				    @else
				          <option value="{{$item->id}}" >{{$item->nombre}}</option>
				    @endif
			  	@endforeach

			</select>
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-5">
			<label for="departamento_id">Departamento</label>
			<select class="form-control" name="departamento_id">
			    <option value="" >{{$empleado->localizacion}}</option>
	            @foreach($departamento as $item)
				    @if($item->id == $empleado->departamento_id)
				          <option value="{{$item->id}}" selected="selected" >{{$item->nombre}}</option>
				    @else
				          <option value="{{$item->id}}" >{{$item->nombre}}</option>
				    @endif
			  	@endforeach
			</select>
		</div>
	</div>

</div>