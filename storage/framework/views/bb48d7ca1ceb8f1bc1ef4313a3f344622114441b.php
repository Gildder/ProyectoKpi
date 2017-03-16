<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
      		<p class="titulo-panel">Localizacion</p>

		</div>
		<div class="panel-body">
			
			<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


			<?php /* Opciones de Menu */ ?>
		    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
		      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		        <a  href="<?php echo e(route('localizaciones.localizacion.create')); ?>" class="btn btn-primary btn-sm" title="Nuevo"><span class="fa fa-plus">  </span>   <b>Nuevo</b></a>
		        
		      </div>
		      <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6" tabindex="2" >
		        <a  href="<?php echo e(route('localizaciones.localizacion.eliminados')); ?>" class="btn btn-danger btn-sm"  title="Eliminados"><span class="fa  fa-trash"></span>  <b></b></a>
		      </div>
		    </div>
		    <?php /* Fin Opciones Menu */ ?>


			<div class="row">
				<div class="col-lg-12">
		        	<?php echo $__env->make("localizaciones/localizacion/partials/tabla_localizacion", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>

		</div>
		<div class="panel-footer">
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>