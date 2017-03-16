<?php $__env->startSection('titulo'); ?>
	<?php echo e($ponderacion->nombre); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
	  <a href="<?php echo e(route('evaluadores.ponderacion.index')); ?>" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel"><?php echo e($ponderacion->nombre); ?></p>
	</div>

	<div class="panel-body">

  		<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
		  <li ><a data-toggle="tab" href="#tipos">Tipo Indicadores</a></li>
		  <li ><a data-toggle="tab" href="#indicadores">Indicadores</a></li>
		  <li ><a data-toggle="tab" href="#escalas">Escalas</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="content col-sm-6">

					<?php echo $__env->make('evaluadores/ponderacion/partials/datos_ponderacion', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	

					<?php echo $__env->make("evaluadores/ponderacion/delete", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div class="col-sm-12 panel-footer text-right">
					<a href="<?php echo e(route('evaluadores.ponderacion.edit', $ponderacion->id)); ?>" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
					<a href="#"  data-toggle="modal" data-target="#modal-delete-<?php echo e($ponderacion->id); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>
				</div>
			</div>

			<?php /* Tipos Indicadores */ ?>
			<div id="tipos" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p>Agregar las ponderacion que desea estimar a los Tipos de Indicadoers para <b><?php echo e($ponderacion->nombre); ?></b>.</p><br>
				</div>

				<?php /* Capa de Seleccion Empleado */ ?>
				<div class="col-sm-7">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Tipo de Indicador</p>
						</div>
						<div class="panel-body">
							<?php echo $__env->make('evaluadores/ponderacion/tipos/tabla_tiposindicadores', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
					</div>
				</div>

				<?php /* Capa de empleados Agregados */ ?>
				<div class="col-sm-5">
						<p class="titulo-panel">Tipos Agregados </p><br>
					<?php echo $__env->make('evaluadores/ponderacion/tipos/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<?php /* Fin Tipos Indicadores */ ?>

			<?php /* Indicadores */ ?>
			<div id="indicadores" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p>Agregar ponderacion a los Indicadores de  <b><?php echo e($ponderacion->nombre); ?></b>.</p><br>
				</div>
				<?php /* Capa de Seleccion cargos */ ?>
				<div class="row col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Indicador</p>
						</div>
						<div class="panel-body">
							<?php echo $__env->make('evaluadores/ponderacion/indicadores/tabla_indicadores', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
					</div>
				</div>

				<div class="col-sm-6">
		      		<p class="titulo-panel">Indicadores ponderados </p><br>
					<?php echo $__env->make('evaluadores/ponderacion/indicadores/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<?php /* Fin Indicadores */ ?>

			<?php /* Escalas */ ?>
			<div id="escalas" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p>Agregar escala a los Indicadores de  <b><?php echo e($ponderacion->nombre); ?></b>.</p><br>
				</div>
				<?php /* Capa de Seleccion cargos */ ?>
				<div class="row col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Seleccionar Escala</p>
						</div>
						<div class="panel-body">
							<?php echo $__env->make('evaluadores/ponderacion/escalas/tabla_escalas', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
					</div>
				</div>

				<div class="col-sm-6">
		      		<p class="titulo-panel">Escalas Agregadas</p><br>
					<?php echo $__env->make('evaluadores/ponderacion/escalas/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<?php /* Fin Escalas */ ?>
		</div>
		<!-- Fin Panel Tab -->

	</div>
	<div class="panel-footer">
	</div>
		
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>