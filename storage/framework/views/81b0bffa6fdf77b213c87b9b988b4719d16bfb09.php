<div class="form-group col-xs-12 col-sm-10 col-md-8">

	<div class="row">
		<div class="form-group  <?php if($errors->has('nombres')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-6 col-md-5">
			<label for="nombres">Nombres *</label>
	      <?php echo form::text('nombres',null, ['id'=>'nombres', 'class'=>'form-control', 'placeholder'=>'Nombre Completo', 'maxlength'=>'50', 'type'=>'text']); ?>

	      <?php if($errors->has('nombres')): ?> <p class="help-block"><?php echo e($errors->first('nombres')); ?></p> <?php endif; ?>

		</div>
		<div class="form-group <?php if($errors->has('apellidos')): ?> has-error <?php endif; ?> col-xs-12 col-sm-6 col-md-5">
			<label for="apellidos">Apellidos *</label>
	      <?php echo form::text('apellidos',null, ['id'=>'apellidos', 'class'=>'form-control', 'placeholder'=>'Apellidos Completo', 'maxlength'=>'50', 'type'=>'text']); ?>

	      <?php if($errors->has('apellidos')): ?> <p class="help-block"><?php echo e($errors->first('apellidos')); ?></p> <?php endif; ?>
		</div>
	</div>

	<div class="row">

	  	<div class="form-group  <?php if($errors->has('codigo')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-6 col-md-5">
			<label for="codigo">Codigo *</label>
	      <?php echo form::text('codigo',null, ['id'=>'codigo', 'class'=>'form-control', 'placeholder'=>'Codigo Empleado', 'maxlength'=>'10', 'type'=>'text']); ?>

	       <?php if($errors->has('codigo')): ?> <p class="help-block"><?php echo e($errors->first('codigo')); ?></p> <?php endif; ?>
		</div>

		<div class="form-group  <?php if($errors->has('cargo_id')): ?> has-error <?php endif; ?>   col-xs-12 col-sm-6 col-md-5">
			<label for="cargo_id">Cargo *</label>
			<select class="form-control" name="cargo_id">
	                <option value="" >Seleccionar...</option>
	              <?php foreach($cargos as $item): ?>
	                <option value="<?php echo e($item->id); ?>"><?php echo e($item->nombre); ?></option>
	              <?php endforeach; ?>
	          </select>
	          <?php if($errors->has('cargo_id')): ?> <p class="help-block"><?php echo e($errors->first('cargo_id')); ?></p> <?php endif; ?>
		</div>
	</div>

	<div class=" row col-lg-12 breadcrumb"><b><i>Datos de Usuarios</i></b></div>


	<div class="row">
		<div class="form-group  <?php if($errors->has('usuario')): ?> has-error <?php endif; ?>   col-xs-12 col-sm-6 col-md-5">
			<label for="usuario">Nombre Usuario *</label>
	      	<?php echo form::text('usuario',null, ['id'=>'usuario', 'class'=>'form-control', 'placeholder'=>'Nombre Usuario', 'maxlength'=>'20', 'type'=>'text']); ?>

			<?php if($errors->has('usuario')): ?> <p class="help-block"><?php echo e($errors->first('usuario')); ?></p> <?php endif; ?>
		</div>
	</div>

	<div class="row">
		<div class="form-group  <?php if($errors->has('email')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-6 col-md-5">
			<label for="email">Correo</label>
	        <?php echo form::text('email',null, ['id'=>'email', 'class'=>'form-control', 'placeholder'=>'Correo Electronico', 'maxlength'=>'30', 'type'=>'email']); ?>

			<?php if($errors->has('email')): ?> <p class="help-block"><?php echo e($errors->first('email')); ?></p> <?php endif; ?>
		</div>

		<div class="form-group  <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-6 col-md-5">
			<label for="type_id">Tipo Usuario *</label>
			<select class="form-control" name="type_id">
			    <option value="" >Seleccionar...</option>
			    <option value="1">Administrador</option>
			    <option value="2">Empleado</option>
			</select>
			<?php if($errors->has('type_id')): ?> <p class="help-block"><?php echo e($errors->first('type_id')); ?></p> <?php endif; ?>
		</div>
	</div>

	<div class="row">
		<div class="form-group  <?php if($errors->has('password')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-6 col-md-5">
			<label for="password">Contraseña *</label>
	        <?php echo form::password('password', ['id'=>'password', 'class'=>'form-control', 'placeholder'=>'Ingrese Contraseña', 'maxlength'=>'30', 'type'=>'password']); ?>

			<?php if($errors->has('password')): ?> <p class="help-block"><?php echo e($errors->first('password')); ?></p> <?php endif; ?>
		</div>


		<div class="form-group  <?php if($errors->has('password_confirmation')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-6 col-md-5">
			<label for="password_confirmation">Repetir Contraseña *</label>
	      <?php echo form::password('password_confirmation', ['id'=>'repassword', 'class'=>'form-control', 'placeholder'=>'Repita Contraseña', 'maxlength'=>'30', 'type'=>'password']); ?>

	      <?php if($errors->has('password_confirmation')): ?> <p class="help-block"><?php echo e($errors->first('password_confirmation')); ?></p> <?php endif; ?>
		</div>
	</div>



	<div class=" row col-lg-12 breadcrumb"><b><i>Datos de Localizaciones</i></b></div>

	<div class="row">
		<div class="form-group  <?php if($errors->has('grlocalizacion_id')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-6 col-md-5">
			<label for="grlocalizacion_id">Grupo Localizacion *</label>
			<select id="grlocalizacion" class="form-control" name="grlocalizacion_id">
			    <option value="0" >Seleccionar...</option>
			     <?php foreach($grlocalizacion as $item): ?>
	                <option value="<?php echo e($item->id); ?>"><?php echo e($item->nombre); ?></option>
	              <?php endforeach; ?>
			</select>
			<?php if($errors->has('grlocalizacion_id')): ?> <p class="help-block"><?php echo e($errors->first('grlocalizacion_id')); ?></p> <?php endif; ?>
		</div>

		<div class="form-group  <?php if($errors->has('localizacion_id')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-6 col-md-5">
			<label for="localizacion_id">Localizacion *</label>
			<select id="localizacion" class="form-control" name="localizacion_id">
			    <option value="0" >Selecciona un grupo</option>
			  <?php /*   <?php foreach($localizacion as $item): ?>
	               <option value="<?php echo e($item->id); ?>"><?php echo e($item->nombre); ?></option>
	             <?php endforeach; ?> */ ?>
			</select>
			<?php if($errors->has('localizacion_id')): ?> <p class="help-block"><?php echo e($errors->first('localizacion_id')); ?></p> <?php endif; ?>
		</div>
	</div>


	<div class="row">
		<div class="form-group  <?php if($errors->has('grdepartamento_id')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-6 col-md-5">
			<label for="grdepartamento_id">Grupo Departamento *</label>
			<select id="grdepartamento" class="form-control" name="grdepartamento_id">
			    <option value="0" >Seleccionar...</option>
			    <?php foreach($grdepartamento as $item): ?>
	                <option value="<?php echo e($item->id); ?>"><?php echo e($item->nombre); ?></option>
	              <?php endforeach; ?>
			</select>
			<?php if($errors->has('grdepartamento_id')): ?> <p class="help-block"><?php echo e($errors->first('grdepartamento_id')); ?></p> <?php endif; ?>
		</div>

		<div class="form-group  <?php if($errors->has('departamento_id')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-6 col-md-5">
			<label for="departamento_id">Departamento *</label>
			<select id="departamento" class="form-control" name="departamento_id">
			    <option value="0" >Selecciona un grupo</option>
			  <?php /*   <?php foreach($departamento as $item): ?>
	               <option value="<?php echo e($item->id); ?>"><?php echo e($item->nombre); ?></option>
	             <?php endforeach; ?> */ ?>
			</select>
			<?php if($errors->has('departamento_id')): ?> <p class="help-block"><?php echo e($errors->first('departamento_id')); ?></p> <?php endif; ?>
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
			$.get("<?php echo e(url('empleados/listaDepartamento')); ?>" +'/'+ argument, function(data) {
				limpiarSelectDepartamento(argument);

				$.each(data, function(key, element) {
					$('#departamento').append("<option value='" + element['id'] + "'>" + element['nombre'] + "</option>");
				});
			});
		}

		function obtenerLocalizacion(argument) {
			$.get("<?php echo e(url('empleados/listaLocalizacion')); ?>" +'/'+ argument, function(data) {
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