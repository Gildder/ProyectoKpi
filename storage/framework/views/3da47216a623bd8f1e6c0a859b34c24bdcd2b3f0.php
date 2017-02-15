<?php $__env->startSection('titulo'); ?>
      Seleccionar
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel"><?php echo e(Cache::get('emp_sado')); ?></p>
  </div>

  <div class="panel-body">

    <!--panelTab -->
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#datos">Indicadores</a></li>
    </ul>

    <div class="tab-content">
      <div id="datos" class="tab-pane fade in active">
        <div class="col-lg-12 breadcrumb">
          <a href="<?php echo e(route('supervisores.supervisados.index')); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
        </div>
        <div class="col-sm-12">
            <?php if($indicadores->count()<= 0): ?>
              <p>Este empleado, No tiene asignado ningun indicador KPI.</p>
            <?php endif; ?>

            <?php foreach($indicadores as $indicador): ?>
              <?php echo $__env->make('supervisores/supervisados/partials/panel_indicador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  <hr>
            <?php endforeach; ?>
        </div>
      
      </div>

    <!-- Fin Panel Tab -->

  </div>

  </div>
    
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>