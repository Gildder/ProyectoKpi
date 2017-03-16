<div class="form-group col-xs-12 col-sm-10 col-md-8">

	<div class="row">
		<div class="form-group <?php if($errors->has('nombre')): ?> has-error <?php endif; ?> col-sm-5 ">
              <label for="nombre" class="hidden-xs">Nombre</label>
              <?php echo form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']); ?>

              <?php if($errors->has('nombre')): ?> <p class="help-block"><?php echo e($errors->first('nombre')); ?></p> <?php endif; ?>
        </div>
        
		<div class="form-group <?php if($errors->has('grupoloc_id')): ?> has-error <?php endif; ?>  col-sm-5 ">
          <label for="grupoloc_id" class="hidden-xs">Grupo Localizacion</label>
            <select class="form-control" name="grupoloc_id">
                <?php foreach($grupo as $item): ?>
				    <?php if($item->idgrupo == $localizacion->grupoloc_id): ?>
				        <option value="<?php echo e($item->id); ?>" selected="selected" ><?php echo e($item->nombre); ?></option>
				    <?php else: ?>
				        <option value="<?php echo e($item->id); ?>" ><?php echo e($item->nombre); ?></option>
				    <?php endif; ?>
				 <?php endforeach; ?>
            </select>
            <?php if($errors->has('grupoloc_id')): ?> <p class="help-block"><?php echo e($errors->first('grupoloc_id')); ?></p> <?php endif; ?>

        </div>
	</div>

	<div class="row">
	  	<div class="form-group  <?php if($errors->has('direccion')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-6 col-md-5">
			<label for="direccion">Direccion </label>
	      <?php echo form::text('direccion',null, ['id'=>'direccion', 'class'=>'form-control', 'placeholder'=>'Ingresa la Direccion', 'maxlength'=>'30', 'type'=>'text']); ?>

	       <?php if($errors->has('direccion')): ?> <p class="help-block"><?php echo e($errors->first('direccion')); ?></p> <?php endif; ?>
		</div>

		<div class="form-group  <?php if($errors->has('telefono')): ?> has-error <?php endif; ?>   col-xs-12 col-sm-6 col-md-5">
			<label for="telefono">Telefono </label>
	      	<?php echo form::text('telefono',null, ['id'=>'telefono', 'class'=>'form-control', 'placeholder'=>'Ingresa el Telefono', 'maxlength'=>'20', 'type'=>'phono']); ?>

			<?php if($errors->has('telefono')): ?> <p class="help-block"><?php echo e($errors->first('telefono')); ?></p> <?php endif; ?>
		</div>
	</div>
</div>